<?php
ob_start();
session_start();
include('db_conn.php');

try {
    // Validation of empty fields
    if (isset($_POST['signup'])) {
        if (empty($_POST['email'])) {
            throw new Exception("Email can't be empty.");
        }
        if (empty($_POST['uname'])) {
            throw new Exception("Username can't be empty.");
        }
        if (empty($_POST['pass'])) {
            throw new Exception("Password can't be empty.");
        }
        if (empty($_POST['fname'])) {
            throw new Exception("Full name can't be empty.");
        }
        if (empty($_POST['phone'])) {
            throw new Exception("Phone number can't be empty.");
        }
        if (empty($_POST['type'])) {
            throw new Exception("Role must be selected.");
        }

        // Using prepared statements for security
        $stmt = $conn->prepare("INSERT INTO admininfo (username, password, email, fname, phone, type) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $_POST['uname'], $_POST['pass'], $_POST['email'], $_POST['fname'], $_POST['phone'], $_POST['type']);

        if ($stmt->execute()) {
            $success_msg = "Signup Successful!";
        } else {
            throw new Exception("Error during signup: " . $stmt->error);
        }
        $stmt->close();
    }
} catch (Exception $e) {
    $error_msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create User</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Add any additional custom styles here */
        body {
            background-color: #f8f9fa;
        }
        .content {
            margin-top: 20px;
        }
        header {
            background-color: #343a40;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .navbar a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Menus started-->
    <header>
        <h1>Student Management System</h1>
        <div class="navbar">
            <a href="homePage.php">Home</a>
            <a href="signup.php">Create Users</a>
            <a href="addStudentDetails.php">Add Data</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>
    <!-- Menus ended -->

    <center>
        <h1>Create User</h1>
        <p>
            <?php
            if (isset($success_msg)) echo $success_msg;
            if (isset($error_msg)) echo $error_msg;
            ?>
        </p>
        <br>
        <div class="content">
            <div class="row">
                <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" name="email" class="form-control" id="email" placeholder="your email" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" name="uname" class="form-control" id="username" placeholder="choose username" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="pass" class="form-control" id="password" placeholder="choose a strong password" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fullname" class="col-sm-3 control-label">Full Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="fname" class="form-control" id="fullname" placeholder="your full name" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-sm-3 control-label">Phone Number</label>
                        <div class="col-sm-7">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="your phone number" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Role</label>
                        <div class="col-sm-7">
                            <label>
                                <input type="radio" name="type" value="student" checked> Student
                            </label>
                            
                            <label>
                                <input type="radio" name="type" value="admin"> Admin
                            </label>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Signup" name="signup" />
                </form>
            </div>
            <br>
            <p><strong>Already have an account? <a href="../index.php">Login</a> here.</strong></p>
        </div>
    </center>
</body>
</html>