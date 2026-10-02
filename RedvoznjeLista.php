<?php
	   session_start();
     	   
	   // citanje vrednosti iz sesije
	   $korisnik=$_SESSION["korisnik"];
      
	  // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
				if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	

// REALIZACIJA CITANJA SVIH I FILTRIRANIH PODATAKA

//KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		// prikaz svih redova voznje sa nazivima gradova
		$RedVoznjeObject = new Tabela($KonekcijaObject, "red_voznje");
		$UpitRedaVoznje = "SELECT red.id, polazni.naziv, odredisni.naziv, red.vreme, red.cena "
			. "FROM `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`red_voznje` red "
			. "INNER JOIN `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`gradovi` polazni ON polazni.id = red.iz "
			. "INNER JOIN `" . $KonekcijaObject->KompletanNazivBazePodataka . "`.`gradovi` odredisni ON odredisni.id = red.ka "
			. "ORDER BY red.iz, red.vreme";
		$RedVoznjeObject->UcitajSvePoUpitu($UpitRedaVoznje);
		$RedVoznjeObject->PrebaciKolekcijuUListu($RedVoznjeObject->Kolekcija);




    }
	else
	{
		echo "Неуспешна конекција!";
	}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>ТФ М Пупин Зрењанин</title>
<meta charset="UTF-8">
<!-----STIL PRIKAZA CSS---->
<!-----<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">--->
<!----- POSTAVLJEN U PHP DA BI SE ODMAH VIDELA PROMENA, A NE DA VUCE IZ KESIRANOG FOLDERA U BROWSERU---->
<?php include 'css/stil.php';?>
</head>
<body>

<!-----VELIKA TABELA KOJA SADRZI SVE---->
<!-----10% SADRZAJ 10%---->
<table class="no-spacing" style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" style="border-spacing: 0;">

<!-------------------------- ZAGLAVLJE ------->
<?php include 'delovi/zaglavljewelcome.php';?>


<!-------------------------- DONJI DEO  ------->
<tr style="padding:0px;">

<!-----LEVO PRAZNINA---->
<td style="width:10%;">
</td>

<!------------------------------------------------------------------------------------------->
<!---------------------- SREDINA DONJEG DELA SA SADRZAJEM pocinje ovde ---------------------->
<td align="center" valign="middle" style="width:80%; padding:0" > 

<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#003366">

<tr>
<td style="width:1%;">
</td>

<td style="width:15%;padding:0" cellspacing="0" cellpadding="0" border="0" valign="top">
<?php include 'delovi/menilevoadmin.php';?>
</td>

<td style="width:1%;">
</td>

<td style="width:80%;padding:0" cellspacing="0" cellpadding="0" border="0" valign="top">
<!------- GLAVNI SADRZAJ desno ----------->  
<?php include 'delovi/desnoRedvoznjeLista.php';?>
</td>

<td style="width:1%;">
</td>

</tr>
</table>

</td>
<!---------------------- SADRZAJ zavrsava ovde ---------------------->

<!-----DESNO PRAZNINA---->
<td style="width:10%;">
</td>

</tr>
<!---------------------- DONJI DEO zavrsava ovde ---------------------->


<tr style="padding:0px;">
<td style="width:10%;"></td>
<td align="center" valign="middle"></td>
<td style="width:10%;"></td>
</tr>
<!--- DONJI DEO sa donjom ivicom zavrsava ovde  ------->
<!-- footer panel starts here -->
<?php include 'delovi/footer.php';?>

</table>

</body>
</html>