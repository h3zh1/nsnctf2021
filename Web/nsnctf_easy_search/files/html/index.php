<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Kee1ongz's Seach page</title>
		<link href="https://cdn.bootcss.com/font-awesome/5.8.0/css/all.css" rel="stylesheet" />
		<style>
			body {
				margin: 0;
				padding: 0;
				background: url(./wallpaper.jpg) no-repeat;
				background-size: cover;
                background-attachment: fixed;
			}
			.search-box {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				background: #2f3640;
				height: 40px;
				border-radius: 40px;
				padding: 10px;
			}
			.search-btn {
				color: #e84118;
				float: right;
				width: 40px;
				height: 40px;
				border-radius: 50%;
				background: #2f3640;
				display: flex;
				justify-content: center;
				align-items: center;
				transition: 0.4s;
				text-decoration: none;
			}
			.search-txt {
				border: none;
				background: none;
				outline: none;
				float: left;
				padding: 0;
				color: white;
				font-size: 16px;
				transition: 0.4s;
				line-height: 40px;
				width: 0;
			}
			.search-box:hover > .search-txt {
				width: 240px;
				padding: 0 6px;
			}
			.search-box:hover > .search-btn {
				background: white;
			}
		</style>
	</head>
	<body>
		<form action="" method="POST">
		<div class="search-box">
			<input class="search-txt" type="text" placeholder="Type to search"  name="id"/>
			<button class="search-btn" type="submit">
				<i class="fas fa-search"></i>
		</button>
		</div>
		</form>
	</body>
</html>

<?php

error_reporting(0);
$dbuser='root';
//$dbuser='root';
$dbpass='root';
//$dbpass='root';

function safe($sql){
    $blackList = array(' ','load_file','outfile','./');
    foreach($blackList as $blackitem){
        if(stripos($sql,$blackitem)){
            return False;
        }
    }
    return True;
}


if(isset($_POST['id'])){
    $id = $_POST['id'];
}else{
    die();
}

$db = mysql_connect("127.0.0.1",$dbuser,$dbpass);
if(!$db){
    die(mysqli_error());
}
//selct db
mysql_select_db("kee1ongzs_news",$db);

if(safe($id)){
    $query = mysql_query("SELECT content from passage WHERE id = ${id} limit 0,1");
    if($query){
        echo ('<font size="5" color="blue">OK.I got your request.Thank for using.</font>');
	}else{
		echo mysql_error($db);
	}
}else{
	echo '<img src=\'cat_waf.png\'><br>';
    echo ('<font size="10" color="red">Don\'t do anything bad.</font>');
}
