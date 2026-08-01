<?php
session_start();
include("db_connection.php");
$conn = OpenCon();
$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if(isset($_POST['save'])){
    $_SESSION['order'][$id] = array(

        "name"=>$row['name'],
        "company"=>$_POST['company'],
        "quantity"=>$_POST['quantity']
    );
    header("Location: adminsupplier.php");
}
?>
<div class="box">
 <h2>הזמנת מוצר</h2>
 <p>שם המוצר: <?php echo $row['name']; ?></p>
 <form method="post">
  <label>בחר חברה:</label>
  <br>
  <select name="company">
    <option>תנובה</option>
    <option>שטראוס</option>
    <option>אסם</option>
    <option>אנג'ל</option>
  </select>
  <br><br>
  <label>כמות להזמנה:</label>
  <br>
  <input type="number" name="quantity" min="1" required>
  <br><br>
  <button type="submit" name="save">שמירה</button>
 </form>
</div>
<style>
body{
    font-family: Arial;
    background:#f0f0f0;
    direction:rtl;
}
.box{
    width:350px;
    margin:80px auto;
    background:white;
    padding:20px;
    border:1px solid #ccc;
    border-radius:8px;
    text-align:center;
}
select,input{
    width:90%;
    padding:8px;
}
button{
    border-radius: 6px;
    background:#374151;
    color:white;
    border:none;
    padding:10px 20px;
    cursor:pointer;
}
</style>

