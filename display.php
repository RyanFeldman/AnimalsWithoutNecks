
<?php 

	function htmlCell($n, $i, $t, $l) {
		echo '
			<div class="cell">
				<div class="title">'.$n.'</div> 
				<!-Image source: '.$i.'->
				<img src= '.$i.' onerror = "this.src=\'http://i.imgur.com/hPYOVf9.jpg\';" /> 
				<div class="type"> Type: '.$t.'</div> 
				<div class="loc"> Location: '.$l.'</div> 
			</div>';
	}

	$file = fopen("data/data.txt", "r");

	//If data needs to be sorted
	if(isset($_POST["sort"])) {

		$option = $_POST["sortOption"];

		$cells = array();

		function cmpName($a, $b) {
			return strcasecmp($a[0], $b[0]);
		}
		function cmpType($a, $b) {
			return strcasecmp($a[2], $b[2]);
		}
		function cmpLoc($a, $b) {
			return strcasecmp($a[3], $b[3]);
		}

		//Output cells
		
		while ((($line = fgets($file)) !== false)) {
			$values = explode("*", $line);
			$name = trim($values[0]);
			$image = trim($values[1]);
			$type = trim($values[2]);
			$loc = trim($values[3]);

			array_push($cells, array($name, $image, $type, $loc));
		}
		$f = "cmp".$option;
		usort($cells, $f);
		foreach($cells as $cell) {
			htmlCell($cell[0], $cell[1], $cell[2], $cell[3]);
		}
	}
	//Search Results
	else if(isset($_POST["search"])) {

		$searchName = $_POST["searchName"];
		$searchType = $_POST["searchType"];
		$searchLoc = $_POST["searchLocation"];

		$valid = true;
		$num = 0;

		//Test if any fields exceed 55 characters or if url is not valid
		if (strlen($searchName) > 55 || strlen($searchLoc) > 55) {
			$valid = false;
		}

		//Only allow letters and numbers and spaces
		if (!preg_match("/^[a-zA-Z0-9 _]*$/", $searchName) || !preg_match("/^[a-zA-Z0-9 _]*$/", $searchLoc)) {
			$valid = false;
		}

		//Output cells
		if (!$valid) {
			echo 'Invalid Search';
		}
		while ((($line = fgets($file)) !== false) && $valid) {
			$values = explode("*", $line);
			$name = trim($values[0]);
			$image = trim($values[1]);
			$type = trim($values[2]);
			$loc = trim($values[3]);

			//Only output searched values
			if (((false !== stripos($name, $searchName)) || empty($searchName)) && ((false !== stripos($loc, $searchLoc)) || empty($searchLoc)) && (($searchType == $type) || $searchType == "either")) {
				htmlCell($name, $image, $type, $loc);
				$num ++;
			}

		}
		if ($num == 0) {
			echo 'No results found.';
		}

	}
	//Display ALL
	else {

		while (($line = fgets($file)) !== false) {
			$values = explode("*", $line);
			$name = trim($values[0]);
			$image = trim($values[1]);
			$type = trim($values[2]);
			$loc = trim($values[3]);

			htmlCell($name, $image, $type, $loc);
		}
	}

	fclose($file);
?>
