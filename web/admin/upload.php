<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }

//$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
//$max_file_size = 30000000; //30 mb
//// Upload directory
//$path = "high_res_img/".$_SESSION['collection'].'/'.$_SESSION['album'].'/';
//
//if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
//	// Loop $_FILES to exeicute all files
//	foreach ($_FILES['files']['name'] as $f => $name) {
//	    if ($_FILES['files']['error'][$f] == 4) {
//            echo 'nothing was uploaded.';
//	        continue; // Skip file if any error found
//	    }
//	    if ($_FILES['files']['error'][$f] == 0) {
//	        if ($_FILES['files']['size'][$f] > $max_file_size) {
//                echo '<div class=""><p>File '.$name.' was to large</div>';
//	            continue; // Skip large files
//	        }
//			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
//                echo '<div class=""><p>File '.$name;
//                echo ' is not a valid file format</div>';
//				continue; // Skip invalid file formats
//			}
//	        else{ // No error found! Move uploaded files and add to database
//	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)) {
//                    $count++; // Number of successfully uploaded file
//                    echo '<div class=""><p>File '.$name.' Uploaded Successfully</div>';
//                }
//	        }
//	    }
//	}
//}

$storeFolder = "high_res_img/".$_SESSION['collection'].'/'.$_SESSION['album'].'/';  //2

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath = dirname( __FILE__ ).'/'. $storeFolder;  //4

    $targetFile =  $targetPath. $_FILES['file']['name'];  //5

    move_uploaded_file($tempFile,$targetFile); //6

}
?>
