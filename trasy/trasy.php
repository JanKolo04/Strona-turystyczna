<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-trasy.css">
    <title>Trasy - Szlakiem Szczecina</title>
</head>
<body>

    <?php include("get_objects_routes/route.php"); ?>

    <h1>Trasy</h1>
    <div id='routesMainHolder'>
        <form method="POST">
            <?php
                //sql function
                $sql = "SELECT * FROM Trasy ORDER BY Nazwa ASC;";

                $print_objects = new GetRoutes();
                $print_objects->check_data_and_print($sql);
            ?>
        </form>
    </div>

</body>
</html>