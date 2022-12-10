<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <div id="chartdata">
        <div id="chart-header">
            <div class="option-chart">
                <div id="users-count-holder">
                    <div class="border-top"></div>
                    
                    <label for="users-count">Ilość wejść</label></br></br>
                    <span id="users-count-moves"></span>
                </div>

                <div id="select-chart">
                    <details class="custom-select">
                        <summary class="radios_moves">
                            <input type="radio" name="item" class="move_inputs" id="item1_moves" title="7 dni" onclick="chart_moves(1,7);" checked>
                            <input type="radio" name="item" class="move_inputs"  id="item2_moves" title="14 dni" onclick="chart_moves(2,14);">
                            <input type="radio" name="item" class="move_inputs"  id="item3_moves" title="1 miesiąc" onclick="chart_moves(6,30);">
                        </summary>
                        <ul class="list_moves">
                            <li>
                                <label class="label-select" for="item1_moves">
                                    7 dni
                                    <span id="span-select-move"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-select" for="item2_moves">14 dni</label>
                            </li>
                            <li>
                                <label class="label-select" for="item3_moves">1 miesiąc</label>
                            </li>
                        </ul>
                    </details>
                </div>
            </div>
        </div>

        <canvas id="myChart_moves"></canvas>
    </div>

    <?php
    
        function get_moves_dates() {
            global $con, $array_data;

            //get current date
            $mydate=getdate(date("U"));
            //set sql format date
            $current_date = "$mydate[year]-$mydate[mon]-$mydate[mday]";
            //from date
            $date_create = date_create($current_date);
            //minus six days form current date
            $from_date = date_sub($date_create,date_interval_create_from_date_string("29 days"))->format('Y-m-d');

            //seatrch moves
            $sql_all = "SELECT Count_visit, Date FROM Move WHERE Date BETWEEN '$from_date' AND '$current_date' GROUP BY Date";
            $query_all = mysqli_query($con, $sql_all);

            //get all dates between current and 6 day ago
            $period = new DatePeriod(
                new DateTime($from_date),
                new DateInterval('P1D'),
                new DateTime(date('Y-m-d', strtotime($current_date . ' +1 day')))
            );

            //insert data into arrays
            $users = [];
            $dates = [];
            $i=0; //counter
            foreach($period as $key => $value) {
                $users[$i] = 0;
                $dates[$i] = $value->format('Y-m-d');
                $i++;
            }

            //check which dates is same and update data
            while($row = mysqli_fetch_array($query_all)) {
                for($i=0; $i<sizeof($dates); $i++) {
                    if($dates[$i] == $row['Date']) {
                        $users[$i] = intval($row['Count_visit']);
                    }
                }
            }

            //combain all arrays
            $array_data = [
                "users"=>$users, 
                "dates"=>$dates
            ];
        }

        get_moves_dates();
    
    ?>

    <script>

        function chart_moves(space_between_dates=1, count_of_dates=7) {
            //arrays with data
            let users = <?php echo json_encode($array_data['users']); ?>;
            let dates = <?php echo json_encode($array_data['dates']); ?>;

            //new arrays
            let dates2 = [];
            let users2 = [];

            //append count of dates into new arrays
            let counter = 0;
            for(let i=dates.length-1; i>=dates.length - count_of_dates; i--) {
                dates2[counter] = dates[i];
                users2[counter] = users[i];
                counter++;
            }

            //reverse arrays
            dates2.reverse();
            users2.reverse();

            //create space between dates
            counter = 1;
            for(let i=0; i<dates2.length; i++) {
                if(counter != space_between_dates) {
                    dates2[i] = "";
                    counter++;
                }
                else {
                    counter = 1;
                }
            }

            //max users
            let max_users = Math.max.apply(Math, users)+5;

            //sum all users
            let sum = users2.reduce((partialSum, a) => partialSum + a, 0);
            //set max users count in label
            document.querySelector("#users-count-moves").innerHTML = sum;

            let chart = document.querySelector("#myChart_moves");

            //configure chart
            new Chart(chart, {
                type: "line",
                data: {
                    labels: dates2,
                    datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: users2,
                    label: "Ilość"
                    }]
                },
                options: {
                    legend: {display: false},
                    scales: {
                        yAxes: [{ticks: {min: 0, max:max_users}}]
                    }
                }
            });

        }

        chart_moves();
       
    </script>

</body>
</html>