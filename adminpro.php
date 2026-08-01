<?php include "adminpanel.php";?>
<?php
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    mysqli_query($conn,"DELETE FROM products WHERE id='$id'");
}
if(isset($_POST['update_stock'])){
    $id = intval($_POST['id']);
    $stock = intval($_POST['stock']);
    mysqli_query($conn,"UPDATE products SET stock=$stock WHERE id=$id");
}
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    mysqli_query($conn,"
    INSERT INTO products(name,price,category,image)
    VALUES('$name','$price','$category','$image')
    ");
}
$result = mysqli_query($conn,"SELECT * FROM products");
$showForm = false;
if(isset($_POST['show_add'])){
    $showForm = true;
}
?>
<div class="container">
  <h2>ניהול מוצרים</h2>
  <form method="post">
    <button class="add-btn" name="show_add">
        הוסף מוצר חדש
    </button>
</form>
<?php
if($showForm){
?>
<div class="add-box" style="display:block;">
    <h3>הוספת מוצר</h3>
    <form method="post">
        <input type="text" name="name" placeholder="שם מוצר" required>
        <input type="text" name="category" placeholder="קטגוריה" required>
        <input type="text" name="image" placeholder="נתיב תמונה" required>
        <input type="number" name="stock" placeholder="כמות במלאי" required>
        <input type="number" name="price" placeholder="מחיר" required>
        <br><br>
        <button class="update" name="add">
            שמור מוצר
        </button>
    </form>
</div>
<?php
}
?>
 <table>
  <tr>
    <th>ID</th>
    <th>תמונה</th>
    <th>שם</th>
    <th>קטגוריה</th>
    <th>כמות</th>
    <th>מחיר</th>
    <th>מחיקה</th>
  </tr>
<?php
while($row = mysqli_fetch_assoc($result)){
?>
  <tr>
    <td><?php echo $row['id']; ?></td>
    <td>
        <img src="<?php echo $row['image']; ?>">
    </td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td>
       <form method="post">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <input type="number" name="stock" value="<?= $row['stock'] ?>" style="width:60px;">
          <button class="update" name="update_stock">עדכן</button>
        </form>
    </td>
    <td>₪<?php echo $row['price']; ?></td>
    <td>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button class="delete" name="delete">   מחק</button>
        </form>
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

.add-box{
    display:none;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px #ccc;
    margin-bottom:30px;
}

.add-box input{
    width:100%;
    padding:8px;
    margin:5px 0;
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