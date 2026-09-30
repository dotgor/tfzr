<?php
class DBStudent extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $BrojIndeksa;
public $Prezime;
public $Ime;
public $OznakaSmera;
public $NazivFajlaFotografije;

// METODE

// konstruktor

public function DajKolekcijuSvihStudenata()
{
$SQL = "select * from `student` ORDER BY prezime ASC";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

public function UcitajStudentaPoBrojuIndeksa($BrojIndeksaParametar)
{
$SQL = "select * from `student` where `BrojIndeksa`='".$BrojIndeksaParametar."'";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
// raspolazemo sa:
// $Kolekcija;
//  $BrojZapisa;
}

public function DajOznakuSmeraStudenta($BrojIndeksaParametar)
{
	$SQL = "select `OznakaSmera` from `student` where `BrojIndeksa`='".$BrojIndeksaParametar."'";
	$this->UcitajSvePoUpitu($SQL);
	return $this->DajVrednostPoRednomBrojuZapisaPoRBPolja ($this->Kolekcija, 0, 0);;
}

public function DodajNovogStudenta()
{
	$SQL = "INSERT INTO `student` (BrojIndeksa, Prezime, Ime, OznakaSmera, NazivFajlaFotografije) VALUES ('$this->BrojIndeksa','$this->Prezime', '$this->Ime', '$this->OznakaSmera', '$this->NazivFajlaFotografije')";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}



public function ObrisiStudenta($IdZaBrisanje)
{
	$SQL = "DELETE FROM `student` WHERE BrojIndeksa='".$IdZaBrisanje."'";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}

// TO DO

public function IzmeniStudenta($StariBrojIndeksa, $brojIndeksa, $prezime, $ime, $oznakaSmera, $nazivFajlaFotografije)
{
	$SQL = "UPDATE `student` SET BrojIndeksa='".$brojIndeksa."', Prezime='".$prezime."', Ime='".$ime."', OznakaSmera='".$oznakaSmera."', NazivFajlaFotografije='".$nazivFajlaFotografije."' WHERE BrojIndeksa='".$StariBrojIndeksa."'";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}

// ostale metode 




}
?>