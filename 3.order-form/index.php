<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions

session_start();

$nameErr = $emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = "";
$name = $email = $street = $streetnumber = $city = $zipcode = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = check($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "* Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = check($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "* Invalid email format";
        }
    }

    if (empty($_POST["street"])) {
        $streetErr = "Street is required";
    } else {
        $street = check($_POST["street"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $street)) {
            $streetErr = "* Only letters please";
        }
    }

    if (empty($_POST["streetnumber"])) {
        $streetnumberErr = "Number is required";
    } else {
        if ((is_numeric($streetnumber)) and (preg_match("/^[0-9]{1,4}$/", $streetnumber))) {
            $streetnumber = check($_POST["streetnumber"]);
        } else {
            $streetnumberErr = "* Please enter a maximum of 4 numbers, no letters";
        }
    }

    if (empty($_POST["city"])) {
        $cityErr = "City is required";
    } else {
        $city = check($_POST["city"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
            $cityErr = "* Only letters and white space allowed";
        }
    }

    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "Zipcode is required";
    } else {
        if ((is_numeric($zipcode)) and (preg_match("/^[0-9]{1,4}$/", $zipcode))) {
            $zipcode = check($_POST["zipcode"]);
        } else {
            $zipcodeErr = "* Please enter a maximum of 4 numbers, no letters";
        }
    }
    function check ($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_NOQUOTES, "UTF-8");
        return $data;
    }
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
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;

require 'form-view.php';