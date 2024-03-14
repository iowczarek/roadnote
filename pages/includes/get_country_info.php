<?php

include "../login/connect.php";    
$conn = connect();
    if($conn->connect_errno!=0){
        echo "Error: ".$conn->connect_errno;
    }

$country = $_POST["country"];
$query ="SELECT cg.*, ca.pic1, ca.pic2, ca.pic3, ca.attr1, ca.attr2, ca.attr3
            FROM countries_general cg
            INNER JOIN countries_attractions ca 
            ON cg.country_name = ca.country_name
            WHERE cg.country_name = ?;";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $country);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageBlob1 = $row["pic1"];
    $imageBlob2 = $row["pic2"];
    $imageBlob3 = $row["pic3"];
   
    // send back to js
    
    echo  "<br>";
    echo "<button id='backButton' onclick='window.scrollTo(0, 0)'>";
    echo "<span class='material-symbols-sharp'>arrow_upward</span>";
    echo "</button>";
    echo "<div class='info_country'>";
    echo "<b>Country:</b> " . $row["country_name"] . "<br>";
    echo "<b>Language:</b> " . $row["language_id"]. "<br>";
    echo "<b>Currency:</b> " . $row["currency_id"]. "<br>";
    echo "<b>Speed limits:</b>". "<br>";
    echo " &nbsp;&nbsp;• city: " . $row["driving_city"]. "<br>";
    echo " &nbsp;&nbsp;• highway: " . $row["driving_highway"]. "<br>";
    echo " &nbsp;&nbsp;• other: " . $row["driving_out"]. "<br>";
    echo "<b>Needed document:</b> " . $row["documents"]. "<br>". "<br>";
    echo "<b>Attractions:</b>". "<br>";
    
        echo '<div class="photos-line">';   
        echo '<div class="attractions-container">';   
        echo '<img class="attraction-photo" src="data:image/jpeg;base64,' . base64_encode($imageBlob1) . '" alt="zdjecie">';
        echo '<div class="pic_desc">' .'<p>'. $row["attr1"] .'</p>'. '</div>';
        echo '</div>';
        echo '<div class="attractions-container">'; 
        echo '<img class="attraction-photo" src="data:image/jpeg;base64,' . base64_encode($imageBlob2) . '" alt="zdjecie">';
        echo '<div class="pic_desc">' .'<p>'. $row["attr2"] .'</p>'. '</div>';
        echo '</div>';
        echo '<div class="attractions-container">'; 
        echo '<img class="attraction-photo" src="data:image/jpeg;base64,' . base64_encode($imageBlob3) . '" alt="zdjecie">';
        echo '<div class="pic_desc">' .'<p>'. $row["attr3"] .'</p>'. '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div';
    echo "</div>";
} else {
    echo  "<br>";
    echo "<button id='backButton' onclick='window.scrollTo(0, 0)'>";
    echo "<span class='material-symbols-sharp'>arrow_upward</span>";
    echo "</button>";
    echo "<div class='info_country'>";
    echo "<b>Country:</b> " . $country . "<br>";
    echo "Sorry! No info.";
    echo "</div>";
}

$stmt->close();
$conn->close();
?>