<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-obiekty.css">
    <title>Obiekty - Szlakiem Szczecina</title>
</head>
<body>

    <?php include("get_objects_routes/objects.php"); ?>
    
    <h1>Obiekty</h1>
    <div id='objectsMainHolder'>
        <form method="POST">
            <?php 
                //sql function
                $sql = "SELECT Obiekty.*, Trasy.Nazwa AS 'trasa_nazwa' FROM Obiekty INNER JOIN Trasy ON Trasy.Id=Obiekty.Id_trasa ORDER BY (Obiekty.Nazwa) ASC";

                $print_objects = new GetObjects();
                $print_objects->check_data_and_print($sql);
            ?>
        </form>
    </div>

</body>
</html>