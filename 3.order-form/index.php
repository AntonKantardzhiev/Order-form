<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions

session_start();
const zip = 4;
$name_Err = $email_Err = $street_Err = $street_number_Err = $city_Err = $zip_code_Err = "";
$name = $email = $street = $street_number = $city = $zip_code = "";

if (!isset($_GET["food"])) {
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];
} else if ($_GET["food"] == 1) {
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];
} else if ($_GET["food"] == 0) {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function check(string $data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_NOQUOTES, "UTF-8");
        return $data;
    }

    if (empty($_POST["name"])) {
        $name_Err = "Name is required";
    } else if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $name_Err = "* Invalid name";
    } else {
        $name = check($_POST["name"]);
        $_SESSION["name"] = $name;
    }

    if (empty($_POST["email"])) {
        $email_Err = "Email is required";
    } else if (!filter_var((check($_POST["email"])), FILTER_VALIDATE_EMAIL)) {
        $email_Err = "* Invalid email ";
    } else {
        $email = check($_POST["email"]);
        $_SESSION["email"] = $email;
    }

    if (empty($_POST["street"])) {
        $street_Err = "Street is required";
    } else if (!preg_match("/^[a-zA-Z-' ]*$/", $street)) {
        $street_Err = "* Invalid street name";
    } else {
        $street = check($_POST["street"]);
        $_SESSION["street"] = $street;
    }

    if (empty($_POST["street_number"])) {
        $street_number_Err = "Number is required";
    } else if (is_numeric($_POST["street_number"])) {
        $street_number = check($_POST["street_number"]);
        $_SESSION["street_number"] = $street_number;
    } else {
        $street_number_Err = "* Invalid street number";
    }

    if (empty($_POST["city"])) {
        $city_Err = "City is required";
    } else if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
        $city_Err = "* Invalid city";
    } else {
        $city = check($_POST["city"]);
        $_SESSION["city"] = $city;
    }

    if (empty($_POST["zip_code"])) {
        $zip_code_Err = "Zipcode is required";
    } else if (is_numeric(($_POST["zip_code"]))&&(strlen($_POST["zip_code"])== zip)) {
        $zip_code = check($_POST["zip_code"]);
        $_SESSION["zip_code"] = $zip_code;
    } else {
        $zip_code_Err = "* Invalid zip";
    }
}

if (isset($_POST["products"])){
    date_default_timezone_set("Europe/Brussels");
    $totalValue = 0;
    $order = [];
    $msg ="Estimated delivery of your order";
    if (isset($_POST["express_delivery"])){
        $totalValue += 5;
        $time = date('h:i', strtotime("+45 minutes"));

    }else {
        $time = date('h:i', strtotime("+2 hours"));

    }
  /*  foreach ($_POST["products"] as $i => $product){
        $totalValue += intval($product[$i]["price"]);
  }*/

}

function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

whatIsHappening();

//your products with their price.



//Time


//Calculating the bill



require 'form-view.php';