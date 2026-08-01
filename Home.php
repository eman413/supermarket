 <?php include "index.php";?>
 <?php
if(isset($_POST['add_to_cart'])){

    $id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id] += $quantity;
    }
    else{
        $_SESSION['cart'][$id] = $quantity;
    }

    header("Location: Home.php");
    exit();
}
?>
<div class="page">
 <div class="recommend-section">
 <?php
  if(isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id'];
    $products=array();
    $related=array();
    $bought=array();

    $sql="SELECT product_id
          FROM order_items oi
          JOIN orders o
          ON oi.order_id=o.id
          WHERE o.user_id=$user_id";

    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_assoc($result)){
      $bought[]=$row['product_id'];
    }
    $sql="SELECT product_id
          FROM favorites
          WHERE user_id=$user_id";

     $result=mysqli_query($conn,$sql);

     while($row=mysqli_fetch_assoc($result)){
       $products[]=$row['product_id'];
    }
    if(count($products)==0){

         $sql="SELECT product_id
               FROM order_items
               WHERE order_id=(
                   SELECT id
                   FROM orders
                   WHERE user_id=$user_id
                   ORDER BY created_at DESC
                   LIMIT 1)";


        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_assoc($result)){
          $products[]=$row['product_id'];
        }
    }
   if(count($products)==0){

        $sql="SELECT p.*,o.new_price
              FROM products p
              JOIN offers o
              ON p.id=o.product_id
              LIMIT 5";


        $result=mysqli_query($conn,$sql);
?>
   <div class="recommend">
   <?php
      while($row=mysqli_fetch_assoc($result)){
    ?>
     <div class="recommend-card">
       <img src="<?php echo $row['image']; ?>">
        <h4><?php echo $row['name']; ?></h4>
       <?php
         if($row['new_price'] != NULL){
        ?>
         <p>
           <p class="old-price">
             ₪<?php echo $row['price']; ?>
           </p> 
           <p class="new-price">
             ₪<?php echo $row['new_price']; ?>
           </p>
          </p>
        <?php
         }else{
        ?>
          <p>
            ₪<?php echo $row['price']; ?>
          </p>
        <?php
         }
         ?>
       <form method="post">
         <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
         <input type="hidden" name="quantity" value="1">
         <button type="submit" name="add_to_cart"> הוסף לסל</button>
        </form>
     </div>
    <?php
     }
    ?>
    </div>
   <?php
   }else{
      foreach($products as $id){

         $sql="SELECT category
               FROM products
               WHERE id=$id";

        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $category=$row['category'];

        $sql="SELECT p.*,o.new_price
              FROM products p
              LEFT JOIN offers o
              ON p.id=o.product_id
              WHERE p.category='$category'
              AND p.id<>$id";

        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_assoc($result)){
           if(!in_array($row['id'],$bought)){
            if(isset($related[$row['id']])){
              $related[$row['id']]['count']++;
            }else{
              $row['count']=1;
              $related[$row['id']]=$row;
            }
           } 
        }
      }
      usort($related,function($a,$b){
      return $b['count']-$a['count'];
      });
   ?>
    <div class="recommend">
    <?php
      $i=0;
      foreach($related as $row){
    ?>
       <div class="recommend-card">
          <img src="<?php echo $row['image']; ?>">
          <h4><?php echo $row['name']; ?></h4>
          <p class="price">₪<?php echo $row['price']; ?></p>

          <form method="post">
           <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
           <input type="hidden" name="quantity" value="1">
           <button type="submit" name="add_to_cart"> הוסף לסל </button>
          </form>
        </div>
    <?php
       $i++;
       if($i==5){
           break;
        }
     }
    ?>
    </div>
<?php
   }
}
?>
</div>
<br>
<div class="content">
    <section id="home">
        <h2 style="text-align: center;"> הפינה שלכם למוצרים הכי טובים </h2>
        <div class="categories">
            <div class="card">
                <img src="L.jpg" alt="בשר ועוף ">
                <br>
                <a href="meatandchicken.php"> בשר ועוף</a>
            </div>
            <div class="card">
                <img src="L1.png" alt="חלב ומוצרי חלב ">
                <br>
                <a href="milkandmilkproducts.php">חלב ומוצרי חלב</a>  
            </div>
            <div class="card">
                <img src="L2.jpg" alt="ירקות ופירות">
                <br>
                <a href="vegandfruit.php"> ירקות ופירות</a>
            </div>
            <div class="card">
                <img src="L3.jpg" alt="משקאות">
                <br>
                <a href="drinks.php"> משקאות</a>
            </div>
            <div class="card">
                <img src="L4.jpg" alt="חטופים">
                <br>
                <a href="snacks.php"> חטופים</a>
            </div>
        </div>
        <div class="categories">
            <div class="card">
                <img src="L5.jpg" alt="מזון">
                <br>
                <a href="food.php"> מזון</a>
            </div>
            <div class="card">
                <img src="L6.jpg" alt="גלידה ">
                <br>
                <a href="icecream.php"> גלידה</a>
            </div>
            <div class="card">
                <img src="L7.jpg" alt="מוקפאים">
                <br>
                <a href="frozen.php"> מוקפאים</a>
            </div>
            <div class="card">
                <img src="L8.jpg" alt="שוקלוד">
                <br>
                <a href="chocolate.php"> שוקלוד</a>
            </div>
            <div class="card">
                <img src="L9.jpg" alt="מעדנייה">
                <br>
                <a href="del.php"> מעדנייה</a>
            </div>
        </div>
        <div class="categories">
            <div class="card">
                <img src="P.jpg" alt="חד פעמי">
                <br>
                <a href="oneuse.php"> חד פעמי</a>
            </div>
        </div>
    </section>
</div>
</div>
<style>
body {
    font-family: Arial;
    direction: rtl;
    overflow-x:hidden;
}
.page{
    width:100%;
    display:block;
}
.content {
    width:100%;
    padding:20px;
    display:block;
}
.categories {
    margin-top:15px;
    margin-right:50px;
    display: flex;
    gap: 15px;
    margin-right: 200px;
}
.card {
    background: #f1f1f1;
    padding: 20px;
    border-radius: 8px;
    width: 150px;
    text-align: center;
    cursor: pointer;
}
.card img {
    width:120px;
    height: 100px;
}
.recommend-section{
    width:100%;
    margin-top: 5px;
}
.recommend{
    display:flex;
    margin-right: 215px;
    gap:15px;
    width:100%;
}
.recommend-card{
    width:140px;
    background:#f1f1f1;
    padding:10px;
    border-radius:10px;
    text-align:center;
}
.recommend-card img{
    width:80px;
    height:80px;
    object-fit:contain;
}
.recommend-card button{
    background:#34495e;
    color:white;
    border:0;
    border-radius:7px;
    padding:5px 12px;
}
.price{
    color:green;
    font-weight: bold;
}
.old-price{
    color:red;
    text-decoration:line-through;
    font-weight: bold;
}

.new-price{
    color:green;
    font-weight: bold;
}
</style>








