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
	   $IdZaBrisanje=$_POST['BrojIndeksa'];
	   
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
		
		require "klase/DBStudent.php";
		$StudentObject = new DBStudent($KonekcijaObject, 'student');
		$OznakaSmera=$StudentObject->DajOznakuSmeraStudenta($IdZaBrisanje);
		$greska1=$StudentObject->ObrisiStudenta($IdZaBrisanje);

		// denkrement broja studenata kroz klasu DBSmer
		require "klase/DBSmer.php";
		$SmerObject = new DBSmer($KonekcijaObject, 'smer');
		$greska2=$SmerObject->DekrementirajBrojStudenata($OznakaSmera);
		
		// zatvaranje transakcije
		//$UtvrdjenaGreska=$greska1 or $greska2;
		$UtvrdjenaGreska=$greska1.$greska2;
		$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
	}
		
    $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	//echo "Ukupno procesirano $retval zapisa";
	//echo "Greska $greska";	

	if ($UtvrdjenaGreska) {
		echo "Greska: $UtvrdjenaGreska";
		echo "<br><br>";
		echo "<a href=\"StudentiLista.php\">ПОВРАТАК</a>";		
		}	
		else
		{
			echo "Snimljeno!";	
			echo "<br><br>";
			echo "<a href=\"StudentiLista.php\">ПОВРАТАК</a>";	
			//header ('Location:StudentiLista.php');		
		}
		
	  
      ?>

