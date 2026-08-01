<?php include "index.php";?>
<?php
$user_id = $_SESSION['user_id'];

if(!isset($_SESSION['user_id'])){
    echo "<script>
            alert('יש להתחבר קודם');
            window.location='Allproducts.php';
          </script>";

    exit();
}

if(isset($_GET['product_id'])){
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['product_id'];
    mysqli_query($conn,"
    INSERT INTO favorites(user_id,product_id)
    VALUES('$user_id','$product_id')
    ");
}

if(isset($_GET['delete'])){
    $product_id = $_GET['delete'];
    mysqli_query($conn,"
        DELETE FROM favorites 
        WHERE user_id='$user_id' 
        AND product_id='$product_id'
    ");
    header("Location: favorites.php");
    exit();
}

if(isset($_POST['add_cart'])){
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][$product_id] = 1;
    header("Location: cartt.php");
    exit();
}
$query = "SELECT products.*
          FROM products
          JOIN favorites
          ON products.id = favorites.product_id
          WHERE favorites.user_id = '$user_id'";

$result = mysqli_query($conn, $query);
?>
<div class="container">
 <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="product">
        <img src="<?php echo $row['image']; ?>" width="150">
        <h3><?php echo $row['name']; ?></h3>
        <p><?php echo $row['price']; ?> ₪</p>
        <form method="post">
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <input type="number" name="quantity" value="1" min="1"><br>
            <button type="submit" name="add_cart" class="product_button"> הוסף לסל</button>
        </form>
        <form method="post">
            <a href="favorites.php?delete=<?= $row['id'] ?>" style="color:black; text-decoration:none;">
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
             </svg>
            </a>
        </form>
    </div>
 <?php 
  } 
 ?>
</div>

<style>
.container{
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    justify-content: flex-start;
    margin-right: 210px;
    margin-top: 10px;
}
.product{
    width: 220px;
    background: #f5f5f5;
    border-radius: 15px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
.product img{
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 10px;
}
.product h3{
    font-size: 20px;
}
.product p{ 
    color:green;
    font-weight: bold;
}
/* כמות*/
.product input[type="number"]{
    width: 70px;
    padding: 6px;
    text-align: center;
    margin-top: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.product button{
    margin-top: 12px;
    padding: 10px 10px;
    border: none;
    border-radius: 7px;
    background: #34495e;
    color: white;
    cursor: pointer;
    font-size: 15px;
}
.product button:hover{
    background: #2c3e50;
}
.product .delete-btn{
    background:red;
    color:white;
}
</style>