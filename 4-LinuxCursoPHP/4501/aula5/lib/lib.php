<?php

namespace lib;

trait FuncoesUteis {

    function Nota($nota1, $nota2, $nota3, $nota4) {
        $this->Nota = ($nota1 + $nota2 + $nota3 + $nota4) / 4;
        $media = $this->Nota;
        return $media;
    }

}
