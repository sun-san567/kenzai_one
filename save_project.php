<?php

$client_name = $_POST['client_name'];
$project_name = $_POST['project_name'];
$deadline = $_POST['deadline'];
$proposal_amount = $_POST['proposal_amount'];

// 各種項目設定
$dbn ='mysql:dbname=pj_data;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
    $pdo = new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }

// SQL作成&実行
$sql = 'INSERT INTO pj_data_detail (id, client_name, project_name, deadline, proposal_amount, created_at, updated_at) VALUES (NULL, :client_name, :project_name, :deadline, :proposal_amount, now(), now())';
$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':client_name', $client_name, PDO::PARAM_STR);
$stmt->bindValue(':project_name', $project_name, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':proposal_amount', $proposal_amount, PDO::PARAM_INT);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:home.php');
exit();