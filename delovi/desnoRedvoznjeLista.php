
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
<b>РЕД ВОЖЊЕ АУТОБУСА</b></br>
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
// PRETHODNI KOD PREUZIMA PODATKE IZ BAZE I POPUNJAVA KOLEKCIJU

if (!$KonekcijaObject->konekcijaDB)
	{
		echo "Неуспешна конекција са базом података.";
	}
elseif ($RedVoznjeObject->BrojZapisa==0)
	{
		echo "НЕМА УНЕТИХ ПОЛАЗАКА!";
	}
else
	{
		// ------------ zaglavlje ----------------
		echo "<table style=\"width:90%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"#D8E7F4\">";
		echo "<tr>";
			echo "<td style=\"width:10%;\">";
			echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">&nbsp;ОД МЕСТА&nbsp;</font></b><br/>";
		echo "</td>";
		echo "<td style=\"width:20%;\">";
			echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">&nbsp;ДО МЕСТА&nbsp;</font></b><br/>";
		echo "</td>";
		echo "<td style=\"width:20%;\">";
			echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">&nbsp;ВРЕМЕ ПОЛАСКА&nbsp;</font></b><br/>";
		echo "</td>";
		echo "<td style=\"width:50%;\">";
			echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">&nbsp;ЦЕНА&nbsp;</font></b><br/>";
		echo "</td>";
		echo "<td>";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">IZMENA</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">BRISANJE</font><br/>";
		echo "</td>";
		echo "</tr>";

		for ($RBZapisa = 0; $RBZapisa < $RedVoznjeObject->BrojZapisa; $RBZapisa++)
		{
							
		// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
		$RedVoznje=$RedVoznjeObject->ListaZapisa[$RBZapisa];
		$IdRedaVoznje=(int) $RedVoznje[0];
		$GradIz=htmlspecialchars($RedVoznje[1], ENT_QUOTES, 'UTF-8');
		$GradDo=htmlspecialchars($RedVoznje[2], ENT_QUOTES, 'UTF-8');
		$Vreme=htmlspecialchars(substr($RedVoznje[3], 0, 5), ENT_QUOTES, 'UTF-8');
		$Cena=htmlspecialchars(number_format((float) $RedVoznje[4], 2, ',', '.'), ENT_QUOTES, 'UTF-8');

		// CRTANJE REDA TABELE SA PODACIMA
		echo "<tr>";
		echo "<td>";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$GradIz</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$GradDo</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$Vreme</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$Cena</font><br/>";
		echo "</td>";
		echo "<td>";
		echo "<form ACTION=\"RedvoznjeIzmeniForm.php\" METHOD=\"POST\">";
		echo "<input type=\"hidden\" name=\"IdRedaVoznje\" value=\"$IdRedaVoznje\">";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\"><input TYPE=\"submit\" name=\"izmeniStudenta\" value=\"IZMENI\" /></font></b>";
		echo "</form>";
		echo "</td>";
		echo "<td>";
		echo "<form ACTION=\"RedvoznjeObrisi.php\" METHOD=\"POST\">";
		echo "<input type=\"hidden\" name=\"IdRedaVoznje\" value=\"$IdRedaVoznje\">";
		echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\"><input TYPE=\"submit\" name=\"obrisiStudenta\" value=\"OBRISI\"  onclick=\"return confirm('Da li ste sigurni da zelite da obrisete zapis?')\"/></font></b>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";

		}  //za for 
		echo "<tr>";
		echo "<td colspan=\"3\">";
		echo "</td>";
		echo "<td align=\"right\">";
		echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">УКУПНО:".$RedVoznjeObject->BrojZapisa."&nbsp;&nbsp;</font><br/>";
		echo "</td>";
		echo "<td colspan=\"2\">";
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

    