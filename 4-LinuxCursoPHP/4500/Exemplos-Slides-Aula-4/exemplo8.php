<?php

$ensino = 'EAD';
$formacao = array('PHP' => 'Desenvolvedor PHP', 'Infra' => 'SysAdmin Linux');

echo "<p>No $ensino da 4Linux você se torna {$formacao['PHP']}";
echo " e pode se tornar também {$formacao['Infra']}.</p>"; // Não concatenadas
 
echo '<p>No ' . $ensino . ' da 4Linux você se torna ' . $formacao['PHP'];
echo ' e pode se tornar também '. $formacao['Infra'] . '.</p>'; // Concatenadas