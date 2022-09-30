<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-main.css">
</head>
<body>

    <?php
    
        function get_all_data() {
            global $con;

            //get current date
            $mydate=getdate(date("U"));
            //set sql format date
            $current_date = "$mydate[year]-$mydate[mon]-$mydate[mday]";
            //from date
            $date_create = date_create($current_date);
            //minus six days form current date
            $from_date = date_sub($date_create,date_interval_create_from_date_string("6 days"))->format('Y-m-d');

            //seatrch moves
            $sql_all = "SELECT * FROM Move WHERE Date BETWEEN '$from_date' AND '$current_date'";
            $query_all = mysqli_query($con, $sql_all);

            //echo  data
            while($row = mysqli_fetch_array($query_all)) {
                echo "User: ".$row['id_user']."</br>";
                echo "Date: ".$row['Date']."</br></br>";
            }
            
        }

        get_all_data();

    
    ?>

</body>
</html>