<?php
// MySQL 연결 설정
$servername = "localhost";
$username = "admin";
$password = "password123";  // MySQL root 비밀번호
$dbname = "login_system"; 

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 회원가입 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // 비밀번호 해시
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 사용자 정보 저장
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Registration successful!');
        window.location.href = 'index.php'; // 로그인 페이지로 리다이렉트
      </script>";
        }
     else {
        $error_message = $conn->error;
        echo "<script>
                alert('Error: $error_message');
              </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <!-- 검은색 테마 및 CSS 스타일 적용 -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1c1c1c;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .signup-container {
            background-color: #333;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 300px;
        }
        h1 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #444;
            border-radius: 4px;
            font-size: 16px;
            background-color: #2a2a2a;
            color: #fff;
        }
        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            width: 100%;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>Sign up</h1>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="USER ID" required><br>
            <input type="password" name="password" placeholder="PASSWORD" required><br>
            <input type="email" name="email" placeholder="E-mail" required><br>
            <button type="submit">Sign up</button>
        </form>
    </div>
</body>
</html>
