<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
</head>
<body>
   <?php
$servername = "localhost";
$username = "admin";
$password = "password123";  // MySQL root 비밀번호
$dbname = "login_system"; 
   // MySQL 연결
   $conn = new mysqli($servername, $username, $password, $dbname);
   
   // 연결 오류 확인
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
      //login.php에서 입력받은 id, password
      $username = $_POST['id'];
      $password = $_POST['pw'];
      session_start();

      
      $conn = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
      $result = $mysqli->query($conn);
      $row = $result->fetch_array(MYSQLI_ASSOC);
      
      //결과가 존재하면 세션 생성
      if ($row != null) {
         $_SESSION['username'] = $row['id'];
         $_SESSION['name'] = $row['name'];
         echo "<script>location.replace('index.php');</script>";
         exit;
      }
      
      //결과가 존재하지 않으면 로그인 실패
      if($row == null){
         echo "<script>alert('Invalid username or password')</script>";
         echo "<script>location.replace('login_.php');</script>";
         exit;
      }
      ?>
   </body>