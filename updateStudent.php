<?php
session_start();
include('db_conn.php');

// Initialize variables
$success_msg = '';
$error_msg = '';
$student = null;

// Handle the search for a student
if (isset($_POST['search'])) {
  $st_id = $_POST['st_id'];
  $st_name = $_POST['st_name'];

  // Fetch the current data of the student
  $query = "SELECT * FROM students WHERE st_id = ? AND st_name = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ss", $st_id, $st_name);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if the student exists
  if ($result->num_rows > 0) {
    // Fetch the student's data
    $student = $result->fetch_assoc();
  } else {
    $error_msg = "Student not found.";
  }
}

// Handle the update form submission
if (isset($_POST['update'])) {
  $st_id = $_POST['st_id'];
  $name = $_POST['st_name'];
  $dept = $_POST['st_dept'];
  $batch = $_POST['st_batch'];
  $sem = $_POST['st_sem'];
  $email = $_POST['st_email'];

  // Update the student data in the database
  $update_query = "UPDATE students SET st_name = ?, st_dept = ?, st_batch = ?, st_sem = ?, st_email = ? WHERE st_id = ?";
  $update_stmt = $conn->prepare($update_query);
  $update_stmt->bind_param("ssisss", $name, $dept, $batch, $sem, $email, $st_id);

  if ($update_stmt->execute()) {
    $success_msg = "Student updated successfully!";
    // Clear student data after successful update
    $student = null;
  } else {
    $error_msg = "Error updating student.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Update Student</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <style>
    /* Google Fonts Import Link */
    /* Google Fonts Import Link */
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

    body {
      background: powderblue;
    }

    .sidebar {
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

    .sidebar.close {
      width: 78px;
    }

    .sidebar .logo-details {
      height: 60px;
      width: 100%;
      display: flex;
      align-items: center;
    }

    .sidebar .logo-details i {
      font-size: 30px;
      color: #fff;
      height: 50px;
      min-width: 78px;
      text-align: center;
      line-height: 50px;
    }

    .sidebar .logo-details .logo_name {
      font-size: 22px;
      color: #fff;
      font-weight: 600;
      transition: 0.3s ease;
      transition-delay: 0.1s;
      margin-left: 0px;
    }

    .sidebar.close .logo-details .logo_name {
      transition-delay: 0s;
      opacity: 0;
      pointer-events: none;
    }

    .sidebar .nav-links {
      height: 100%;
      padding: 30px 0 150px 0;
      overflow: auto;
    }

    .sidebar.close .nav-links {
      overflow: visible;
    }

    .sidebar .nav-links::-webkit-scrollbar {
      display: none;
    }

    .sidebar .nav-links li {
      position: relative;
      list-style: none;
      transition: all 0.4s ease;
    }

    .sidebar .nav-links li:hover {
      background: #1d1b31;
    }

    .sidebar .nav-links li .iocn-link {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .sidebar.close .nav-links li .iocn-link {
      display: block
    }

    .sidebar .nav-links li i {
      height: 50px;
      min-width: 78px;
      text-align: center;
      line-height: 50px;
      color: #fff;
      font-size: 20px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .sidebar .nav-links li.showMenu i.arrow {
      transform: rotate(-180deg);
    }

    .sidebar.close .nav-links i.arrow {
      display: none;
    }

    .sidebar .nav-links li a {
      display: flex;
      align-items: center;
      text-decoration: none;
    }

    .sidebar .nav-links li a .link_name {
      font-size: 18px;
      font-weight: 400;
      color: #fff;
      transition: all 0.4s ease;
    }

    .sidebar.close .nav-links li a .link_name {
      opacity: 0;
      pointer-events: none;
    }

    .sidebar .nav-links li .sub-menu {
      padding: 6px 6px 14px 80px;
      margin-top: -10px;
      background: #1d1b31;
      display: none;
    }

    .sidebar .nav-links li.showMenu .sub-menu {
      display: block;
    }

    .sidebar .nav-links li .sub-menu a {
      color: #fff;
      font-size: 15px;
      padding: 5px 0;
      white-space: nowrap;
      opacity: 0.6;
      transition: all 0.3s ease;
    }

    .sidebar .nav-links li .sub-menu a:hover {
      opacity: 1;
    }

    .sidebar.close .nav-links li .sub-menu {
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

    .sidebar.close .nav-links li:hover .sub-menu {
      top: 0;
      opacity: 1;
      pointer-events: auto;
      transition: all 0.4s ease;
    }

    .sidebar .nav-links li .sub-menu .link_name {
      display: none;
    }

    .sidebar.close .nav-links li .sub-menu .link_name {
      font-size: 18px;
      opacity: 1;
      display: block;
    }

    .sidebar .nav-links li .sub-menu.blank {
      opacity: 1;
      pointer-events: auto;
      padding: 3px 20px 6px 16px;
      opacity: 0;
      pointer-events: none;
    }

    .sidebar .nav-links li:hover .sub-menu.blank {
      top: 50%;
      transform: translateY(-50%);
    }

    .sidebar .profile-details {
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

    .sidebar.close .profile-details {
      background: none;
    }

    .sidebar.close .profile-details {
      width: 78px;
    }

    .sidebar .profile-details .profile-content {
      display: flex;
      align-items: center;
    }

    .sidebar .profile-details img {
      height: 20px;
      width: 20px;
      object-fit: cover;
      border-radius: 16px;
      margin: 0 14px 0 12px;
      background: #1d1b31;
      transition: all 0.5s ease;
    }

    .sidebar.close .profile-details img {
      padding: 10px;
    }

    .sidebar .profile-details .profile_name,
    .sidebar .profile-details .job {
      color: #fff;
      font-size: 18px;
      font-weight: 500;
      white-space: nowrap;
    }

    .sidebar.close .profile-details i,
    .sidebar.close .profile-details .profile_name,
    .sidebar.close .profile-details .job {
      display: none;
    }

    .sidebar .profile-details .job {
      font-size: 12px;
    }

    .home-section {
      position: relative;
      height: 100vh;
      left: 260px;
      width: calc(100% - 260px);
      transition: all 0.5s ease;
    }

    .sidebar.close~.home-section {
      left: 78px;
      width: calc(100% - 78px);
    }

    .home-section .home-content {
      height: 60px;
      display: flex;
      align-items: center;
    }

    .home-section .home-content .bx-menu,
    .home-section .home-content .text {
      color: #11101d;
      font-size: 35px;
    }

    .home-section .home-content .bx-menu {
      margin: 0 15px;
      cursor: pointer;
    }

    .home-section .home-content .text {
      font-size: 26px;
      font-weight: 600;
    }

    @media (max-width: 420px) {
      .sidebar.close .nav-links li .sub-menu {
        display: none;
      }
    }

    /* Form Styles */
    .container {
      max-width: 600px;
      margin: 30px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #11101d;
    }

    .form-horizontal {
      display: flex;
      flex-direction: column;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      margin-bottom: 5px;
      font-weight: 500;
      color: #11101d;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="email"],
    .form-group input[type="submit"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="number"]:focus,
    .form-group input[type="email"]:focus {
      border-color: #007bff;
      outline: none;
    }

    .form-group input[type="submit"] {
      background-color: #007bff;
      color: #ffffff;
      cursor: pointer;
      border: none;
      transition: background-color 0.3s ease;
    }

    .form-group input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .alert {
      padding: 10px;
      border-radius: 4px;
      margin-bottom: 20px;
      color: #fff;
    }

    .alert-success {
      background-color: #28a745;
    }

    .alert-danger {
      background-color: #dc3545;
    }
  </style>
  <!-- Sidebar -->
  <div class="sidebar close">
    <div class="logo-details">
      <i class="fa fa-graduation-cap" aria-hidden="true"></i>
      <span class="logo_name">Student</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="homePage.php">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Home</span>
        </a>
      </li>
      <li>
        <a href="addStudentDetails.php">
          <i class="fa fa-plus" aria-hidden="true"></i>
          <span class="link_name">Add User</span>
        </a>
      </li>
      <li>
        <a href="students.php">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span class="link_name">Students</span>
        </a>
      </li>
      <li>
        <div class="iocn-link">
          <a href="updateStudent.php">
            <i class="fa-sharp fa-solid fa-square-pen" aria-hidden="true" style="color: white;"></i>

            <!-- <i class=" fa-pen-to-square" aria-hidden="true"></i> -->
            <!-- <i class="fas fa-edit" aria-hidden="true"></i> -->

            <span class="link_name">Update Student</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Update Student</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="deleteStudent.php">
            <i class="fa fa-trash" aria-hidden="true"></i>

            <span class="link_name">Remove Student</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Remove Student</a></li>
        </ul>
      </li>


    </ul>
  </div>

  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <p>Update Student</p>
      <div class="profile">
        <ul style="list-style:none; display: inline-flex; margin-left: auto;">
          <li style="margin-top: 12px; margin-left: 10px;">
            <h4><?php echo $_SESSION['user_name']; ?></h4>
          </li>
          <li style="margin-top: 14px; margin-left: 8px;">
            <a href="logout.php"><i class='bx bx-log-out'></i></a>
          </li>
        </ul>
      </div>
    </div>

    <div class="container">
      <h2>Update Student</h2>

      <?php if ($success_msg)
        echo "<div class='alert alert-success'>$success_msg</div>"; ?>
      <?php if ($error_msg)
        echo "<div class='alert alert-danger'>$error_msg</div>"; ?>

      <!-- Form to search for student -->
      <form method="post" class="form-horizontal">
        <div class="form-group">
          <label for="st_id">Student ID</label>
          <input type="text" name="st_id" required>
        </div>
        <div class="form-group">
          <label for="st_name">Student Name</label>
          <input type="text" name="st_name" required>
        </div>
        <div class="form-group">
          <input type="submit" value="Search" name="search">
        </div>
      </form>

      <!-- Form to update student details -->
      <?php if ($student): ?>
        <form method="post" class="form-horizontal">
          <input type="hidden" name="st_id" value="<?php echo $student['st_id']; ?>">
          <div class="form-group">
            <label for="st_name">Name</label>
            <input type="text" name="st_name" value="<?php echo $student['st_name']; ?>" required>
          </div>
          <div class="form-group">
            <label for="st_dept">Department</label>
            <input type="text" name="st_dept" value="<?php echo $student['st_dept']; ?>" required>
          </div>
          <div class="form-group">
            <label for="st_batch">Batch</label>
            <input type="number" name="st_batch" value="<?php echo $student['st_batch']; ?>" required>
          </div>
          <div class="form-group">
            <label for="st_sem">Semester</label>
            <input type="number" name="st_sem" value="<?php echo $student['st_sem']; ?>" required>
          </div>
          <div class="form-group">
            <label for="st_email">Email</label>
            <input type="email" name="st_email" value="<?php echo $student['st_email']; ?>" required>
          </div>
          <div class="form-group">
            <input type="submit" value="Update" name="update">
            <a href="updateStudent.php">Cancel</a>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </section>

  <script type="text/javascript">
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
      arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; // selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
      });
    }

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    sidebarBtn.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });
  </script>

</body>

</html>