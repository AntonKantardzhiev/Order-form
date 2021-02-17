<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions

session_start();

$nameErr = $emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = "";
$name = $email = $street = $streetnumber = $city = $zipcode = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function check($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_NOQUOTES, "UTF-8");
        return $data;
    }

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = check($_POST["name"]);
        $_SESSION["name"] = $name;
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "* Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = check($_POST["email"]);
        $_SESSION["email"] = $email;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "* Invalid email format";
        }
    }

    if (empty($_POST["street"])) {
        $streetErr = "Street is required";
    } else {
        $street = check($_POST["street"]);
        $_SESSION["street"] = $street;
        if (!preg_match("/^[a-zA-Z-' ]*$/", $street)) {
            $streetErr = "* Only letters please";
        }
    }

    if (empty($_POST["streetnumber"])) {
        $streetnumberErr = "Number is required";
    } elseif (is_numeric($_POST["streetnumber"])) {
        $streetnumber = check($_POST["streetnumber"]);
        $_SESSION["streetnumber"] = $streetnumber;
    } else {
        $streetnumberErr = "* Only numbers please";
    }
    if (empty($_POST["city"])) {
        $cityErr = "City is required";
    } else {
        $city = check($_POST["city"]);
        $_SESSION["city"] = $city;
        if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
            $cityErr = "* Only letters and white space allowed";
        }
    }

    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "Zipcode is required";
    } elseif (is_numeric(($_POST["zipcode"]))) {
        $zipcode = check($_POST["zipcode"]);
        $_SESSION["zipcode"] = $zipcode;
    } else {
        $zipcodeErr = "* Only numbers please";
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
if (isset($_GET["?food=0"])) {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}elseif (isset($_GET["?food=1"])) {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}else {
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];
}


$totalValue = "";
foreach ($products as $i => $product) {
    if (isset($_POST[$product[$i]])) {
        $totalValue .= $product[$i]["price"];
    }
}
setcookie( "order" , $totalValue, time() + 60);

require 'form-view.php';