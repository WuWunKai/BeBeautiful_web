<?

include("config.php");
  date_default_timezone_set('Asia/Taipei');
  header("Content-Type:text/html; charest=utf-8");
    $Time = $datetime= date("Y-m-d H:i:s");
    if (empty($_GET['phone'])) {
      echo "未提供電話號碼";
    }else {
      $phone = $_GET['phone'];
    }

    $sql = "UPDATE reservation SET status = 'Onsite',SigninTime = '$Time' WHERE phone = '$phone'";
    // mysqli_query($db,$sql)or die ("無法新增".mysql_error()); //執行sql語法
    if(mysqli_query($db,$sql)){
      echo "已簽到";
    }else {
      echo "無法新增".mysql_error();
    }




?>
