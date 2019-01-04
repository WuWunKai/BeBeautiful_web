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
    $haveMember = "false";
    $data = array();
    $sql = 	"SELECT * FROM member WHERE phone = '$phone'";
    $result = mysqli_query($db,$sql);
    while($row = mysqli_fetch_array($result)) {
        $haveMember = "true";
        $data[0] = array ("APIstatus"=>"有會員資料","name"=>$row['name'],"birthday"=>$row['birthday'],"phone"=>$row['phone'],"id_number"=>$row['id_number'],"gender"=>$row['gender'],"Email"=>$row['Email'],"address"=>$row['address'],"drug"=>$row['drug'],"updateTime"=>$row['updateTime']);
    }
    if($haveMember == "false"){
        $data[0] = array ("APIstatus"=>"查無會員資料","phone"=>$phone,"name"=>"","birthday"=>"","id_number"=>"","gender"=>"","Email"=>"","address"=>"","drug"=>"","updateTime"=>"");

    }


    $json = json_encode($data);
    echo "$json";
  }

?>
