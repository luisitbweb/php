<?php

include_once("IFormat.php");

class Desktop implements IFormat {

    private $head = "<!doctype html><html><head>";
    private $headClose = "<meta charset='UTF-8'>
                    <title>Desktop</title></head><body>";
    private $cap = "</body></html>";
    private $sampleText;

    public function formatCSS() {
        echo $this->head;
        echo "<link rel='stylesheet' href='Desktop.css'>";
        echo $this->headClose;
        echo "<h1>Hello, Everyone!</h1>";
    }

    public function formatGraphics() {
        echo "<img class='pixRight' src='../Factory_Work/imagens/background-fundo.jpg' width='620'
                height='480' alt='river'>";
    }

    public function horizontalLayout() {
        $textFile = "../Factory_Work/CountryWriteups/Moldova.txt";
        $openText = fopen($textFile, 'r');
        $textInfo = fread($openText, filesize($textFile));
        fclose($openText);
        $this->sampleText = $textInfo;
        echo "<div>" . $this->sampleText . "</div>";
        echo "<p/><div>" . $this->sampleText . "</div>";
    }

    public function closeHTML() {
        echo $this->cap;
    }

}
$te = new Desktop();
$te->formatCSS();
$te->formatGraphics();
$te->horizontalLayout();
$te->closeHTML();