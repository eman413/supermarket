<?php include "adminpanel.php";?>
<?php
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    mysqli_query($conn,"DELETE FROM offers WHERE id='$id'");
}
if(isset($_POST['add'])){
    $product_id = $_POST['product_id'];
    $old_price = $_POST['old_price'];
    $new_price = $_POST['new_price'];

    mysqli_query($conn,"
    INSERT INTO offers(product_id,old_price,new_price)
    VALUES('$product_id','$old_price','$new_price')
    ");
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $new_price = $_POST['new_price'];

    mysqli_query($conn,"
    UPDATE offers
    SET new_price='$new_price'
    WHERE id='$id'
    ");
}
$result = mysqli_query($conn,"SELECT * FROM offers");
$showForm = false;
if(isset($_POST['show_add'])){
    $showForm = true;
}
?>
<div class="container">
 <h2>ניהול מבצעים</h2>
 <form method="post">
    <button class="add-btn" name="show_add"> הוסף מבצע חדש</button>
 </form>
<?php
 if($showForm){
?>
 <div class="add-box" style="display:block;">
    <h3>הוספת מבצע </h3>
    <form method="post">
        <input type="number" name="product_id"  placeholder="קוד מוצר" required>
        <input type="number" name="old_price"  step="0.01" placeholder="מחיר קודם" required>
        <input type="number" name="new_price" step="0.01" placeholder="מחיר חדש" required>
        <br><br>
        <button class="update" name="add"> שמור מבצע</button>
    </form>
 </div>

<?php
 }
?>
 <table>
  <tr>
    <th>ID</th>
    <th>קוד מוצר</th>
    <th>מחיר קודם</th>
    <th>מחיר מבצע</th>
    <th>מחיקה</th>
  </tr>
<?php
while($row=mysqli_fetch_assoc($result)){
?>
  <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['product_id']; ?></td>
    <td>₪<?php echo $row['old_price']; ?></td>
    <td>
    <form method="post">
        <input type="hidden"
               name="id"
               value="<?php echo $row['id']; ?>">
        <input type="number" step="0.01" name="new_price" value="<?php echo $row['new_price']; ?>">
        <button class="update" name="update"> עדכן</button>
    </form>
</td>
    <td>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button class="delete" name="delete"> מחק</button>
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