
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
<b><font face="Trebuchet MS" color="black" size="3px">ИЗМЕНА ПОДАТАКА СТУДЕНТА</b></br>
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


<!------------------------FORMA ZA UNOS ---- ACTION="studentsnimi.php" --->
<table style="width:50%;" bgcolor="#D8E7F4" padding:0" align="center" cellspacing="0" cellpadding="0" border="0">
<form name="FormaZaUnosStudenta" action="studentIzmeni.php" METHOD="POST" enctype="multipart/form-data" >

<tr>
<td align="right" valign="bottom">     
<b><font face="Trebuchet MS" color="black" size="2px">Број индекса&nbsp;&nbsp;</font></b>
</td>
<td align="left" valign="bottom">
<input name="brojIndeksa" type="text" size="50" value="<?php echo $StariBrojIndeksa; ?>"  />
<input type="hidden" name="StariBrojIndeksa" value="<?php echo $StariBrojIndeksa; ?>">

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
<b><font face="Trebuchet MS" color="black" size="2px">Презиме&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<input name="prezime" type="text" size="50" value="<?php echo $StaroPrezime; ?>"/>
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
<b><font face="Trebuchet MS" color="black" size="2px">Име&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<input name="ime" type="text" size="50" value="<?php echo $StaroIme; ?>"/>
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
<b><font face="Trebuchet MS" color="black" size="2px">Смер&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<select name="oznakaSmera" required TABINDEX=7>		
	<option value="">изаберите...</option>
	<?php
	// upis vrednosti iz bp - Tip vozila
		
	// PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
	if ($UkupanBrojZapisa>0) 
	{					
		for ($brojacSmerova = 0; $brojacSmerova < $UkupanBrojZapisa; $brojacSmerova++) 
			{
				$oznakaSmera =$SmerObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $brojacSmerova, 0);				
				$nazivSmera=$SmerObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $brojacSmerova, 1);				
				echo "<option value=\"$oznakaSmera\">$nazivSmera</option>";						
			} //for
										
	} // 
	
	?>
		
</select>
<br/>
<font face="Trebuchet MS" color="black" size="2px">Стара ознакa смера: <?php echo $StaraOznakaSmera; ?></font>
<input type="hidden" name="StaraOznakaSmera" value="<?php echo $StaraOznakaSmera; ?>">

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
<b><font face="Trebuchet MS" color="black" size="2px">Фотографија&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="bottom">
<input name="nazivFajlaFotografije" type="file" size="50" placeholder="Унесите назив фајла фотографије"/> <br/>
<font face="Trebuchet MS" color="black" size="2px">Стари назив фајла фотографије: <?php echo $StariNazivFajlaFotografije; ?></font>
<input type="hidden" name="StariNazivFajlaFotografije" value="<?php echo $StariNazivFajlaFotografije; ?>">
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
    