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


			function get_all_objects($id_user) {
				global $con;

				//get all objects where id_uzytkownik equals $id_user
				$sql = "SELECT obiekty.* FROM ulubione INNER JOIN obiekty ON obiekty.Id=ulubione.Id_obiektu WHERE ulubione.id_uzytkownika=$id_user;";
				$query = mysqli_query($con, $sql);

				//insert data into array objects
				$objects_array = [];
				$i=0; //iteration
				if($query->num_rows > 0 && $query !== false) {
					while($row = mysqli_fetch_array($query)) {
						//append data
						$objects_array[$i] = [
							"id"=>$row['Id'],
							"name"=>$row['Nazwa'],
							"place"=>$row['Miejsce'],
							"link"=>"index.php?strona=obiekty/obiekt&obiekt={$row['Id']}&trasa={$row['Id_trasa']}'",
							"media"=>$this->check_media($row['Media'])
						];
						$i++;
					}
				}
				else {
					echo "Brak zapisanych obiektów";
				}

				return $objects_array;
			}
		}

		$id_user = 3;

		$favorite_data = new get_all_favorite_data();

		//send user id from SESSION
		$obejcts = $favorite_data->get_all_objects($id_user);

		function print_favorite_data($data_array) {
			for($i=0; $i<sizeof($data_array); $i++) {
				echo "
					<div class='workHolder'>
						<a href='{$data_array[$i]['link']}'><img class='workImg' src='img/{$data_array[$i]['media']}'></a>
						<div class='workInfo'>
							<p class='otherdata'><img class='iconLocation' src='img/icon/bookmark.png'> {$data_array[$i]['place']}</p>
							<a class='workName' href='{$data_array[$i]['link']}'><h4>{$data_array[$i]['name']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
						</div>
					</div>	
				";
			}
		}

		echo "<div id='objectsMainHolder'>";
		print_favorite_data($obejcts);
		echo "</div>";
	
	?>

</body>
</html>