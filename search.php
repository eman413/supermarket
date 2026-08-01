<?php
include "index.php";

if(isset($_POST['add_to_cart'])){
    if(!isset($_SESSION['user_id'])){
        echo "<script>
                alert('יש להתחבר קודם');
              </script>";
    }
    else{
     $id = $_POST['product_id'];
     $_SESSION['cart'][$id] = 1;

     header("Location: cartt.php");
     exit();
    }
}
?>
<div class="container">
<?php
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
    $result = mysqli_query($conn , $sql);
    while($row = mysqli_fetch_assoc($result)){
?>
        <div class="product">
            <img src="<?php echo $row['image']; ?>">
            <h3>
                <?php echo $row['name']; ?>
            </h3>
            <p>
                <?php echo $row['price']; ?> ₪
            </p>
            <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <input type='number' name='quantity' value='1' min='1'>
                <button type="submit" name="add_to_cart"> הוסף לסל </button>
            </form>
            <form method="post" action="favorites.php">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="love" class="love-btn"> אהבה </button>
            </form>
        </div>
<?php
    }
}
?>
</div>
<style>
.container{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:20px;
    padding-right: 300px;
    padding-top: 20px;
}
.product{
    background:#f2f2f2;
    width:220px;
    padding:15px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 0 10px gray;
}
.product img{
    width:100%;
    height:180px;
    object-fit:cover;
}
.product button{
    margin-top:10px;
    padding:7px;
    border:none;
    border-radius:5px;
    background:#34495e;
    color:white;
}
.love-btn{
    background:white;
    font-size:20px;
}
</style>