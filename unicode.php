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
'Login'=> '   Логин   ',
'Lang'=>'ru');
$cookiepath = __DIR__.'/my_cookies.txt';
$url = 'http://10.18.32.145/kamarep1/index.php';
//Проходим авторизацию
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
//прошли авторизацию, нажимаем на кнопку "производство"
$pq = phpQuery::newDocument($html);
$linkA = $pq->find('div a:first');
$href = $linkA->attr('href');
$url2 = 'http://10.18.32.145/kamarep1/'.$href;
$curl = curl_init($url2);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_VERBOSE,1);
curl_setopt($curl,CURLOPT_POST,false);
curl_setopt($curl,CURLOPT_URL,$url2);
$out = curl_exec($curl);
curl_close($curl);
//Нажали на кнопку производство, переходим на вкладку "статистика".
$url3 = str_replace('item=0','item=1',$url2);
$curl = curl_init($url3);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_VERBOSE,1);
curl_setopt($curl,CURLOPT_POST,false);
curl_setopt($curl,CURLOPT_URL,$url3);
$out = curl_exec($curl);
curl_close($curl);
//echo $out;
echo $url3;
/*echo '<form action="StatZF.php" method="post" enctype="multipart/form-data" target="_blank" >
VVEDITE DATU STARTA OTBORA "DD.MM.YYYY HH:MM:SS" :<input type = "text" name="start" value=""></br>
VVEDITE DATU KONTSA OTBORA "DD.MM.YYYY HH:MM:SS" :<input type = "text" name="end" value=""></br>
POLUCHIT RAZMERY SHIN:<input type="submit" name="refresh" value = "1" ></br>
NOMER SESSII<input type = "text" name="SessionURL" value='.$url3.'>'.'<br>';
echo '</form>';*/
/*name="add" value="►"
  name='add' value='&#9658';
  name='del' value='◄';
*/
echo '<br>';
$request = array('start' => $_POST['start'],'end' => $_POST['end']);
if(isset($_POST['refresh_x']))
{$request['refresh']='1';}
if(isset($_POST['add']))
{$request['add']='►';}
if(isset($_POST['del']))
{$request['del']='◄';}
if(isset($_POST['bilanz']))
{$requst['bilanz']='bilanz';}
var_dump($request);
var_dump($_POST);

$curl = curl_init($url3);
curl_setopt($curl,CURLOPT_POST,1);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($_POST));
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_HEADER,false);
$out = curl_exec($curl);
echo $out;
?>