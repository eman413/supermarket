<?php
session_start();
session_unset();   // מוחק את כל משתני הסשן
session_destroy(); // מסיים את הסשן
header("Location: Home.php"); // חזרה לדף הבית
exit();
?>