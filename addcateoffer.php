<?php
session_start();
include ('db_connection.php');
$conn =OpenCon();
?>
<?php
if(isset($_POST['save'])){

    $category = $_POST['category'];
    $percent = $_POST['percent'];

    $sql = "DELETE FROM offers
            WHERE product_id IN
            (
                SELECT id FROM products
                WHERE category='$category'
            )";

    mysqli_query($conn,$sql);
    $sql = "SELECT MAX(offer_group_id) AS max_group  FROM offers";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $group_id = $row['max_group'] + 1;
    if($group_id == 1){
        $group_id = 1;
    }
    $sql = "SELECT * FROM products  WHERE category='$category'";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){

        $product_id = $row['id'];
        $old_price = $row['price'];
        $discount = $old_price * $percent / 100;
        $new_price = $old_price - $discount;

        $sql2 = "INSERT INTO offers(product_id,old_price,new_price,offer_group_id)
        VALUES('$product_id','$old_price','$new_price','$group_id')";
        mysqli_query($conn,$sql2);
    }
    header("Location: adminoffers.php");
    exit();
}
?>
<div class="container">
    <h2>הוספת מבצע לקטגוריה</h2>
    <form method="post">
        <label>בחר קטגוריה:</label>
        <select name="category" required>
            <option value="">בחר קטגוריה</option>
            <option value="בשר ועוף">בשר ועוף</option>
            <option value="חלב ומוצרי חלב">חלב ומוצרי חלב</option>
            <option value="ירקות ופירות">ירקות ופירות</option>
            <option value="משקאות">משקאות</option>
            <option value="חטופים">חטופים</option>
            <option value="מזון">מזון</option>
            <option value="גלידה">גלידה</option>
            <option value="מוקפאות">מוקפאות</option>
            <option value="שוקלוד">שוקלוד</option>
            <option value="מעדנייה">מעדנייה</option>
            <option value="חד פעמי">חד פעמי</option>
        </select>
        <br><br>
        <label>אחוז הנחה:</label>
        <input type="number" name="percent" min="0" max="90" required>
        <br><br>
        <button name="save">שמור</button>
    </form>
</div>
<style>
body{
    font-family:Arial;
    direction:rtl;
    background:#f4f4f4;
}
.container{
    width:400px;
    margin:70px auto;
    background:white;
    padding:25px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 0 10px #ccc;
}
h2{
    margin-bottom:25px;
}
label{
    display:block;
    margin-top:10px;
}
select{
    width:100%;
    padding:10px;
    margin-top:5px;
}
input{
    width:94%;
    padding:10px;
    margin-top:5px;
}
button{
    background:#374151;
    color:white;
    border:none;
    padding:10px 30px;
    border-radius:6px;
    cursor:pointer;
}
</style>