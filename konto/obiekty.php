<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/konto/style-favorite.css">
	<title>Ulubione obiekty - Szlakiem Szczecina</title>
</head>
<body>

    <h3>Polubione obiekty</h3>

	<?php

		include("get_objects/index.php");
	
		class get_all_favorite_objects {
			function get_all_objects_from_fav($id_user) {
				global $con;
	
				//get all objects from favorite where id_user is user id
				$sql_fav = "SELECT Id_obiektu FROM ulubione WHERE Id_uzytkownika=$id_user";
				$query_fav = $con->query($sql_fav);
	
				$array = [];
				//if count results is bigger than 0 append data into array
				if($query_fav->num_rows > 0) {
					$i=0;
					while($row = $query_fav->fetch_array(MYSQLI_ASSOC)) {
						$array[$i] = [
							"Id"=>$row['Id_obiektu']
						];
						$i++;
					}
				}
	
				//all objects from fav
				//reverse array to get from newest objects to oldest
				return array_reverse($array);
			}

			function print_objects() {
				global $con;
				//object
				$objects = new GetObjects();

				//array with favorite objects id
				$favorite_objects_id = $this->get_all_objects_from_fav(3);
				//send argument to metod in class in favortie.php
				for($i=0; $i<sizeof($favorite_objects_id); $i++) {
					//sql function
					$sql = "SELECT Obiekty.*, Trasy.Nazwa AS 'trasa_nazwa' FROM Obiekty INNER JOIN Trasy ON Trasy.Id=Obiekty.Id_trasa WHERE Obiekty.Id={$favorite_objects_id[$i]['Id']}";

					$objects->check_data_and_print($sql);
				}
			}

		}
	
	?>

	<div id="objectsMainHolder">
		<form method="POST">
			<?php 
				//sql function
				//$sql = "SELECT Obiekty.*, Trasy.* FROM Ulubione INNER JOIN Trasy ON Trasy.Id=Obiekty.id_trasa INNER JOIN Obiekty ON Obiekty.Id=Ulubione.Id_obiektu WHERE Ulubione.id_uzytkownika=3;";

				$objects = new get_all_favorite_objects();
				$objects->print_objects();
			?>
		</form>
	</div>

</body>
</html>