<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kudenv
 * Date: 9/16/13
 * Time: 10:39 PM
 * To change this template use File | Settings | File Templates.
 */
 
error_reporting(E_ALL);
require "lib/Vktoken.php";
require "lib/convert.php";


    $vk =  new Vktoken('3872689','http://www.jewins.com/index.php','WH2Avcc14XKH1sDh0F7E');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>



<div class="background">


    <?php if (!$vk->getCode()) :?>
        <a class="link" href="<?php echo $vk->getAuthUrl()?>">glitch EM</a>
    <?php endif;?>
</div>


<?php  $res = array(); $res = $vk->getToken(); if (isset($res)):?>
   
   <?php
    $params = array (
        'uid' => $res['user_id'],
        'fields' => 'user_id,first_name,last_name,screen_name,sex,photo_100',
        'access_token' => $res['access_token']
    );
    ?>

    <?php $res = $vk->getRequest('method/friends.get',$params);?>
    <?php $res = (array) $res['response'];?>
<?php endif;?>


<?php
    $file_array  = array();
    for ($i=1;$i<=count($res);$i++){
            $lurl = save_file($res[$i]['photo_100']);
            $file_array[] = $lurl;
    }
?>

<div class="wrapper">
    <ul class="list-ul">

        <?php $i=0;foreach($file_array as $image_url):?>
            <li>
                <img src="<?php echo $image_url;?>">
            </li>
            <?php $i++; if ($i=="5"){echo "</ul><ul class=\"list-ul\">"; $i=0;}?>

        <?php endforeach;?>
    </ul>
</div>
</body>
</html>
