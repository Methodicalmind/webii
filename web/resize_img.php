<?php
$image = new Imagick($imagePath);
$d = $image->getImageGeometry();
$w = $d['width'];
$h = $d['height'];

if($w > 1260) {
    if($w > $h) {
        $width = 1024;
        $percentReduction = $width / $w;
        $height = $percentReduction * $h;
    }
}
if ($h > 900) {
    if($h > $w) {
        $height = 900;
        $percentReduction = $height / $h;
        $width = $percentReduction * $w;
    }
}


function resizeImage($image, $width, $height,
                     $filterType, $blur, $bestFit, $cropZoom) {
    //The blur factor where &gt; 1 is blurry, &lt; 1 is sharp.
    $imagick = new Imagick(realpath($imagePath));

    $imagick->resizeImage($width, $height, $filterType, $blur, $bestFit);

    $cropWidth = $imagick->getImageWidth();
    $cropHeight = $imagick->getImageHeight();

    if ($cropZoom) {
        $newWidth = $cropWidth / 2;
        $newHeight = $cropHeight / 2;

        $imagick->cropimage(
            $newWidth,
            $newHeight,
            ($cropWidth - $newWidth) / 2,
            ($cropHeight - $newHeight) / 2
        );

        $imagick->scaleimage(
            $imagick->getImageWidth() * 4,
            $imagick->getImageHeight() * 4
        );
    }


    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
}

?>
