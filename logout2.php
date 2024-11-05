<?php 
session_start();

// Unset all session variables
session_unset(); 

// Destroy the session
session_destroy(); 

// Redirect to the login page or home page
header("Location: http://localhost/StudentManagementSystem-Using-PHP-main/admin.php"); 
exit(); // Ensure no further code is executed
?>
