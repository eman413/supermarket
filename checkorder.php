<?php
session_start();
include('db_connection.php');
$conn = OpenCon();

if(isset($_POST['pay'])){
    $full_name = $_POST['full_name'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $house = $_POST['house'];
    $user_id = $_SESSION['user_id'];
    $total = 0;

    foreach($_SESSION['cart'] as $id => $qty){

        $sql = "SELECT * FROM products WHERE id='$id'";
        $result = mysqli_query($conn,$sql);
        $product = mysqli_fetch_assoc($result);
        $total += $product['price'] * $qty;
    }

    $sql = "INSERT INTO orders
    (user_id, full_name, address, street, house, total_price)
    VALUES
    ('$user_id','$full_name','$city','$street','$house','$total')";

    mysqli_query($conn,$sql);
    $order_id = mysqli_insert_id($conn);

    foreach($_SESSION['cart'] as $id => $qty){

        $sql = "SELECT * FROM products WHERE id='$id'";
        $result = mysqli_query($conn,$sql);
        $product = mysqli_fetch_assoc($result);

        $price = $product['price'];
        $sql = "INSERT INTO order_items
        (order_id, product_id, quantity, price)
        VALUES
        ('$order_id','$id','$qty','$price')";
        mysqli_query($conn,$sql);

    }
    $sql = "SELECT email FROM users WHERE id='$user_id'";
    $result = mysqli_query($conn,$sql);
    $user = mysqli_fetch_assoc($result);

    $to = $user['email'];
    $subject = "Order Confirmation";
    $message = "שלום ".$full_name."\n\n";
    $message .= "ההזמנה שלך בוצעה בהצלחה\n\n";
    $message .= "מספר הזמנה: ".$order_id."\n";
    $message .= "סכום לתשלום: ".$total." ₪\n\n";
    $message .= "כתובת למשלוח:\n";
    $message .= "עיר: ".$city."\n";
    $message .= "רחוב: ".$street."\n";
    $message .= "מספר בית: ".$house."\n\n";
    $message .= "תודה שקנית אצלנו!";
    $headers = "From: supermarket@gmail.com";
    mail($to,$subject,$message,$headers);
    unset($_SESSION['cart']);
    header("Location: Home.php");
    exit();

}
?>
<div class="order-container">
 <h2>פרטי הזמנה</h2>
 <form method="post">
  <label>: שם מלא</label>
  <input type="text" name="full_name" required>

  <label>: עיר</label>
  <input type="text" name="city" required>

  <label>: שם רחוב</label>
  <input type="text" name="street" required>

  <label>: מספר בית</label>
  <input type="number" name="house" required>

  <button name="pay">שלם</button>
 </form>
</div>
<style>
body{
    margin:0;
    font-family:Arial;
    background:#f0f0f0;
}
.order-container{
    width:400px;
    background:white;
    margin:70px auto;
    padding:25px;
    border-radius:8px;
    border:1px solid #ccc;
    text-align:center;
}
h2{
    margin-bottom:25px;
}
form{
    display:flex;
    flex-direction:column;
}
label{
    text-align:right;
    margin-top:10px;
}
input{
    padding:10px;
    margin-top:5px;
    border-radius:5px;
    border:1px solid #ccc;
}
button{
    margin-top:20px;
    padding:12px;
    background:#2c3e50;
    color:white;
    border:0;
    border-radius:6px;
    cursor:pointer;
}
</style>