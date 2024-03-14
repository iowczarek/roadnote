<?php
require_once "login/connect.php";
    session_start();

    if(!isset($_SESSION['logged'])){
        header('Location:login/login.php');
        exit();
    }
    $conn = connect();
?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="1.0">
      <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/mainup.css">
      <link rel="stylesheet" href="css/calendar.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      
      <title>roadnote • calendar</title>
    </head>
    
    <body>
           
    <?php 
    include_once 'sidebar.php';
?>
<?php 
    include_once 'mainup.php';
?>

<div class="w_calendar">


 <div id="main">
         <div id="container">
            
         <div id="header">
        
         <button id="todayButton" title="today">
            <span class="material-symbols-sharp">today</span>
        </button>

                <div id="monthDisplay"></div>
                <div>
                    
                    <button id="backButton" ><span class="material-symbols-sharp">chevron_left</span></button>
                     <button id="nextButton" ><span  class="material-symbols-sharp">chevron_right</span></button>

                </div>
            </div>

        <div id="cont_main">
            <div id="weekdays">
                <div>Sunday</div>
                <div>Monday</div>
                <div>Tuesday</div>
                <div>Wednesday</div>
                <div>Thursday</div>
                <div>Friday</div>
                <div>Saturday</div>
            </div>

            <div id="calendar"></div>
        </div>
        </div>

<!-- adding event popup -->
        <div id="newEventModal">
            <form><h2>ADD NEW EVENT</h2>
            <h3>Title:</h3>
                <input id="eventTitleInput" name="eventTitleInput" placeholder="Event title" />
            <div class="eventDates">
                <div class="startDate">
            <h3>Start date:</h3>
				<input type="date" name="event_start_date" id="event_start_date">
                </div>
            <div class="endDate">
                <h3>End date:</h3>	 
				<input type="date" name="event_end_date" id="event_end_date"></br>
                </div></form>

                
            </div>
            <div id="errorMessage"></div>
            <div class="eventButtons">   
            <button id="saveButton">Save</button>
            <button id="cancelButton">Cancel</button></div> 
        </div>

<!-- del event popup  -->
<div id="deleteEventModal">
            
            <h2 id="eventText"></h2>
            <h3>duration:</h3> 
            <div class="exEvents">
            
                <h3 id="eventStart"></h3>
                <h3> • </h3>
                <h3 id="eventEnd"></h3>
    
                
            </div>
            <div class="eventButtons"> 
            <button id="deleteButton">Delete</button>
            <button id="closeButton">Close</button>
            </div>
</div>
 <!-- changind data mess  -->
    <div id="status">
                        <?php 
                         if (isset($_GET['success'])) {
                           
                            echo '<h2 class=bg-success> '.'Event was added to your calendar!'.'</h2>';
                            
                        }if (isset($_GET['error'])) {
                           
                            echo '<h2 class=bg-error> '.'Unknown error occurred!'.'</h2>';
                        }

                        if (isset($_GET['esuccess'])) {

                            echo '<h2 class=bg-success> '.'Event was deleted from your calendar!'.'</h2>';
                            
                        }
                        ?>
                </div>

                <div id="userEventsContainer"></div>

        <div id="modalBackDrop"></div>

    </div>
        </div>
        <script type="text/javascript">
             var user_id = <?php echo json_encode($id); ?>;
         

        </script>
  <script src="js/calendar.js"></script>
 
    </body>
    </html>

