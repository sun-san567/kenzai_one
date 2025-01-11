<?php
session_start();
include('/Applications/XAMPP/xamppfiles/htdocs/WorkSpace/kenzai_one_pj_data/functions.php');
// POSTデータの取得

// POSTデータの取得
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// 入力値の検証
if (empty($email) || empty($password)) {
    echo "<p>メールアドレスとパスワードを入力してください</p>";
    echo "<a href='login.php'>ログイン画面へ</a>";
    exit();
}


$pdo = connect_to_db();
// emailとdeleted_atで認証可能なユーザーを検索
$sql = 'SELECT * FROM auth_credentials WHERE email = :email AND deleted_at IS NULL';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
// パスワードのバインドを削除（WHERE句で使用していないため）


try {
    $status = $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// ユーザーが存在し、パスワードが一致する場合
if ($user && $user['password'] === $password) {
    $_SESSION = array();
    $_SESSION['session_id'] = session_id();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    header("Location: ../home.php");  // 親ディレクトリのhome.phpを参照
    exit();
} else {
    echo "<p>メールアドレスまたはパスワードが間違っています</p>";
    echo "<a href='login.php'>ログイン画面へ</a>";
    exit();
}



// // POSTでない場合はここまで実行される
// var_dump("GETリクエスト確認");
