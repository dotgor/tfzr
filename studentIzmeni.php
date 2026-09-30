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
	   

	      // -------------------------------------
		// UPLOAD FAJLA SLIKE

		if (isset($_FILES["nazivFajlaFotografije"]["name"]))
		{
			$name = $_FILES["nazivFajlaFotografije"]["name"];
			//$size = $_FILES['nazivFajlaFotografije']['size']
			//$type = $_FILES['nazivFajlaFotografije']['type']
			$tmp_name = $_FILES['nazivFajlaFotografije']['tmp_name'];
			$error = $_FILES['nazivFajlaFotografije']['error'];
	
			if (isset ($name)) {
				if (!empty($name)) {
							$location = 'SlikeStudenata/';
							if  (move_uploaded_file($tmp_name, $location.$name)){
										//echo 'Uploaded';    
							}
						} else {
								//echo 'please choose a file';
								}
						} 
			$nazivFajlaFotografije=$name;
		}
		$StariNazivFajlaFotografije=$_POST['StariNazivFajlaFotografije'];
		// korekcija
		if (($nazivFajlaFotografije=="") or ($nazivFajlaFotografije==null) or (!isset($nazivFajlaFotografije)) or (empty($nazivFajlaFotografije))){
			$nazivFajlaFotografije=$StariNazivFajlaFotografije;
		}

	   // preuzimanje vrednosti sa forme
	   $brojIndeksa=$_POST['brojIndeksa'];
	   $StariBrojIndeksa=$_POST['StariBrojIndeksa'];
	   $prezime=$_POST['prezime'];
	   $ime=$_POST['ime'];

	   if (isset($_POST['oznakaSmera']))
	   {
		$oznakaSmera=$_POST['oznakaSmera'];
	   }
	   else // ako nije nista promenjeno
	   {
		$StaraOznakaSmera=$_POST['StaraOznakaSmera'];
		$oznakaSmera=$StaraOznakaSmera;
	   }
	  
	   // koristimo klasu za poziv procedure za konekciju
		require "klase/BaznaKonekcija.php";
		require "klase/BaznaTabela.php";
		$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
		$KonekcijaObject->connect();
		if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
		{	
			require "klase/DBStudent.php";
			$StudentObject = new DBStudent($KonekcijaObject, 'student');
			//echo "Naziv fajla fotografije:".$nazivFajlaFotografije;
			$greska=$StudentObject->IzmeniStudenta($StariBrojIndeksa, $brojIndeksa, $prezime, $ime, $oznakaSmera, $nazivFajlaFotografije);
		}
		else
		{
			echo "Nije uspostavljena konekcija ka bazi podataka!";
		}
		
    $KonekcijaObject->disconnect();
	   
	// prikaz uspeha aktivnosti	
	//echo "Ukupno procesirano $retval zapisa";
	if ((isset($greska)) and (!empty($greska)) and ($greska!=null) and ($greska!="")){
		echo "ГРЕШКА:";
		echo "<br><br>"; 
		echo $greska;
		echo "<br><br>";
		echo "<a href=\"StudentiLista.php\">ПОВРАТАК</a>";	
	}else {
		//echo "Snimljena izmena uspesno!";	
		header ('Location:StudentiLista.php');		
	}		
	 
      ?>

