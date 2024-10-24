<?php
// MySQL 연결 정보
$servername = "localhost";
$username = "admin";
$password = "password123";  // MySQL root 비밀번호
$dbname = "login_system";  // 연결할 데이터베이스

// MySQL 연결 시도
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 오류 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 연결 성공 메시지 출력
echo "Connected successfully to the database";

// 연결 종료
$conn->close();
?>
