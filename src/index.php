<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//$email = $_POST['email']



//street numbers and zip code are only numbers
// $number= $_POST['number_entered'];
// $form_result= $_POST['form'];

//     if (isset($form_result)){
//         if (is_numeric($number)) {
//         echo 'The number you entered is ' . $number. '. This is a valid number.';
//         }
//         else {
//         echo 'Error: You did not enter numbers only. Please enter only numbers.';
//         }
// }



//street validation

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$products  = [
    ['name' => 'Margherita', 'price' => 8],
    ['name' => 'Hawaï', 'price' => 8.5],
    ['name' => 'Salami pepper', 'price' => 10],
    ['name' => 'Prosciutto', 'price' => 9],
    ['name' => 'Parmiggiana', 'price' => 9],
    ['name' => 'Vegetarian', 'price' => 8.5],
    ['name' => 'Four cheeses', 'price' => 10],
    ['name' => 'Four seasons', 'price' => 10.5],
    ['name' => 'Scampi', 'price' => 11.5]
];
if (isset($_GET ["food"])&& $_GET ["food"] == 0 ){
$products  = [
    ['name' => 'Water', 'price' => 1.8],
    ['name' => 'Sparkling water', 'price' => 1.8],
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 2.2],
];
}

// we are setting the total value in the cookie
if (isset($_COOKIE["totalAmount"])){
    $totalValue = (float)$_COOKIE["totalAmount"];
}else{
     $totalValue = 0;
}
// we are evaluting if the fields is empty or not
foreach ($products as $i =>$product){
    if(!empty($_POST["products-{$i}"])){

        $price = $product["price"];
        $totalValue = $totalValue + $price;
    }
};
setcookie("totalValue", "{$totalValue}", time()+3600);
require 'form-view.php';
