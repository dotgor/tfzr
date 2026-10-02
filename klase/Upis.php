<?php
class Upis extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
// METODE

// konstruktor nasledjuje od bazne klase Tabela

public function DaLiImaMestaZaUpis($GradIzParametar)
{
// incijalizacija promenljive za izlaz
$odgovor="NE";

// izdvajanje ogranicenja iz XML
$GradIdParametar = (int) $GradIzParametar;
$SQLGrad = "SELECT naziv FROM `" . $this->NazivBazePodataka . "`.`gradovi` WHERE id = " . $GradIdParametar;
$this->UcitajSvePoUpitu($SQLGrad);
if ($this->BrojZapisa < 1) {
	return $odgovor;
}
$NazivGrada = $this->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->Kolekcija, 0, 0);
$xml=simplexml_load_file(__DIR__ . DIRECTORY_SEPARATOR . $NazivGrada . ".xml") or die("Nije uspesno ucitavanje fajla sa ogranicenjem!");
$maxBrojPolazaka=$xml->MaxBrPolazaka;

// izdvajanje koliko trenutno imamo upisanih za taj smer u bazi podataka
$NazivTrazenogPolja="count(`id`)";
$KriterijumFiltriranja="`iz`='".$GradIdParametar."'";
$KriterijumSortiranja="`id`"; // nema potrebe da se sortira, ali ne menjamo baznu klasu
$trenutanBrojPolazaka=$this->DajVrednostJednogPoljaPrvogZapisa($NazivTrazenogPolja, $KriterijumFiltriranja, $KriterijumSortiranja); 

// uporedjivanje max i trenutno i odlucivanje
if ($trenutanBrojPolazaka<$maxBrojPolazaka)
{
$odgovor="DA";
}
else
{
$odgovor="NE";
}

//vracanje odgovora
return $odgovor;
}


}
?>