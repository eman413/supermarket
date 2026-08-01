<?php
session_start();
$conn = mysqli_connect("localhost","root","","supermarket");
if(isset($_POST['change'])){
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    if($password == $confirm){
        $username = $_SESSION['reset_user'];
        $sql = "UPDATE users SET password='$password' WHERE username='$username'";
        $result = mysqli_query($conn,$sql);
        if($result){
            echo "Password changed successfully";
            unset($_SESSION['reset_code']);
            unset($_SESSION['reset_user']);
        }
        else{
            echo "Error updating password";
        }
    }
    else{
        echo "Passwords do not match";
    }
}
?>
<form method="post">
    New Password:
    <input type="password" name="password" required>
    <br><br>
    Confirm Password:
    <input type="password" name="confirm" required>
    <br><br>
    <button name="change">
        Change Password
    </button>
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
