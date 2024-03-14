<?php 
require_once "login/connect.php";
    session_start();

    if(!isset($_SESSION['logged'])){
        header('Location:login/login.php');
        exit();
    }
?>
<?php
   
    $conn = connect();
    if($conn->connect_errno!=0){
        $conn->connect_errno;
    }
    else{
        $sql = "SELECT * FROM countries_general";
        if($result = @$conn->query($sql)){
            $ile_państw = $result->num_rows;
            if($ile_państw>0){
                $i=0;
                while($row = $result->fetch_assoc()){
                    $countries[$i] = $row;
                    $i++;
                }
            }
        }
    }
    $query = "SELECT country_name FROM countries_general";
    $result = $conn->query($query);

if (!$result) {
    die("SQL error: " . $conn->error);
}

    $conn->close();

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
      <link rel="stylesheet" href="css/informations.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title>roadnote • informations</title>
    </head>
    
    <body>
        <div class="dashboard">

<?php 
    include_once 'sidebar.php';
?>
<?php 
    include_once 'mainup.php';
?>


<section class="main_countries">
                <div class="heading">
                    <h1>Search by a country:</h1>
                </div>


 <table id="countries_table">
    <tr>
        <th>A</th><th></th><th>B</th><th></th><th>C</th><th></th><th>D</th><th></th>
    </tr> 
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Afghanistan">Afghanistan</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Bahamas">Bahamas</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Cambodia">Cambodia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Demo. Rep. of the Congo">Demo. Rep. of the Congo</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Albania">Albania</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Bangladesh">Bangladesh</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Canada">Canada</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Denmark">Denmark</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Algeria">Algeria</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Belgium">Belgium</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Chile">Chile</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Djibouti">Djibouti</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Argentina">Argentina</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Bosnia and Herzegovina">Bosnia and Herzegovina</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="China">China</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Dominica">Dominica</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Australia">Australia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Brazil">Brazil</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Croatia">Croatia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Dominican Republic">Dominican Republic</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Austria">Austria</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Bulgaria">Bulgaria</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Czech Republic">Czech Republic</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>E</th><th></th><th>F</th><th></th><th>G</th><th></th><th>H</th><th></th>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Ecuador">Ecuador</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Fiji">Fiji</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Gambia">Gambia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Haiti">Haiti</a></td>
    </tr>
    <tr>
       <td></td>
        <td><a href="#" class="country-link" data-country="Egypt">Egypt</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Finland">Finland</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Georgia">Georgia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Holy See">Holy See</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="El Salvador">El Salvador</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="France">France</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Germany">Germany</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Honduras">Honduras</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Equatorial Guinea">Equatorial Guinea</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Ghana">Ghana</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Hungary">Hungary</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Estonia">Estonia</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Greece">Greece</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Ethiopia">Ethiopia</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Guatemala">Guatemala</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>I</th><th></th><th>J</th><th></th><th>K</th><th></th><th>L</th><th></th>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Iceland">Iceland</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Jamaica">Jamaica</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Kazakhstan">Kazakhstan</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Latvia">Latvia</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="India">India</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Japan">Japan</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Kenya">Kenya</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Liberia">Liberia</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Indonesia">Indonesia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Jordan">Jordan</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Kiribati">Kiribati</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Libya">Libya</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Iran">Iran</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Kuwait">Kuwait</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Liechtenstein">Liechtenstein</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Ireland">Ireland</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Kyrgyzstan">Kyrgyzstan</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Lithuania">Lithuania</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Italy">Italy</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Luxembourg">Luxembourg</a></td>
    </tr>
    <tr>
        <th>M</th><th></th><th>N</th><th></th><th>O</th><th></th><th>P</th><th></th>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Malaysia">Malaysia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Nambia">Nambia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Oman">Oman</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Pakistan">Pakistan</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Maldives">Maldives</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Netherlands">Netherlands</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Panama">Panama</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Malta">Malta</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="New Zealand">New Zealand</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Paraguay">Paraguay</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Mexico">Mexico</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Nigeria">Nigeria</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Philippines">Philippines</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Monaco">Monaco</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="North Korea">North Korea</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Poland">Poland</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Morocco">Morocco</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Norway">Norway</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Portugal">Portugal</a></td>
    </tr>
    <tr>
        <th>Q</th><th></th><th>R</th><th></th><th>S</th><th></th><th>T</th><th></th>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Qatar">Qatar</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Romania">Romania</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Saudi Arabia">Saudi Arabia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Tanzania">Tanzania</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Russia">Russia</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Singapore">Singapore</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Thailand">Thailand</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Rwanda">Rwanda</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="South Africa">South Africa</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Tonga">Tonga</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Spain">Spain</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Tunisia">Tunisia</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Sweden">Sweden</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Turkey">Turkey</a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Switzerland">Switzerland</a></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>U</th><th></th><th>V</th><th></th><th>Y</th><th></th><th>Z</th><th></th>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Uganda">Uganda</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Vanuatu">Vanuatu</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Yemen">Yemen</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Zambia">Zambia</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Ukraine">Ukraine</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Venezuela">Venezuela</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Zimbabwe">Zimbabwe</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="United Kingdom">United Kingdom</a></td>
        <td></td>
        <td><a href="#" class="country-link" data-country="Vietnam">Vietnam</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="United States of America">United States of America</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Uruguay">Uruguay</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="#" class="country-link" data-country="Uzbekistan">Uzbekistan</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
</section>


<section class="countries_info">

<div id="country_info"></div> 
           
            </section>
           
        </div>
        <script src="js/informations.js"></script>
 
    </body>
    </html>