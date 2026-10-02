<?php
session_start();

// citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
if (!isset($_SESSION["korisnik"])) {
	header("Location:index.php");
	exit;
}

// obrada podataka poslatih iz forme
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	header("Location:unosSP.php");
	exit;
}

// preuzimanje i provera vrednosti sa forme
$iz = isset($_POST["iz"]) ? filter_var($_POST["iz"], FILTER_VALIDATE_INT) : false;
$ka = isset($_POST["ka"]) ? filter_var($_POST["ka"], FILTER_VALIDATE_INT) : false;
$vreme = isset($_POST["vreme"]) ? trim($_POST["vreme"]) : "";
$cena = isset($_POST["cena"]) ? trim($_POST["cena"]) : "";

if (!$iz || !$ka || $iz === $ka || !preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $vreme)
	|| !preg_match('/^\d{1,8}(\.\d{1,2})?$/', $cena)) {
	echo "Неисправни подаци. Проверите полазно место, одредиште, време и цену.";
	echo "<br><br><a href=\"unosSP.php\">ПОВРАТАК</a>";
	exit;
}

$vreme .= ":00";
$cena = (float) $cena;

require "klase/BaznaKonekcija.php";
require "klase/BaznaTabela.php";
require "klase/BaznaTransakcija.php";
require "klase/Upis.php";
require "klase/DBRedVoznjeSP.php";

// koristimo klasu za poziv procedure za konekciju
$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
$KonekcijaObject->connect();

if (!$KonekcijaObject->konekcijaDB) {
	echo "Неуспешна конекција са базом података.";
	exit;
}

// provera poslovne logike - ogranicenja polazaka za polazni grad
$UnosObject = new Upis($KonekcijaObject, 'red_voznje');
if ($UnosObject->DaLiImaMestaZaUpis($iz) !== "DA") {
	$KonekcijaObject->disconnect();
	echo "Није могуће додати полазак: достигнут је лимит за изабрано полазно место.";
	echo "<br><br><a href=\"unosSP.php\">ПОВРАТАК</a>";
	exit;
}

// zapocinjanje transakcije
$TransakcijaObject = new Transakcija($KonekcijaObject);
$TransakcijaObject->ZapocniTransakciju();

// upis novog reda voznje primenom stored procedure
$RedVoznjeObject = new DBRedVoznjeSP($KonekcijaObject, 'red_voznje');
$RedVoznjeObject->Iz = $iz;
$RedVoznjeObject->Ka = $ka;
$RedVoznjeObject->Vreme = $vreme;
$RedVoznjeObject->Cena = $cena;
$greska1 = $RedVoznjeObject->DodajRedVoznje();

if (empty($greska1)) {
	// inkrement broja polazaka kroz tabelu gradovi
	$SQL = "UPDATE `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`gradovi` SET ukupan_broj_polazaka = ukupan_broj_polazaka + 1 WHERE id = " . (int) $iz;
	$TabelaObject = new Tabela($KonekcijaObject, 'gradovi');
	$greska2 = $TabelaObject->IzvrsiAktivanSQLUpit($SQL);
} else {
	$greska2 = "";
}

// zatvaranje transakcije
$UtvrdjenaGreska = $greska1 . $greska2;
$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
$KonekcijaObject->disconnect();

// prikaz uspeha aktivnosti
if ($UtvrdjenaGreska) {
	echo "Грешка: " . htmlspecialchars($UtvrdjenaGreska, ENT_QUOTES, 'UTF-8');
	echo "<br><br><a href=\"unosSP.php\">ПОВРАТАК</a>";
} else {
	echo "Ред вожње је сачуван.";
	echo "<br><br><a href=\"RedvoznjeLista.php\">ПОВРАТАК</a>";
}
?>

