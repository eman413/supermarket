<?php
session_start();
include('db_connection.php');
$conn = OpenCon();

if(isset($_POST['continue'])){

    $card_number = $_POST['card_number'];
    $card_name = $_POST['card_name'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];

    header("Location:checkorder.php");
    exit();
}
?>
<div class="payment-container">
    <h2>פרטי תשלום</h2>
    <form method="post">
        <label>שם בעל הכרטיס</label>
        <input type="text" name="card_name" required>

        <label>מספר כרטיס</label>
        <input type="text" name="card_number" required>

        <label>תוקף הכרטיס</label>
        <input type="text" name="expiry" placeholder="MM/YY" required>

        <label>CVV</label>
        <input type="text" name="cvv" required>

        <button type="submit" name="continue">     המשך </button>
    </form>
</div>
<style>
body{
    font-family:Arial;
    direction:rtl;
    background:#f0f0f0;
}
.payment-container{
    width:400px;
    background:white;
    margin:70px auto;
    padding:25px;
    border-radius:8px;
    border:1px solid #ccc;
    text-align:center;
}
h2{
    margin-bottom:25px;
}
form{
    display:flex;
    flex-direction:column;
}
label{
    text-align:right;
    margin-top:10px;
}
input{
    padding:10px;
    margin-top:5px;
    border-radius:5px;
    border:1px solid #ccc;
}
button{
    margin-top:25px;
    padding:12px;
    background:#2c3e50;
    color:white;
    border:0;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#34495e;
}

</style>