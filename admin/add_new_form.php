<?php
if(AdminLogin::isAdminLoggedIn()) {
echo '
<form enctype="multipart/form-data" action="index.php?action=admin&view=add_new" method="post">
<input type="hidden" name="ok" value="1"><br>

	<div class="front-panel-header"style="margin-bottom: 20px;"><strong>Dodaj samochód</strong></div>
	<div class="add-new-wrapper">

	<div class="box add-new-basic-data">
		<div class="show-car-header"style="margin-bottom: 20px;">Podstawowe dane na temat pojazdu:</div>
		<div class="box-inside" style="width: fit-content; margin: auto;">
			<input placeholder="Marka pojazdu" type="text" name="marka" class="input-panel" maxlength="20" autocomplete="off"><br>
			<input placeholder="Model pojazdu" type="text" name="model" class="input-panel"  maxlength="20" autocomplete="off"><br>
			<input placeholder="Typ (TDI, GHIA, etc.)" type="text" name="typ" class="input-panel" maxlength="20" autocomplete="off"><br>
			<input placeholder="Rok produkcji" type="text" name="rok" class="input-panel" maxlength="20" autocomplete="off"><br>
			<input placeholder="Przebieg (Km)" type="text" name="przebieg" class="input-panel" maxlength="20" autocomplete="off"><br>
			<select length="20" name="nadwozie" class="input-panel" required>
				<option value="" hidden>Rodzaj nadwozia</option>
				<option value="1">Sedan</option>
				<option value="2">Hatchback</option>
				<option value="3">Kombi</option>
				<option value="4">Cabrio</option>
				<option value="5">Coupe</option>
				<option value="6">Pick-up</option>
				<option value="7">Van</option>
			</select><br>
			<input placeholder="Kolor nadwozia" type="text" name="kolor" class="input-panel" maxlength="20" autocomplete="off"><br>
		</div>
	</div>

	<div class="box add-new-tech">
		<div class="show-car-header"style="margin-bottom: 20px;">Trochę danych technicznych</div>
		<div class="box-inside" style="width: fit-content; margin: auto;">
			<input placeholder="Pojemność silnika (cm3)" type="text" name="pojemnosc" class="input-panel" maxlength="20" autocomplete="off"><br>
			<input placeholder="Moc silnika (Kw)" type="text" name="moc" class="input-panel" maxlength="20" autocomplete="off"><br>
			<select length="20" name="paliwo" class="input-panel">
				<option value="" hidden>Rodzaj paliwa</option>
				<option value="1">Benzyna</option>
				<option value="2">Benzyna + LPG</option>
				<option value="3">Olej napędowy</option>
				<option value="4">Hybryda</option>
				<option value="5">Elektryczny</option>
			</select><br>
			<select length="20" name="skrzynia" class="input-panel">
				<option value="" hidden>Skrzynia biegów</option>
				<option value="1">Manual</option>
				<option value="2">Automat</option>
			</select><br>
		</div>
	</div>
	
	<div class="box add-new-comfort">
		<div class="show-car-header" style="margin-bottom: 20px;">Wyposażenie</div>
		<div class="box-inside" style="width: fit-content; margin: auto;">
			<table align="center" cellpadding="0" cellspacing="10" border="0">
				<tr>
					<td valign="top" class="wyposazenie">
						<label><input type="checkbox" name="abs" value="1" />ABS</label><br>
						<label><input type="checkbox" name="aluminiowe" value="1" />Aluminowe felgi</label><br>
						<label><input type="checkbox" name="autoalarm" value="1" />Autoalarm</label><br>
						<label><input type="checkbox" name="blokada" value="1" />Blokada skrzynii biegów</label><br>
						<label><input type="checkbox" name="centralny" value="1" />Centralny zamek</label><br>
						<label><input type="checkbox" name="lusterka" value="1" />Elektryczne lusterka</label><br>
						<label><input type="checkbox" name="szyby" value="1" />Elektryczne szyby</label><br>
						<label><input type="checkbox" name="hak" value="1" />Hak holowniczy</label><br>
						<label><input type="checkbox" name="immobiliser" value="1" />Immobiliser</label><br>
						<label><input type="checkbox" name="klimatyzacja" value="1" />Klimatyzacja</label><br>
						<label><input type="checkbox" name="komputer" value="1" />Komputer pokładowy</label><br>
						<label><input type="checkbox" name="kontrola" value="1" />Kontrola trakcji</label><br>
					</td>
					<td valign="top" class="wyposazenie">
						<label><input type="checkbox" name="awd" value="1" />Napęd na 4 koła</label><br>
						<label><input type="checkbox" name="navigacja" value="1" />Navigacja</label><br>
						<label><input type="checkbox" name="parktronic" value="1" />Parktronic</label><br>
						<label><input type="checkbox" name="podgrzewane" value="1" />Podgrzewane lusterka</label><br>
						<label><input type="checkbox" name="poduszki" value="1" />Poduszki powietrzne</label><br>
						<label><input type="checkbox" name="radio" value="1" />Radio / CD</label><br>
						<label><input type="checkbox" name="reflektory" value="1" />Reflektory ksenonowe</label><br>
						<label><input type="checkbox" name="skorzana" value="1" />Skórzana tapicerka</label><br>
						<label><input type="checkbox" name="szyberdach" value="1" />Szyberdach</label><br>
						<label><input type="checkbox" name="tempomat" value="1" />Tempomat</label><br>
						<label><input type="checkbox" name="webasto" value="1" />Webasto</label><br>
						<label><input type="checkbox" name="wspomaganie" value="1" />Wspomaganie kierownicy</label><br>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div class="box add-new-photos">
		<div class="show-car-header" style="margin-bottom: 20px;">Zdjęcia</div>
		<div class="box-inside" style="width: fit-content; margin: auto;">
         Wybierz zdjęcia z dysku<br>
         <input id="image" type="file" name="photo[]" class="input-panel" accept="image/jpeg" multiple><br>
         <span style="display:block; font-size: 12px; margin-bottom: 10px;">Max 8 zdjęć w formacie .jpg. Maksymalny rozmiar zdjęcia to 4MB</span><br>
		</div>
	</div>

	<div class="box add-new-price">
		<div class="show-car-header" style="margin-bottom: 20px;">Pozostałe informacje</div>
		<div class="box-inside">
         <textarea class="opis_mainpage2" name="opis" placeholder="Dodatkowy opis"></textarea><br>
         <input placeholder="Cena (PLN)" type="text" name="cena" class="input-panel" maxlength="10" autocomplete="off"><br>
		</div>
   </div>
   <button type="submit" class="email_b">Dodaj samochód</button>
</div>
</form>';
}
?>