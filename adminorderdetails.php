<?php
session_start();
include("db_connection.php");
$conn = OpenCon();

$order_id = $_GET['order_id'];

 $sql = "SELECT p.name,
       p.image,
       oi.quantity,
       oi.price
  FROM order_items oi
  JOIN products p
  ON oi.product_id = p.id
  WHERE oi.order_id=$order_id";

$result = mysqli_query($conn,$sql);
$total = 0;
?>

<h1>פרטי ההזמנה</h1>
 <table border="1">
 <tr>
    <th>תמונה</th>
    <th>שם מוצר</th>
    <th>כמות</th>
    <th>מחיר</th>
    <th>סה״כ</th>
 </tr>
<?php
while($row=mysqli_fetch_assoc($result)){
 $sum = $row['quantity'] * $row['price'];
 $total += $sum;
?>
 <tr>
  <td>
   <img src="<?php echo $row['image']; ?>" width="80">
  </td>
  <td>
  <?php echo $row['name']; ?>
  </td>
  <td>
   <?php echo $row['quantity']; ?>
  </td>
  <td>
   ₪<?php echo $row['price']; ?>
  </td>
  <td>
  ₪<?php echo $sum; ?>
  </td>
</tr>
<?php
}
?>
 <tr>

  <td colspan="4">
   <b>סה"כ לתשלום</b>
  </td>
  <td>
   <p>₪<?php echo $total; ?></p>
  </td>
 </tr>
</table>
<br>
<a href="adminorders.php">חזרה להזמנות</a>
<style>
body{
    direction:rtl;
    font-family:Arial;
    text-align:center;
    background:#f4f6f9;
}
table{
    margin:auto;
    border-collapse:collapse;
    width:70%;
    background:white;
}
th,td{
    padding:10px;
}
th{
    background:#374151;
    color:white;
}
img{
    width:70px;
    height:70px;
}
a{
    text-decoration:none;
    background:#2c3e50;
    color:white;
    padding:10px 20px;
    border-radius:5px;
}
</style>