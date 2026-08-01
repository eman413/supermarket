<?php include "adminpanel.php";?>
<?php
$sql = "SELECT * FROM products WHERE stock <= min";
$result = mysqli_query($conn,$sql);
?>
<div class="container">
<h2>מוצרים שחסרים במלאי</h2>
<table border="1">
 <tr>
  <th>שם מוצר</th>
  <th>קטגוריה</th>
  <th>מחיר</th>
  <th>כמות במלאי</th>
  <th>סטטוס</th>
 </tr>
<?php
while($row = mysqli_fetch_assoc($result)){
?>
 <tr>
  <td>
   <?php echo $row['name']; ?>
  </td>
  <td>
   <?php echo $row['category']; ?>
  </td>
  <td>
   <?php echo $row['price']; ?> ₪
  </td>
  <td>
   <?php echo $row['stock']; ?>
  </td>
  <td>
   <a href="adminchooseproduct.php?id=<?php echo $row['id']; ?>">הזמנה</a>
  </td>
 </tr>
<?php
}
?>
</table>
<br>
<a href="adminsupdf.php" style="background-color:#374151; color: white;  padding: 8px 15px; text-decoration: none; border-radius: 5px;">ADD</a>
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
</style>