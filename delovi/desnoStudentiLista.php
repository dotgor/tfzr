
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="#D8E7F4">

<tr>
<td style="width:5%;">
</td>

<td>
</br> 
<font face="Trebuchet MS" color="darkblue" size="4px">
<b>СПИСАК СТУДЕНАТА</b></br> 
</br> 
<form action="" method="GET">
Број индекса: <input type="text" name="filter" />
<input type="submit" name="filtriraj" value="FILTRIRAJ" />
<input type="submit" name="svi" value="SVI" />
</form>
</font>

</td>

<td style="width:5%;">
</td>
</tr>


<tr>
<td style="width:5%;">
</td>

<td align="left">
<br/>
<font face="Trebuchet MS" color="darkblue" size="4px">

<?php
// PRETHODNI KOD PREUZIMA PODATKE I TO JE NA INDEX.PHP

if ($StudentViewObject->BrojZapisa==0)
	{
		echo "НЕМА ЗАПИСА У ТАБЕЛИ!";
	}
else
	{
		// ------------ zaglavlje ----------------
		echo "<table style=\"width:90%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"#D8E7F4\">";
		echo "<tr>";
		echo "<td style=\"width:10%;\">";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">&nbsp;БРОЈ ИНДЕКСА&nbsp;</font></b><br/>";
		echo "</td>";
		echo "<td style=\"width:20%;\">";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">&nbsp;ПРЕЗИМЕ&nbsp;</font></b><br/>";
		echo "</td>";
		echo "<td style=\"width:20%;\">";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">&nbsp;ИМЕ&nbsp;</font></b><br/>";
		echo "</td>";
		echo "<td style=\"width:50%;\">";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">&nbsp;НАЗИВ СМЕРА&nbsp;</font></b><br/>";
		echo "</td>";
		echo "<td>";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">IZMENA</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">BRISANJE</font><br/>";
		echo "</td>";
		echo "</tr>";

		for ($RBZapisa = 0; $RBZapisa < $StudentViewObject->BrojZapisa; $RBZapisa++) 
		{
							
		// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
		$BrojIndeksa=$StudentViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($StudentViewObject->Kolekcija, $RBZapisa, 0);//mysql_result($result,$row,"REGISTARSKIBROJ");
		$Prezime=$StudentViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($StudentViewObject->Kolekcija, $RBZapisa, 1);
		$Ime=$StudentViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($StudentViewObject->Kolekcija, $RBZapisa, 2);
		$NazivSmera=$StudentViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($StudentViewObject->Kolekcija, $RBZapisa, 3);

		// CRTANJE REDA TABELE SA PODACIMA
		echo "<tr>";
		echo "<td>";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$BrojIndeksa</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$Prezime</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$Ime</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$NazivSmera</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<form ACTION=\"StudentIzmeniForm.php\" METHOD=\"POST\">";
		echo "<input type=\"hidden\" name=\"BrojIndeksa\" value=\"$BrojIndeksa\">";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\"><input TYPE=\"submit\" name=\"izmeniStudenta\" value=\"IZMENI\" /></font></b>";
		echo "</form>";
		echo "</td>";
		echo "<td>";
		echo "<form ACTION=\"StudentObrisi.php\" METHOD=\"POST\">";
		echo "<input type=\"hidden\" name=\"BrojIndeksa\" value=\"$BrojIndeksa\">";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\"><input TYPE=\"submit\" name=\"obrisiStudenta\" value=\"OBRISI\"  onclick=\"return confirm('Da li ste sigurni da zelite da obrisete zapis?')\"/></font></b>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";

		}  //za for 
		echo "<tr>";
		echo "<td style=\"width:10%;\">";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
		echo "</td>";
		echo "<td style=\"width:20%;\">";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
		echo "</td>";
		echo "<td style=\"width:20%;\">";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
		echo "</td>";
		echo "<td align=\"right\">";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">УКУПНO:".$StudentViewObject->BrojZapisa."&nbsp;&nbsp;</font><br/>";
		echo "</td>";
		echo "<td align=\"right\">";
		echo "</td>";
		echo "<td style=\"width:20%;\">";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
		echo "</td>";
		echo "<td align=\"right\">";
		echo "</td>";
		echo "</tr>";

		echo "</table>";
		echo "<br/>";
		echo "<br/>";
	}
$KonekcijaObject->disconnect();

?>



</td>

<td style="width:5%;">
</td>

</tr>
</table>

    