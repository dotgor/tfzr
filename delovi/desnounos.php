
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="#D8E7F4">
<tr>
<td style="width:5%;">
</td>

<td align="left">
<br/>
<b><font face="Trebuchet MS" color="darkblue" size="4px">  </font></b>
<table style="width:100%;" bgcolor="#D8E7F4" padding:0" align="center" cellspacing="0" cellpadding="0" border="0">

<tr>
<td style="width:3%;">
</td>
<td align="center">
<font color="#D8E7F4" size="1px">.</font>
</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>
<td align="left">
<b><font face="Trebuchet MS" color="black" size="3px">УНОС НОВОГ РЕДА ВОЖЊЕ</b></br>
</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>
<td align="center">
<font color="#D8E7F4" size="1px">.</font>
</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>

<td align="center">


<!------------------------FORMA ZA UNOS REDA VOZNJE --->
<table style="width:95%;" bgcolor="#D8E7F4" align="center" cellspacing="0" cellpadding="6" border="0">
<form name="FormaZaUnosRedaVoznje" action="RedvoznjeSnimi.php" method="POST">
<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Од места&nbsp;&nbsp;</font></b></td>
<td align="left">
<select name="iz" required>
	<option value="">Изаберите полазно место...</option>
	<?php
	if ($UkupanBrojZapisa > 0) {
		// predstavljanje gradova u padajucoj listi
		for ($brojacGrada = 0; $brojacGrada < $UkupanBrojZapisa; $brojacGrada++) {
			$idGrada = (int) $GradoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa, $brojacGrada, 0);
			$nazivGrada = $GradoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa, $brojacGrada, 1);
			echo '<option value="' . $idGrada . '">' . htmlspecialchars($nazivGrada, ENT_QUOTES, 'UTF-8') . '</option>';
		}
	}
	?>
</select>
</td>
</tr>
<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">До места&nbsp;&nbsp;</font></b></td>
<td align="left">
<select name="ka" required>
	<option value="">Изаберите одредишно место...</option>
	<?php
	if ($UkupanBrojZapisa > 0) {
		for ($brojacGrada = 0; $brojacGrada < $UkupanBrojZapisa; $brojacGrada++) {
			$idGrada = (int) $GradoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa, $brojacGrada, 0);
			$nazivGrada = $GradoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa, $brojacGrada, 1);
			echo '<option value="' . $idGrada . '">' . htmlspecialchars($nazivGrada, ENT_QUOTES, 'UTF-8') . '</option>';
		}
	}
	?>
</select>
</td>
</tr>
<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Време поласка&nbsp;&nbsp;</font></b></td>
<td align="left"><input name="vreme" type="text" pattern="(?:[01][0-9]|2[0-3]):[0-5][0-9]" maxlength="5" placeholder="HH:MM" title="Унесите време у 24-часовном формату HH:MM" required /></td>
</tr>
<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Цена&nbsp;&nbsp;</font></b></td>
<td align="left"><input name="cena" type="number" min="0" step="0.01" required /></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="snimiButton" value="СНИМИ" /></td>
</tr>
</form>
</table>

</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>
<td align="center">
<font color="#D8E7F4" size="1px">.</font>
</td>
<td style="width:3%;">
</td>
</tr>
</table>
</td>

<td style="width:5%;">
</td>

</tr>
</table>
<img src="images/sredinadole.jpg" width="100%" height="5" alt="" class="flt1" /> 
    