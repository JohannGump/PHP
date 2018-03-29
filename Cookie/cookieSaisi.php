<?php
	header("Content-Type: text/html;charset=UTF-8");
?>

<form action="" method="get">
	<label>Nom d'utilisateur : </label>
	<input type="text" name="ut" value="Tintin" />
	<input type="submit" name="bt_valider" /><br/>
</form>

<?php
	if(isSet($_GET["bt_valider"])) {
		setCookie("ut", $_GET["ut"]);
		echo "Le cookie UT a été créé : " . $_GET["ut"];
	}
?>