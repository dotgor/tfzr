 <?php
        
		session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $korisnik=$_SESSION["korisnik"];
      
	  // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
				if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	
	   
	   // preuzimanje vrednosti sa forme
	   $IdRedaVoznje = isset($_POST['IdRedaVoznje']) ? (int) $_POST['IdRedaVoznje'] : 0;
	   
      // koristimo klasu za poziv procedure za konekciju
	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		
		require "klase/BaznaTransakcija.php";
		$TransakcijaObject = new Transakcija($KonekcijaObject);
		$TransakcijaObject->ZapocniTransakciju();
		
		$RedVoznjeObject = new Tabela($KonekcijaObject, 'red_voznje');
		$RedVoznjeObject->UcitajSvePoUpitu("SELECT iz FROM `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`red_voznje` WHERE id = " . $IdRedaVoznje);
		if ($IdRedaVoznje < 1 || $RedVoznjeObject->BrojZapisa < 1) {
			$greska1 = "Ред вожње није пронађен.";
			$greska2 = "";
		} else {
			$GradIz = (int) $RedVoznjeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($RedVoznjeObject->Kolekcija, 0, 0);
			$greska1 = $RedVoznjeObject->IzvrsiAktivanSQLUpit("DELETE FROM `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`red_voznje` WHERE id = " . $IdRedaVoznje);

			// denkrement broja polazaka kroz tabelu gradovi
			if (empty($greska1)) {
				$greska2 = $RedVoznjeObject->IzvrsiAktivanSQLUpit("UPDATE `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`gradovi` SET ukupan_broj_polazaka = ukupan_broj_polazaka - 1 WHERE id = " . $GradIz . " AND ukupan_broj_polazaka > 0");
			} else {
				$greska2 = "";
			}
		}
		
		// zatvaranje transakcije
		//$UtvrdjenaGreska=$greska1 or $greska2;
		$UtvrdjenaGreska=$greska1.$greska2;
		$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
	}
	else
	{
		$UtvrdjenaGreska = "Nije uspostavljena konekcija ka bazi podataka!";
	}
		
    $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	//echo "Ukupno procesirano $retval zapisa";
	//echo "Greska $greska";	

	if ($UtvrdjenaGreska) {
		echo "Greska: $UtvrdjenaGreska";
		echo "<br><br>";
		echo "<a href=\"RedvoznjeLista.php\">ПОВРАТАК</a>";
		}	
		else
		{
			echo "Snimljeno!";	
			echo "<br><br>";
			echo "<a href=\"RedvoznjeLista.php\">ПОВРАТАК</a>";
			//header ('Location:RedvoznjeLista.php');
		}
		
	  
      ?>

