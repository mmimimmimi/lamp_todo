<?php
session_start();
session_unset(); // 모든 세션 변수 제거
session_destroy(); // 세션 자체를 삭제

// 로그인 페이지로 리다이렉트
header("Location: index.php");
exit();
?>
