$(document).ready(function() {
    $(".country-link").click(function(e) {
      
        e.preventDefault(); 
        var country = $(this).data("country");
        
        $.ajax({
            url: "./includes/get_country_info.php",
            method: "POST",
            data: { country: country },
            success: function(response) {
                $("#country_info").html(response);
                window.scrollTo(0, document.body.scrollHeight);
                
            }
        });
       
        
    });
});

// searchbar 
$(document).ready(function() {
   
    var searchCountry = getUrlParameter('search_country');
    var searchCountry = searchCountry.replace(/\+/g, ' ');
    
    if (searchCountry) {
        $.ajax({
            url: "./includes/get_country_info.php",
            method: "POST",
            data: { country: searchCountry },
            success: function(response) {
                
                $("#country_info").html(response);
                window.scrollTo(0, document.body.scrollHeight);
            }
        });
    }

function getUrlParameter(name) {
    
        var queryString = window.location.search.substring(1);
        var queryParams = queryString.split('&');
        for (var i = 0; i < queryParams.length; i++) {
            var param = queryParams[i].split('=');
            if (param[0] === name) {
                return decodeURIComponent(param[1]);
            }
        }
        return '';
    }
});

const searchForm = document.getElementById('searching_form');
const searchInput = document.getElementById('search_country');
const countryInfo = document.getElementById('country_info');
const countryLinks = document.querySelectorAll('.country-link');

searchForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const searchText = searchInput.value.trim().toLowerCase()
    for (let link of countryLinks) {
        const countryName = link.dataset.country.toLowerCase();
        if (countryName.includes(searchText)) {
            link.click();
            return;
        }
        else {}
    }
});
