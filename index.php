<?php
session_start();
include ('db_connection.php');
$conn =OpenCon();
?>
<div class="top-nav">
    <div class="logo"> SuperMarket</div>
    <div class="search">
     <form action="search.php" method="get">
        <input type="text"  name="search"  placeholder="חיפוש מוצר...">
     </form>
    </div>
    <div class="login">
      <ul>
        <?php
        if(isset($_SESSION['user'])) {
            echo '
            <li class="user-box">
                <a href="logout.php">Logout</a> | Hello '.$_SESSION['user'].'
            </li>
            ';
        } else {
            echo '
            <li class="dropdown">
                <a href="#">Login</a>
                <ul class="dropdown-content">
                    <li><a href="loginin.php">User Login</a></li>
                    <li><a href="adminlogin.php">Admin Login</a></li>
                </ul>
            </li>';
        }
        ?>
      </ul>
    </div>
</div>
<div class="main">
    <div class="side-nav">
        <a href="Home.php">דף בית</a>
        <a href="Allproducts.php">כל המוצרים</a>
        <a href="cartt.php">סל קניות</a>
        <a href="offers.php">מבצעים</a>
        <a href="favorites.php">מועדפים</a>
    </div>
<style>
body{
    margin:0;
    font-family: Arial;
    direction: rtl;
    overflow-x:hidden;
}
.top-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #2c3e50;
    color: white;
    padding: 10px 20px;
}
.search input {
    padding: 6px;
    width: 250px;
}
.login a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}
.main {
    display: flex;
}
.side-nav {
    position: absolute;
    width: 200px;
    background: #ecf0f1;
    height: 100%;
    padding-top: 20px;
}
.side-nav a {
    display: block;
    padding: 10px;
    color: #333;
    text-decoration: none;
}
.side-nav a:hover {
    background: #bdc3c7;
}
.content {
    padding: 20px;
    flex: 1;
}
.categories {
    display: flex;
    gap: 15px;
}
.card {
    background: #f1f1f1;
    padding: 20px;
    border-radius: 8px;
    width: 150px;
    text-align: center;
    cursor: pointer;
}
.products {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}
.product {
    background: #f9f9f9;
    padding: 15px;
    border: 1px solid #ddd;
}
.dropdown {
    position: relative;
    display: inline-block;
}
.dropbtn {
    background-color: #2c3e50;
    color: white;
    padding: 10px 15px;
    font-size: 10px;
    border: none;
    cursor: pointer;
    text-decoration: none;
}
.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;          
    left: 0; 
    background-color: #34495e;
    min-width: 150px;
    border-radius: 4px;
    box-shadow: 0px 8px 16px rgba(0,0,0,0.3);
   z-index: 1;
}
.dropdown-content li a {
    color: #fff;
    padding: 10px 12px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s;
}
.dropdown-content li a:hover {
    background-color: #1a40bc;
}
.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #1a53bc;
}
</style>