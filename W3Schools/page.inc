<?php

class page {

    // atributos da classe page

    var $content;
    var $title = 'TLA Consulting Pty LTD';
    var $keywords = 'TLA Consulting, Theree Letter Abbreviation,
                 some of my best friends are search engines';
    var $buttons = array('Home' => 'home.php',
        'Contact' => 'contact.php',
        'Services' => 'services.php',
        'Site Map' => 'map.php');

    // operacoes da classe page

    function SetContent($newcontent) {
        $this->content = $newcontent;
    }

    function SetTitle($newtitle) {
        $this->title = $newtitle;
    }

    function SetKeywords($newkeywords) {
        $this->keywords = $newkeywords;
    }

    function SetButtons($newbuttons) {
        $this->buttons = $newbuttons;
    }

    function Display() {
        echo "<html>\n<head>\n";
        $this->DisplayTitle();
        $this->DisplayKeywords();
        $this->DisplayStyles();
        echo "</head>\n<body>\n";
        $this->DisplayHeader();
        $this->DisplayMenu($this->buttons);
        echo $this->content;
        $this->DisplayFooter();
        echo "</body>\n</html>\n";
    }

    function DisplayTitle() {
        echo '<title>$this->title</title>';
    }

    function DisplayKeywords() {
        echo "<META name=\"keywords\"content=\"$this->keywords\">";
    }

    function DisplayStyles() {
        ?>

        <style>

            h1 {color:white; font-size:24pt; text-align:center;
                font-family:arial,sans-serif}

            .menu {color:white; font-size:12pt; text-align:center;
                   font-family:arial,sans-serif; font-weight:bold}

            td {background-color:black}

            p {color:black; font-size:12pt; text-align:justify;
               font-family:arial,sans-serif}

            p.foot {color:white; font-size:9pt; text-align:center;
                    font-family:arial,sans-serif; font-weight:bold}

            a:link,a:visited,a:active {color:white}


            #tableid{
                width: 100%;
                background-color: black;
                padding: 12px;
                border: 0px;
            }

            #tableid2{
                width:100%;
                padding:12px;
                border:0px;
            }

            #trid{
                background-color: black;
            }

            #tdid{
                text-align:left;
            }

            #tdid2{
                text-align:right;
            }
        </style>

        <?php

    }

    function DisplayHeader() {
        ?>
        <table id="tableid2">
            <tr id="trid">
                <td id="tdid"><img src="logo.gif" alt="logo"></td>
                <td>
                    <h1> TLA Consulting Pty LTD</h1>
                </td>
                <td id="tdid2"><img src="logo.gif" alt="logo"></td>
            </tr>
        </table>

        <?php

    }

    function DisplayMenu($buttons) {
        echo "<table width='100%' bgcolor='white' cellpadding='4' cellspacing='4'\n";
        echo "<tr>\n";

        // calcula o tamanho do botao

        $width = 100 / count($buttons);

        while (list($name, $url) = each($buttons)) {
            $this->DisplayButtons($width, $name, $url, !$this->IsURLCurrentPage($url));
        }

        echo "</tr>\n";
        echo "</table>\n";
    }

    function IsURLCurrentPage($url) {
        if(@strpos($GLOBALS['SCRIPT_NAME'], $url) == false) {
            return false;
        } else {
            return true;
        }
    }

    function DisplayButtons($width, $name, $url, $active = true) {
        if ($active) {
            echo "<td width ='$width%'>
          <a href ='$url'>
          <img src ='side-logo.gif' alt ='$name' border ='0'></a>
          <a href ='$url'><span class='menu'>$name</span></a></td>";
        } else {
            echo "<td width ='$width%'>
            <img src ='side-logo.gif'>
            <span class='menu'>$name</span></td>";
        }
    }

    function DisplayFooter() {
        ?>

        <table id="tableid">
            <tr>
                <td>
                    <p class="foot">&copy; TLA Consulting Pty LTD.</p>
                    <p class="foot">Please see our
                        <a href ="">legal information page</a></p>
                </td>
            </tr>
        </table>
        <?php

    }

}
