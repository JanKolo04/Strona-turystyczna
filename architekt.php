<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-architekt.css">
</head>
<body>

    <?php

        function get_architect_data() {
            global $con;
            
            //get architect ID
            $Architect_id = $_GET['architekt'];

            //get data about this architect
            $sql_archi = "SELECT * FROM Architekci WHERE Id=$Architect_id";
            $query_archi = mysqli_query($con, $sql_archi);

            //show data about this architect
            if($query_archi->num_rows > 0) {
                return  mysqli_fetch_array($query_archi);
            }
        }

        function architect_name() {
            //row with data
            $row = get_architect_data();
            
            echo $nameLastname = $row['Imie'].' '.$row['Nazwisko'];
        }

        function show_works_architecs() {
            global $con;
            
            //get architect ID
            $Architect_id = $_GET['architekt'];

            //get all works created by this architect
            $sql_obiekt = "SELECT * FROM Obiekty WHERE Id_architekt=$Architect_id";
            $query_obiekt = mysqli_query($con, $sql_obiekt);

            //show works
            if($query_obiekt->num_rows > 0) {
                while($row_works = mysqli_fetch_array($query_obiekt)) {
                    echo "<div class='workHolder'>";
                    echo "<img class='workImg' src='img/{$row_works['Media']}/main.jpeg'>";
                    echo "<h4 class='workName'>".$row_works['Nazwa']."</h4>"; 
                    echo "</div>";
                }
            }
        } 

    ?>

    <title><?php architect_name(); ?></title>

    <div id='architectName'>
        <h2><?php architect_name(); ?></h2>
    </div>

    <div id='allWorksHolder'>
        <?php show_works_architecs(); ?>
    </div>

</body>
</html>