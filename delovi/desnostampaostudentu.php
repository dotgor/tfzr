
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="white">

<tr>
<td style="width:5%;">
</td>

<td align="center">
<font face="Trebuchet MS" color="darkblue" size="4px">
<b>ПОДАЦИ О СТУДЕНТУ</br> </font>


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

// PRETHODNI KOD PREUZIMA PODATKE I TO JE NA INDEX.PHP
				
				$URLSlike='SlikeStudenata/'.$NazivFajlaFotografije;

				// PRIKAZ SLIKE
				echo "<img src=\"".$URLSlike."\" width=\"200\"/><br/>";
				
				// CRTANJE REDA TABELE SA PODACIMA

				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Број индекса: $BrojIndeksa</font><br/>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Презиме: $Prezime</font><br/>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Име: $Ime</font><br/>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Назив смера: $NazivSmera</font><br/>";

?>



</td>

<td style="width:5%;">
</td>

</tr>
</table>

    