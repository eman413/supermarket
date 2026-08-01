<?php
session_start();
include ('db_connection.php');
$conn =OpenCon();
?>
<?php
if(isset($_GET['clear'])){
    unset($_SESSION['order']);
    header("Location: adminsupplier.php");
    exit();
}
 ?>
<div class="paper">
 <h1>הזמנת מוצרים</h1>
 <hr>
 <p>
  תאריך:
  <?php echo date("d/m/Y"); ?>
 </p>
 <p>
  שם העסק:
  סופרמרקט אונליין
 </p>
 <p>
  לכבוד הספק
 </p>
 <hr>
 <h3>פרטי ההזמנה</h3>
<?php
 if(isset($_SESSION['order'])){
    foreach($_SESSION['order'] as $product){
?>
 <p>
  שם מוצר:
  <?php echo $product['name']; ?>
 </p>
 <p>
  חברה:
  <?php echo $product['company']; ?>
 </p>
 <p>
  כמות:
  <?php echo $product['quantity']; ?>
 </p>
 <hr>
<?php
    }
 }
?>
 <p>נשמח לקבל את המוצרים בהקדם האפשרי.</p>
 <br>
 <p>תודה,צוות הסופרמרקט</p>
 <br>
 <div class="buttons">
  <button onclick="window.print()">הדפס</button>
  <a href="mailto:neman3774@gmail.com?subject=הזמנת מוצרים">
    <button type="button">      שליחת מייל</button>
  </a>
  <a href="adminsupdf.php?clear=1" class="finish">
    <button type="button">סיום הזמנה</button>
  </a>
 </div>
</div>
<style>
body{
    font-family: Arial;
    background:#f0f0f0;
    direction:rtl;
}
.paper{
    width:700px;
    margin:30px auto;
    background:white;
    padding:40px;
    border:1px solid #999;
     position:relative;
}
h1{
    text-align:center;
}
h3{
    color:green;
}
p{
    font-size:18px;
    line-height:30px;
}
.finish{
    position:absolute;
    top:20px;
    left:20px;
}

.finish button{
    background-color:#374151;
    color:white;
    border:none;
    padding:10px 20px;
    cursor:pointer;
    border-radius:6px;
}
hr{
    margin:20px 0;
}
.buttons{
    text-align:center;
    margin-top:20px;
    
}
.buttons button{
    background-color:#374151;
    color:white;
    border:none;
    padding:10px 20px;
    margin:5px;
    cursor:pointer;
    border-radius: 6px;
}
</style>

