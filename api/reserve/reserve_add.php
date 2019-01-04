<?

    include("config.php");
    date_default_timezone_set('Asia/Taipei');
    header("Content-Type:text/html; charest=utf-8");


    $is_frist="true";
    $is_have_reserve ="false";
    $Time = $datetime= date("Y-m-d H:i:s");
    if (empty($_GET['phone'])) {
      $phone = "";
      echo "未輸入電話號碼,";
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
      echo "未輸入姓名,";
    }else {
      $name = $_GET['name'];
    }

    if (empty($_GET['item'])) {
      $item = "";
      echo "未輸入預約項目,";
    }else {
      if($_GET['item'] == "杏仁酸" || $_GET['item'] == "美白針/電波" || $_GET['item'] == "微整型" || $_GET['item'] == "除毛" ){
        $item = $_GET['item'];
      }else {
        $item = "";
        echo "項目輸入錯誤,"."<br/>";
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


    if($phone!="" && $name!="" && $item!="" && $reservationDate!=""){
      $member_count = 0;
      $sql = 	"SELECT * FROM member WHERE phone = $phone";
      $result = mysqli_query($db,$sql);
      while($row = mysqli_fetch_array($result)) {
        $member_count++;
        if($row['birthday']!=""){
          $is_frist = "false";
        }

      }
      // echo "Time".$Time."<br/>";
      // echo "reservationDate".$reservationDate."<br/>";

      $time1 = (strtotime($Time));
      $time2 = (strtotime($reservationDate));
      // echo "time1".$time1."<br/>,time2".$time2;
      if($time1<$time2){
        $sql2 = 	"SELECT * FROM reservation WHERE phone = '$phone' ";
        $result2 = mysqli_query($db,$sql2);
        while($row2 = mysqli_fetch_array($result2)) {
          switch ($row2['status']) {
            case 'Pending':
              $is_have_reserve="true";
              $id = $row2['id'];
              $sql3 = "UPDATE reservation SET reservationDate = '$reservationDate',item = '$item' WHERE id = '$id'";
              //echo "sql:".$sql3;
              mysqli_query($db,$sql3)or die ("無法新增".mysql_error()); //執行sql語法
              echo "修改預約成功,";
              // code...
              break;
            case 'Onsite':
              $is_have_reserve="true";
              echo "此客人再進行療程不得修改預約,";
                // code...
              break;
          }
        }

        if($is_have_reserve=="false"){
          $sql = "INSERT INTO reservation (Id,creatDate,SigninTime,reservationDate,status,phone,name,item,firstCome) VALUES (Null,'$Time','','$reservationDate','Pending','$phone','$name','$item','$is_frist')";
          mysqli_query($db,$sql)or die ("無法新增".mysql_error()); //執行sql語法
          echo "新增預約成功,";
        }

        if($member_count=="0"){
          $sql = "INSERT INTO member (Id,name,birthday,phone) VALUES (Null,'$name','','$phone')";
          mysqli_query($db,$sql)or die ("無法新增".mysql_error()); //執行sql語法
          echo "新增會員成功";
        }
      }else {
        echo "預約時間不能是過去的時間";
      }
    }






?>
