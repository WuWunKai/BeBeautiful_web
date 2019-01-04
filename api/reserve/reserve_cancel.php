<?
  include("config.php");
  date_default_timezone_set('Asia/Taipei');
  header("Content-Type:text/html; charest=utf-8");

  if (empty($_GET['phone'])) {
    $phone = "";
    echo "未輸入刪除電話號碼,";
  }else {
    if(strlen( $_GET['phone'] )!=10){
      $phone = "";
      echo "電話號碼輸入錯誤,";
    }else {
      $phone = $_GET['phone'];
    }
  }

  $haveReserve = "false";

  $sql = 	"SELECT * FROM reservation WHERE phone = '$phone' AND status = 'Pending'";
  $result = mysqli_query($db,$sql);
  while($row = mysqli_fetch_array($result)) {
    $haveReserve = "true";
  }


  //確認有此預約
  if($haveReserve == "true"){
    //修改預約資料
    $sql1 = "DELETE FROM reservation WHERE phone = '$phone' AND status = 'Pending'";
    if(mysqli_query($db,$sql1)){
      echo "已取消預約";
    }else {
      echo "無法新增".mysql_error();
    }
  }else {
    echo "此電話號碼尚未有預約,";
  }

?>
