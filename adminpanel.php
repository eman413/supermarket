<?php
session_start();
include ('db_connection.php');
$conn =OpenCon();
?>
<div class="top-nav">
    <div class="logo">  SuperMarket</div>
    <div class="admin-info">
       <?php
       if(isset($_SESSION['admin'])) {   
             echo 'Hello '.$_SESSION['admin'].' | ';
             echo '<a href="logout.php">Logout</a>';  
       } 
       ?>
    </div>
</div>
<div class="main">
    <div class="sidenav">
        <a href="admindashboard.php"> דף ראשית </a>
        <a href="adminpro.php">מוצרים</a>
        <a href="adminoffers.php"> מבצעים</a>
        <a href="adminorders.php"> הזמנות</a>
        <a href="adminsupplier.php"> הזמנת מוצר</a>
        <a href="#"> </a>
        <a href="#"> </a>
        <a href="#"> </a>
    </div>
</div>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    direction:rtl;
    background:#f4f6f9;
}
.top-nav{
    background:#1f2937;
    color:white;
    height:60px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
}
.admin-info a{
    color: white;
    text-decoration: none;
    font-weight: bold;
}
.main{
    display:flex;
    
}
.sidenav{
    position: absolute;
    width: 200px;
    background: #ecf0f1;
    height: 100%;
    padding-top: 20px;
}
.sidenav a{
    display: block;
    padding: 10px;
    color: #333;
    text-decoration: none;
    
}
.sidenav a:hover{
    background:#bdc3c7;
}
</style>