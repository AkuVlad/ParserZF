<?php
require_once 'C:\Server\data\htdocs\phpQuery\phpQuery\phpQuery.php';
$enterdata = array('usr' => 'ad','pwd' => 'ad','Action' => 'Login','Login'=> '   Логин   ','Lang'=>'ru');
$url = 'http://10.18.32.104/lub5_kama_nizhnekamsk_1/index.php';
$headers = 
array('Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/vnd.ms-excel, application/msword,', 
'Accept-Language: ru',
'Content-Type: application/x-www-form-urlencoded',
'UA-CPU: x86',
'Accept-Encoding: gzip, deflate',
'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)',
'Host: 10.18.32.145',
'Connection: Keep-Alive',
'Cache-Control: no-cache');
//Проходим авторизацию
$url2 = 'http://10.18.32.104/lub5_kama_nizhnekamsk_1/index.php?item=2&hist=&SessionID=&Lang=ru';
$curl = curl_init($url2);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl,CURLOPT_VERBOSE,1);
curl_setopt($curl,CURLOPT_POST,false);
curl_setopt($curl,CURLOPT_URL,$url2);
$out = curl_exec($curl);
curl_close($curl);
echo $out;
?>
