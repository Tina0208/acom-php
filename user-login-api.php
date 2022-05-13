<?php
require __DIR__ . '/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '帳號或密碼錯誤',
    'account' => $_POST['account'],
];

$account = $_POST['account'];
$password = $_POST['password'];

if (empty($account) or empty($password)) {
    $output['error'] = '欄位資料不足';
    echo json_encode($output);
    exit();
}

$userSql = sprintf("SELECT * from `user` WHERE `account` = '%s'", $account);
$user = $pdo->query($userSql)->fetch();

if (empty(user)) {
    echo json_encode($output);
    exit();
}

if ($password == $user['password']) {
    $output['success'] = true;
    $output['error'] = '登入成功';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>
