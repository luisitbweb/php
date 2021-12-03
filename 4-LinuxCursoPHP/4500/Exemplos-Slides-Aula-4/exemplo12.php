<?php

$trimestres = array(
    'Primeiro' => 8.2,
    'Segundo' => 6.7,
    'Terceiro' => 9.1);

echo '<h1>Notas dos trimestres:</h1>';

foreach ($trimestres as $prova => $nota) {
    echo "<h2>$prova = $nota</h2><hr/>";
}