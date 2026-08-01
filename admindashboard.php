<?php include "adminpanel.php";?>
<?php
$sql = "SELECT COUNT(*) AS total FROM products";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$products = $row['total'];

$sql = "SELECT COUNT(*) AS total FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$users = $row['total'];

$sql = "SELECT COUNT(*) AS total FROM orders";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$orders = $row['total'];

$sql = "SELECT AVG(total_price) AS avg FROM orders";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$average = round($row['avg'], 2);

$sql = "SELECT SUM(quantity) AS total
        FROM order_items
        WHERE product_id IN (
            SELECT product_id
            FROM offers
        )";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$offers = $row['total'];

if($offers == NULL){
    $offers = 0;
}

$sql = "SELECT DATE(created_at) AS day,
               SUM(total_price) AS sales
        FROM orders
        GROUP BY DATE(created_at)";
$result = mysqli_query($conn, $sql);

$days = array();
$sales = array();

while($row = mysqli_fetch_assoc($result)){
    $days[] = $row['day'];
    $sales[] = $row['sales'];
}
?>
<h2>לוח הבקרה של מנהל הסופרמרקט</h2>
<div class="dashboard">
 <div class="box">
  <h3>מוצרים</h3>
  <p><?= $products ?></p>
 </div>
 <div class="box">
  <h3>משתמשים</h3>
  <p><?= $users ?></p>
 </div>
 <div class="box">
  <h3>הזמנות</h3>
  <p><?= $orders ?></p>
 </div>
 <div class="box">
  <h3>ממוצע מכירות</h3>
  <p><?= $average ?> ₪</p>
 </div>
 <div class="box">
  <h3>מוצרי מבצע</h3>
  <p><?= $offers ?></p>
 </div>
</div>
<div class="chartBox">
 <canvas id="salesChart" width="550" height="250"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = <?= json_encode($days) ?>;
const data = <?= json_encode($sales) ?>;
new Chart(document.getElementById('salesChart'),{
 type:'line',
 data:{
  labels:labels,
  datasets:[{
   label:'מכירות לפי ימים',
   data:data,
   fill:false,
   borderWidth:3,
   tension:0.3
  }]
 },
 options:{
    responsive:false,
    maintainAspectRatio:false,
    plugins:{
        legend:{
            display:true
        }
    }
 }
});
</script>
<style>
body{
    background:#f4f6f9;
    font-family:Arial;
    direction:rtl;
}

h2{
    text-align:center;
    margin:20px;
    font-size:28px;
}

.dashboard{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:15px;
    width:600px;
    margin:20px auto;
}
.box{
    width:150px;
    height:100px;
    background:white;
    border:1px solid #ccc;
    border-radius:8px;
    text-align:center;
    padding:10px;
}
.box h3{
    margin:5px;
    font-size:18px;
    color:#444;
}

.box p{
    margin-top:10px;
    font-size:24px;
    color:green;
    font-weight:bold;
}

.chartBox{
    width:650px;
    margin:30px auto;
    background:white;
    border:1px solid #ccc;
    border-radius:10px;
    padding:20px;
}

#salesChart{
    width:550px !important;
    height:250px !important;
}
</style>
