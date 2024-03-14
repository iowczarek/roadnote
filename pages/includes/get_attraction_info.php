<?php

include "../login/connect.php";    
$conn = connect();
    if($conn->connect_errno!=0){
        echo "Error: ".$conn->connect_errno;
    }
$attraction = $_POST["attraction"];  

$query1 = "SELECT desc1, country_name, pic1 FROM countries_attractions WHERE attr1 = ?";
$query2 = "SELECT desc2, country_name, pic2 FROM countries_attractions WHERE attr2 = ?";
$query3 = "SELECT desc3, country_name, pic3 FROM countries_attractions WHERE attr3 = ?";
$stmt1 = $conn->prepare($query1);
$stmt1->bind_param("s", $attraction);
$stmt1->execute();
$result1 = $stmt1->get_result();

$stmt2 = $conn->prepare($query2);
$stmt2->bind_param("s", $attraction);
$stmt2->execute();
$result2 = $stmt2->get_result();

$stmt3 = $conn->prepare($query3);
$stmt3->bind_param("s", $attraction);
$stmt3->execute();
$result3 = $stmt3->get_result();

echo  "<br>";
echo "<button id='backButton' onclick='window.scrollTo(0, 0)'>";
echo "<span class='material-symbols-sharp'>arrow_upward</span>";
echo "</button>";
echo "<div class='info_attraction'>";
if ($result1->num_rows > 0) {
    $row = $result1->fetch_assoc();

echo "<b>Attraction: </b>" . $attraction . "<br>";
echo "<b>Country: </b>" . $row['country_name'] . "<br>" . "<br>";
echo "<b>Description: </b>" ."<br>". $row['desc1'] . "<br>";
$imageBlob = $row["pic1"];
echo '<img src="data:image/jpeg;base64,' . base64_encode($imageBlob) . '" alt="pic">';
$country_search = str_replace(' ', '+',$row['country_name']);
echo "<p><a href=" ."./informations.php?search_country=".$country_search.">go to informations ↗</a></p>";
}
if($result2->num_rows > 0) {
    $row = $result2->fetch_assoc();

    echo "<b>Attraction: </b>" . $attraction . "<br>";
    echo "<b>Country: </b>" . $row['country_name'] . "<br>" . "<br>";
    echo "<b>Description: </b>" ."<br>". $row['desc2'] . "<br>";
    $imageBlob = $row["pic2"];
echo '<img src="data:image/jpeg;base64,' . base64_encode($imageBlob) . '" alt="pic">';
$country_search = str_replace(' ', '+',$row['country_name']);
echo "<p><a href=" ."./informations.php?search_country=".$country_search.">go to informations ↗</a></p>";
}
if($result3->num_rows > 0) {
    $row = $result3->fetch_assoc();

    echo "<b>Attraction: </b>" . $attraction . "<br>";
    echo "<b>Country: </b>" . $row['country_name'] . "<br>" . "<br>";
    echo "<b>Description: </b>" ."<br>". $row['desc3'] . "<br>";
    $imageBlob = $row["pic3"];
echo '<img src="data:image/jpeg;base64,' . base64_encode($imageBlob) . '" alt="pic">';
$country_search = str_replace(' ', '+',$row['country_name']);
echo "<p><a href=" ."./informations.php?search_country=".$country_search.">go to informations ↗</a></p>";

}   
echo "</div>";    
    
if($result1->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0) {
    echo  "<br>";
    echo "<div class='info_attraction'>";
    echo "<b>Attraction: </b> " . $attraction . "<br>";
    echo "Sorry! No info.";
    echo "</div>";
}
$stmt1->close();
$stmt2->close();
$stmt3->close();
$conn->close();
?>