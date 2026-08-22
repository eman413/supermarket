
<?php
session_start();
include('db_connection.php');
$conn = OpenCon();

$user_id = $_SESSION['user_id'];

$sql = "SELECT *
       FROM orders
       WHERE user_id='$user_id'
       ORDER BY created_at DESC";

$result = mysqli_query($conn,$sql);
?>
<br>
<a href="Home.php" class="back-button">   חזרה לבית</a>
<div class="container">
 <h2>ההזמנות שלי</h2>
 <?php
 if(mysqli_num_rows($result)==0){
 ?>
  <p>עדיין לא ביצעת הזמנה.</p>
 <?php
 }
 while($order=mysqli_fetch_assoc($result)){
 ?>
  <div class="order">
   <h3>הזמנה מספר <?php echo $order['id']; ?></h3>
   <p>
    תאריך:
    <?php echo $order['created_at']; ?>
   </p>

   <p>
    סה"כ:
    <?php echo $order['total_price']; ?> ₪
   </p>

    <p>
   סטטוס:
   </p>
   <div class="status">
   <?php
    if($order['status']=="Still not sent"){
      echo "ההזמנה עדיין לא נשלחה";
    }elseif($order['status']=="On the way"){
      echo "ההזמנה בדרך אליך";
    }elseif($order['status']=="Delivered"){
      echo "ההזמנה נמסרה";
    }else{
      echo $order['status'];
    }
    ?>
  </div>
  <h4>המוצרים שהוזמנו:</h4>
  <?php
  $order_id=$order['id'];

  $sql2="SELECT p.name,
       oi.quantity,
       oi.price
  FROM order_items oi
  JOIN products p
  ON oi.product_id=p.id
  WHERE oi.order_id='$order_id'";

  $result2=mysqli_query($conn,$sql2);

  while($item=mysqli_fetch_assoc($result2)){
  ?>
   <div class="product">
    <p><?php echo $item['name']; ?></p>

    <p>
     כמות:
    <?php echo $item['quantity']; ?>
    </p>

    <p>
     מחיר:
     <?php echo $item['price']; ?> ₪
    </p>
   </div>
  <?php
   }
  ?>
  </div>
 <?php
 }
 ?>
</div>
<style>
body{
    font-family:Arial;
    direction:rtl;
    background:#eeeeee;
}
.container{
    width:700px;
    margin:30px auto;
    text-align:center;
}
h2{
    color:#34495e;
}
.order{
    background:white;
    margin-bottom:25px;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px #ccc;
}
.order h3{
    color:#34495e;
}
.status{
    background:#f1f1f1;
    padding:10px;
    border-radius:7px;
    font-size:18px;
}
.product{
    background:#f5f5f5;
    margin:10px;
    padding:10px;
    border-radius:7px;
}
.product p{
    margin:5px;
}
.back-button{
    margin-top: 12px;
    padding: 10px 15px;
    border: none;
    border-radius: 7px;
    background: #34495e;
    color: white;
    cursor: pointer;
    font-size: 15px;
}
</style>
