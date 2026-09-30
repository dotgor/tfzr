<?php
class DBStudent extends Tabela 
// rad sa pogledom
{

// METODE

// konstruktor

public function DajSvePodatkeOStudentima($filterParametar)
{
	if (isset($filterParametar))
	{
		// nad pogledom se moze dodati filter, jer se pogled koristi kao da je tabela
		$upit="select * from `".$this->NazivBazePodataka."`.`SviPodacioStudentimaSaSlikom` where `BrojIndeksa`='".$filterParametar."'";
	}
	else
	{
		$upit="select * from `".$this->NazivBazePodataka."`.`SviPodacioStudentimaSaSlikom`";
	}
	$this->UcitajSvePoUpitu($upit);
	// sada raspolazemo sa:
	//$this->Kolekcija 
	//$this->BrojZapisa
}


}
?>