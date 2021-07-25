<?php 
header("Content-Type:text/html;charset=utf-8");
highlight_file(__FILE__);

$nickname = $_GET['a'];
$nonono = $_POST['b'];

if( $nickname!=$nonono and md5($nickname)==md5($nonono) )
{
    if( $_POST['c']!==$_POST['d'] && md5($_POST['c']) === md5($_POST['d'])){
        $e = $_POST['e'];
        include($e);
    }
    else{
        exit('byebye');
    }
    
}
else{
    exit('h');
}

?>