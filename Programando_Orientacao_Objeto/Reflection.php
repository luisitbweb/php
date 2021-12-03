<?php

include './Classes/ShopProduct.class.php';
include './Classes/CdProduct.class.php';

function classData(ReflectionClass $class) {
    $details = '';
    $name = $class->getName();
    if ($class->isUserDefined()) {
        $details .= "$name e definido pelo Usuario<br />";
    }
    if ($class->isInternal()) {
        $details .= "$name e construido<br />";
    }
    if ($class->isInterface()) {
        $details .= "$name e interface<br />";
    }
    if ($class->isAbstract()) {
        $details .= "$name e uma classe abstrata<br />";
    }
    if ($class->isFinal()) {
        $details .= "$name e uma classe final<br />";
    }
    if ($class->isInstantiable()) {
        $details .= "$name pode ser instanciado<br />";
    } else {
        $details .= "$name não pode ser instanciado<br />";
    }
    return $details;
}

$prod_class = new ReflectionClass('CdProduct');
print classData($prod_class);

class ReflectionUtil {

    static function getClassSource(ReflectionClass $class) {
        $path = $class->getFileName();
        $lines = @ file($path);
        $from = $class->getStartLine();
        $to = $class->getEndLine();
        $len = $to - $from + 1;
        return implode(array_slice($lines, $from - 1, $len));
    }

}

echo '<pre>';
print ReflectionUtil::getClassSource(new ReflectionClass('CdProduct'));

$prod_class = new ReflectionClass('CdProduct');
$methods = $prod_class->getMethods();

foreach ($methods as $method) {
    print methodData($method);
    print '<br />-------<br />';
}

function methodData(ReflectionMethod $method) {
    $details = '';
    $name = $method->getName();
    if ($method->isUserDefined()) {
        $details .= "$name Definido pelo Usuario!<br />";
    } elseif ($method->isInternal()) {
        $details .= "$name e construido!<br />";
    } elseif ($method->isAbstract()) {
        $details .= "$name e abstrato!<br />";
    } elseif ($method->isPublic()) {
        $details .= "$name e publico!<br />";
    } elseif ($method->isProtected()) {
        $details .= "$name e protegido!<br />";
    } elseif ($method->isPrivate()) {
        $details .= "$name e privado!<br />";
    } elseif ($method->isStatic()) {
        $details .= "$name e statico!<br />";
    } elseif ($method->isFinal()) {
        $details .= "$name e final!<br />";
    } elseif ($method->isConstructor()) {
        $details .= "$name e o construtor<br />";
    } elseif ($method->returnsReference()) {
        $details .= "$name retorna uma referencia (como oposição a um valor)<br />";
    }
    return $details;
}

class ReflectionUtilite {

    static function getMethodSource(ReflectionMethod $method) {
        $path = $method->getFileName();
        $lines = @ file($path);
        $from = $method->getStartLine();
        $to = $method->getEndLine();
        $len = $to - $from + 1;
        return implode(array_slice($lines, $from - 1, $len));
    }

}

$class = new ReflectionClass('CdProduct');
$method = $class->getMethod('getSummaryLine');
print ReflectionUtilite::getMethodSource($method);

$prod_class = new ReflectionClass('CdProduct');
$method = $prod_class->getMethod("__construct");
$params = $method->getParameters();

foreach ($params as $param) {
    print argData($param) . '<br />';
}

function argData(ReflectionParameter $arg) {
    $details = '';
    $declaringclass = $arg->getDeclaringClass();
    $name = $arg->getName();
    $class = $arg->getClass();
    $position = $arg->getPosition();
    $details .= "\$$name tem possiçao $position!<br />";

    if (!empty($class)) {
        $classname = $class->getName();
        $details .= "\$$name deve ser um $classname Objeto<br />";
    } elseif ($arg->isPassedByReference()) {
        $details .= "\$$name e passado a referencia!<br />";
    }elseif ($arg->isDefaultValueAvailable()) {
        $def = $arg->getDefaultValue();
        $details .= "\$$name tem padrão: $def <br />";
    }
    return $details;
}
