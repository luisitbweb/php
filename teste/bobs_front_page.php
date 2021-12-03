<?php
$pictures = ['tire.jpg', 'oil.jpg', 'spark_plug.jpg',
    'door.jpg', 'steering_wheel.jpg',
    'thermostat.jpg', 'wiper_blade.jpg',
    'gasket.jpg', 'brake_pad.jpg'];

shuffle($pictures);
?>

<html>
    <head>
        <title>Bob's Auto Parts</title>
    </head>
    <body>
        <h1 style="text-align: center">Bob's Auto Parts</h1>
        <table style="width: 100%">
            <tr>
                <?php
                for ($i = 0; $i < 6; $i++) {
                    echo '<td style="text-align: center"><img src="';
                    echo $pictures[$i];
                    echo '"style="width: 100px; height: 100px"></td>';
                }
                ?>
            </tr>
        </table>
</body>
</html>