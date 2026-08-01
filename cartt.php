<?php
session_start();
include('db_connection.php');
$conn = OpenCon();

if(isset($_POST['remove'])) {
    $id = $_POST['product_id'];
    unset($_SESSION['cart'][$id]);
}
if(isset($_POST['update'])) {
    foreach($_POST['quantity'] as $id => $qty) {
        if($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }
}
if(isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']); 
}
?>
<h1> סל קניות</h1>
<div class="cart-container">
 <form method="post">
  <?php
   $total = 0;
   if(!empty($_SESSION['cart'])) {
     foreach($_SESSION['cart'] as $id => $quantity) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $price = $row['price'];
        $subtotal = $price * $quantity;
        $total += $subtotal;
        echo '<div class="cart-item">';
        echo '<img src="'.$row['image'].'" alt="">';
        echo '<div class="item-details">';
        echo '<p class="item-name">'.$row['name'].'</p>';
        echo '<p class="item-price">'.$price.' ₪</p>';
        echo '<input type="number" name="quantity['.$id.']" value="'.$quantity.'" min="1">';
        echo '<button type="submit" name="remove" value="1" class="remove-btn" onclick="this.form.product_id.value='.$id.'">הסר</button>';
        echo '</div>';
        echo '</div>';
     }

    } else {
    echo "<p>הסל ריק </p>";
    }
?>
 <input type="hidden" name="product_id" value="">
  <div class="cart-total">
    <p>סה\"כ: <?php echo $total; ?> ₪</p>
    <button type="submit" name="update" class="checkout-btn">עדכן כמויות</button>
    <a href="checkorder.php" class="checkout-btn">לשלם</a> 
    <button type="submit" name="clear_cart" class="clear-btn"> נקה סל</button>
  </div>
 </form>
</div>
<style>
 body {
    font-family: Arial;
    direction: rtl;
    background: #f5f5f5;
    text-align: center;
    margin: 0;
    padding: 20px;
}
h1 {
    margin-bottom: 30px;
}
.cart-container {
    max-width: 600px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
}
.cart-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}
.cart-item img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    margin-left: 10px;
}
.item-details {
    flex: 1;
    text-align: right;
}
.item-details input {
    width: 50px;
    padding: 4px;
    margin: 5px 0;
}
.remove-btn {
    padding: 5px 10px;
    background: #e74c3c;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
.remove-btn:hover {
    background: #c0392b;
}
.cart-total {
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
}
.checkout-btn {
    display: block;
    margin-top: 10px;
    padding: 10px;
    background: #2c3e50;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
.clear-btn {
    margin-top: 10px;
    padding: 10px;
    background: red;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
</style>