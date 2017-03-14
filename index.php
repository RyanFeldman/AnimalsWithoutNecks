<!doctype html>
<html>
	<head>
		<title>Project 2</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- JS render templates -->
		<script src="scripts/main.js"></script>
	</head>
	<body>
		<div class="animals">
			<div class="banner container-fluid">
				<div class="title">
					Animals Without Necks
				</div>
			</div>
			<div class="menu container">
				<form class="add" method="post">
					<b>Add a neckless animal:</b> <br>
					Name: <input type="text" name="name" placeholder="name..." required>
					Link to image: <input type="text" name="image" placeholder="image..." required>
					Type: <select name="type">
						<option value="Animal">Animal</option>
						<option value="Human">Human</option>
					</select>
					Location: <input type="text" name="location" placeholder="location..." required>
					<input type="submit" name="submit" value="Add">
				</form>
				<?php include "add.php"; ?>
				<form class="form-inline" method="post">
					<b>Search by:</b><br>
					Name: <input type="text" name="searchName" placeholder="name...">
					Type: <select name="searchType">
						<option selected value="either">Choose a Type</option>
						<option value="Animal">Animal</option>
						<option value="Human">Human</option>
					</select>
					Location: <input type="text" name="searchLocation" placeholder="location...">
					<input type="submit" name="search" value="Search">
				</form>
				<form class="form-inline" method="post">
					<b>Sort by: </b><br>
					<select name="sortOption">
						<option selected value="Name">Name</option>
						<option value="Type">Type</option>
						<option value="Loc">Location</option>
					</select>
					<input type="submit" name="sort" value="Sort">
				</form>
			</div>
			<div class="results">
				<div class="container">
					<div class="row">
						<?php include "display.php"; ?>
							
					</div>
				</div>
			</div>
		</div>
	</body>
</html>