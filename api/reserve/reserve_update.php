<?
    include("config.php");
    date_default_timezone_set('Asia/Taipei');
    header("Content-Type:text/html; charest=utf-8");


    $Time = $datetime= date("Y-m-d H:i:s");
    if (empty($_GET['phone'])) {
      $phone = "";
      echo "未輸入修改電話號碼,";
    }else {
      if(strlen( $_GET['phone'] )!=10){
        $phone = "";
        echo "電話號碼輸入錯誤,";
      }else {
        $phone = $_GET['phone'];
      }
    }

    if (empty($_GET['name'])) {
      $name = "";
      //echo "未輸入姓名,";
    }else {
      $name = $_GET['name'];
    }

    if (empty($_GET['item'])) {
      $item = "";
      //echo "未輸入預約項目,";
    }else {
      if($_GET['item'] == "杏仁酸" || $_GET['item'] == "美白針/電波" || $_GET['item'] == "微整型" || $_GET['item'] == "除毛" ){
        $item = $_GET['item'];
      }else {
        $item = "";
        //echo "項目輸入錯誤,"."<br/>";
      }
    }

    if (empty($_GET['reservationDate'])) {
      $reservationDate = "";
      echo "未輸入預約時間,";
    }else {

      if(strlen( $_GET['reservationDate'] )!=16){
        echo "預約時間輸入錯誤,";
        $reservationDate = "";
      }else {
        $reservationDate = $_GET['reservationDate'];
      }
    }

    $time1 = (strtotime($Time));
    $time2 = (strtotime($reservationDate));
    $haveReserve = "false";
    if($time1<$time2){
      if($phone!="" && $reservationDate!=""){

        //若姓名跟項目為空去資料庫搜尋
        if($name == "" || $item == ""){
          $sql = 	"SELECT * FROM reservation WHERE phone = '$phone' AND status = 'Pending'";
          $result = mysqli_query($db,$sql);
          while($row = mysqli_fetch_array($result)) {
            $haveReserve = "true";
            $name = $row['name'];
            $$item = $row['$item'];
          }
        }

        //確認有此預約
        if($haveReserve == "true"){
          //修改預約資料
          $sql1 = "UPDATE reservation SET reservationDate = '$reservationDate',name = '$name',item = '$item' WHERE phone = '$phone' AND status = 'Pending'";
          if(mysqli_query($db,$sql1)){
            echo "已修改完成";
          }else {
            echo "無法新增".mysql_error();
          }
        }else {
          echo "此電話號碼尚未有預約,";
        }


      }
    }else {
      echo "預約時間不能是過去的時間,";
    }






?>
