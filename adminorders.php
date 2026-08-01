<?php include "adminpanel.php";?>
<?php
$search = "";
if(isset($_POST['search'])){
  $search = $_POST['search'];
}
$sql = "SELECT * FROM orders WHERE id LIKE '%$search%' OR full_name LIKE '%$search%'";
$result = mysqli_query($conn,$sql);
?>
<div class="container">
 <h2>ניהול הזמנות</h2>
 <form method="post">
  <input type="text" name="search" placeholder="Search order" class="search">
 </form>
 <br>
 <table border="1">
  <tr>
   <th>Order ID</th>
   <th>Name</th>
   <th>Address</th>
   <th>Total</th>
   <th>Status</th>
   <th>Update</th>
 </tr>
 <?php
 while($row=mysqli_fetch_assoc($result)){
 ?>
  <tr>
    <td>
     <?php echo $row['id']; ?>
    </td>
    <td>
     <?php echo $row['full_name']; ?>
    </td>
    <td>
     <?php echo $row['address']." ".$row['street']." ".$row['house']; ?>
    </td>
    <td>
     <?php echo $row['total_price']; ?> ₪
    </td>
    <td>
     <?php echo $row['status']; ?>
    </td>
    <td>
     <a href="adminupdateorder.php?id=<?php echo $row['id']; ?>">עדכון</a>
   </td>
  </tr>
   <?php
   }
   ?>
 </table>
</div>
<style>
h2{
    text-align:center;
    margin:20px;
    color:black;
}
.container{
    width:80%;
    margin:auto;
    margin-right:240px;
}
.search{
    background-color: white;
    width: 200px;
    padding: 10px 10px;
    text-align: center;
    border-radius: 6px;
}
.add-btn{
    background:#374151;
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
    margin-bottom:15px;
}
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
}

th{
    background:#374151;
    color:white;
    padding:10px;
}

td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f1f1f1;
}

img{
    width:80px;
    border-radius:8px;
}

.delete{
    background:red;
    color:white;
    border:none;
    padding:6px 10px;
    border-radius:6px;
    cursor:pointer;
}

.update{
    background:blue;
    color:white;
    border:none;
    padding:5px 10px;
    border-radius:6px;
    cursor:pointer;
}
</style>