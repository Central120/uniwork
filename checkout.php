<?php
include_once 'inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');

if (isset($_SESSION['user']))
{
    $session_usern = $_SESSION['user'];
}
else if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('index');</script>";
}

$sqlfindcart = "SELECT * FROM `cart` WHERE `username` = '$session_usern'";
$findcart = mysqli_query($conn, $sqlfindcart);
$countfindcart = mysqli_num_rows($findcart);
if($countfindcart !=0){
    while($rowfindcart = $findcart->fetch_assoc()){
$price = $rowfindcart['price'];
$quantity = $rowfindcart['quantity'];
$total = $price * $quantity;
$total1 = $total1 + $total;
    }
} 
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />

		<style>
  .footer 
  {
    margin-top: 20% !important; 
  }
    </style>
  </head>
  <body>
  <?php include "inc/header.php"; ?>
<center>
  <h2 class="mb-4">Secure Checkout</h2><br>
  <p></p>
  <h2 class="mb-4">Choose one of the following to complete your order:</h2><br>
  <p></p>
  <br>
  <h2 class="mb-4">Item(s) in your cart are:</h2><br>
  <?php
$sqlfindcart1 = "SELECT cart.price, cart.quantity, cart.product, products.Image FROM `cart` LEFT JOIN `products` ON cart.product = products.product_name WHERE `username` = '$session_usern'";
$findcart1 = mysqli_query($conn, $sqlfindcart1);
$countfindcart1 = mysqli_num_rows($findcart1);
if($countfindcart1 !=0){
    while($rowfindcart1 = $findcart1->fetch_assoc()){
$price1 = $rowfindcart1['price'];
$quantity1 = $rowfindcart1['quantity'];
$product1 = $rowfindcart1['product'];
$image1 = $rowfindcart1['Image'];
$total2 = $price1 * $quantity1;
$total_1 = $total_1 + $total2;
echo "<img src='$image1' style='height: 100px; width: 100px;'/><h5 style='display:list-item;'>$product1 - $quantity1 x £$price1</h5><br>";
    }
} 

?>
  <p>
  <?php
?>
<div id="smart-button-container">
      <div style="text-align: center;">
        <div style="margin-bottom: 1.25rem;">
          <p></p>
          Total:
          <select id="item-options"><option value="<?php echo $total_1;?>" price="<?php echo $total_1;?>">£<?php echo $total_1;?> -  GBP</option></select>
          <select style="visibility: hidden" id="quantitySelect"></select>
        </div>
      <div id="paypal-button-container"></div>
      </div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=GBP" data-sdk-integration-source="button-factory"></script>
    <script>
      function initPayPalButton() {
        var shipping = 0;
        var itemOptions = document.querySelector("#smart-button-container #item-options");
    var quantity = parseInt();
    var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
    if (!isNaN(quantity)) {
      quantitySelect.style.visibility = "visible";
    }
    var orderDescription = '';
    if(orderDescription === '') {
      orderDescription = 'Item';
    }
    paypal.Buttons({
      style: {
        shape: 'pill',
        color: 'black',
        layout: 'vertical',
        label: 'checkout',
        
      },
      createOrder: function(data, actions) {
        var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
        var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
        var tax = (0 === 0) ? 0 : (selectedItemPrice * (parseFloat(0)/100));
        if(quantitySelect.options.length > 0) {
          quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
        } else {
          quantity = 1;
        }

        tax *= quantity;
        tax = Math.round(tax * 100) / 100;
        var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
        priceTotal = Math.round(priceTotal * 100) / 100;
        var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;

        return actions.order.create({
          purchase_units: [{
            description: orderDescription,
            amount: {
              currency_code: 'GBP',
              value: priceTotal,
              breakdown: {
                item_total: {
                  currency_code: 'GBP',
                  value: itemTotalValue,
                },
                shipping: {
                  currency_code: 'GBP',
                  value: shipping,
                },
                tax_total: {
                  currency_code: 'GBP',
                  value: tax,
                }
              }
            },
            items: [{
              name: selectedItemDescription,
              unit_amount: {
                currency_code: 'GBP',
                value: selectedItemPrice,
              },
              quantity: quantity
            }]
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          alert('Transaction completed by ' + details.payer.name.given_name + '!');
        });
      },
      onError: function(err) {
        console.log(err);
      },
    }).render('#paypal-button-container');
  }
  initPayPalButton();
    </script>
</div>
<?php include "inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>