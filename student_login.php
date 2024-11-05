<?php
session_start();
include 'db_conn.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Check if username and password are empty
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=Username and Password required");
        exit();
    } else {
        // SQL to check if the user exists in the database
        $sql = "SELECT * FROM users WHERE username=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a matching user was found
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: student_homepage.php"); // Redirect to profile page
            exit();
        } else {
            header("Location: login.php?error=Invalid Username or Password");
            exit();
        }
    }
}
?>
