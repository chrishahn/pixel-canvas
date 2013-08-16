<?php

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

function html2rgb($color) {
    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0] . $color[1],
            $color[2] . $color[3],
            $color[4] . $color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    else
        return false;

    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    
    return array($r, $g, $b);
}

if (!empty($_POST)) {
    $canvas = $_POST['canvas'];
    $_SESSION['canvas'] = $canvas;

    $new = imagecreatetruecolor(600, 600);
    // fill the background with black for the grid lines
    $color = imagecolorallocate($new, 0, 0, 0);
    imagefilledrectangle($new, 0, 0, 600, 600, $color);
    
    $size = 20; // width and height of each color block
    $count = 30; // number of cells across and down in the canvas
    foreach ($canvas as $blockIndex => $colorIndex) {
        $rgb = html2rgb($colors[$colorIndex]);
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