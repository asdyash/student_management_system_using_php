<?php

ob_start();
session_start();


?>

<?php

include('db_conn.php');

//data insertion
  try{

    //checking if the data comes from students form
    if(isset($_POST['std'])){

      //students data insertion to database table "students"
        $result = mysqli_query($conn,"insert into students(st_id,st_name,st_dept,st_batch,st_sem,st_email) values('$_POST[st_id]','$_POST[st_name]','$_POST[st_dept]','$_POST[st_batch]','$_POST[st_sem]','$_POST[st_email]')");
        $success_msg = "Student added successfully.";

    }

        //checking if the data comes from teachers form
        if(isset($_POST['tcr'])){

          //teachers data insertion to the database table "teachers"
          $res = mysqli_query($conn,"insert into teachers(tc_id,tc_name,tc_dept,tc_email,tc_course) values('$_POST[tc_id]','$_POST[tc_name]','$_POST[tc_dept]','$_POST[tc_email]','$_POST[tc_course]')");
          $success_msg = "Teacher added successfully.";
    }

  }
 catch(mysqli_sql_exception $e){
  $success_msg = $e->getMessage();
 }

 ?>



<!DOCTYPE html>
<html lang="en">
<!-- head started -->
<head>
<title>Add User</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
 >
   
  <!-- <link rel="stylesheet" href="styles.css" > -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   
  <!-- Latest compiled and minified JavaScript -->

<style type="text/css">

  .message{
    padding: 10px;
    font-size: 15px;
    font-style: bold;
    color: black;
  }
</style>
</head>
<!-- head ended -->

<!-- body started -->
<body>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

html {
  overflow-x: hidden;
}

.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 260px;
  background: black;
  transition: width 0.5s ease;
}


.sidebar.close {
  width: 78px;
}

.sidebar .logo-details {
  height: 60px;
  display: flex;
  align-items: center;
}

.sidebar .logo-details i {
  font-size: 30px;
  color: #fff;
  min-width: 78px;
  text-align: center;
}

.sidebar .logo-details .logo_name {
  font-size: 22px;
  color: #fff;
  font-weight: 600;
  transition: opacity 0.3s ease;
}

.sidebar.close .logo-details .logo_name {
  opacity: 0;
  pointer-events: none;
}

.sidebar .nav-links {
  padding: 30px 0;
}

.sidebar .nav-links li {
  list-style: none;
}

.sidebar .nav-links li a {
  display: flex;
  align-items: center;
  text-decoration: none;
  color: #fff;
}

.sidebar .nav-links li a .link_name {
  font-size: 18px;
  transition: opacity 0.4s ease;
}

.sidebar.close .nav-links li a .link_name {
  opacity: 0;
  pointer-events: none;
}

.sidebar .profile-details {
  position: fixed;
  bottom: 0;
  width: 260px;
  padding: 12px 0;
  background: #1d1b31;
  transition: width 0.5s ease;
}

.sidebar.close .profile-details {
  width: 78px;
}

.home-section {
  position: relative;
  height: 100vh;
  left: 260px;
  width: calc(100% - 260px);
  transition: left 0.5s ease, width 0.5s ease;
}

.sidebar.close ~ .home-section {
  left: 78px;
  width: calc(100% - 78px);
}

.home-section .home-content {
  display: flex;
  align-items: center;
  height: 60px;
}

.home-section .home-content .bx-menu {
  font-size: 35px;
  color: #11101d;
  cursor: pointer;
}

form input[type="text"], input[type="email"], input[type="reg"], input[type="mail"], select, textarea {
  width: 750px; /* Set to full width for a wider appearance */
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  color: black;
  margin: 6px 0 16px;
  outline: 0;
}

form input[type="submit"] {
  margin-left: 70px;
  color: black;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
  background-color: green;
}

#student {
  margin: 50px auto;
  max-width: 600px;
}

.sidebar{
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 260px;
  z-index: 100;
  transition: all 0.5s ease;
  background-color: black;
  opacity: none;
}
.sidebar.close{
  width: 78px;
}
.sidebar .logo-details{
  height: 60px;
  width: 100%;
  display: flex;
  align-items: center;
}
.sidebar .logo-details i{
  font-size: 30px;
  color: #fff;
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
}
.sidebar .logo-details .logo_name{
  font-size: 22px;
  color: #fff;
  font-weight: 600;
  transition: 0.3s ease;
  transition-delay: 0.1s;
  margin-left: 0px;
}
.sidebar.close .logo-details .logo_name{
  transition-delay: 0s;
  opacity: 0;
  pointer-events: none;
}
.sidebar .nav-links{
  height: 100%;
  padding: 30px 0 150px 0;
  overflow: auto;
}
.sidebar.close .nav-links{
  overflow: visible;
}
.sidebar .nav-links::-webkit-scrollbar{
  display: none;
}
.sidebar .nav-links li{
  position: relative;
  list-style: none;
  transition: all 0.4s ease;
}
.sidebar .nav-links li:hover{
  background: #1d1b31;
}
.sidebar .nav-links li .iocn-link{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.sidebar.close .nav-links li .iocn-link{
  display: block
}
.sidebar .nav-links li i{
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  transition: all 0.3s ease;
}
.sidebar .nav-links li.showMenu i.arrow{
  transform: rotate(-180deg);
}
.sidebar.close .nav-links i.arrow{
  display: none;
}
.sidebar .nav-links li a{
  display: flex;
  align-items: center;
  text-decoration: none;
}
.sidebar .nav-links li a .link_name{
  font-size: 18px;
  font-weight: 400;
  color: #fff;
  transition: all 0.4s ease;
}
.sidebar.close .nav-links li a .link_name{
  opacity: 0;
  pointer-events: none;
}
.sidebar .nav-links li .sub-menu{
  padding: 6px 6px 14px 80px;
  margin-top: -10px;
  background: #1d1b31;
  display: none;
}
.sidebar .nav-links li.showMenu .sub-menu{
  display: block;
}
.sidebar .nav-links li .sub-menu a{
  color: #fff;
  font-size: 15px;
  padding: 5px 0;
  white-space: nowrap;
  opacity: 0.6;
  transition: all 0.3s ease;
}
.sidebar .nav-links li .sub-menu a:hover{
  opacity: 1;
}
.sidebar.close .nav-links li .sub-menu{
  position: absolute;
  left: 100%;
  top: -10px;
  margin-top: 0;
  padding: 10px 20px;
  border-radius: 0 6px 6px 0;
  opacity: 0;
  display: block;
  pointer-events: none;
  transition: 0s;
}
.sidebar.close .nav-links li:hover .sub-menu{
  top: 0;
  opacity: 1;
  pointer-events: auto;
  transition: all 0.4s ease;
}
.sidebar .nav-links li .sub-menu .link_name{
  display: none;
}
.sidebar.close .nav-links li .sub-menu .link_name{
  font-size: 18px;
  opacity: 1;
  display: block;
}
.sidebar .nav-links li .sub-menu.blank{
  opacity: 1;
  pointer-events: auto;
  padding: 3px 20px 6px 16px;
  opacity: 0;
  pointer-events: none;
}
.sidebar .nav-links li:hover .sub-menu.blank{
  top: 50%;
  transform: translateY(-50%);
}
.sidebar .profile-details{
  position: fixed;
  bottom: 0;
  width: 260px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #1d1b31;
  padding: 12px 0;
  transition: all 0.5s ease;
}
.sidebar.close .profile-details{
  background: none;
}
.sidebar.close .profile-details{
  width: 78px;
}
.sidebar .profile-details .profile-content{
  display: flex;
  align-items: center;
}
.sidebar .profile-details img{
  height: 20px;
  width: 20px;
  object-fit: cover;
  border-radius: 16px;
  margin: 0 14px 0 12px;
  background: #1d1b31;
  transition: all 0.5s ease;
}
.sidebar.close .profile-details img{
  padding: 10px;
}
.sidebar .profile-details .profile_name,
.sidebar .profile-details .job{
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  white-space: nowrap;
}
.sidebar.close .profile-details i,
.sidebar.close .profile-details .profile_name,
.sidebar.close .profile-details .job{
  display: none;
}
.sidebar .profile-details .job{
  font-size: 12px;
}
.home-section{
  position: relative;
  height: 100vh;
  left: 260px;
  width: calc(100% - 260px);
  transition: all 0.5s ease;
}
.sidebar.close ~ .home-section{
  left: 78px;
  width: calc(100% - 78px);
}
@media (max-width: 420px) {
  .sidebar.close .nav-links li .sub-menu{
    display: none;
  }

  </style>

<header>
   <div class="sidebar close">
    <div class="logo-details">
<i class="fa fa-graduation-cap" aria-hidden="true"></i>
      <span class="logo_name">Student</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="homePage.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Home</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Home</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="signup.php">
        <i class="fa fa-plus" aria-hidden="true"></i>

            <span class="link_name">Add User</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Add User</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="addStudentDetails.php">
        <i class="fa fa-plus" aria-hidden="true"></i>

            <span class="link_name">Add Data</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Add Data</a></li>
        </ul>
      </li>
     
     
      
     
     
      
      <li>
    <div class="profile-details">
    
      <div class="name-job">
        <div class="profile_name"><?php echo $_SESSION['user_name'];?></div>
        


      </div>
      <a href="logout2.php"><i class='bx bx-log-out' > </i></a>
    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
          <p>Add Student Details</p>
       
          <div class="profile">

               <ul style="list-style:none;display: inline-flex;margin-left: 970px;margin-top: 10px;">

               
                 <li style="margin-top: 12px;margin-left: 10px;"><h4><?php echo $_SESSION['user_name'];?></h4></li>
                  <li style="margin-top: 14px;margin-left: 8px;"> <a href="logout2.php"><i class='bx bx-log-out' > </i></a></li>
               </ul>
               
          </div>
    </div>
    <center>
      <h1>Add Student</h1>
<!-- Error or Success Message printint started -->
<div class="message">
        <?php if(isset($success_msg)) echo $success_msg; if(isset($error_msg)) echo $error_msg; ?>
</div>
<!-- Error or Success Message printint ended -->

<!-- Content, Tables, Forms, Texts, Images started -->
<div class="content">

  
  <div class="row" id="student">



      <form method="post" class="form-horizontal col-md-6 col-md-offset-3" id="student">
      <h4>Add Student's Information</h4>
      <div class="form-group">
         
          <div class="col-sm-7">
            <input type="reg" name="st_id"  class="form-control" id="input1" placeholder="student reg. no." / required>
          </div>
      </div>

      <div class="form-group">

          <div class="col-sm-7">
            <input type="reg" name="st_name"  class="form-control" id="input1" placeholder="student full name" / required>
          </div>
      </div>

      <div class="form-group">
      
          <div class="col-sm-7">
            <input type="reg" name="st_dept"  class="form-control" id="input1" placeholder="department ex. CSE" / required>
          </div>
      </div>

      <div class="form-group">
        
          <div class="col-sm-7">
            <input type="reg" name="st_batch"  class="form-control" id="input1" placeholder="batch e.x 2020" / required>
          </div>
      </div>

      <div class="form-group">
  
          <div class="col-sm-7">
            <input type="reg" name="st_sem"  class="form-control" id="input1" placeholder="semester ex. Fall-15" / required>
          </div>
      </div>

      <div class="form-group">
          
          <div class="col-sm-7">
            <input type="mail" name="st_email"  class="form-control" id="input1" placeholder="valid email" / required>
          </div>
      </div>


      <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Add Student" name="std" / id="student_button">
    </form>

  </div>
<br><br><br>
 


</div><br>
<!-- Contents, Tables, Forms, Images ended -->

</center>

    



</header>


    <!-- Menus started-->
   
    <!-- Menus ended -->


<script type="text/javascript">
  let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});

</script>

</body>
<!-- Body ended  -->
</html>
