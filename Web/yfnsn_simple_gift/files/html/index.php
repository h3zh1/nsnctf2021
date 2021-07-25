<?php
error_reporting(0);
highlight_file(__FILE__);
function wtf_1s_th1s($a, $b){
    $wtf = explode('Kee1ongz',$a);
    $wtf1 = $wtf[0];
    $wtf2 = $wtf[1];
    $wtf3 = $wtf[2];
    $wtf4 = $wtf[3];
    $wtf5 = $wtf[4];
    $wtf6 = $wtf[5];
    $res[0] = $wtf1.$wtf2.$wtf3.$wtf4.$wtf5.$wtf6;
    $res[1] = $b;
    return $res;
}

function only_4_admin(){
    $u_key = $_POST['key'];
    $gift = wtf_1s_th1s("aKee1ongzsKee1ongzsKee1ongzeKee1ongzrKee1ongzt", $u_key);
    $a = $gift[0];
    $b = $gift[1];
    array_map($a, array($b));
}


//Can u find my gift?
$pwd=$_POST['pwd'];
if(is_numeric($pwd))
{
    die("Sorry.No number allowed.");
}
switch ($pwd) {
    case 1:
        echo "ybb!";
        break;
    case 2:
        echo "ybb!ybb!";
        break;
    case 3:
        echo "ybb!ybb!ybb!";
        break;
    case 4:
        echo 'So what?';
        only_4_admin();
        break;
    default:
        echo "ybb!ybb!ybb!ybb!ybb!";
        break;
}
//maybe you need to check flag.php.
?>