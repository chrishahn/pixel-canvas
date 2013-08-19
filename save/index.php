<?php

session_start();
include "../colors.php";
if ($handle = opendir(getcwd())) {

    while (false !== ($file = readdir($handle))) {
        $filelastmodified = filemtime($file);

        if (preg_match("/.*\.jpg/i", $file) && (time() - $filelastmodified) > 300) {
            unlink($file);
        }
    }

    closedir($handle);
}

if (!empty($_POST)) {
    $formString = $_POST['formString'];
    $canvas = explode('|', $formString);
    $_SESSION['canvas'] = $canvas;

    $new = imagecreatetruecolor(800, 800);
    // fill the background with black for the grid lines
    $color = imagecolorallocate($new, 0, 0, 0);
    imagefilledrectangle($new, 0, 0, 800, 800, $color);
    
    $size = 20; // width and height of each color block
    $count = 40; // number of cells across and down in the canvas
    foreach ($canvas as $blockIndex => $rgbString) {
        $rgb = explode("-", $rgbString);
        $color = imagecolorallocate($new, $rgb['0'], $rgb['1'], $rgb['2']);
        $x = ($blockIndex % $count) * $size;
        $y = floor($blockIndex / $count) * $size;
        imagefilledrectangle($new, $x, $y, $x + $size, $y + $size, $color);
    }
    $name = md5(rand(1, 99999)) . ".jpg";
    imagejpeg($new, $name, 100);
    echo "<html>
                <body>
                <img src='{$name}' />
                </body>
                </html>";
}
?>