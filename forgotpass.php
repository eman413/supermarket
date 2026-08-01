<?php
session_start();
$conn = mysqli_connect("localhost","root","","supermarket");
if(isset($_POST['send'])){
    $username = $_POST['username'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $code = rand(100000,999999);
        $_SESSION['reset_code'] = $code;
        $_SESSION['reset_user'] = $username;

        $to = $email;
        $subject = "Reset Password";
        $message = "Your reset code is: ".$code;
        $headers = "From: supermarket@gmail.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $send = mail($to,$subject,$message,$headers);
        if($send){
            header("Location: checkpass.php");
        }
        else{
            echo "שליחת אימייל בהצלחה";
        }
    }
    else{
        echo "המשתמש לא קיים";
    }
}
?>
<form method="post">
    Enter your username:
    <input type="text" name="username" required>
    <button name="send">  Send Code</button>
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