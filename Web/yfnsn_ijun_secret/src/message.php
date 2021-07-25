<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head><meta charset="utf-8">
    <title>iJun's Secret BBS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/5.11.2/css/all.css">
  </head>
  <body>
    <div class="newsletter">
      <h1>h3zh1's funs<span>Secret BBS</span></h1><br>
      <font size="6">爱JUN，信JUN，等JUN</font>
      <div class="txtb"><form method="post" action="" >
        <input type="text"  name="u_msg" placeholder="What do you want to say to h3zh1？">
        <button type="submit"><i class="fas fa-arrow-right"></i></button>
      </div>
    </div>
  </body>
<!--听说kee1ongz没事干就在这里敲?debug-->
<!--大概是脑子坏掉了8-->
</html>

<?php
error_reporting(0);
//only for debug
if(isset($_GET['debug']))
{
    highlight_file(__FILE__);
}

//you will like it;
$h3zh1 = $_GET['h3zh1'];
//Make sure u are a nice iJun ~
$msg = $_POST['u_msg'];
$waf = array('`','cat','flag','more','less','head','sort','tail','tac','system', 'exec', 'shell_exec', 'passthru');
$msg = str_replace($waf, '', $msg);
echo $msg;
if($msg){
    echo "<script language=\"JavaScript\">alert(\"Your message is: ".$msg."\");</script>";
}

//h3zh1 will like your message!
$h3zh1('', $msg);


?>
