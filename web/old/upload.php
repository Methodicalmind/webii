<?php
session_start();

include "../dbconn.php";

$insert = "INSERT INTO high_res VALUES (
                DEFAULT,
                :name,
                :file_name,
                (Select id FROM album WHERE name = :album_name),
                :date
            );";

$today = date("Y-m-d");
$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
$max_file_size = 30000000; //30 mb
// Upload directory
$path = "high_res_img/".$_SESSION['collection'].'/'.$_SESSION['album'].'/';
$count = 0;
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }
	    if ($_FILES['files']['error'][$f] == 0) {
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
                echo '<div class=""><p>File '.$name.' was to large</div>';
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
                echo '<div class=""><p>File '.$name;
                echo ' is not a valid file format</div>';
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files and add to database
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)) {
                    $count++; // Number of successfully uploaded file
                    echo '<div class=""><p>File '.$name.' Uploaded Successfully</div>';
                }

//database insert run
$statement = $dbconn->prepare($insert);
$statement->bindValue(":name", $name, PDO::PARAM_STR);
$statement->bindValue(":file_name", $name, PDO::PARAM_STR);
$statement->bindValue(":album_name", $_SESSION['album'], PDO::PARAM_STR);
$statement->bindValue(":date", $today, PDO::PARAM_STR);
$statement->execute();

                    echo '<div><p>File '.$name.' is now stored in DB</div>';
	        }
	    }
	}
}
?>
