<?php
class DBRedVoznjeSP extends Tabela
// rad sa stored procedurom za snimanje novog reda voznje
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $Iz;
public $Ka;
public $Vreme;
public $Cena;

// METODE

// konstruktor

public function DodajRedVoznje()
{
	$GreskarezultatPar1 = $this->IzvrsiAktivanSQLUpit("SET @IzParametar=" . (int) $this->Iz);
	$GreskarezultatPar2 = $this->IzvrsiAktivanSQLUpit("SET @KaParametar=" . (int) $this->Ka);
	$GreskarezultatPar3 = $this->IzvrsiAktivanSQLUpit("SET @VremeParametar='" . $this->Vreme . "'");
	$GreskarezultatPar4 = $this->IzvrsiAktivanSQLUpit("SET @CenaParametar=" . number_format((float) $this->Cena, 2, '.', ''));
	$GreskarezultatCall = $this->IzvrsiAktivanSQLUpit("CALL `DodajRedVoznje`(@IzParametar,@KaParametar,@VremeParametar,@CenaParametar)");

	$greska = $GreskarezultatPar1 . $GreskarezultatPar2 . $GreskarezultatPar3 . $GreskarezultatPar4 . $GreskarezultatCall;
	return $greska;
}


}
?>