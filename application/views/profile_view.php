<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 20.04.2019
 * Time: 13:14
 */
echo '<div class="container">
    <div class="header">
       '.$header.'
    </div>
    <div class="sidebar">
        '.$sidebar.'
    </div>
    <div class="content" id="content">
    ';

echo '<script language="javascript">var a = '.json_encode($content[0]->get_data()).';</script>';

     echo '</tr></table>
     <script src="application/js/script.js"></script>
    </div>
    <div class="footer">
    '.$footer.'
        06.03.2019
    </div>
    </div>
   ';
