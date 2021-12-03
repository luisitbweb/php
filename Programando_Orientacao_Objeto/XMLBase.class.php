<?php
class XMLBase{
    function toXml(){
        $retorno = '<p><' . get_class($this) . '>';
        $propriedades = get_object_vars($this);
        foreach ($propriedades as $propriedade => $valor){
            $retorno .= "\t<$propriedade> $valor </$propriedade>";
        }
        $retorno .= '</' . get_class($this) . '></p>';
        return $retorno;
    }
}