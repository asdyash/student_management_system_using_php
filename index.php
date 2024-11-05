<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Login</title>  
</head>
<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <img src="https://i.pinimg.com/originals/6b/1b/22/6b1b22573f9f3d4bba11a9fa5cb45652.png" alt="Login Image" class="form__img img-fluid" style="max-width: 50%; height: auto;">
        
        <form class="form__content" action="student_login.php" method="post" style="width: 400px; margin-left: 20px;">
            <h1 class="form__title">Login <span style="font-size: 25px; margin: 12px;">Student | Parent</span></h1>
            <a href="admin.php" class="form__forgot">Click here for admin</a>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error" style="color: white; text-align: center; background: #ff8080; padding: 10px; border-radius: 5px;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php } ?>

            <div class="form-group">
                <label for="uname">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class='bx bx-user'></i></span>
                    </div>
                    <input type="text" class="form-control" id="uname" name="uname" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class='bx bx-lock'></i></span>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <a href="#" class="form__forgot">Forgot Password?</a>

            <input type="submit" class="btn btn-primary btn-block" value="Login">
        </form>
    </div>
    
    <script src="main.js"></script>
    <script type="text/javascript">
        setTimeout(function() {
            const errorMsg = document.querySelector('.error');
            if (errorMsg) errorMsg.style.display = 'none';
        }, 3000);
    </script>
</body>
</html>
