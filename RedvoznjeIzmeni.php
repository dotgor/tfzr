 <?php
        
		session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $korisnik=$_SESSION["korisnik"];
      
	  // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
				if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	
	   
	   // preuzimanje vrednosti sa forme
	   $IdRedaVoznje = isset($_POST['IdRedaVoznje']) ? (int) $_POST['IdRedaVoznje'] : 0;
	   $iz = isset($_POST['iz']) ? (int) $_POST['iz'] : 0;
	   $ka = isset($_POST['ka']) ? (int) $_POST['ka'] : 0;
	   $vreme = isset($_POST['vreme']) ? trim($_POST['vreme']) : '';
	   $cena = isset($_POST['cena']) ? trim($_POST['cena']) : '';

	   if ($IdRedaVoznje < 1 || $iz < 1 || $ka < 1 || $iz === $ka
		|| !preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $vreme)
		|| !preg_match('/^\d{1,8}(\.\d{1,2})?$/', $cena)) {
		echo "Неисправни подаци за ред вожње.";
		echo "<br><br><a href=\"RedvoznjeLista.php\">ПОВРАТАК</a>";
		exit;
	   }

	   $vreme .= ':00';
	   $cena = number_format((float) $cena, 2, '.', '');

	   // koristimo klasu za poziv procedure za konekciju
		require "klase/BaznaKonekcija.php";
		require "klase/BaznaTabela.php";
		require "klase/BaznaTransakcija.php";
		require "klase/Upis.php";
		$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
		$KonekcijaObject->connect();
		if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
		{
			$RedVoznjeObject = new Tabela($KonekcijaObject, 'red_voznje');
			$RedVoznjeObject->UcitajSvePoUpitu("SELECT iz FROM `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`red_voznje` WHERE id = " . $IdRedaVoznje);
			if ($RedVoznjeObject->BrojZapisa < 1) {
				$greska = "Ред вожње није пронађен.";
			} else {
				$StariIz = (int) $RedVoznjeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($RedVoznjeObject->Kolekcija, 0, 0);
				$UnosObject = new Upis($KonekcijaObject, 'red_voznje');
				if ($StariIz !== $iz && $UnosObject->DaLiImaMestaZaUpis($iz) !== "DA") {
					$greska = "Достигнут је лимит полазака за изабрано полазно место.";
				} else {
					$TransakcijaObject = new Transakcija($KonekcijaObject);
					$TransakcijaObject->ZapocniTransakciju();
					$SQL = "UPDATE `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`red_voznje` SET iz = " . $iz . ", ka = " . $ka . ", vreme = '" . $vreme . "', cena = " . $cena . " WHERE id = " . $IdRedaVoznje;
					$greska = $RedVoznjeObject->IzvrsiAktivanSQLUpit($SQL);
					if (empty($greska) && $StariIz !== $iz) {
						$SQL = "UPDATE `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`gradovi` SET ukupan_broj_polazaka = ukupan_broj_polazaka - 1 WHERE id = " . $StariIz . " AND ukupan_broj_polazaka > 0";
						$greska = $RedVoznjeObject->IzvrsiAktivanSQLUpit($SQL);
						if (empty($greska)) {
							$SQL = "UPDATE `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`gradovi` SET ukupan_broj_polazaka = ukupan_broj_polazaka + 1 WHERE id = " . $iz;
							$greska = $RedVoznjeObject->IzvrsiAktivanSQLUpit($SQL);
						}
					}
					$TransakcijaObject->ZavrsiTransakciju($greska);
				}
			}
		}
		else
		{
			$greska = "Nije uspostavljena konekcija ka bazi podataka!";
		}
		
    $KonekcijaObject->disconnect();
	   
	// prikaz uspeha aktivnosti	
	//echo "Ukupno procesirano $retval zapisa";
	if ((isset($greska)) and (!empty($greska)) and ($greska!=null) and ($greska!="")){
		echo "ГРЕШКА:";
		echo "<br><br>"; 
		echo htmlspecialchars($greska, ENT_QUOTES, 'UTF-8');
		echo "<br><br>";
		echo "<a href=\"RedvoznjeLista.php\">ПОВРАТАК</a>";
	}else {
		//echo "Snimljena izmena uspesno!";	
		header ('Location:RedvoznjeLista.php');
	}		
	 
      ?>

