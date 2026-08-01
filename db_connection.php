<?php
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "supermarket";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db) 
        or die("Connect failed");

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}
?>