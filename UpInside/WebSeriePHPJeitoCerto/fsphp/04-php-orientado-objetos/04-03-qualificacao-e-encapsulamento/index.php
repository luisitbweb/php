<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.03 - Qualificação e encapsulamento");

/*
 * [ namespaces ] http://php.net/manual/pt_BR/language.namespaces.basics.php
 */
fullStackPHPClassSession("namespaces", __LINE__);

require __DIR__ . "/classes/App/Template.php";
require __DIR__ . "/classes/Web/Template.php";

$appTemplate = new App\Template();
$webTemplate = new Web\Template();

echo '<pre>';
var_dump(
    $appTemplate,
    $webTemplate
);
echo '</pre>';

use App\Template;
use Web\Template AS WebTemplate;

$appUseTemplate = new Template();
$webUseTemplate = new WebTemplate();

echo '<pre>';
var_dump(
    $appUseTemplate,
    $webUseTemplate
);
echo '</pre>';

/*
 * [ visibilidade ] http://php.net/manual/pt_BR/language.oop5.visibility.php
 */
fullStackPHPClassSession("visibilidade", __LINE__);

require __DIR__ . "/source/Qualifield/User.php";

$user = new \Source\Qualifield\User();

//$user->firstName = "Luís Carlos";
//$user->lastName = "Da Silva Santos";

//$user->setFirstName("Luís Carlos");
//$user->setLastName("Da Silva Santos");

echo '<pre>';
var_dump(
    $user,
    get_class_methods($user)
);
echo '</pre>';

echo "<p>O e-mail de {$user->getFirstName()} é {$user->getEmail()}!</p>";

/*
 * [ manipulação ] Classes com estruturas que abstraem a rotina de manipulação de objetos
 */
fullStackPHPClassSession("manipulação", __LINE__);

$luis = new \Source\Qualifield\User();
$luis->SetUser(
        "Luis Carlos",
        "Da Silva Santos",
        "cursos@upinside.com.br"
);

if(!$luis){
    echo "<p class='trigger error'>{$user->getError()}</p>";
}

$kaue = new \Source\Qualifield\User();
$kaue->SetUser(
        "Kaue",
        "Cardosos",
        "cursos@upinside.com.br"
);

$gah = new \Source\Qualifield\User();
$gah->SetUser(
        "gah",
        "Morandi",
        "cursos@upinside.com.br"
);

echo '<pre>';
var_dump(
    $luis,
    $kaue,
    $gah
);
echo '</pre>';