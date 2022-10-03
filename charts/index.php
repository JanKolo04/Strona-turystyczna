<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>


    <?php

        function save_move_on_page() {
            global $con;
            //user id
            $id_user = 1;

            //get current date
            $mydate=getdate(date("U"));
            //set sql format date
            $current_date = "$mydate[year]-$mydate[mon]-$mydate[mday]";

            //check data is exists with today date in move_table
            $check_sql = "SELECT * FROM Move WHERE Date='$current_date' AND id_user=$id_user";
            $check_query = mysqli_query($con, $check_sql);

            if($check_query->num_rows == 0) {
                //set user day row if dosen't exist
                $set_sql = "INSERT INTO Move(id_user, Count_visit, Date) VALUES($id_user, 1, '$current_date');";
                $query_set = mysqli_query($con, $set_sql);
            }
            else {
                $update_sql = "UPDATE Move SET Count_visit=Count_visit+1 WHERE id_user=$id_user AND Date='$current_date'";
                $update_query = mysqli_query($con, $update_sql);
            }
        }

    ?>

</body>
</html>