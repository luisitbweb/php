<?php

function adicionar(&$fruta) {
	return ++$fruta;
}

$laranjas = 5;

adicionar($laranjas);

echo $laranjas;