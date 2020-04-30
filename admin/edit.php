<?php
if (AdminLogin::isAdminLoggedIn()) {

   $car = new Cars;
   $carData = $car->getCarData($_GET['car_id']);

	$marka = strtoupper($carData['make']);
	$model = strtoupper($carData['model']);

	echo '
	<br>
	<div class="front-panel-header" style="margin-bottom: 20px;"><strong>EDYCJA DANYCH SAMOCHODU '.$marka.' '.$model.'</strong></div>
	<form action="index.php?action=show_car&q=edit&car_id='.$_GET['car_id'].'" method="post">

		<div class="edit-wrapper">

		<div class="box edit-basic-data">
			<div class="show-car-header"style="margin-bottom: 20px;">Podstawowe dane na temat pojazdu:</div>
			<div class="box-inside" style="width: fit-content; margin: auto;">
         <input type="hidden" name="q" value="edit">
         <input type="hidden" name="car_id" value="'.$_GET['car_id'].'">
			<input type="hidden" name="ok" value="1">
				Marka pojazdu:<br>
				<input placeholder="Marka pojazdu" type="text" name="marka" value="'.$carData['make'].'" class="input-panel" maxlength="20" autocomplete="off"><br>
				Model pojazdu:<br>
				<input placeholder="Model pojazdu" type="text" name="model" value="'.$carData['model'].'" class="input-panel"  maxlength="20" autocomplete="off"><br>
				Typ (TDI, GHIA, etc.):<br>
				<input placeholder="Typ (TDI, GHIA, etc.)" type="text" name="typ" value="'.$carData['type'].'" class="input-panel" maxlength="20" autocomplete="off"><br>
				Rok produkcji:<br>
				<input placeholder="Rok produkcji" type="text" name="rok" value="'.$carData['year'].'" class="input-panel" maxlength="20" autocomplete="off"><br>
				Przebieg (Km):<br>
				<input placeholder="Przebieg (Km)" type="text" name="przebieg" value="'.$carData['mileage'].'" class="input-panel" maxlength="20" autocomplete="off"><br>
				Rodzaj nadwozia:<br>
				<select length="20" name="nadwozie" class="input-panel edit">
					<option value="" hidden>Typ nadwozia</option>
					<option value="1"';
	if ($carData['body'] == 1) {
		echo ' selected';
	}
	echo '>Sedan</option>
				<option value="2"';
	if ($carData['body'] == 2) {
		echo ' selected';
	}
	echo '>Hatchback</option>
				<option value="3"';
	if ($carData['body'] == 3) {
		echo ' selected';
	}
	echo '>Kombi</option>
				<option value="4"';
	if ($carData['body'] == 4) {
		echo ' selected';
	}
	echo '>Cabrio</option>
				<option value="5"';
	if ($carData['body'] == 5) {
		echo ' selected';
	}
	echo '>Coupe</option>
				<option value="6"';
	if ($carData['body'] == 6) {
		echo ' selected';
	}
	echo '>Pick-up</option>
				<option value="7"';
	if ($carData['body'] == 7) {
		echo ' selected';
	}
	echo '>Van</option>
			</select><br>
			Kolor nadwozia:<br>
			<input placeholder="Kolor nadwozia" type="text" name="kolor" value="'.$carData['color'].'" class="input-panel" maxlength="20">
		</div>
	</div>
	<div class="box edit-tech">
	<div class="show-car-header"style="margin-bottom: 20px;">Trochę danych technicznych</div>
		<div class="box-inside" style="width: fit-content; margin: auto;">
			Pojemność silnika (cm<sup>3</sup>):<br>
			<input placeholder="Pojemność silnika (cm3)" type="text" name="pojemnosc" value="'.$carData['ccm'].'" class="input-panel" maxlength="20" autocomplete="off"><br>
			Moc silnika (Kw):<br>
			<input placeholder="Moc silnika (Kw)" type="text" name="moc" value="'.$carData['power'].'" class="input-panel" maxlength="20" autocomplete="off"><br>
			Rodzaj paliwa:<br>
			<select length="20" name="paliwo" class="input-panel edit">
				<option value="" hidden>Rodzaj paliwa</option>
				<option value="1"';
	if ($carData['fuel'] == 1) {
			echo ' selected';
	}
		echo '>Benzyna</option>
				<option value="2"';
	if ($carData['fuel'] == 2) {
			echo ' selected';
	}
		echo '>Benzyna + LPG</option>
				<option value="3"';
	if ($carData['fuel'] == 3) {
			echo ' selected';
	}
		echo '>Olej napędowy</option>
			</select><br>
			Rodzaj skrzyni biegów:<br>
			<select length="20" name="skrzynia" class="input-panel edit">
				<option value="" hidden>Skrzynia biegów</option>
				<option value="1"';
	if ($carData['gearbox'] == 1) {
		echo ' selected';
	}
	echo '>Manual</option>
				<option value="2"';
	if ($carData['gearbox'] == 2) {
		echo ' selected';
	}
	echo '>Automat</option>
			</select><br>
		</div>
	</div>
	<div class="box edit-comfort">
		<div class="show-car-header"style="margin-bottom: 20px;">Wyposażenie</div>
		<div class="box-inside" style="width: fit-content; margin: auto;">
			<table align="center" cellpadding="0" cellspacing="10" border="0">
				<tr>
					<td valign="top" class="wyposazenie">';
	$checked = '';
	if ($carData['awd'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"awd\" $checked value=\"1\" />4WD</label><br>";
	$checked = '';
	if ($carData['alarm'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"autoalarm\" $checked value=\"1\" />Autoalarm</label><br>";
	$checked = '';
	if ($carData['el_mirr'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"lusterka\" $checked value=\"1\" />Elektryczne lusterka</label><br>";
	$checked = '';
	if ($carData['heat_mirr'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"podgrzewane\" $checked value=\"1\" />Podgrzewane lusterka</label><br>";
	$checked = '';
	if ($carData['immo'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"immobiliser\" $checked value=\"1\" />Immobiliser</label><br>";
	$checked = '';
	if ($carData['tc'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"kontrola\" $checked value=\"1\" />Kontrola trakcji</label><br>";
	$checked = '';
	if ($carData['park'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"parktronic\" $checked value=\"1\" />Parktronic</label><br>";
	$checked = '';
	if ($carData['xenon'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"reflektory\" $checked value=\"1\" />Reflektory ksenonowe</label><br>";
	$checked = '';
	if ($carData['tempo'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"tempomat\" $checked value=\"1\" />Tempomat</label><br>";
	$checked = '';
	if ($carData['abs'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"abs\" $checked value=\"1\" />ABS</label><br>";
	$checked = '';
	if ($carData['block'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"blokada\" $checked value=\"1\" />Blokada skrzynii biegów</label><br>";
	$checked = '';
	if ($carData['webasto'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"webasto\" $checked value=\"1\" />Webasto</label><br>";
	echo "
					</td>";
	echo "
					<td valign=\"top\" class=\"wyposazenie\">";
	$checked = '';
	if ($carData['el_windows'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"szyby\" $checked value=\"1\" />Elektryczne szyby</label><br>";
	$checked = '';
	if ($carData['ac'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"klimatyzacja\" $checked value=\"1\" />Klimatyzacja</label><br>";
	$checked = '';
	if ($carData['airbag'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"poduszki\" $checked value=\"1\" />Poduszki powietrzne</label><br>";
	$checked = '';
	if ($carData['leather'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"skorzana\" $checked value=\"1\" />Skórzana tapicerka</label><br>";
	$checked = '';
	if ($carData['power_steering'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"wspomaganie\" $checked value=\"1\" />Wspomaganie kierownicy</label><br>";
	$checked = '';
	if ($carData['aloys'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"aluminiowe\" $checked value=\"1\" />Aluminowe felgi</label><br>";
	$checked = '';
	if ($carData['central'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"centralny\" $checked value=\"1\" />Centralny zamek</label><br>";
	$checked = '';
	if ($carData['hook'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"hak\" $checked value=\"1\" />Hak holowniczy</label><br>";
	$checked = '';
	if ($carData['computer'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"komputer\" $checked value=\"1\" />Komputer pokładowy</label><br>";
	$checked = '';
	if ($carData['navi'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"navigacja\" $checked value=\"1\" />Navigacja</label><br>";
	$checked = '';
	if ($carData['radio'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"radio\" $checked value=\"1\" />Radio + CD</label><br>";
	$checked = '';
	if ($carData['sunroof'] == 1) {$checked ="checked";}
	echo "
						<label><input type=\"checkbox\" name=\"szyberdach\" $checked value=\"1\" />Szyberdach</label><br>";
	$checked = '';
	echo '
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="box edit-price">
      <div class="show-car-header" style="margin-bottom: 20px;">Pozostałe informacje</div>
         <div class="box-inside">
            Cena (PLN):<br>
            <input placeholder="Cena (PLN)" type="text" name="cena" value="'.$carData['price'].'" class="input-panel" maxlength="10" autocomplete="off"> PLN<br>
            <textarea placeholder="Dodatkowy opis" class="opis_mainpage2" name="opis">'.$carData['descr'].'</textarea><br>
            <button type="submit" class="email_b">Zapisz zmiany</button>
         </div>
      </div>
	</div>
</form>';
}
?>