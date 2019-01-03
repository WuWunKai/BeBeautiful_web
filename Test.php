<?
ignore_user_abort();//關掉瀏覽器，PHP腳本也可以繼續執行.

set_time_limit(3000);// 通過set_time_limit(0)可以讓程序無限制的執行下去

$interval=5;// 每隔5s運行
do{
echo "測試".time()."<br/>";


sleep($interval);// 等待5s

}while(true);

?>
