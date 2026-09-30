<?php
class DBSmer extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $Oznaka;
public $Naziv; 
public $UkupanBrojStudenata;

// METODE

// konstruktor

public function UcitajKolekcijuSvihSmerova()
{
$SQL = "select * from `Smer` ORDER BY Naziv ASC";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
//return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

public function InkrementirajBrojStudenata($IDSmer)
{
	// izdvajanje stare vrednosti broja vozila za taj tip
	//$SQL = "select UkupanBrojStudenata from `".$this->bazapodataka."`.`smer` WHERE Oznaka=".$IDSmer;
	$KriterijumFiltriranja="Oznaka='".$IDSmer."'";
	$StaraVrednostUkBrStudenata=$this->DajVrednostJednogPoljaPrvogZapisa ('UkupanBrojStudenata', $KriterijumFiltriranja, 'UkupanBrojStudenata'); 
	
	// izracunavanje nove vrednosti
	$NovaVrednostUkBrStudenata=$StaraVrednostUkBrStudenata + 1;
	
	// izvrsavanje izmene
    $SQL = "UPDATE `".$this->NazivBazePodataka."`.`smer` SET UkupanBrojStudenata=".$NovaVrednostUkBrStudenata." WHERE Oznaka='".$IDSmer."'";
	$greska= $this->IzvrsiAktivanSQLUpit($SQL);

	return $greska;
	
	}

	public function DekrementirajBrojStudenata($IDSmer)
	{
		// izdvajanje stare vrednosti broja vozila za taj tip
		//$SQL = "select UkupanBrojStudenata from `".$this->bazapodataka."`.`smer` WHERE Oznaka=".$IDSmer;
		$KriterijumFiltriranja="Oznaka='".$IDSmer."'";
		$StaraVrednostUkBrStudenata=$this->DajVrednostJednogPoljaPrvogZapisa ('UkupanBrojStudenata', $KriterijumFiltriranja, 'UkupanBrojStudenata'); 
		
		// izracunavanje nove vrednosti
		$NovaVrednostUkBrStudenata=$StaraVrednostUkBrStudenata - 1;
		
		// izvrsavanje izmene
		$SQL = "UPDATE `".$this->NazivBazePodataka."`.`smer` SET UkupanBrojStudenata=".$NovaVrednostUkBrStudenata." WHERE Oznaka='".$IDSmer."'";
		$greska= $this->IzvrsiAktivanSQLUpit($SQL);
	
		return $greska;
		
		}
	
// ostale metode 

}
?>