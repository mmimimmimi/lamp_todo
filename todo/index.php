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

// 로그인 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 사용자 정보 가져오기
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // 비밀번호 검증
        if (password_verify($password, $user['password'])) {
            echo "Login Success!";
            // 세션 시작
            session_start();
            $_SESSION['username'] = $username;
            header("Location: todo.php"); // 로그인 후 할 일 페이지로 리다이렉트
        } else {
            echo 
            "<script>alert('Wrong Password !');</script>";
        }
    } else {
        echo "<script>alert('The username does not exist');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- 검은색 테마 및 CSS 스타일 -->
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
        .login-container {
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
        input[type="text"], input[type="password"] {
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
        .signup-link {
            display: block;
            margin-top: 20px;
            color: #5cb85c;
            text-decoration: none;
        }
        .signup-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>L O G I N </h1>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="USER ID" required><br>
            <input type="password" name="password" placeholder="PASSWORD" required><br>
            <button type="submit">Login</button>
        </form>
        <!-- 회원가입 링크 추가 -->
        <a href="join.php" class="signup-link">Join</a>
    </div>
</body>
</html>
