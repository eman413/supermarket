<?php
session_start();
include ('db_connection.php');
$conn =OpenCon();
?>

<?php
if(isset($_POST['signup'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $adress = $_POST['adress'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (fname, lname, address, email, username, password) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fname, $lname, $adress, $email, $username, $password);

    if($stmt->execute()) {
        echo "נרשמת בהצלחה ✅";
        header("Location:loginin.php");
    } else {
        echo "שגיאה ❌";
    }
}

$conn->close();
?>
<form method="POST" action="">
    <h2>הרשמה</h2>
    <input type="text" name="fname" placeholder="שם פרטי" required><br><br>
    <input type="text" name="lname" placeholder="שם משפחה" required><br><br>
    <input type="text" name="adress" placeholder="כתובת" required><br><br>
    <input type="email" name="email" placeholder="אימייל" required><br><br>
    <input type="text" name="username" placeholder="שם משתמש" required><br><br>
    <input type="password" name="password" placeholder="סיסמה" required><br><br>
    <button type="submit" name="signup">Sign Up</button>
</form>
<style>
 
body {
    display: flex;
    justify-content: center;
    align-items: center;
}
form {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    width: 300px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    text-align: center;
}
form h2 {
    margin-bottom: 20px;
    text-align: center;
}
form input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}
form input:focus {
    border-color:#34495e;
    outline: none;
}
form button {
    width: 100%;
    padding: 10px;
    background-color:#34495e;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}
form button:hover {
    background-color: #34495e;
}
.success {
    color: green;
    margin-top: 10px;
}
.error {
    color: red;
    margin-top: 10px;
}
</style>