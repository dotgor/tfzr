
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="white">

<tr>
<td style="width:15%;" align="right" valign="middle">
<font face="Trebuchet MS" color="darkblue" size="2px">
<b>&nbsp;датум: <?php echo date("d.m.Y.");  ?></b></br> </font>
</td>

<td align="left" valign="middle"> 

</td>

<td style="width:5%;">
</td>
</tr>

<tr>
<td style="width:15%;">
</td>

<td align="center" valign="middle"> 
<font face="Trebuchet MS" color="darkblue" size="5px">
<b>РЕД ВОЖЊЕ АУТОБУСА</br> </font>
</td>

<td style="width:5%;">
</td>
</tr>


<tr>
<td style="width:15%;">
</td>

<td align="left">
<br/>
<font face="Trebuchet MS" color="darkblue" size="4px">

<?php

// PRETHODNI KOD PREUZIMA PODATKE IZ BAZE I POPUNJAVA KOLEKCIJU

if (!$KonekcijaObject->konekcijaDB)
{
	echo "Неуспешна конекција са базом података!";
}
elseif ($RedVoznjeObject->BrojZapisa==0)
{
	echo "НЕМА УНЕТИХ ПОЛАЗАКА!";
}
else
{
	// ------------ zaglavlje ----------------
	echo "<table style=\"width:90%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"white\">";
	echo "<tr>";
	echo "<td style=\"width:25%;\">";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">ОД МЕСТА</font><br/>";
	echo "</td>";
	echo "<td style=\"width:25%;\">";
	echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">ДО МЕСТА</font><br/>";
	echo "</td>";
	echo "<td style=\"width:25%;\">";
	echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">ВРЕМЕ ПОЛАСКА</font><br/>";
	echo "</td>";
	echo "<td style=\"width:25%;\">";
	echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">ЦЕНА (RSD)</font><br/>";
	echo "</td>";
	echo "</tr>";

	for ($RBZapisa = 0; $RBZapisa < $RedVoznjeObject->BrojZapisa; $RBZapisa++)
	{
						
	// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
	$RedVoznje=$RedVoznjeObject->ListaZapisa[$RBZapisa];
	$GradIz=htmlspecialchars($RedVoznje[1], ENT_QUOTES, 'UTF-8');
	$GradDo=htmlspecialchars($RedVoznje[2], ENT_QUOTES, 'UTF-8');
	$Vreme=htmlspecialchars(substr($RedVoznje[3], 0, 5), ENT_QUOTES, 'UTF-8');
	$Cena=htmlspecialchars(number_format((float) $RedVoznje[4], 2, ',', '.'), ENT_QUOTES, 'UTF-8');

	// CRTANJE REDA TABELE SA PODACIMA
	echo "<tr>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">$GradIz</font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">$GradDo</font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">$Vreme</font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">$Cena</font><br/>";
	echo "</td>";
	echo "</tr>";

	}  //za for 

	// ISPOD PODATAKA JE UKUPNO
	echo "<tr>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
	echo "</td>";
	echo "<td>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\"></font><br/>";
	echo "</td>";
	echo "<td align=\"right\" valign=\"middle\">"; 
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">УКУПНО: ".$RedVoznjeObject->BrojZapisa."</font>&nbsp;&nbsp;<br/>";
	echo "</td>";
	echo "</tr>";


	echo "</table>";
}
if ($KonekcijaObject->konekcijaDB) {
	$KonekcijaObject->disconnect();
}

?>

</td>

<td style="width:5%;">
</td>

</tr>


<tr>
<td style="width:15%;">
</td>

<td align="right" valign="middle"> 
<?php
	echo "<br/>";
	echo "<br/>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">Одговорно лице</font><br/>";
	echo "<br/>";
	echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">_______________________</font><br/>";
	?>
</td>

<td style="width:5%;">
</td>
</tr>

</tr>
</table>

    