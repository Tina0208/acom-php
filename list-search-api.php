<?php
require __DIR__ . '/__connect_db.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$pageClicked = $data['clickedPage'];
$word = $data['word'];

$perPage = 50;
$totalListSql = sprintf(
    "SELECT COUNT(1) FROM `acom-db` WHERE `ip_src` LIKE '%%%s%%' OR `dns_qry_name` LIKE '%%%s%%' ORDER BY `time_epoch` ASC",
    $word,
    $word
);
$totalList = intval($pdo->query($totalListSql)->fetch(PDO::FETCH_NUM)[0]);
$totalPage = ceil($totalList / $perPage);
$nowPage = $pageClicked ? $perPage * ($pageClicked - 1) : 0;

$searchSql = sprintf(
    "SELECT * FROM `acom-db` WHERE `ip_src` LIKE '%%%s%%' OR `dns_qry_name` LIKE '%%%s%%' ORDER BY `time_epoch` ASC LIMIT %s, %s",
    $word,
    $word,
    $nowPage,
    50
);

$search = $pdo->query($searchSql)->fetchAll();

$output = [
    'totalList' => $totalList,
    'word' => $word,
    'pageClicked' => $pageClicked,
    'totalPage' => $totalPage,
    'search' => $search,
];

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>
