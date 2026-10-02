<?php
class DBRedVoznjeV extends Tabela 
// rad sa pogledom
{

// METODE

// konstruktor

public function Listing()
{
	$upit="select * from `".$this->NazivBazePodataka."`.`Listing`";
	$this->UcitajSvePoUpitu($upit);
}


}
?>