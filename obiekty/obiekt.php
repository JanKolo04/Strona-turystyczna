<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-obiekt.css">
</head>
<body>

    <?php


        function object_data() {
            global $con, $source_photos, $file_count;

            //object id
            $object_id = $_GET['obiekt'];

            //select data
            $sql = "SELECT Obiekty.*, Architekci.*, Trasy.Nazwa AS 'trasa_nazwa' FROM Obiekty INNER JOIN Architekci ON Architekci.Id=Obiekty.Id_architekt INNER JOIN Trasy ON Trasy.Id=Obiekty.Id_trasa WHERE Obiekty.Id=$object_id";
            $query = mysqli_query($con, $sql);

            //show all data
            if($query->num_rows > 0) {
                while($row = mysqli_fetch_array($query)) {
                    //source to photos
                    $source_photos = "img/".$row['Media']."/";
                    $main_file = $source_photos."main\ 1.jpeg";

                    $iterator = new FilesystemIterator($source_photos, FilesystemIterator::SKIP_DOTS);
                    $file_count = iterator_count($iterator);
                    $flex = "flex";
                    echo "  
                        <div id='currentObjectName'>
                            <h1>{$row['Nazwa']}</h1>
                        </div>
                        <div id='objectData'>
                            <div id='currentObjectInfo'>       
                                <div id='details'>               
                                    <p id='currentObjectLocation'><img id='iconLocationCurrentObject' src='img/icon/bookmark.png'> {$row['trasa_nazwa']}</p>
                                    
                                    <div id='architect' class='infoDiv'>
                                        <label>Architekt:</label>
                                        <h3>{$row['Imie']} {$row['Nazwisko']}</h3>
                                    </div>

                                    <div id='years' class='infoDiv'>
                                        <label>Lata budowy:</label>
                                        <h3>{$row['Rok_budowy']}</h3>
                                    </div>

                                    <div id='place' class='infoDiv'>
                                        <label>Miejsce:</label>
                                        <h3>{$row['Miejsce']}</h3>
                                    </div>

                                    <div id='category' class='infoDiv'>
                                        <label>Typ obiektu:</label>
                                        <h3>{$row['Kategoria']}</h3>
                                    </div>
                                </div>
                            </div>

                            <div id='gallery' style='background-image: url($main_file);'>
                                <div id='navigation-menu-gallery'>
                                    <div id='maxview-button-holder'>
                                        <button onclick='open_close_maxview(this)' class='gallery-button' id='open-maxview' value='flex'></button>
                                    </div>
                                    <div id='navigation-buttons-holder'>
                                        <div id='space'>
                                            <button onclick='change_photo()' class='gallery-button previous-button' id='previous-button'></button>
                                            <button class='gallery-button next-button' id='next-button' style='margin-right: 40px;'></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                }
            }
        }

        //show objects which you can see on route
        function show_close_objects() {
            global $con;

            //get architect ID
            $route_id = $_GET['trasa'];
            //obejct Id
            $object_id = $_GET['obiekt'];

            //get all works created by this architect
            $sql_obiekt = "SELECT * FROM Obiekty WHERE Id_trasa=$route_id AND Id != $object_id";
            $query_obiekt = mysqli_query($con, $sql_obiekt);

            //show works
            if($query_obiekt->num_rows > 0) {
                while($row_works = mysqli_fetch_array($query_obiekt)) {
                    //link_to_work
                    $link_to_work = "index.php?strona=obiekty/obiekt&obiekt={$row_works['Id']}&trasa={$row_works['Id_trasa']}";
                    echo "
                        <div class='workHolder'>
                            <a href='$link_to_work'><img class='workImg' src='img/{$row_works['Media']}/main 1.jpeg'></a>
                            <div class='workInfo'>
                                <a class='workName' href='$link_to_work'><h4>{$row_works['Nazwa']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
                            </div>
                        </div>
                    ";
                }
            }
        }

    ?>

    <div id="maxview-gallery">
        <div id="maxview-header">
            <button onclick="open_close_maxview(this);" id="close-maxview" class="gallery-button" value='none'></button>
        </div>

        <div id="maxview-content">
            <div class="navigation-button-holder-maxsize">
                <button class='gallery-button previous-button' id="previous-button-maxview"></button>
            </div>

            <div id="max-view-photo-holder" style="background-image: url('img/kosciol_mariacki/main 1.jpeg');"></div>

            <div class="navigation-button-holder-maxsize">
                <button class='gallery-button next-button' id="next-button-maxview"></button>
            </div>
        </div>
    </div>

    <div id='currentObejctHolder'>
        <?php object_data(); ?>
    </div>

    <div id='objectsMainHolder'>
        <div id='objectsHolderHeader'>
            <h2>Inne obiekty na tej trasie</h2>
        </div>
        <div id='objectsHolder'>
            <?php show_close_objects(); ?>
        </div>
    </div>

    <script>

        function open_close_maxview(element) {
            //get maxview gallery
            let maxview = document.querySelector('#maxview-gallery');
            //action on maxview
            console.log(element.value);
            maxview.style.display = element.value;

            if(element.value == "flex") {
                document.querySelector('#currentObejctHolder').style.display = "none";
                document.querySelector('#objectsMainHolder').style.display = "none";
                document.querySelector('#baner').style.display = "none";
                document.querySelector('#footer').style.display = "none";
                document.querySelector('#margin-top-div').style.display = "none";
                document.querySelector('#maxview-gallery').animationName = "animation-maxview";
            }
            else {
                document.querySelector('#currentObejctHolder').style.display = "block";
                document.querySelector('#objectsMainHolder').style.display = "flex";
                document.querySelector('#baner').style.display = "flex";
                document.querySelector('#footer').style.display = "flex";
                document.querySelector('#margin-top-div').style.display = "block";
                document.querySelector('#maxview-gallery').animationName = "";
            }
        }

        function change_photo(button_prev, button_next, backGround) {
            //soruce of object media 
            let source_photos = <?php echo json_encode($source_photos); ?>;

            //main file name
            let file_name = "main";

            //len of all photos
            let len = <?php echo json_encode($file_count); ?>;

            let i = 1; //iteration
            //function for previous button
            button_prev.onclick = function() {
                //photo name
                let photo = "";
                if(i == 1) {
                    photo = file_name+" "+len+".jpeg";
                    i = len;
                }
                else {
                    photo = file_name+" "+(i-1)+".jpeg";
                    i--;
                }
                //set new photo
                backGround.style = "background-image: url('"+source_photos+photo+"')";
            }

            //function for next button
            button_next.onclick = function() {
                //photo name
                let photo = "";
                if(i == len) {
                    photo = file_name+" "+1+".jpeg";
                    i = 1;
                }
                else {
                    photo = file_name+" "+(i+1)+".jpeg";
                    i++;
                }
                //set new photo
                backGround.style = "background-image: url('"+source_photos+photo+"')";
            }
        }
        
        window.onload = function() {
            //default change photo
            let button_prev_def = document.querySelector("#previous-button");
            let button_next_def = document.querySelector("#next-button");
            let backGround_def = document.querySelector("#gallery");

            change_photo(button_prev_def, button_next_def, backGround_def);

            //maxview photo
            let button_prev_max = document.querySelector("#previous-button-maxview");
            let button_next_max = document.querySelector("#next-button-maxview");
            let backGround_max = document.querySelector("#max-view-photo-holder");

            change_photo(button_prev_max, button_next_max, backGround_max);
        }

    </script>


</body>
</html>