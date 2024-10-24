<?php

session_start();

// 로그인 확인
if (!isset($_SESSION['username'])) {
    // 로그인이 안 되어 있으면 login.php로 리다이렉트
    header("Location: login.php");
    exit();
}

include 'db.php';

// 할 일 추가 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO todos (task) VALUES (:task)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['task' => $task]);
    header("Location: todo.php");
    exit;
}

// 할 일 완료 처리
if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    $sql = "UPDATE todos SET status = 'completed' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    header("Location: todo.php");
    exit;
}

// 할 일 삭제 처리
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM todos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    header("Location: todo.php");
    exit;
}

// 필터링 조건에 따른 할 일 목록 불러오기
$statusFilter = $_GET['filter'] ?? 'all';
if ($statusFilter == 'completed') {
    $sql = "SELECT * FROM todos WHERE status = 'completed'";
} elseif ($statusFilter == 'pending') {
    $sql = "SELECT * FROM todos WHERE status = 'pending'";
} else {
    $sql = "SELECT * FROM todos";
}
$stmt = $pdo->query($sql);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superduper To do list</title>

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center"><?php echo $_SESSION['username']; ?>'s To do list</h1>
        <!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MI MI MI MI</title>
    <style>
        body {
            font-family: monospace;
            background-color: #000; /* 검정 배경 */
            color: #00ff00; /* 글자를 초록색으로 변경 */
            text-align: center;
            padding-top: 50px;
        }
        pre {
            font-size: 16px;
            color: #FFFFFF; /* 글자가 여전히 흰색으로 보이도록 설정 */
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>

    
</head>
<body>
    <pre>
 __    __     __     __    __     __        ______   ______        _____     ______       
/\ "-./  \   /\ \   /\ "-./  \   /\ \      /\__  _\ /\  __ \      /\  __-.  /\  __ \      
\ \ \-./\ \  \ \ \  \ \ \-./\ \  \ \ \     \/_/\ \/ \ \ \/\ \     \ \ \/\ \ \ \ \/\ \     
 \ \_\ \ \_\  \ \_\  \ \_\ \ \_\  \ \_\       \ \_\  \ \_____\     \ \____-  \ \_____\    
    \/_/  \/_/   \/_/   \/_/  \/_/   \/_/        \/_/   \/_____/      \/____/   \/_____/      

    </pre>
</body>
</html>

        <!-- 오른쪽 상단 로그아웃 버튼 -->
        <div class="logout-btn">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- 할 일 추가 폼 -->
        <form method="POST" action="todo.php" class="form-inline justify-content-center mb-4">
            <div class="form-group">
                <input type="text" name="task" class="form-control" required placeholder="Today's Task">
            </div>
            <button type="submit" class="btn btn-primary ml-2">Add</button>
        </form>

        <!-- 필터링 버튼 -->
        <div class="text-center mb-4">
            <a href="todo.php?filter=all" class="btn btn-secondary">Today</a>
            <a href="todo.php?filter=pending" class="btn btn-warning">In progress</a>
            <a href="todo.php?filter=completed" class="btn btn-success">Finish</a>
        </div>

        <ul class="list-group mx-auto" style="max-width: 500px;">
            <?php foreach ($tasks as $task): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php if ($task['status'] == 'completed'): ?>
                        <strike><?php echo htmlspecialchars($task['task']); ?></strike>
                    <?php else: ?>
                        <?php echo htmlspecialchars($task['task']); ?>
                    <?php endif; ?>
                    <div>
                        <?php if ($task['status'] != 'completed'): ?>
                            <a href="?complete=<?php echo $task['id']; ?>" class="btn btn-sm btn-success">
                                <i class="fas fa-check"></i> Finish
                            </a>
                        <?php endif; ?>
                        <a href="?delete=<?php echo $task['id']; ?>" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
