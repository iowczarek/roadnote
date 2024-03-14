const container = document.querySelector('.containter_weather');
const search = document.querySelector('.search-box #weather-search-icon');
const weatherBox = document.querySelector('.weather-box');
const weatherDetails = document.querySelector('.weather-details');
const error404 = document.querySelector('.not-found');
const defaultLoc = document.querySelector('.default-loc');


weatherBox.style.display = 'none';
weatherDetails.style.display = 'none';
defaultLoc.classList.add('fadeIn');
defaultLoc.style.display = 'block';

search.addEventListener('click', () => {

  const APIKey = '719013bafe0d80584a41aff146b0c8b9';
  const city = document.querySelector('.search-box input').value;
 
  if (city === '')
  return;
  
      
fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${APIKey}`)
.then(response => response.json())
.then(json => {

          if (json.cod === '404') {
              weatherBox.style.display = 'none';
              weatherDetails.style.display = 'none';
              error404.style.display = 'block';
              defaultLoc.style.display = 'none';
              error404.classList.add('fadeIn');
              
              return;
          }

          error404.style.display = 'none';
          error404.classList.remove('fadeIn');
          weatherBox.style.display = 'none';
        weatherDetails.style.display = 'none';

const image = document.querySelector('.weather-box img');
const temperature = document.querySelector('.weather-box .temperature');
const description = document.querySelector('.weather-box .description');
const humidity = document.querySelector('.weather-details .humidity span');
const wind = document.querySelector('.weather-details .wind span');
defaultLoc.style.display = 'none';

          switch (json.weather[0].main) {
              case 'Clear':
                  image.src = 'images/clear.png';
                  break;

              case 'Rain':
                  image.src = 'images/rain.png';
                  break;

              case 'Snow':
                  image.src = 'images/snow.png';
                  break;

              case 'Clouds':
                  image.src = 'images/cloud.png';
                  break;

              case 'Mist':
                  image.src = 'images/mist.png';
                  break;
                  
              case 'Haze':
                  image.src = 'images/haze.png';
                  break;

              default:
                  image.src = '';
          }

          temperature.innerHTML = `${parseInt(json.main.temp)}<span>°C</span>`;
          description.innerHTML = `${json.weather[0].description}`;
          humidity.innerHTML = `${json.main.humidity}%`;
          wind.innerHTML = `${parseInt(json.wind.speed)}Km/h`;

          weatherBox.style.display = '';
          weatherDetails.style.display = '';
          weatherBox.classList.add('fadeIn');
          weatherDetails.classList.add('fadeIn');
          container.style.height = '380px';


      });


});
//////////////////////////////////////////////////////CALENDAR//////////////////////////////////////////////////////

const currentDate = document.querySelector(".current-date"),
daysTag = document.querySelector(".days"),
prevNextIcon = document.querySelectorAll(".calendar_icons span");

// getting date, current year and month
let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), 
    lastDateofMonth = new Date(currYear, currMonth +1, 0).getDate(), 
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), 
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); 

    let liTag = ""; 

    for (let i = firstDayofMonth; i > 0; i--) { 
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`; 
    }
    for (let i = 1; i <= lastDateofMonth; i++) { 
        //adding active class to li if the current day, month, and year matched 
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                      && currYear === new Date().getFullYear() ? "active" : "";
    
        const eventForDay = events.find(event => {
        const eventStartDate = new Date(event.event_start_date);
        const eventEndDate = new Date(event.event_end_date);
        eventStartDate.setHours(0, 0, 0, 0);
        eventEndDate.setHours(0, 0, 0, 0);
        
        return eventStartDate <= new Date(currYear, currMonth, i) &&
        eventEndDate >= new Date(currYear, currMonth, i);
    });
        if (eventForDay) {
            //if there is an event, add class "event"
            liTag += `<li class="${isToday} event" style="background-color: ${eventForDay.event_color}" 
                                                        title="${eventForDay.event_name}">${i}</li>`;
        } else {
            liTag += `<li class="${isToday}">${i}</li>`;
        }
    }
    for (let i = lastDayofMonth; i < 6; i++) { 
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;  
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
    
}
renderCalendar();

prevNextIcon.forEach(icon =>{
    icon.addEventListener("click", () => { 
        currMonth =icon.id === "prev" ? currMonth - 1 : currMonth + 1; 
        if(currMonth < 0 || currMonth > 11){ 
            date = new Date(currYear, currMonth);
            currYear = date.getFullYear(); 
            currMonth = date.getMonth(); 
        } else { 
            date = new Date();
        }
        renderCalendar();
    });
})