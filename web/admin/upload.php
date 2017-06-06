<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }

$ds          = DIRECTORY_SEPARATOR;
//$storeFolder = "high_res_img". $ds .$_SESSION['collection']. $ds .$_SESSION['album']. $ds;  //2
$storeFolder = "high_res_img". $ds .'Alli_and_Chris'. $ds .'Wedding'. $ds;  //2

echo $storeFolder;
if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath = dirname( __FILE__ ). $ds .$storeFolder;  //4

    $targetFile =  $targetPath. $_FILES['file']['name'];  //5

    move_uploaded_file($tempFile,$targetFile); //6

}
?>
