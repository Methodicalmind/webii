<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }

    $srcPath = "high_res_img/".$_SESSION['collection'].'/'.$_SESSION['album'].'/';
    $destPath = "web_res_img/".$_SESSION['collection'].'/'.$_SESSION['album'].'/';

    $source_img = [];
    $file_count = 0;
    $srcDir = opendir($srcPath);
    while($readFile = readdir($srcDir))
    {
        if($readFile != '.' && $readFile != '..')
        {
            $source_img[$file_count] = $readFile;
            $file_count++;
        }
    }

    closedir($srcDir);
    function reduceSize($src, $dest) {

        $max_width = 1200;
        $max_height = 1200;

        // Get new dimensions
        list($width, $height) = getimagesize($src);
        $x_ratio = $max_width / $width;
        $y_ratio = $max_height / $height;

        if( ($width <= $max_width) && ($height <= $max_height) ){
            $new_width = $width;
            $new_height = $height;
            }elseif (($x_ratio * $height) < $max_height){
                $new_height = ceil($x_ratio * $height);
                $new_width = $max_width;
            }else{
                $new_width = ceil($y_ratio * $width);
                $new_height = $max_height;
        }

        // Resample
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($src);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Output
        imagejpeg($image_p, $dest, 85);
    }

    $reduction_count = 0;
    foreach($source_img as $img) {
        $src = $srcPath.$img;
        $dest = $destPath.$img;
        reduceSize($src, $dest);
        $reduction_count++;
    }

    if($file_count != $reduction_count && $reduction_count == 0){
        echo 'All or some files were not reduced successfully please try again';
    }
    else {
        echo 'All files reduced sucessfully';
    }
?>
