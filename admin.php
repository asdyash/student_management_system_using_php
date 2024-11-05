<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles1.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Login</title>  
</head>
<body>
    <div class="brs">
        <div class="form-container">
            <img src="https://image.freepik.com/free-vector/sign-concept-illustration_114360-5267.jpg" alt="" class="form__img">
            <form class="form__content" action="admin_login.php" method="post">
                <h1 class="form__title">Login<span style="font-size: 25px;margin: 12px;"> Teacher | Admin</span></h1>
                <a href="index.php" class="form__forgot">Click here for student login</a>

                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <div class="form__div">
                    <div class="form__icon">
                        <i class='bx bx-user'></i>
                    </div>
                    <div class="form__div-input">
                        <!-- <label for="username" class="form__label">Username</label> -->
                        <input type="text" class="form__input" placeholder="Username" required name="uname" id="username">
                    </div>
                </div>

                <div class="form__div">
                    <div class="form__icon">
                        <i class='bx bx-lock'></i>
                    </div>
                    <div class="form__div-input">
                        <!-- <label for="password" class="form__label">Password</label> -->
                        <input type="password" class="form__input" placeholder="Password" required name="pass" id="password">
                    </div>
                </div>

                <a href="#" class="form__forgot">Forgot Password?</a>
                <input type="submit" class="form__button" value="Login">
            </form>
        </div>
    </div>
    <script src="main.js"></script>
    <script type="text/javascript">
        setTimeout(function(){
            document.querySelector('.error').style.display = 'none';
        }, 3000);
    </script>
</body>

</html>
