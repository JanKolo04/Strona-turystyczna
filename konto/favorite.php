<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ulubione - Szlakiem Szczecina</title>
</head>
<body>

    <h3>Polubione wycieczki</h3>

	<?php
	
		/* -----Sktórić funkcjer tylko do jednej która będzie pobierała dane, a druga która będzie je wypisywać----- */


		function get_all_objects() {
			global $con;
			//user_id from SESSION
			$id_user = 3;

			//get all objects where id_uzytkownik equals $id_user
			$sql = "SELECT obiekty.* FROM ulubione INNER JOIN obiekty ON obiekty.Id=ulubione.Id_obiektu WHERE ulubione.id_uzytkownika=$id_user;";
			$query = mysqli_query($con, $sql);


			echo "<strong>Obiekty: </strong>";
			//insert data into array objects
			$objects_array = [];
			if($query->num_rows > 0 && $query !== false) {
				while($row = mysqli_fetch_array($query)) {
					echo $row['Nazwa'];
				}
			}
			else {
				echo "Brak zapisanych obiektów";
			}

		}


		function get_all_routes() {
			global $con;
			//user_id from SESSION
			$id_user = 3;

			//get all routes where id_uzytkownik equals $id_user
			$sql = "SELECT trasy.* FROM ulubione INNER JOIN trasy ON trasy.Id=ulubione.Id_trasy WHERE ulubione.id_uzytkownika=$id_user;";
			$query = mysqli_query($con, $sql);


			echo "</br><strong>Trasy: </strong>";
			//insert data into array objects
			$routes_array = [];
			if($query->num_rows > 0 && $query !== false) {
				while($row = mysqli_fetch_array($query)) {
					echo $row['Nazwa'];
				}
			}
			else {
				echo "Brak zapisanych tras";
			}

		}

		get_all_objects();
		get_all_routes();
	
	?>

</body>
</html>