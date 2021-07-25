<?php
error_reporting(0);

function getHeader() {
	$headers = array(); 
	foreach ($_SERVER as $key => $value) {
        if ('HTTP_' == substr($key, 0, 5)) { 
			$headers[str_replace('_', '-', substr($key, 5))] = $value; 
	    }
	    if (isset($_SERVER['PHP_AUTH_DIGEST'])) { 
			$header['AUTHORIZATION'] = $_SERVER['PHP_AUTH_DIGEST']; 
	    } elseif (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) { 
			$header['AUTHORIZATION'] = base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']); 
	    } 
	    if (isset($_SERVER['CONTENT_LENGTH'])) { 
	        $header['CONTENT-LENGTH'] = $_SERVER['CONTENT_LENGTH']; 
	    } 
	    if (isset($_SERVER['CONTENT_TYPE'])) { 
			$header['CONTENT-TYPE'] = $_SERVER['CONTENT_TYPE']; 
	    }
	}
	return $headers;
}

$head = getHeader();

if($head['H3ZH1']==='g00d')
{
  echo("Well done! Welcome to join the iJun's Family!");
  header('Location:message.php');
  exit;
}elseif($head['H3ZH1']){
  header("HTTP/1.1 403 Forbidden");
  header("Our-Secret-Header-is: h3zh1");
  header("And-its-value-is: g00d");
  echo("Almost,Check the respone carefully ~ h3zh1 must have a value ^_^");
}else{
  header("HTTP/1.1 403 Forbidden");
  header("Our-Secret-Header-is: h3zh1");
  header("And-its-value-is: g00d");
  die("Sorry, our BBS is only open to iJun :(");
}

?>
