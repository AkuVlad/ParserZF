<?php
require_once 'C:\Server\data\htdocs\phpQuery\phpQuery\phpQuery.php';
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
$enterdata = array(
'usr' => 'ad',
'pwd' => 'ad',
'Action' => 'Login',
'Login'=> '   �����   ',
'Lang'=>'ru');
$cookiepath = __DIR__.'/my_cookies.txt';
$url = 'http://10.18.32.145/kamarep1/index.php';
//�������� �����������
$curl = curl_init($url);
curl_setopt($curl,CURLOPT_POST,1);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($enterdata));
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_HEADER,false);
$html = curl_exec($curl);
curl_close($curl);
//������ �����������, �������� �� ������ "������������"
$pq = phpQuery::newDocument($html);
$linkA = $pq->find('div a:first');
$href = $linkA->attr('href');
$url2 = 'http://10.18.32.145/kamarep1/'.$href;
$curl = curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_VERBOSE,1);
curl_setopt($curl,CURLOPT_POST,false);
curl_setopt($curl,CURLOPT_URL,$url2);
$out = curl_exec($curl);
curl_close($curl);
//������ �� ������ ������������, ��������� �� ������� "����������".
$url3 = str_replace('item=0','item=1',$url2);
$curl = curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_VERBOSE,1);
curl_setopt($curl,CURLOPT_POST,false);
curl_setopt($curl,CURLOPT_URL,$url3);
$out = curl_exec($curl);
curl_close($curl);
echo $out;
echo $url3;
echo '<form action="StatZF.php" method="post" enctype="multipart/form-data" target="_blank">
VVEDITE DATU STARTA OTBORA "DD.MM.YYYY HH:MM:SS" :<input type = "text" name="start" value=""></br>
VVEDITE DATU KONTSA OTBORA "DD.MM.YYYY HH:MM:SS" :<input type = "text" name="end" value=""></br>
POLUCHIT RAZMERY SHIN:<input type="submit" name="refresh" value = "1" ></br>
NOMER SESSII<input type = "text" name="SessionURL" value='.$url3.'>'.'<br>';
echo '</form>';

?>