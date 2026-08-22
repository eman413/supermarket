<?php include "index.php";?>

<?php
if(isset($_POST['add_to_cart'])) {

    if(!isset($_SESSION['user_id']))
    {
        echo "<script>
                alert('יש להתחבר קודם');
              </script>";
    }
    else{

      $id = $_POST['product_id'];
      $quantity = $_POST['quantity'];

      if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
      }

      if(isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $quantity;
      } 
      else {
        $_SESSION['cart'][$id] = $quantity;
      }

      header("Location: cartt.php");
      exit();
    }
}
?>
<div class="products-section">
 <h1 class="container-title">מוצרי חטופים</h1>
 <div class="container">
    <?php
    $category = "חטופים";
    $sql = "SELECT products.*, offers.old_price, offers.new_price
            FROM products
            LEFT JOIN offers
            ON products.id = offers.product_id
            WHERE products.category = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<img src='".$row['image']."' alt='תמונה'>";
        echo "<h3>".$row['name']."</h3>";
        if($row['new_price'] != NULL){
            echo "<p class='old-price'>".$row['old_price']." ₪</p>";
            echo "<p class='new-price'>".$row['new_price']." ₪</p>";
        }else{
            echo "<p class='price'>".$row['price']." ₪</p>";
        }
        if(isset($_SESSION['cart'][$row['id']])) {
            echo "<p class='cart-msg'> המוצר קיים בסל</p>";
        }
        echo "<form method='post'>";
         echo "<input type='number' name='quantity' value='1' min='1'>";
         echo "<input type='hidden' name='product_id' value='".$row['id']."'><br>";
         echo "<button type='submit' name='add_to_cart'>הוסף לסל</button>";
        echo "</form>";
        echo "<form method='post' action='favorites.php'>";
         echo '<a href="favorites.php?product_id='.$row['id'].'">
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                 </svg>
               </a>';
        echo "</form>";
        echo "</div>";
    }
    ?>
 </div>
</div>
<style>
.products-section{
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}
.container-title{
    text-align: center;
    font-size: 25px;
    color:black;
    margin-bottom: 40px;
}
.container{
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    justify-content: flex-start;
    margin-right: 200px;
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
.price{
    color:green;
    font-weight: bold;
}
.cart-msg{
    color: green;
    font-size: 14px;
}
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
    padding: 10px 15px;
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
a{
    color:black;
    text-decoration:none;
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

</style>