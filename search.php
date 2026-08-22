<?php
include "index.php";

if(isset($_POST['add_to_cart'])) {
    if(!isset($_SESSION['user_id'])) {
        echo "<script>
                alert('יש להתחבר קודם');
              </script>";
    }else{
        $id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if(isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $quantity;
        } else {
            $_SESSION['cart'][$id] = $quantity;
        }

        header("Location: cartt.php");
        exit();
    }
}
?>
<div class="container">
<?php
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT products.*, offers.old_price, offers.new_price
            FROM products
            LEFT JOIN offers
            ON products.id = offers.product_id
            WHERE products.name LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
?>
        <div class="product">
            <img src="<?php echo $row['image']; ?>">
            <h3>
                <?php echo $row['name']; ?>
            </h3>
            <?php
            if($row['new_price'] != NULL){
            ?>
                <p class="old-price">
                    <?php echo $row['old_price']; ?> ₪
                </p>
                <p class="new-price">
                    <?php echo $row['new_price']; ?> ₪
                </p>
            <?php
            }else{
            ?>
                <p class="price">
                    <?php echo $row['price']; ?> ₪
                </p>
            <?php
            }
            ?>
            <form method="post">
                <input type="hidden"  name="product_id"  value="<?php echo $row['id']; ?>">
                <input type="number"  name="quantity"  value="1"  min="1">
                <button type="submit" name="add_to_cart">    הוסף לסל </button>
            </form>
            <form method="post" action="favorites.php">
                <a href="favorites.php?product_id=<?php echo $row['id']; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                    </svg>
                </a>
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
    padding-right:300px;
    padding-top:20px;
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
.old-price{
    color:red;
    text-decoration:line-through;
    font-weight:bold;
}
.new-price{
    color:green;
    font-weight:bold;
}
.price{
    color:green;
    font-weight:bold;
}
.product button{
    margin-top:10px;
    padding:7px;
    border:none;
    border-radius:5px;
    background:#34495e;
    color:white;
    cursor:pointer;
    font-size:15px;
}
.product button:hover{
    background:#2c3e50;
}
a{
    color:black;
    text-decoration:none;
}
</style>