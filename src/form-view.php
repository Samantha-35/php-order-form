<?php
require_once 'index.php';
//email validation
if(isset($_POST["submit_button"])){

    $emailRequired= filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $streetRequired = filter_var($_POST['street'],FILTER_SANITIZE_STRING);
    $streetNumber = filter_var($_POST['streetnumber'],FILTER_SANITIZE_NUMBER_INT);
    $city = filter_var($_POST['street'],FILTER_SANITIZE_STRING);
    $zipCode = filter_var($_POST['streetnumber'],FILTER_SANITIZE_NUMBER_INT);

    if(filter_var($emailRequired,FILTER_VALIDATE_EMAIL) && !is_numeric($city) && !is_numeric($streetRequired) && is_numeric($streetNumber)){
        echo"This works!";
        $_SESSION["email"]= $emailRequired;
        if (isset($_POST ['express_delivery'])){
            echo "<div class='alert alert-success' role='alert'> 30 minutes express delivery!</div>";
        }else{ 
            echo'<div class="alert alert-success" role="alert">Order has been sent!</div>';
        };
   
    }else{
        echo'<div class="alert alert-danger" role="alert">This is not correct!!</div>';
    };
                       
};


// whatIsHappening();


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>Order Pizzas & drinks</title>
</head>
<body>
<div class="container">
    <h1>Pizza Da Mama Mia!"</h1>
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
    <form method="post" action= 'index.php'>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control" required value= "<?= $_SESSION['email'] ?? ""?>"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" required value= "<?= $_SESSION['street'] ?? ""?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" required value= "<?= $_SESSION['streetnumber'] ?? ""?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" required value= "<?= $_SESSION['city'] ?? ""?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" required maxlength="5" value= "<?= $_SESSION['zipcode'] ?? ""?>">
                </div>
            </div>
        </fieldset>

        <fieldset class="foodMenu">
            <legend>Products</legend> 
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products-<?php echo $i ?>"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        
        <label class="boxExpressDelivery">
            <input type="checkbox" name="express_delivery" value="5" class="boxExpressDelivery" /> 
            Express delivery (+ 5 EUR) 
        </label>
            
        <button type="submit" class="btn btn-primary" name="submit_button" class=>Order!</button>
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
