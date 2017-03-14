<?php 
	if(isset($_POST["submit"])) {
		$file = fopen("data/data.txt", "a");

		$name = $_POST["name"];
		$image = $_POST["image"];
		$type = $_POST["type"];
		$location = $_POST["location"];

		$valid = true;

		//Test if any fields exceed 55 characters or if url is not valid
		if (strlen($name) > 55 || strlen($location) > 55 || !filter_var($image, FILTER_VALIDATE_URL)) {
			$valid = false;
		}
		//Prevent malicious code
		$image = htmlspecialchars($image);

		//Only allow letters and numbers and spaces
		if (!preg_match("/^[a-zA-Z0-9 _]+$/", $name) || !preg_match("/^[a-zA-Z0-9 _]+$/", $name)) {
			$valid = false;
		}

		if ($type != "Animal" && $type != "Human") {
			$valid = false;
		}

		if ($valid) {
			fwrite($file, $name." * ".$image." * ".$type." * ".$location."\n");
		}
		fclose($file);
	}
?>