
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="#D8E7F4">

<tr>
<td style="width:5%;">
</td>

<td>
<font face="Trebuchet MS" color="darkblue" size="4px">
</br>
<b>ПАРАМЕТАРСКА ШТАМПА</br> 
</br>
<?php if (!$KonekcijaObject->konekcijaDB) { ?>
Неуспешна конекција са базом података.
<?php } elseif (!$GradoviObject || $GradoviObject->BrojZapisa == 0) { ?>
Нема унетих градова.
<?php } else { ?>
<form action="StampaPodatakaORedvoznje.php" method="POST">
Град поласка:
<select name="GradIzFilter" required>
	<option value="">Изаберите град...</option>
	<?php foreach ($GradoviObject->ListaZapisa as $Grad) { ?>
	<option value="<?php echo (int) $Grad[0]; ?>"><?php echo htmlspecialchars($Grad[1], ENT_QUOTES, 'UTF-8'); ?></option>
	<?php } ?>
</select>
<input type="submit" name="stampaj" value="STAMPAJ" />
</form>
<?php }
if ($KonekcijaObject->konekcijaDB) {
	$KonekcijaObject->disconnect();
}
?>
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


</td>

<td style="width:5%;">
</td>

</tr>
</table>

    