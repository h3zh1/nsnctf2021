<?php
header("Content-Type: text/html;charset=utf-8");
echo "Flag被分成了3部分 , 我在此留下了几个任务 , 你每完成一部分我就会给你一部分关于flag的线索。<br/>";
$FLAG =  getenv("FLAG");
//flag{good_job_th1s_is_an_easy_pr0blem_about_htt9}

if( $_GET['account' ]=== 'admin' ){
	echo "喔~第一部分给你啦:".substr($FLAG,0,14)."<br/><br/>";
} else {
	die("1. get方法传参account,值为admin<br/><br/>");
}
//flag{edd4c905-165f-4a73-93e0-08b897c3797f}
$UA = $_SERVER['HTTP_USER_AGENT'];

if( strstr($UA,"NSN") ){
	echo "芜湖!第二部分:".substr($FLAG,14,14)."<br/><br/>";
} else {
	die("2. 只有在使用'NSN'浏览器才可以获取下一步信息。<br/><br/>");
}

if($_SERVER['HTTP_REFERER'] === 'www.cnblogs.com/h3zh1'){
	echo "okok,但是你好像不是我的本机奥,只有本机才能访问下一部分。<br/><br/>";
} else {
	die( "3.You should come from www.cnblogs.com/h3zh1。<br/><br/>");
}

$xff = $_SERVER['HTTP_X_FORWARDED_FOR'];
//echo $xff;
$cip = $_SERVER['HTTP_CLIENT_IP'];

if( strstr($cip,"127.0.0.1") || strstr($cip,"localhost") ){
	echo "goodjob:".substr($FLAG,28,14);
} else {
	if( strstr($xff,"127.0.0.1") || strstr($xff,"localhost") ){
		echo "换个其他相关的头试试?";		
	} 
}
