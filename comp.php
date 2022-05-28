<?php
if (file_exists("lib.php")) {
  include_once("lib.php");
} else {
  echo json_encode(array("error" => "lib.php not found !"));
}

//deafult time zone
date_default_timezone_set('Asia/Tashkent');

$time = date("H:i:s");
$time = strtotime($time);
$db = new Mylib();

$key = ""; // secret key merchant.click.uz/home/service orqali olinadi
$prepare = ""; // userid merchant.click.uz/home/service orqali olinadi


if ($_POST['action'] == 1 and $_SERVER['REMOTE_ADDR'] == "83.221.178.214") {
  $click_trans = $_POST['click_trans_id'];
  $merchant_trans_id = $_POST['merchant_trans_id'];
  $amount = $_POST['amount'];
  $sign_time = $_POST['sign_time'];
  $service_id = $_POST['service_id'];
  $action = $_POST['action'];
  $error = $_POST['error'];
  $merchant_prepare_id = $_POST['merchant_prepare_id'];
  $md5 = md5($click_trans . $service_id . $key . $merchant_trans_id . $merchant_prepare_id . $amount . $action . $sign_time);
  $db->insert("click_uz", ['click_trans_id' => $click_trans, 'merchant_trans_id' => $merchant_trans_id, 'amount' => $amount, 'sign_time' => $sign_time, 'situation' => $error, 'status' => "success"]);


  //merchant_trans_id orqali pul tushishi kerak bo'lgan foydalanuvchi id raqami yoki logini keladi
  $check_user = $db->select("users", ["id" => $merchant_trans_id]);
  $row = mysqli_fetch_assoc($check_user);

  if (strlen($row['id']) > 0) {
    if ($error == 0) {

      $db->update("users", ['balans' => $row['balans'] + $amount], ['id' => $merchant_trans_id]);
      $db->update("click_uz", ['situation' => 1], ['click_trans_id' => $click_trans]);

      
      $array = array(
        'click_trans_id' => $click_trans,
        'merchant_trans_id' => $merchant_trans_id,
        'merchant_prepare_id' => $prepare,
        'error' => 0,
        'error_note' => $_POST['error_note']
      );
      echo json_encode($array);
    }
  } else {
    $array = array(
      'click_trans_id' => $click_trans,
      'merchant_trans_id' => $merchant_trans_id,
      'merchant_prepare_id' => $prepare,
      'error' => -9,
      'error_note' => "Do not find a user!!\n\ncreated by dadabayev.uz"
    );
    echo json_encode($array);
  }
} else {
  echo json_encode(["error" => "Ushbu url faqat clickuz uchun!\n\ncreated by dadabayev.uz"]);
}
