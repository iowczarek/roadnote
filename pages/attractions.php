<?php
    session_start();

    if(!isset($_SESSION['logged'])){
        header('Location:login/login.php');
        exit();
    }
?>
<?php

require_once "login/connect.php";
$conn = connect();

// random top pics
function randomPicture() {
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
        echo '<div class="pic_desc" data-attraction="' . $randomRow['attr' . $i] . '">' .'<p>'. $randomRow['attr' . $i] .'</p>'. '</div>';
        echo '</div>';
    }
    echo '</div>';

} else {
    echo "No photos available.";
}
}
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
      <link rel="stylesheet" href="css/attractions.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title>roadnote • attractions</title>
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
            <div class="heading">
            <h1>Discover something new:</h1> 
            <div class="randompic">
            <?php 
            randomPicture();
            randomPicture();
            ?>
            </div>
            </br>
            <h1>Or search by a category: </h1>
</div>
            
            <table id="attractions_table">
    <tr>
        <th>Bays</th><th></th><th>Lakes</th><th></th><th>Islands</th><th></th><th>Waterfalls</th><th></th>
    </tr> 
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Al Kabir Beach">Al Kabir Beach</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Aydar">Aydar</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Bohol">Bohol</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Krushuna">Krushuna</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Gardens by the Bay">Gardens by the Bay</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Chott el Jerid">Chott el Jerid</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Giftun">Giftun</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Laton">Laton</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Half Moon Bay Beach">Half Moon Bay Beach</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Issyk Kul">Issyk Kul</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Gran Canaria">Gran Canaria</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Cambugahay">Cambugahay</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Ha-Long Bay">Ha-Long Bay</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Baikal">Baikal</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Isle of Wight">Isle of Wight</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Ouzoud">Ouzoud</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Balaton">Balaton</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Jeju Gods">Jeju Gods</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Niagara Falls">Niagara Falls</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Lake Garda">Garda</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Lanzarote">Lanzarote</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Hierve el agua">Hierve el agua</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Urmia">Urmia</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Milos">Milos</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Masurian Lakes">Masurian Lakes</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Mljet">Mljet</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Salt Lake Mir">Salt Lake Mir</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Mykonos">Mykonos</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Padar">Padar</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Rügen">Rügen</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Santorini">Santorini</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Tenerife">Tenerife</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>Cliffs</th><th></th><th>Canyons</th><th></th><th>National Parks</th><th></th><th></th><th></th>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Cliffs of Moher">Cliffs of Moher</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Canyon del Corte">Canyon del Corte</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Ba Be National Park">Ba Be</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Sarek">Sarek</a></td>
    </tr>
    <tr>
       <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Møns Klint">Møns Klint</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Grand Canyon">Grand Canyon</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Göreme">Göreme</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Seoraksan">Seoraksan</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="White Cliffs of Dover">White Cliffs of Dover</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Zanskar Rocky Canyon">Zanskar Rocky Canyon</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Hallasan">Hallasan</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Serra de Estrela">Serra de Estrela</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Hortobágy">Hortobágy</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Thy">Thy</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Iguazu">Iguazu</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Tierra del Fuego">Tierra del Fuego</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Jasper">Jasper</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Wicklow Mountains">Wicklow Mountains</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Kakadu">Kakadu</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Yellowstone">Yellowstone</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Krkonoše">Krkonoše</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Kruger">Kruger</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Ugam-Chatkal">Ugam-Chatkal</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="UA National Parks">UA National Parks</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Plitvice Lakes">Plitvice Lakes</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Ras Mohammed">Ras Mohammed</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Rila">Rila</a></td>
        <td></td>
        <td></td>
    </tr>
     <tr>
        <th>Cities</th><th></th><th></th><th></th><th>Towns</th><th></th><th>Museums</th><th></th>
    </tr>
    
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Amsterdam">Amsterdam</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Tokaj">Tokaj</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Haarlem">Haarlem</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Choeung Ek">Choeung Ek</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Ardennes">Ardennes</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Visby">Visby</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Dingle">Dingle</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Louvre">Louvre</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Bangkok">Bangkok</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Zakopane">Zakopane</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Maastricht">Maastricht</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Musée d´Orsay">Musée d´Orsay</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Bruges">Bruges</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="SG National Gallery">SG National Gallery</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Chiang Mai">Chiang Mai</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="De Haan">De Haan</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Gdańsk">Gdańsk</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Karakol">Karakol</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Malakka">Malakka</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Matmata">Matmata</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Nakhon Ratchasima">Nakhon Ratchasima</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Nazaré">Nazaré</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Pamukkale">Pamukkale</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Putrajaya">Putrajaya</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr>
        <th>Palace Temple</th><th></th><th>Towers</th><th></th><th>Mountains</th><th></th><th></th><th></th>
    </tr>
    
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Royal Palace">Royal Palace</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Eiffel Tower">Eiffel Tower</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Adršpach-Teplice Rocks">Adršpach-Teplice Rocks</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Mount Damavand">Mount Damavand</a></td>
    </tr>
    
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Schönbrunn Palace">Schönbrunn Palace</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Petronas Twin Towers">Petronas Twin Towers</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Altay">Altay</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Mount Vesuvius">Mount Vesuvius</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Angkor Wat">Angkor Wat</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Blue Mountains">Blue Mountains</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Patagonia">Patagonia</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Senso-ji">Senso-ji</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Chébika and Tamerza">Chébika and Tamerza</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Pilatus">Pilatus</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Fushimi Inari Taisha">Fushimi Inari Taisha</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Chimgan">Chimgan</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Schnyge Platte">Schnyge Platte</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Kinkaku-ji">Kinkaku-ji</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Dolomites">Dolomites</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Schwarzwald">Schwarzwald</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Cathedral of St. Stephan">Cathedral of St. Stephan</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Drakensberg">Drakensberg</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Ladakh Mountain Passes">Ladakh Mountain Passes</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Europaweg">Europaweg</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="The Rocky Mountains">The Rocky Mountains</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Great Smoky Mountains">Great Smoky Mountains</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Yanartaş">Yanartaş</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Huangshan Yellow Mountains">Huangshan Yellow Mountains</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Jebel Toubkal">Jebel Toubkal</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Jeti Oguz">Jeti Oguz</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Kerala Green State">Kerala Green State</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Langeberg and Outeniqua">Langeberg and Outeniqua</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>Other</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
    </tr>
    
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Batad rice terraces">Batad rice terraces</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Merapi Volcano">Merapi Volcano</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Cabo da Roca">Cabo da Roca</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Moravian Karst">Moravian Karst</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Cenotes in the Yucatan">Cenotes in the Yucatan</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Prater">Prater</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Chinatown">Chinatown</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Råbjerg Mile">Råbjerg Mile</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Devetashka Cave">Devetashka Cave</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Red Sea Coast">Red Sea Coast</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Great Barrier Reef">Great Barrier Reef</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Sahara">Sahara</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Jurassic Coast">Jurassic Coast</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Shilin Stone Forest">Shilin Stone Forest</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Kamchatka">Kamchatka</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Monkey Forest Ubud">Monkey Forest Ubud</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Kolmården">Kolmården</a></td>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Transcarpathian Ukraine">Transcarpathian Ukraine</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Kuej-lin Limestone Area">Kuej-lin Limestone Area</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Love Tunnel">Love Tunnel</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Lüneburg Heath">Lüneburg Heath</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Mecca">Mecca</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="attraction-link" data-attraction="Mekong Delta">Mekong Delta</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

<div id="attraction_info"></div> 

            </section>
            
        </div>
  <script src="js/attractions.js"></script>
  
    </body>
    <?php 
    $conn->close();
?>
    </html>