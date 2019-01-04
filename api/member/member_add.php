<?

    include("config.php");
    date_default_timezone_set('Asia/Taipei');
    header("Content-Type:text/html; charest=utf-8");

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

    if (empty($_GET['gender'])) {
      $gender = "";
      echo "未輸入性別,";
    }else {
      if($_GET['gender']=="male" || $_GET['gender']=="Female"){
        $gender = $_GET['gender'];
      }else {
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
      $address = "";
      echo "未輸入是否藥物過敏,";
    }else {
        $drug = $_GET['drug'];
    }






?>
