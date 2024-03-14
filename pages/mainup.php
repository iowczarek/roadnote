<?php
$id = $_SESSION['id'];
function retrieveUserEvents($id) { 
    $conn = connect();
    $stmt = $conn->prepare("SELECT event_id, event_name, color, event_start_date, event_end_date, seen from calendar_events WHERE user_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $results = $stmt->get_result();

    $userEvents = array();

    if ($results && $results->num_rows > 0) {
    while ($row=$results->fetch_assoc()) {

        $userEvents[] = array(
            'event_id' => $row['event_id'],
            'event_name' => $row['event_name'],
            'event_color' => $row['color'],
            'event_start_date' => $row['event_start_date'],
            'event_end_date' => $row['event_end_date'],
            'event_seen' => $row['seen']
        );
    } 
}

$json_eventsdata = json_encode($userEvents);

return $json_eventsdata;
}
$json_eventsdata = retrieveUserEvents($id);
?>

<div id="notif_div">
                    
                </div>
                
<section class="mainup-container">
        <?php        
             echo   "<h1>Hello, ".$_SESSION['user']. "!</h1>";
        ?> 
           
                <div class="mainup-wrapper">
                    <span class="material-symbols-sharp" id="search-icon" >search</span>
                        <form action="informations.php" method="GET" id="searching_form">
                            <input class="mainup-search" placeholder="Search..." type="text" id="search_country" name="search_country">
                            <span class="mainup-clear" onclick="document.getElementById('search_country').value=''">
                            <span class="material-symbols-sharp" id="clear-icon">close</span>
                            
                         </form> 
                       
                </div>  
                    
                <div class="mainup-notification">
                
                <button type="button" class="notif_button" onclick="toggleDiv()">
                    <span class="material-symbols-sharp" id="notif">notifications</span>
                    <span class="icon-button__badge" id="badge"> </span>
                </button>

                    <a href="settings.php">
                   
                    <img src='includes/uploads/<?=$_SESSION['pp']?>' alt="avatar" style="width:38px;height:38px;">   
                    </a>
                </div>
                
</section>
<script>
   
var divVisible = false;
var notifMess = document.getElementById('notif_div');
notifMess.innerHTML = "no notifications";
var badgeElement = document.getElementById('badge');

function toggleDiv() {
    if (divVisible) {
        notifMess.style.display = 'none';
        
    } else {
        notifMess.style.display = 'block';
    }

    divVisible = !divVisible;
}

document.addEventListener('click', function(event) {
        var targetElement = event.target; // clicked element

        // if clicked inside div
        if (targetElement !== notifMess && targetElement !== document.getElementById('notif')) {
            //hide if not
            notifMess.style.display = 'none';
            divVisible = false;
        }
    });

   var events = <?php echo $json_eventsdata; ?>;
    const threeDaysFromNow = new Date();
    threeDaysFromNow.setDate(threeDaysFromNow.getDate() + 3);
    const threeDays = threeDaysFromNow.toLocaleDateString('en-US');

   const eventForDay = events.find(e => {

        const eventStartDate = new Date(e.event_start_date);
        const eventEndDate = new Date(e.event_end_date);
        eventStartDate.setHours(0, 0, 0, 0);
        eventEndDate.setHours(0, 0, 0, 0);
        
        startDate = eventStartDate.toLocaleDateString('en-US');
        var eventId = e.event_id;
        eventSeen = e.event_seen;

        if (startDate <= threeDays) {

            if (eventSeen == '0'){
            
            badgeElement.style.display = 'block';
            notifMess.innerHTML = `Event "${e.event_name}" starts in less than 3 days.`;
            
    notifMess.addEventListener('click', function() {
    

    $.ajax({
                url: './includes/change_notif.php',
                type: 'POST',
                data: {
                    eventId: eventId
                },
                
    success: function (response) {
        if (response.status) {
            badgeElement.style.display = 'none';
            notifMess.innerHTML = `No notifications`;
            notifMess.style.display = 'none';
            divVisible = false;
        } else {
            badgeElement.style.display = 'block';
        }
    }
})
});
        }
        else {
            badgeElement.style.display = 'none';
            notifMess.innerHTML = `No notifications`;
            notifMess.style.display = 'none';
            divVisible = false;
        }
    }
   });


</script>