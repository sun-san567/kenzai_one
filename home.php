<?php
include('functions.php');
$pdo = connect_to_db();

$sql = 'SELECT * FROM pj_data_detail';
$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
    $output .= "
    <tr>
      <td>{$record["client_name"]}</td>
      <td>{$record["project_name"]}</td>
    </tr>
  ";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>案件登録</title>
    <link rel="stylesheet" href="./css/project-registration.css">
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <div id="main-page">
        <div id="container">
            <div id="header">
                <nav class="menu">
                    <button class="menu-btn" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <ul class="menu-list">
                        <li><a href="<?php echo 'client-registration.php'; ?>">取引先登録</a></li>
                        <li><a href="<?php echo 'client_list.php'; ?>">取引先一覧</a></li>
                    </ul>
                </nav>
            </div>

            <div id="main-contants">
                <div id="modalOverlay" class="modal-overlay" style="display: none;">
                    <div class="modal-content">
                        <h2>新規案件登録</h2>
                        <form id="projectForm" method="post" action="save_project.php">
                            <div class="form-group">
                                <label for="client_name">クライアント名:</label>
                                <input type="text" id="client_name" name="client_name" required>
                            </div>
                            <div class="form-group">
                                <label for="project_name">プロジェクト名:</label>
                                <input type="text" id="project_name" name="project_name" required>
                            </div>
                            <div class="form-group">
                                <label for="deadline">見積期限:</label>
                                <input type="date" id="deadline" name="deadline" required>
                            </div>
                            <div class="form-group">
                                <label for="proposal_amount">提案金額:</label>
                                <input type="number" id="proposal_amount" name="proposal_amount" required>
                            </div>
                            <div class="button-group">
                                <button type="submit" class="btn-save">
                                    <i class="fas fa-save"></i>
                                    保存
                                </button>
                                <button type="button" id="cancelButton" class="btn-cancel">
                                    <i class="fas fa-times"></i>
                                    キャンセル
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button id="showFormButton">新規案件登録</button>
        <!-- モーダルウィンドウ -->


    </div>



    <script src="./js/request.js"></script>
</body>

</html>