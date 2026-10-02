<?php
session_start();

// citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
if (!isset($_SESSION["korisnik"])) {
	header("Location:index.php");
	exit;
}

// obrada podataka poslatih iz forme
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	header("Location:unos.php");
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
	echo "<br><br><a href=\"unos.php\">ПОВРАТАК</a>";
	exit;
}

$vreme .= ":00";
$cena = (float) $cena;

require "klase/BaznaKonekcija.php";
require "klase/BaznaTabela.php";
require "klase/BaznaTransakcija.php";
require "klase/Upis.php";

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
	echo "<br><br><a href=\"unos.php\">ПОВРАТАК</a>";
	exit;
}

// zapocinjanje transakcije
$TransakcijaObject = new Transakcija($KonekcijaObject);
$TransakcijaObject->ZapocniTransakciju();

// upis novog reda voznje
$RedVoznjeObject = new Tabela($KonekcijaObject, 'red_voznje');
$CenaSQL = number_format($cena, 2, '.', '');
$SQL = "INSERT INTO `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`red_voznje` (iz, ka, vreme, cena) VALUES (" . $iz . ", " . $ka . ", '" . $vreme . "', " . $CenaSQL . ")";
$greska1 = $RedVoznjeObject->IzvrsiAktivanSQLUpit($SQL);

if (empty($greska1)) {
	// inkrement broja polazaka kroz tabelu gradovi
	$SQL = "UPDATE `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`gradovi` "
		. "SET ukupan_broj_polazaka = ukupan_broj_polazaka + 1 WHERE id = " . $iz;
	$greska2 = $RedVoznjeObject->IzvrsiAktivanSQLUpit($SQL);
} else {
	$greska2 = "";
}

$UtvrdjenaGreska = $greska1 . $greska2;

if (empty($UtvrdjenaGreska)) {
	// zatvaranje transakcije
	$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
	$poruka = "Ред вожње је сачуван.";
} else {
	$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
	$poruka = "Грешка при упису: " . $UtvrdjenaGreska;
}

$KonekcijaObject->disconnect();
// prikaz rezultata aktivnosti
echo htmlspecialchars($poruka, ENT_QUOTES, 'UTF-8');
echo "<br><br><a href=\"unos.php\">ПОВРАТАК</a>";
?>

