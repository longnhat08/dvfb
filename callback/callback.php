<?php
require_once('../config.php');
error_reporting(0);
if ( isset($_GET['content']) && isset($_GET['status']) )
{
    $code = check_string($_GET['content']);
    $card = $ketnoi->query("SELECT * FROM cards WHERE code = '$code' ")->fetch_array();
    if ($_GET['status'] == 'hoantat')
    {
        $thucnhan = $_GET['menhgiathuc'] - $_GET['menhgiathuc'] * $chiet_khau_the / 100;
        $ketnoi->query("UPDATE cards SET `status` = 'thanhcong' WHERE `status` = 'xuly' AND `code` = '".$code."'");
        $ketnoi->query("UPDATE users SET `money` = `money` + '$thucnhan', `total_nap` = `total_nap` + '$thucnhan' WHERE `username` = '".$card['username']."' ");
    }
    else if ($_GET['status'] == 'thatbai')
    {
        $ketnoi->query("UPDATE cards SET status = 'thatbai' WHERE status = 'xuly' AND code = '".$code."'");
    }
}
else
{   
    echo json_encode(array('status' => "error", 'msg' => "Cái quát đờ phắc gì vậy?"));
}
?>