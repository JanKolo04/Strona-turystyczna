<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/konto/style-favorite.css">
	<title>Ulubione trasy - Szlakiem Szczecina</title>
</head>
<body>

    <h3>Polubione Trasy</h3>

	<?php
	
		class get_all_favorite_data {
			public $id_user;

			function check_media($media) {
				//when media dosent exist return no-photo.png
				$img = $media.'/main 1.jpeg';
				if($img == "/main 1.jpeg") {
					$img = "brak-zdjecia-architekta.png";
				}

				return $img;
			}

			function get_all_routes($id_user) {
				global $con;

				//get all routes where id_uzytkownik equals $id_user
				$sql = "SELECT trasy.* FROM ulubione INNER JOIN trasy ON trasy.Id=ulubione.Id_trasy WHERE ulubione.id_uzytkownika=$id_user;";
				$query = mysqli_query($con, $sql);

				//insert data into array objects
				$routes_array = [];
				$i=0; //iteration
				if($query->num_rows > 0 && $query !== false) {
					while($row = mysqli_fetch_array($query)) {
						//append data
						$routes_array[$i] = [
							"id"=>$row['Id'],
							"name"=>$row['Nazwa'],
							"link"=>"index.php?strona=trasy/trasa&trasa={$row['Id']}'{$row['Nazwa']}",
							"media"=>$this->check_media($row['Media']),
                            "category"=>$row['Kategoria']
						];
						$i++;
					}
				}
				else {
					echo "Brak zapisanych tras";
				}

				return $routes_array;
			}
		}

		$id_user = 3;

		$favorite_data = new get_all_favorite_data();

		//send user id from SESSION
		$routes = $favorite_data->get_all_routes($id_user);

		function print_favorite_data($data_array) {
			for($i=0; $i<sizeof($data_array); $i++) {
				echo "
					<div class='workHolder'>
						<a href='{$data_array[$i]['link']}'><img class='workImg' src='img/{$data_array[$i]['media']}'></a>
						<div class='workInfo'>
							<p class='otherdata'><img class='iconLocation' src='img/icon/bookmark.png'> {$data_array[$i]['category']}</p>
							<a class='workName' href='{$data_array[$i]['link']}'><h4>{$data_array[$i]['name']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
						</div>
					</div>	
				";
			}
		}

		echo "<div id='objectsMainHolder'>";
		print_favorite_data($routes);
		echo "</div>";
	
	?>

</body>
</html>