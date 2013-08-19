<?php
    session_start();
    include "colors.php";
    $canvas = isset($_SESSION['canvas']) ? 
    $_SESSION['canvas'] : array();

    function rgbStringDecode($rgb)
    {
        $parts = explode("-", $rgb);
        return "rgb({$parts[0]}, {$parts[1]}, {$parts[2]})";
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body>
        <div class="main">
            <div class="left_menu">
                <div class="selection" style="background-color: <?php echo $colors[0]; ?>"></div>
                <div class="colors">
                    <?php foreach ($colors as $val => $color) {
                        echo "<div class='color' style='background:$color;'></div>";
                    }?>
                </div>
                <div class="button fillGrid">Fill Canvas With Active</div>
                <div class="button clearGrid">Clear Canvas</div>
                <div class="button submit">Save Picture</div>
            </div>
            <div class="content">
                <div class="canvas">
                    <?php for ($i = 0; $i < 1600; $i++) {
                        $val = isset($canvas[$i]) ? $canvas[$i] : 0;
                        $col = isset($canvas[$i]) ? rgbStringDecode($canvas[$i]) : $colors[0];
                        echo "<div class='block' style='background-color:$col;'></div>";
                    }?>
                    <form class="canvasForm" method="post" action="save/">
                        <input type="hidden" value="" name="formString" id="formString" />
                    </form>
                </div>
                <div class="recent"></div>
            </div>
        </div>
    </body>
</html>
