<?php
    session_start();
    require "includes/map_continents.php";

    if(!isset($_SESSION['logged'])){
        header('Location:login/login.php');
        exit();
    }
    require_once "login/connect.php";
    $conn = connect();
    $id = $_SESSION['id'];

    function retrieveProfileInfo($id) { //getting user data
        $conn = connect();
        $stmt = $conn->prepare("SELECT country_id from map_records WHERE user_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $results = $stmt->get_result();
    
        if ($results && $results->num_rows > 0) {
        while ($row=$results->fetch_assoc()) {
            $isInDatabase[] = $row['country_id']; 
        } 
    }else {
            $isInDatabase = [];
            $_SESSION['status'] = "No records to display";
            $_SESSION['status_code'] = "error";
        }
        $json_data = json_encode($isInDatabase);
        return $json_data;
    }
    $json_data = retrieveProfileInfo($id);
    $info = retrieveProfileInfo($id);
    $percentworld = percentworld();
    $percenteuropa = percenteurope();
    $percentasia = percentasia();
    $percentnam = percentnam();
    $percentsam = percentsam();
    $percentaustralia = percentaustr();
    $percentafryka = percentafrica();

    function picsSection() {
      global $conn;
    
      $sql = "SELECT pic1, pic2, pic3, attr1, attr2, attr3 FROM countries_attractions";
      $result = $conn->query($sql);
    
      if ($result->num_rows > 0) {
        $ranResult = $result->fetch_all(MYSQLI_ASSOC);
        $randomRow = $ranResult[array_rand($ranResult)];
        echo '<div class="photos-line">';
        for ($i = 1; $i <= 3; $i++) {
            echo '<div class="pic-container">';
            echo '<img class="attraction-photo" src="data:image/jpeg;base64,' . base64_encode($randomRow['pic' . $i]) . '" alt="random photo">';
            echo '<div class="pic_desc">' .'<p>'. $randomRow['attr' . $i] .'</p>'. '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No photos available.";
    }
    }
function retrieveNotes($id) { 
        $conn = connect();
        $stmt = $conn->prepare("SELECT * from user_notes WHERE user_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $results = $stmt->get_result();
        $userDatabase = array(); 
      
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $userDatabase[] = $row; 
            }
        } else {
            $_SESSION['status'] = "No records to display";
            $_SESSION['status_code'] = "error";
        }
      
        return $userDatabase; 
      }
      $notes = retrieveNotes($id);

    $scoreasia = 189 - 189 * $percentasia/100;
    $scoreeurope = 189 - 189 * $percenteuropa/100;
    $scoreworld = 189 - 189 * $percentworld/100;
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="1.0">
      <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;600;700&display=swap" rel="stylesheet">
      <script src="https://kit.fontawesome.com/381a9823e2.js" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/mainup.css">
      <link rel="stylesheet" href="css/dashboard.css">
      <title>roadnote • dashboard</title>
      <style>
        @keyframes anim1{
    100%{
        stroke-dashoffset: <?php echo $scoreworld; ?>;
    }
    }

    @keyframes anim2{
    100%{
        stroke-dashoffset: <?php echo $scoreeurope; ?>;
    }
    }

    @keyframes anim3{
    100%{
        stroke-dashoffset: <?php echo $scoreasia; ?>;
    }
    }

      </style>
    </head>
    
    <body>
        
        <div class="dashboard">

<?php 
    include_once 'sidebar.php';
?>
<?php 
    include_once 'mainup.php';
?>
<section class="main">
<div class="left-box">
<div class="container_headers">
    <h1>Add new memories:</h1>
    <h1>Upcoming events:</h1>
</div>

<div class="container_trips">
    
<div class="add-manage">   
            <a href="newnote.php">
                            <img src="svg/add.svg" class="add-icon" />
                            <h3>Add</h3>
                        </a>
            <a href="trips.php">
                            <img src="svg/manage.svg" class="manage-icon" />
                            <h3>Manage</h3>
                        </a>
                </div> 

    <div class="prevtrips">
    <p>Previous trips: </p>
    <div class="note-container">
        <?php
        // database notes
        $reversedNotes = array_reverse($notes);
        $lastFourNotes = array_slice($reversedNotes, 0, 4);
        foreach ($lastFourNotes as $note) {
            echo '<a href="newnote.php?nid=' . $note['note_id'] . '">';
            echo '<img src="svg/file.svg" class="file-icon" />';
            echo '<h3>' . $note['note_title'] . '</h3>';
            echo '</a>';
        }
            ?>  
        </div>
</div>
</div>

        <div class="container_calendar">

            <header>
                <p class="current-date"></p>
                <div class="calendar_icons">
                    <span id="prev" class="material-symbols-sharp">chevron_left</span>
                    <span id="next" class="material-symbols-sharp">chevron_right</span>
                </div>
            </header>
            <div class="calendar">
               <ul class="weeks">
                    <li>Sun</li>
                    <li>Mon</li>
                    <li>Tue</li>
                    <li>Wed</li>
                    <li>Thu</li>
                    <li>Fri</li>
                    <li>Sat</li>
               </ul> 
               <ul class="days">
                    
               </ul> 
            </div>
        </div>

        <div class="container_headers-fav">
    <h1>Find breathtaking destinations:</h1>
</div>
        <div class="container_favourites">
        <?php 
            picsSection();
            ?>
    
        </div>
        

</div>

<div class="right-box">

        <div class="container_weather">
            <div class="search-box">
            <span class="material-symbols-sharp" id="weather-location-icon">location_on</span>
                <input type="text" placeholder="Enter location...">
                <span class="material-symbols-sharp" id="weather-search-icon">search</span>
            </div>
            
            <div class="default-loc">
                <img src="images/defweather.png">
                <p>Search your location!</p>
            </div>

            <div class="not-found">
                <img src="images/404.png">
                <p>Oops! Invalid location :/</p>
            </div>
            

            <div class="weather-box">
                <img src="" >
                <p class="temperature"></p>
                <p class="description"></p>
            </div>

            <div class="weather-details">
                <div class="humidity">
                    <i class="fa-solid fa-water"></i>
                    <div class="text">
                    <span></span>
                    <p>Humidity</p>
                </div>
                </div>

                <div class="wind">
                    <i class="fa-solid fa-wind"></i>
                    <div class="text">
                    <span></span>
                    <p>Wind Speed</p>
                </div>
                </div>
            </div>
            
        </div>

        <div class="container_stats"> 
                
                 <div class="stats_header">
                    <p>Statistics:</p> 
                 <a href="map.php"><span class="material-symbols-sharp">more_horiz</span></a>
                </div>
                
                 <div class="stats_charts">
                <!-- europe -->
                <svg>
                    <circle cx="45" cy="40" r="34" fill="#F9F9F9" ></circle>
                    <circle cx="45" cy="40" r="26" fill="white"></circle>
                    <circle id="world_circle" cx="45" cy="40" r="30" 
                    background-color= "transparent";
                    fill="none";
                    stroke="#8db383";
                    stroke-width= "8";
                    stroke-linecap= "round";
                    stroke-dasharray="<?php echo $percentworld  ?>, 100 ";
                    ></circle>
                    <text x="45" y="40" text-anchor="middle" dy="0.4em" fill="#8db383" font-size="12px" font-weight="600">
                        <?php echo $percentworld ?>%
                    </text>
                    
                    <!-- Text below the circle -->
                    <text x="45" y="40" text-anchor="middle" dy="4.5em" fill="#333" font-size="14px">
        World
    </text>
                </svg>

                <svg>
                    <circle cx="45" cy="40" r="34" fill="#F9F9F9" ></circle>
                    <circle cx="45" cy="40" r="26" fill="white"></circle>
                    <circle id="europe_circle" cx="45" cy="40" r="30" 
                    background-color= "transparent";
                    fill="none";
                    stroke="#F6CE74";
                    stroke-width= "8";
                    stroke-linecap= "round";
                    stroke-dasharray="<?php echo $percenteuropa  ?> ";
                    ></circle>
                    <text x="45" y="40" text-anchor="middle" dy="0.4em" fill="#F6CE74" font-size="12px" font-weight="600">
                        <?php echo $percenteuropa ?>%
                    </text>
                    
                    <!-- Text below the circle -->
                    <text x="45" y="40" text-anchor="middle" dy="4.5em" fill="#333" font-size="14px">
        Europe
    </text>
                </svg>
                <svg>
                    <circle cx="45" cy="40" r="34" fill="#F9F9F9" ></circle>
                    <circle cx="45" cy="40" r="26" fill="white"></circle>
                    <circle id="asia_circle" cx="45" cy="40" r="30" 
                   
                    ></circle>
                    <text x="45" y="40" text-anchor="middle" dy="0.4em" fill="#D88864" font-size="12px" font-weight="600">
                        <?php echo $percentasia ?>%
                    </text>
                    
                    <!-- Text below the circle -->
                    <text x="45" y="40" text-anchor="middle" dy="4.5em" fill="#333" font-size="14px">
        Asia
    </text>
              
</div>
         </div>
</div>
        </section>
</div>
        
        <script src="https://kit.fontawesome.com/7c8801c017.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            
            var user_id = <?php echo json_encode($id); ?>;

        </script>
        <script src="js/dashboard.js"></script>
        
        
        
    </body>
    </html>