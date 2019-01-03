<?



  if (empty($_GET['Quantity'])) {
    $Quantity = 10;
  }else {
    $Quantity = $_GET['Quantity'];
  }

  if (empty($_GET['StartDate'])) {
    $StartDate = date("Y-m-d");
  }else {
    $StartDate = $_GET['StartDate'];
  }

  if (empty($_GET['EndDate'])) {
    $EndDate = "";
  }else {
    $EndDate = $_GET['EndDate'];
  }

  if (empty($_GET['Status'])) {
      $Status = "Pending";
  }else {
      $Status = $_GET['Status'];
  }


  if($Status == "ALL"){
    if($EndDate == "" ){
      $sql2 = 	"SELECT * FROM reservation WHERE reservationDate LIKE '%$StartDate%' ORDER BY reservationDate ASC LIMIT $Quantity ";
    }else {
      $sql2 = 	"SELECT * FROM reservation WHERE reservationDate BETWEEN '$StartDate' AND '$EndDate' ORDER BY reservationDate ASC LIMIT $Quantity ";
    }
  }else {
    if($EndDate == "" ){
      $sql2 = 	"SELECT * FROM reservation WHERE status = '$Status'  AND reservationDate LIKE '%$StartDate%' ORDER BY reservationDate ASC LIMIT $Quantity ";
    }else {
      $sql2 = 	"SELECT * FROM reservation WHERE status = '$Status'  AND reservationDate BETWEEN '$StartDate' AND '$EndDate' ORDER BY reservationDate ASC LIMIT $Quantity ";
    }
  }

  //echo "sql2".$sql2."</br>";

  $result2 = mysqli_query($db,$sql2);
  $havereservation= "false";
  $data = array();
  $count = 1;
  $Time = date("H:i:s");
  echo "<tbody>";
  while($row = mysqli_fetch_array($result2)) {

    // $datearr = mb_split("\s",$row['reservationDate']);
    //
    // $datearr1 = mb_split(":",$datearr[1]);
    // $data_hour= $datearr1[0];
    // $data_min= $datearr1[1];
    // $data_Time  = $data_hour*60 + $data_min;




    if($Status=="Pending"){
      $date =  mb_split("\s",$row['reservationDate']);
      echo "<tr>";
      echo "<td align=\"center\">".$date[1]."</td>";
      echo "<td align=\"center\">".$row['name']."</td>";
      echo "<td align=\"center\">".$row['phone']."</td>";
      if($row['firstCome'] == "true"){
        echo "<td align=\"center\">V</td>";
      }else {
        echo "<td align=\"center\"></td>";
      }
      echo "<td align=\"center\">".$row['item']."</td>";



      // echo "<td align=\"center\"><a href=\"https://www.google.com.tw/\"><img src=\"images/onsite.png\" width=\"50px\" height=\"50p\"></a></td>";
      // echo "<td align=\"center\"><a href=\"https://www.google.com.tw/\"><img src=\"images/update.png\" width=\"50px\" height=\"50p\"></a></td>";
      // echo "<td align=\"center\"><a href=\"https://www.google.com.tw/\"><img src=\"images/delete.png\" width=\"50px\" height=\"50p\"></a></td>";
      echo "</tr>";
    }




    if($Status == "Onsite"){
      $date =  mb_split("\s",$row['SigninTime']);
      $time1 = (strtotime($date[1]));
      $time2 = (strtotime($Time));
      $m = ($time2 - $time1)/(60);
      $m = (int)($m);
      if($m>=60){
        $m = $m%60;
      }
      if($m<10){
        $m = "0".$m;
      }
      $h = ($time2 - $time1)/(3600);
      $h = (int)($h);
      if($h<10){
        $h = "0".$h;
      }

      echo "<tr>";
      echo "<td align=\"center\">".$row['name']."</td>";
      echo "<td align=\"center\">"."諮詢"."</td>";
      echo "<td align=\"center\">". $h.":". $m."</td>";
      echo "</tr>";
    }

    // $data[0] = array ("APIstatus"=>"有預約資料","Time"=>"$Time");
    // $data[$count] = array ("Status"=>$row['status'],"reservationDate"=>$row['reservationDate'],"phone"=>$row['phone'],"name"=>$row['name'],"creatDate"=>$row['creatDate']);
    $havereservation = "true";
    // $count++;
    //echo "Id".$row1['Id']."</br>";
    //   echo "姓名:".$row['id']." 學號:".$row['TeamName']."</br>";
  }

  //echo "havereservation".$havereservation."</br>";
  if($havereservation == "false"){
    //$data[0] = array ("APIstatus"=>"無預約資料","Time"=>"$Time");
    if($Status == "Pending"){
      echo "<tr><td colspan=\"4\" align=\"center\">目前無預約資料</td></tr>";
    }
    if($Status == "Onsite"){
      echo "<tr><td colspan=\"3\" align=\"center\">目前現場客人</td></tr>";
    }

  }

  echo "</tbody>";
  //
  // $json = json_encode($data);
  // echo "$json";
?>
