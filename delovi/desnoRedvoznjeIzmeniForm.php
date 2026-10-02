
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
<td align="center">
<b><font face="Trebuchet MS" color="black" size="3px">ИЗМЕНА РЕДА ВОЖЊЕ</b></br>
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


<!------------------------FORMA ZA IZMENU REDA VOZNJE --->
<table style="width:50%;" bgcolor="#D8E7F4" padding:0" align="center" cellspacing="0" cellpadding="0" border="0">
<form name="FormaZaIzmenuRedaVoznje" action="RedvoznjeIzmeni.php" METHOD="POST">

<tr>
<td align="right" valign="bottom">     
<b><font face="Trebuchet MS" color="black" size="2px">Идентификатор&nbsp;&nbsp;</font></b>
</td>
<td align="left" valign="bottom">
<?php echo (int) $StariIdRedaVoznje; ?>
<input type="hidden" name="IdRedaVoznje" value="<?php echo (int) $StariIdRedaVoznje; ?>">

</td>
</tr>

<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<b><font face="Trebuchet MS" color="black" size="2px">Од места&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<select name="iz" required>
<?php
	if ($UkupanBrojZapisa > 0) {
		// PREDSTAVLJANJE GRADOVA U OPTION KROZ FOR CIKLUS
		for ($brojacGrada = 0; $brojacGrada < $UkupanBrojZapisa; $brojacGrada++) {
			$idGrada = (int) $GradoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa, $brojacGrada, 0);
			$nazivGrada = $GradoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa, $brojacGrada, 1);
			$izabran = ((int) $StariIz === $idGrada) ? " selected" : "";
			echo "<option value=\"$idGrada\"$izabran>" . htmlspecialchars($nazivGrada, ENT_QUOTES, 'UTF-8') . "</option>";
		}
	}
?>
</select>
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<b><font face="Trebuchet MS" color="black" size="2px">До места&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<select name="ka" required>
<?php
	if ($UkupanBrojZapisa > 0) {
		for ($brojacGrada = 0; $brojacGrada < $UkupanBrojZapisa; $brojacGrada++) {
			$idGrada = (int) $GradoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa, $brojacGrada, 0);
			$nazivGrada = $GradoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa, $brojacGrada, 1);
			$izabran = ((int) $StariKa === $idGrada) ? " selected" : "";
			echo "<option value=\"$idGrada\"$izabran>" . htmlspecialchars($nazivGrada, ENT_QUOTES, 'UTF-8') . "</option>";
		}
	}
?>
</select>
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="black" size="2px">Време поласка&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<input name="vreme" type="text" pattern="(?:[01][0-9]|2[0-3]):[0-5][0-9]" maxlength="5" placeholder="HH:MM" title="Унесите време у 24-часовном формату HH:MM" required value="<?php echo htmlspecialchars($StaroVreme, ENT_QUOTES, 'UTF-8'); ?>" />
</td>
</tr>

<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="black" size="2px">Цена&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<input name="cena" type="number" min="0" step="0.01" required value="<?php echo htmlspecialchars($StaraCena, ENT_QUOTES, 'UTF-8'); ?>" />
</td>
</tr>


<!-------------------------- prazan red ------->
<tr>
<td align="right" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="bottom">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<tr>

<td>       
</td>
<td><input TYPE="submit" name="snimiButton" value="СНИМИ ИЗМЕНУ" TABINDEX=3/>
</td>
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
    