<?php
    include "colors.php";
    $canvas = isset($_SESSION['canvas']) ? 
    $_SESSION['canvas'] : array();
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
                <div class="selection"><input name='canvas[]' type='hidden' value='0'/></div>
                <div class="colors">
                    <?php foreach ($colors as $val => $color) {
                        echo "<div class='color' style='background:$color;'><input name='canvas[]' type='hidden' value='$val'/></div>";
                    }?>
                </div>
                <div class="button fillGrid">Fill Canvas With Active</div>
                <div class="button clearGrid">Clear Canvas</div>
                <div class="button submit">Save Picture</div>
            </div>
            <div class="content">
                <div class="canvas">
                    <form class="canvasForm" method="post" action="save/">
                        <?php for ($i = 0; $i < 900; $i++) {
                            $val = isset($canvas[$i]) ? $canvas[$i] : 0;
                            $col = isset($canvas[$i]) ? $colors[$canvas[$i]] : $colors[0];
                            echo "<div class='block' style='background-color:$col;'><input name='canvas[]' type='hidden' value='$val'/></div>";
                        }?>
                    </form>
                </div>
                <div class="recent"></div>
            </div>
        </div>
    </body>
</html>
