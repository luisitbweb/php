<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.03 - Funções para arrays");

/*
 * [ criação ] https://php.net/manual/pt_BR/ref.array.php
 */
fullStackPHPClassSession("manipulação", __LINE__);

$index = [
    "AC/DC",
    "Nirvana",
    "Alter Bridge"
];

$assoc = [
    "band_1" => "AC/DC",
    "band_2" => "Nirvana",
    "band_3" => "Alter Bridge"
];

array_unshift($index, " ", "Pearl Jam");
$assoc = ["band_4" => "Pearl Jam", "band_5" => ""] + $assoc;

array_push($index, "");
$assoc = $assoc + ["band_6" => ""];

array_shift($index);
array_shift($assoc);

array_pop($index);
array_pop($assoc);

array_unshift($index, "");

$index = array_filter($index);
$assoc = array_filter($assoc);

echo '<pre>';
var_dump(
        $index,
        $assoc
);
echo '</pre>';

/*
 * [ ordenação ] reverse | asort | ksort | sort
 */
fullStackPHPClassSession("ordenação", __LINE__);

$index = array_reverse($index);
$assoc = array_reverse($assoc);

asort($index);
asort($assoc);

ksort($index);
krsort($index);

sort($index);
rsort($index);

echo '<pre>';
var_dump(
        $index,
        $assoc
);
echo '</pre>';

/*
 * [ verificação ]  keys | values | in | explode
 */
fullStackPHPClassSession("verificação", __LINE__);

echo '<pre>';
var_dump(
    [
        array_keys($assoc),
        array_values($index)
    ]
);
echo '</pre>';

if(in_array("AC/DC", $assoc)){
    echo "<p>Cause I`m back!</p>";
}

$arrToString = implode(",", $assoc);
echo "<p>Eu curso {$arrToString} e muitas outras!</p>";
echo "<p>{$arrToString}</p>";

echo '<pre>';
var_dump(explode(",", $arrToString));
echo '</pre>';

/**
 * [ exemplo prático ] um template view | implode
 */
fullStackPHPClassSession("exemplo prático", __LINE__);

$profile = [
    "name" => "Luis Carlos",
    "company" => "UpInside",
    "mail" => "cursos@upinside.com.br"
];

$template = <<<TPL
    <article>
        <h1>{{name}}</h1>
        <p>{{company}}<br>
            <a href="mailto:{{mail}}" title="Enviar e-mail para {{name}}">
                Enviar E-mail</a>
        </p>
    </article>
TPL;

echo $template;

echo str_replace($profile, array_values($profile), $template);

$replaces = "{{" . implode("}}&{{", array_keys($profile)) . "}}";

//var_dump(explode("&", $replaces));

echo str_replace(explode("&", $replaces), array_values($profile), $template);