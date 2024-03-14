<?php                
function getTotalArea($countries) {
    $conn = connect();
    if ($conn->connect_error) {
        die("Database connection error: " . $conn->connect_error);
    }
    $countryList = implode("','", $countries);
    $sql = "SELECT country_name, total_area FROM map_area WHERE country_name IN ('$countryList')";
    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$row['country_name']] = $row['total_area'];
        }
    }
    $conn->close();
    return $data;
}
function getContinent($countries) {
    $conn = connect();
    if ($conn->connect_error) {
        die("Database connection error: " . $conn->connect_error);
    }
    $countryList = implode("','", $countries);
    $sql = "SELECT country_name, continent FROM map_area WHERE country_name IN ('$countryList')";
    $result = $conn->query($sql);
    $datacontinent = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $datacontinent[$row['country_name']] = $row['continent'];
        }
    }
    $conn->close();
    return $datacontinent;
}
function percentworld(){
    $conn = connect();
    $id = $_SESSION['id'];

$userCountriesJson = retrieveProfileInfo($id);
$userCountries = json_decode($userCountriesJson);
$sum = 0;

$countryData = getTotalArea($userCountries);
foreach ($countryData as $country => $data) {
    $cleanedData = str_replace(' ', '', $data);
    $cleanedData = str_replace(',', '.', $cleanedData);
    if (is_numeric($cleanedData)) {
        $sum += (float) $cleanedData; 
    } else {
        echo "It's not a number: $data<br>";
    }
}
$proworld = ($sum/150000000) * 100;
$proworldr = round($proworld, 2);
$conn->close();
return $proworldr;
} 
function percenteurope(){
    $conn = connect();
    $id = $_SESSION['id'];
$userCountriesJson = retrieveProfileInfo($id);
$userCountries = json_decode($userCountriesJson);
$sumeuro = 0;
$countryData = getTotalArea($userCountries);
$countryContinent = getContinent($userCountries);
foreach ($countryData as $country => $data) {
    $cleanedData = str_replace(' ', '', $data);
    $cleanedData = str_replace(',', '.', $cleanedData);
    if (is_numeric($cleanedData) && $countryContinent[$country] == "Europe") {
        $sumeuro += (float) $cleanedData; 
    } else {
        $sumeuro+=0;
    }
}
$proeuro = ($sumeuro/10530000) * 100;
$proeuror = round($proeuro, 2);
$conn->close();
return $proeuror;
}

function percentasia(){
    $conn = connect();
    $id = $_SESSION['id'];
$userCountriesJson = retrieveProfileInfo($id);
$userCountries = json_decode($userCountriesJson);
$sumasia = 0;
$countryData = getTotalArea($userCountries);
$countryContinent = getContinent($userCountries);
foreach ($countryData as $country => $data) {
    $cleanedData = str_replace(' ', '', $data);
    $cleanedData = str_replace(',', '.', $cleanedData);
    if (is_numeric($cleanedData) && $countryContinent[$country] == "Asia") {
        $sumasia += (float) $cleanedData; 
    } else {
        $sumasia+=0;
    }
}
$proasia = ($sumasia/44580000) * 100;
$proasiar = round($proasia, 2);
$conn->close();
return $proasiar;
}
function percentnam(){
    $conn = connect();
    $id = $_SESSION['id'];
$userCountriesJson = retrieveProfileInfo($id);
$userCountries = json_decode($userCountriesJson);
$sumnam = 0;
$countryData = getTotalArea($userCountries);
$countryContinent = getContinent($userCountries);
foreach ($countryData as $country => $data) {
    $cleanedData = str_replace(' ', '', $data);
    $cleanedData = str_replace(',', '.', $cleanedData);
    if (is_numeric($cleanedData) && $countryContinent[$country] == "North America") {
        $sumnam += (float) $cleanedData; 
    } else {
        $sumnam+=0;
    }
}
$pronam = ($sumnam/24710000) * 100;
$pronamr = round($pronam, 2);
$conn->close();
return $pronamr;
}
function percentsam(){
    $conn = connect();
    $id = $_SESSION['id'];
$userCountriesJson = retrieveProfileInfo($id);
$userCountries = json_decode($userCountriesJson);
$sumsam = 0;
$countryData = getTotalArea($userCountries);
$countryContinent = getContinent($userCountries);
foreach ($countryData as $country => $data) {
    $cleanedData = str_replace(' ', '', $data);
    $cleanedData = str_replace(',', '.', $cleanedData);
    if (is_numeric($cleanedData) && $countryContinent[$country] == "South America") {
        $sumsam += (float) $cleanedData; 
    } else {
        $sumsam+=0;
    }
}
$prosam = ($sumsam/17840000) * 100;
$prosamr = round($prosam, 2);
$conn->close();
return $prosamr;
}
function percentaustr(){
    $conn = connect();
    $id = $_SESSION['id'];
$userCountriesJson = retrieveProfileInfo($id);
$userCountries = json_decode($userCountriesJson);
$sumaustr = 0;
$countryData = getTotalArea($userCountries);
$countryContinent = getContinent($userCountries);
foreach ($countryData as $country => $data) {
    $cleanedData = str_replace(' ', '', $data);
    $cleanedData = str_replace(',', '.', $cleanedData);
    if (is_numeric($cleanedData) && $countryContinent[$country] == "Oceania") {
        $sumaustr += (float) $cleanedData; 
    } else {
        $sumaustr+=0;
    }
}
$proaustr = ($sumaustr/16214000) * 100;
$proaustrr = round($proaustr, 2);
$conn->close();
return $proaustrr;
}

function percentafrica(){
$conn = connect();
$id = $_SESSION['id'];
$userCountriesJson = retrieveProfileInfo($id);
$userCountries = json_decode($userCountriesJson);
$sumafr = 0;
$countryData = getTotalArea($userCountries);
$countryContinent = getContinent($userCountries);
foreach ($countryData as $country => $data) {
    $cleanedData = str_replace(' ', '', $data);
    $cleanedData = str_replace(',', '.', $cleanedData);
    if (is_numeric($cleanedData) && $countryContinent[$country] == "Africa") {
        $sumafr += (float) $cleanedData; 
    } else {
        $sumafr+=0;
    }
}
$proafr = ($sumafr/30370000) * 100;
$proafrr = round($proafr, 2);
$conn->close();
return $proafrr;
}

