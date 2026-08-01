<?php
session_start();
if(isset($_POST['check'])){
    $code = $_POST['code'];
    if($code == $_SESSION['reset_code']){
        header("Location: newpass.php");
    }
    else{
        echo "Wrong code";
    }
}
?>
<form method="post">
    Enter the code you received:
    <input type="text" name="code" required>
    <button name="check">  Check Code</button>
</form>
<style>
body {
    margin: 0;
    font-family: Arial;
    background: #f0f0f0;
    display: flex;
    justify-content: center;  
    align-items: center;      
    height: 100vh;
}
form {
    background-color: white;
    width: 300px;
    margin: 100px auto;
    padding: 30px 40px;
    text-align: center;
    border-radius: 6px;
    flex-direction: column;
}
input {
    width: 90%;
    padding: 8px;
    margin: 10px;
}
button {
    background-color: #2c3e50;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
    border-radius: 6px;
}
</style>
