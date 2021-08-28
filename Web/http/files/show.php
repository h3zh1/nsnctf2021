<title>W&M exclusive robot</title>

<style>
    h1 {text-align:center}
    p {text-align:center}
</style>

<h1>Fully automatic rp system</h1>
<p>Come and get your rp value today!</p>
<hr></hr>

<?php
$num = $_POST['rp'];
if(!isset($num) or $num == ''){$num = mt_rand(0,100);}
if($num <= 100 and is_numeric($num))
{
    echo "<p>Your rp value:";
    echo $num;
    echo "</p>";
    if(mt_rand(1,100) <= 50)
    {
        echo "\r\n<p>";
        if($num == 100){echo "Wow! Golden legend!";}
        elseif($num >= 80 and $num < 100){echo "You are Koi! Congratulations!";}
        elseif($num >= 60 and $num < 80){echo "Fortunately, you passed 60.";}
        elseif($num >= 40 and $num < 60){echo "Oh, you almost passed it!";}
        elseif($num >= 20 and $num < 40){echo "Gee, this is too miserable.";}
        elseif($num < 20){echo "Ah-ha! There is a idiot!";}
        echo "</p>";
    }
    if($num == 100 and mt_rand(1,100) <= 5)
    {
        for($i=0;$i<100;$i++){echo "\r\n<br></br>";}
        echo 'Tired of playing rp? Let\'s <a href="http://localhost/show.php?rp=flag" target="_blank">get the secret</a>!';
    }
}
elseif($num === '4159506287')
{
    echo "wmctf{success}";
    echo "\r\n<hr></hr> Wow, you cut my backpack and found the secret!";
}
else
{
    if($num === 'flag') $num = 4159506287;
    $key = array(28186390895657, 84559172686971, 80692115733908, 57353373067776, 22059564851978, 40388473698647, 124542182410773, 91051110026378, 112742212150946, 54290928637774, 94404798756171, 40392871001665, 68598110798404, 41785472478854, 25996629336722, 101019837363048, 82963866264519, 24316288533033, 84737125416797, 56368973049223, 2311575715655, 64261597617025, 115771983454147, 46184783396167, 2121345207564, 53330718889073, 49534310783118, 103728503304990, 108707065719744, 73356817713575, 32652300906411, 97005071980911);
    $cipher = 0;
    $cnt = 31;
    while ($num>0)
    {
        $cipher += ($num%2)*$key[$cnt];
        $cnt -= 1;
        if($cnt == -1)$cnt = 31;
        $num = floor($num / 2);
    }
    echo $cipher;
    echo "\r\n<hr></hr>What happend to my bot?????";
    echo "\r\n<br></br>Let me find something in my special cycle backpack which can fix this bug!";
}
?>
