<?php
include('db_connection.php');
$conn = OpenCon();

$id = $_GET['id'];
if(isset($_POST['update'])){
    $status = $_POST['status'];
    $sql = "UPDATE orders  SET status='$status' WHERE id='$id'";
    mysqli_query($conn,$sql);
     header("Location: adminorders.php");
    exit();
}
$sql = "SELECT * FROM orders WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$order = mysqli_fetch_assoc($result);
?>
<div class="container">
 <h2>עדכון הזמנה</h2>
 <p>
  Customer:
  <?php echo $order['full_name']; ?>
 </p>
 <p>
  Total:
  <?php echo $order['total_price']; ?> ₪
 </p>
 <form method="post">
  <select name="status">
   <option>Still not sent</option>
   <option>On the way</option>
   <option>Delivered</option>
  </select>
  <br><br>
  <button name="update">עדכון</button>
 </form>
</div>
<style>
body {
    font-family: Arial;
    background-color: #eeeeee;
}
h2 {
    text-align: center;
    color:black;
}
.container {
    width: 350px;
    background-color: white;
    margin: 50px auto;
    padding: 20px;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 8px;
}
p {
    font-size: 18px;
    color:black;
}
select {
    width: 90%;
    padding: 10px;
    margin: 15px;
}
button {
    background-color: #374151;
    color: white;
    padding: 10px 30px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}
</style>