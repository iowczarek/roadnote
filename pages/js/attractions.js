$(document).ready(function() {
    $(".attraction-link").click(function(e) {
        e.preventDefault(); 
        var attraction = $(this).data("attraction");
        fetchAttractionInfo(attraction);
    });

    $(".pic_desc").click(function() {
      
        var attraction = $(this).data("attraction");
        fetchAttractionInfo(attraction);
    });

    function fetchAttractionInfo(attraction) {
        $.ajax({
            url: "./includes/get_attraction_info.php",
            method: "POST",
            data: { attraction: attraction },
            success: function(response) {
                $("#attraction_info").html(response);
                window.scrollTo(0, document.body.scrollHeight);
            }
        });
    }
});
