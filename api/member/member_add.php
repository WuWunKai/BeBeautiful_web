<?

    include("config.php");
    date_default_timezone_set('Asia/Taipei');
    header("Content-Type:text/html; charest=utf-8");
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

    if (empty($_GET['id_number'])) {
      $id_number = "";
      echo "未輸入身分證字號,";
    }else {
      $id_number = $_GET['id_number'];
    }

    if (empty($_GET['birthday'])) {
      $birthday = "";
      echo "未輸入生日,";
    }else {

      $tmparray = explode('-',$_GET['birthday']);
      	if(count($tmparray)==3){
      	$birthday = $_GET['birthday'];
      	} else{
          $birthday = "";
      	echo "輸入的生日格式不符,";
      	}
    }

    if (empty($_GET['gender'])) {
      $gender = "";
      echo "未輸入性別,";
    }else {
      if($_GET['gender']=="male" || $_GET['gender']=="Female"){
        $gender = $_GET['gender'];
      }else {
        $gender = "";
        echo "輸入性別錯誤,";
      }
    }

    if (empty($_GET['Email'])) {
      $Email = "";
      echo "未輸入電子郵件,";
    }else {
      $tmparray = explode('@',$_GET['Email']);
      	if(count($tmparray)>1){
      	$Email = $_GET['Email'];
      	} else{
          $Email = "";
      	echo "輸入的電子郵件格式不符,";
      	}
    }

    if (empty($_GET['address'])) {
      $address = "";
      echo "未輸入地址,";
    }else {
      $address = $_GET['address'];
    }

    if (empty($_GET['drug'])) {
      $drug = "";
      echo "未輸入是否藥物過敏,";
    }else {
        $drug = $_GET['drug'];
    }






    if($phone!="" && $name!="" && $id_number!="" && $birthday!="" && $gender!="" && $Email!="" && $address!="" && $drug!=""){

      $haveMember = "false";

      $sql = 	"SELECT * FROM member WHERE phone = '$phone'";
      $result = mysqli_query($db,$sql);
      while($row = mysqli_fetch_array($result)) {
        $haveMember = "true";
      }


      if($haveMember == "false"){
        //查無此會員
        $sql1 = "INSERT INTO member (Id,name,birthday,phone,id_number,gender,Email,address,drug,updateTime) VALUES (Null,'$name','$birthday','$phone','$id_number','$gender','$Email','$address','$drug','$Time')";
        if(mysqli_query($db,$sql1)){
          echo "新增會員資料完成";
        }else {
          echo "無法新增".mysql_error();
        }
      }else {
        //有此會員修改會員資料
        $sql1 = "UPDATE member SET name = '$name',birthday = '$birthday',phone = '$phone',id_number = '$id_number',gender = '$gender',Email = '$Email',address = '$address',drug = '$drug',updateTime = '$Time' WHERE phone = '$phone'";
        if(mysqli_query($db,$sql1)){
          echo "修改新增會員資料完成";
        }else {
          echo "無法新增".mysql_error();
        }
      }


    }




?>
