<?php
session_start();
include ('db_connection.php');
$conn =OpenCon();

if(isset($_POST['username']) && isset($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

$sql = "SELECT * FROM admins
        WHERE username = ?
        AND password = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss",$username,$password);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $_SESSION['admin'] = $username;

    header("Location: adminpanel.php");
    exit();

}else{

    echo "פרטי אדמין שגויים";
}
}
?>
<div class="login-container">
    <h2>Login</h2>
    <form method="POST" action="adminlogin.php">
        <label for="username">שם משתמש:</label>
        <input type="text" id="username" name="username" placeholder="הכנס שם משתמש" required>
        <label for="password">סיסמה:</label>
        <input type="password" id="password" name="password" placeholder="הכנס סיסמה" required>
        <button type="submit">כניסה</button>
    </form>
</div>
<style>
    body {
    margin: 0;
    font-family: Arial;
    background: #f0f0f0;
    display: flex;
    justify-content: center;   /* מרכז אופקית */
    align-items: center;       /* מרכז אנכית */
    height: 100vh;
}

.login-container {
    background: white;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    width: 300px;
    text-align: center;
}

.login-container h2 {
    margin-bottom: 20px;
}

.login-container form {
    display: flex;
    flex-direction: column;
}

.login-container label {
    margin: 10px 0 5px 0;
    text-align: right; 
}

.login-container input {
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.login-container button {
    margin-top: 15px;
    padding: 10px;
    border: none;
    background: #2c3e50;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
}

.login-container button:hover {
    background: #34495e;
}

.login-container p {
    margin-top: 15px;
    font-size: 14px;
}

.login-container a {
    text-decoration: none;
    color: #2980b9;
}
</style>