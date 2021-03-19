



<!doctype html>
<html lang="en">
<?php
//email validation
$emailRequired= $_POST['email'];

if (empty $_POST['email']){
    $emailRequired = 'email is required';
} elseif(!filter_var($_POST['email'] FILTER_VALIDATE_EMAIL)){
    $emailRequired = 'email format is valid';
} else{
    $emailData = validData($_POST['email']);
}

//Street required
$streetRequired = $_POST['street'];

if (empty $_POST['street']){
    $streetRequired = 'your street is required';
} elseif(!filter_var($_POST['street'] FILTER_VALIDATE_STREET)){
    $streetRequired = 'format not valid';
} else{
    $streetData = validData($_POST['street']);
}

//street numbers and zip code are only numbers
//Street numbers is_numeric:
$streetNumber= $_POST['streetnumber'];
$form_result= $_POST['submit_button'];

if (isset($form_result)){
if (is_numeric($streetNumber)) {
echo 'The number you entered is ' . $streetNumber. '. This is a valid number.';
} //je ne dois pas déclarer de var avec valeur numérique?
else {
echo 'Error: Please enter numbers only.';
}
//zip code is_numeric
$zipCode = $_POST['zipcode'];
if (isset($form_result)){
    if (is_numeric($zipCode)) {
    echo 'The number you entered is ' . $zipCode. '. This is a valid number.';
    } //je ne dois déclarer de var avec valeur numérique?
    else {
    echo 'Error: Please enter numbers only.';
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Order Pizzas & drinks</title>
</head>
<body>
<div class="container">
    <h1>Order pizzas in restaurant "the Personal Pizza Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order pizzas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control" required/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" required>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        
        <label>
            <input type="checkbox" name="express_delivery" value="5" /> 
            Express delivery (+ 5 EUR) 
        </label>
            
        <button type="submit" class="btn btn-primary" name="submit_button">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in pizza(s) and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>
