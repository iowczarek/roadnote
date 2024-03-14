let nav = 0; //month im on
let clicked = null; 

const calendar = document.getElementById('calendar');
const errorMessage = document.getElementById('errorMessage');
const eventStartModal = document.getElementById('eventStart');
const eventEndModal = document.getElementById('eventEnd');
const newEventModal = document.getElementById('newEventModal');
const deleteEventModal = document.getElementById('deleteEventModal');
const backDrop = document.getElementById('modalBackDrop');
const eventTitleInput = document.getElementById('eventTitleInput');
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']; 

// popup new event
function openModal(date){
    //mm-dd-yyyy
    clicked = date;

    const eventForDay = events.find(e => {
        //yyyy-mm-dd
        const eventStartDate = new Date(e.event_start_date);
        const eventEndDate = new Date(e.event_end_date);
        
        eventStartDate.setHours(0, 0, 0, 0);
        eventEndDate.setHours(0, 0, 0, 0);
        
        const formattedClicked = new Date(clicked);
       
        // Check if the current day falls within the range of the event
        return formattedClicked >= eventStartDate && formattedClicked <= eventEndDate;
    })

    if(eventForDay){
        document.getElementById('eventText').innerText = eventForDay.event_name;
        deleteEventModal.style.display = 'block';
        eventStartModal.innerHTML =eventForDay.event_start_date;
        eventEndModal.innerHTML =eventForDay.event_end_date;
        document.getElementById('deleteButton').addEventListener('click', () =>  deleteEvent(eventForDay));
        document.getElementById('closeButton').addEventListener('click', closeModal);

    } else {
        newEventModal.style.display = 'block';
        const startDateInput = document.getElementById('event_start_date');
        const endDateInput = document.getElementById('event_end_date');
        const formattedClicked = new Date(clicked);
        const formattedDate = `${formattedClicked.getFullYear()}-${(formattedClicked.getMonth() + 1).toString().padStart(2, '0')}-${formattedClicked.getDate().toString().padStart(2, '0')}`;

        startDateInput.value = formattedDate;
        endDateInput.value = formattedDate;
        document.getElementById('saveButton').addEventListener('click', saveEvent);
        document.getElementById('cancelButton').addEventListener('click', closeModal);
    }
        backDrop.style.display = 'block';
}

function load(){
    const dt = new Date();

    if (nav !== 0){
        dt.setMonth(new Date().getMonth() + nav);
    }

    const day = dt.getDate();
    const month = dt.getMonth();
    const year = dt.getFullYear();
    const firstDayOfMonth = new Date(year, month, 1);
    const daysInMonth = new Date(year, month +1, 0).getDate();

    const dateString = firstDayOfMonth.toLocaleDateString('en-us', { //first day of the month
        weekday: 'long',
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
    });

    const paddingDays = weekdays.indexOf(dateString.split(', ')[0]); 
    //month, day
    document.getElementById('monthDisplay').innerText = 
    `${dt.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

    calendar.innerHTML = '';
     
    for (let i = 1; i <= paddingDays + daysInMonth; i++ ){
        const daySquare = document.createElement('div');
        daySquare.classList.add('day');
        const dayString = `${month +1}/${i - paddingDays}/${year}`;

     if (i > paddingDays){
         daySquare.innerText = i - paddingDays;

        const eventForDay = events.find(e => {
        const eventStartDate = new Date(e.event_start_date);
        const eventEndDate = new Date(e.event_end_date);
        eventStartDate.setHours(0, 0, 0, 0);
        eventEndDate.setHours(0, 0, 0, 0);
        const formattedDayString = new Date(dayString);

        //checking if the current day falls within the range of the event
        return formattedDayString >= eventStartDate && formattedDayString <= eventEndDate;
        });
    
        if(i - paddingDays === day && nav === 0){
            daySquare.id = 'currentDay';
        }
        //showing event 
        if (eventForDay){
            const eventDiv = document.createElement('div');
            eventDiv.classList.add('event');
            eventDiv.innerText = eventForDay.event_name;
            eventDiv.style.backgroundColor = eventForDay.event_color;
            daySquare.appendChild(eventDiv);
        }

         daySquare.addEventListener('click', () => openModal(dayString));

     } else {
         daySquare.classList.add('padding');
     }

     calendar.appendChild(daySquare);
    }
   
}       

function saveEvent(){
var eventTitleValue = $('#eventTitleInput').val();
var event_start_date = $('#event_start_date').val();
var event_end_date = $('#event_end_date').val();

    if (eventTitleInput.value) { 
        if (event_start_date > event_end_date){
            errorMessage.innerHTML = 'Choose correct dates';
        }
        else{
            eventTitleInput.classList.remove('error');
            $.ajax({
                url: './includes/save_event.php',
                type: 'POST',
                data: {
                    eventTitleValue: eventTitleValue,
                    event_start_date: event_start_date,
                    event_end_date: event_end_date,
                    user_id: user_id,
                },
    success: function (response) {
        if (response.status) {
            window.location.href = './calendar.php?success';
        } else {
            window.location.href = './calendar.php?error';
        }
    }
  })}
}
else {
    eventTitleInput.classList.add('error');
    errorMessage.innerHTML = 'No title';
    }
}

function deleteEvent(event){

const event_id = event.event_id; 

    $.ajax({
        url: './includes/delete_event.php',
        type: 'POST',
        data: {
           event_id: event_id,
        },
    success: function (response) {
    if (response.status) {
        window.location.href = './calendar.php?esuccess';
    } else {
        window.location.href = './calendar.php?error';
}}}
)
}

function closeModal(){
    eventTitleInput.classList.remove('error');
    newEventModal.style.display = 'none';
    deleteEventModal.style.display = 'none';
    backDrop.style.display = 'none';
    eventTitleInput.value = '';
    errorMessage.innerHTML = '';
    eventStartModal.innerHTML = '';
    eventEndModal.innerHTML = '';
    clicked = null;
    load();
}
function initButtons() {
    document.getElementById('nextButton').addEventListener('click', () => {
        nav++;
        load();
    });
    document.getElementById('backButton').addEventListener('click', () => {
        nav--;
        load();
    });
    document.getElementById('todayButton').addEventListener('click',() => { nav = 0; load();});
}

initButtons();
load();

