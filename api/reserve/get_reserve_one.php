<?

  include("config.php");
  date_default_timezone_set('Asia/Taipei');
  header("Content-Type:text/html; charest=utf-8");

  if (empty($_GET['phone'])) {
    $phone = "";
    echo "請輸入查詢電話號碼,";
  }else {
    if(strlen( $_GET['phone'] )!=10){
      $phone = "";
      echo "電話號碼輸入錯誤,";
    }else {
      $phone = $_GET['phone'];
    }
  }


  if($phone!=""){
    $haveReserve = "false";
    $data = array();
    $Time = date("H:i:s");
    $sql = 	"SELECT * FROM reservation WHERE phone = '$phone' AND status = 'Pending'";
    $result = mysqli_query($db,$sql);
    while($row = mysqli_fetch_array($result)) {
        $haveReserve = "true";
        $data[0] = array ("APIstatus"=>"有預約資料","phone"=>$row['phone'],"Status"=>$row['status'],"item"=>$row['item'],"reservationDate"=>$row['reservationDate'],"phone"=>$row['phone'],"name"=>$row['name'],"firstCome"=>$row['firstCome'],"creatDate"=>$row['creatDate']);
    }
    if($haveReserve == "false"){
        $data[0] = array ("APIstatus"=>"此電話無預約資料","phone"=>$phone,"Status"=>"","item"=>"","reservationDate"=>"","name"=>"","firstCome"=>"","creatDate"=>"");
    }


    $json = json_encode($data);
    echo "$json";
  }


?>
