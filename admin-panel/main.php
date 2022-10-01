<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-main.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>

    <div id="chartdata">
        <div id="chart-header">
            <div class="option-chart">
                <div class="border-top"></div>
                
                <label for="users-count">Ilość uzytkowników</label></br>
                <label for="users-count">Ilość wejść</label></br>

                <span id="users-count"></span>
            </div>
        </div>

        <canvas id="myChart"></canvas>
    </div>

    <?php
    
        function get_all_data() {
            global $con, $array_data;

            //get current date
            $mydate=getdate(date("U"));
            //set sql format date
            $current_date = "$mydate[year]-$mydate[mon]-$mydate[mday]";
            //from date
            $date_create = date_create($current_date);
            //minus six days form current date
            $from_date = date_sub($date_create,date_interval_create_from_date_string("6 days"))->format('Y-m-d');

            //seatrch moves
            $sql_all = "SELECT COUNT(id_user) AS 'count_users', Date FROM Move WHERE Date BETWEEN '$from_date' AND '$current_date' GROUP BY Date";
            $query_all = mysqli_query($con, $sql_all);

            //insert data into arrays
            $users = [];
            $dates = [];
            $i=0; //counter
            while($row = mysqli_fetch_array($query_all)) {
                $users[$i] = intval($row['count_users']);
                $dates[$i] = $row['Date'];
                $i++;
            }

            //combain all arrays
            $array_data = [
                "users"=>$users, 
                "dates"=>$dates
            ];
            return $array_data;
        }

        get_all_data();
    
    ?>

    <script>

        //arrays with data
        var users = <?php echo json_encode($array_data['users']); ?>;
        var dates = <?php echo json_encode($array_data['dates']); ?>;

        //max users
        let max_users = Math.max.apply(Math, users)+5;

        //sum all users
        let sum = users.reduce((partialSum, a) => partialSum + a, 0);
        //set max users count in label
        document.querySelector("#users-count").innerHTML = sum;

        let chart = document.querySelector("#myChart");

        //configure chart
        new Chart(chart, {
            type: "line",
            data: {
                labels: dates,
                datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: users,
                label: "Ilość",
                }]
            },
            options: {
                /*
                title: {
                    display: true,
                    text: 'Ilość wejść na strone'
                },
                */
                legend: {display: false},
                scales: {
                    yAxes: [{ticks: {min: 0, max:max_users}}]
                }
            }
        });
    
    </script>

</body>
</html>