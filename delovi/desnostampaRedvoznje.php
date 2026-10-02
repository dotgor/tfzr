
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="white">

<tr>
<td style="width:5%;">
</td>

<td align="center">
<font face="Trebuchet MS" color="darkblue" size="4px">
<b>ПАРАМЕТАРСКА ШТАМПА РЕДА ВОЖЊЕ</br> </font>


</td>

<td style="width:5%;">
</td>
</tr>


<tr>
<td style="width:5%;">
</td>

<td align="center">
<br/>
<font face="Trebuchet MS" color="darkblue" size="4px">

<?php

// PRETHODNI KOD PREUZIMA PODATKE IZ BAZE I POPUNJAVA KOLEKCIJU
if ($PorukaStampe !== "") {
	echo htmlspecialchars($PorukaStampe, ENT_QUOTES, 'UTF-8');
} elseif (!$RedVoznjeObject || $RedVoznjeObject->BrojZapisa == 0) {
	echo "Нема полазака из места " . htmlspecialchars($NazivGradaZaStampu, ENT_QUOTES, 'UTF-8') . ".";
} else {
	echo "<b>Поласци из места: " . htmlspecialchars($NazivGradaZaStampu, ENT_QUOTES, 'UTF-8') . "</b><br/><br/>";
	echo "<table style=\"width:95%;\" align=\"center\" cellspacing=\"0\" cellpadding=\"6\" border=\"1\" bgcolor=\"white\">";
	echo "<tr><th>ОД МЕСТА</th><th>ДО МЕСТА</th><th>ВРЕМЕ ПОЛАСКА</th><th>ЦЕНА (RSD)</th></tr>";

	foreach ($RedVoznjeObject->ListaZapisa as $RedVoznje) {
		$GradIz = htmlspecialchars($RedVoznje[1], ENT_QUOTES, 'UTF-8');
		$GradDo = htmlspecialchars($RedVoznje[2], ENT_QUOTES, 'UTF-8');
		$Vreme = htmlspecialchars(substr($RedVoznje[3], 0, 5), ENT_QUOTES, 'UTF-8');
		$Cena = htmlspecialchars(number_format((float) $RedVoznje[4], 2, ',', '.'), ENT_QUOTES, 'UTF-8');
		echo "<tr><td>$GradIz</td><td>$GradDo</td><td>$Vreme</td><td>$Cena</td></tr>";
	}

	echo "<tr><td colspan=\"3\" align=\"right\"><b>УКУПНО ПОЛАЗАКА:</b></td><td>" . $RedVoznjeObject->BrojZapisa . "</td></tr>";
	echo "</table>";
}

?>



</td>

<td style="width:5%;">
</td>

</tr>
</table>

    