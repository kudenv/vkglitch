<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kudenv
 * Date: 9/13/13
 * Time: 6:44 PM
 * To change this template use File | Settings | File Templates.
 */
    

function save_file($url){
    
    $name_from_url = basename($url);
    if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/cache')) {
        mkdir($_SERVER['DOCUMENT_ROOT'].'/cache',0777);

    }

    $file = file_get_contents($url);
    file_put_contents('cache/'.$name_from_url,$file);
    embross($name_from_url);
    $path = '/cache/'.$name_from_url;

    return $path;

}

function embross ($name) {


    if ($name !== " "){
        $path = $_SERVER['DOCUMENT_ROOT'].'/cache/';
        $fpath = $path.$name;

        $ext = pathinfo($name,PATHINFO_EXTENSION);
        switch ($ext){
            case 'jpg':

                $image = imagecreatefromjpeg($fpath);
                break;
            case 'gif':

                $image  = @imagecreatefromgif($fpath);
                break;
            case 'png':

                $image = @imagecreatefrompng($fpath);
                break;
            default: @imagecreatefromgif($fpath);
        }
        if ($image == " ") {echo "ERR";exit();}

        imagefilter($image,IMG_FILTER_EMBOSS);


        switch ($ext){
            case 'jpg': ImageJpeg($image,$fpath,90) ;
                break;
            case 'gif': ImageGif($image,$fpath,90);
                break;
            case 'png': ImagePng($image,$fpath,90);
                break;
            default: ImageGif($image,$fpath,90);
        }
        imagedestroy($image);
    }

}


?>