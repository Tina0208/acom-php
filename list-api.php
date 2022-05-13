<?php
require __DIR__ . '/__connect_db.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$pageClicked = $data['clickedPage'];

$perPage = 50;
$totalListSql = 'SELECT COUNT(1) FROM `acom-db`';
$totalList = $pdo->query($totalListSql)->fetch(PDO::FETCH_NUM)[0];
$totalPage = ceil($totalList / $perPage);
$nowPage = $pageClicked ? $perPage * ($pageClicked - 1) : 0;

$listSql = sprintf(
    'SELECT `sid`, `time_epoch`, `ip_src`, `udp_srcport`, `ip_dst`, `udp_dstport`, `dns_qry_name` FROM `acom-db` ORDER BY `time_epoch` ASC  LIMIT %s, %s',
    $nowPage,
    50
);
$listRows = $pdo->query($listSql)->fetchAll();

$output = [
    'pageClicked' => $pageClicked,
    'totalPage' => $totalPage,
    'data' => $listRows,
];

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>
