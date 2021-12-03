<?php

/*
 * 
  expr     ::= operand (orExpr | andExpr )*
  operand  ::= ( '(' expr ')' | <stringLiteral> | variable ) ( eqExpr )*
  orExpr   ::= 'or' operand
  andExpr  ::= 'and' operand
  eqExpr   ::= 'equals' operand
  variable ::= '$' <word>
 * 
 */

abstract class Expression {

    private static $keycount = 0;
    private $key;

    abstract function interpret(InterpreterContext $context);

    function getKey() {
        if (!isset($this->key)) {
            self::$keycount++;
            $this->key = self::$keycount;
        }
        return $this->key;
    }

}

class LiteralExpression extends Expression {

    private $value;

    function __construct($value) {
        $this->value = $value;
    }

    function interpret(\InterpreterContext $context) {
        $context->replace($this, $this->value);
    }

}

class InterpreterContext {

    private $expressionstore = array();

    function replace(Expression $exp, $value) {
        $this->expressionstore[$exp->getKey()] = $value;
    }

    function lookup(Expression $exp) {
        return $this->expressionstore[$exp->getKey()];
    }

}

class variableExpression extends Expression {

    private $name, $val;

    function __construct($name, $val = NULL) {
        $this->name = $name;
        $this->val = $val;
    }

    function interpret(\InterpreterContext $context) {
        if (!is_null($this->val)) {
            $context->replace($this, $this->val);
            $this->val = NULL;
        }
    }

    function setValue($value) {
        $this->val = $value;
    }

    function getKey() {
        return $this->name;
    }

}

abstract class OperatorExpression extends Expression {

    protected $l_op, $r_op;

    function __construct(Expression $l_op, Exception $r_op) {
        $this->l_op = $l_op;
        $this->r_op = $r_op;
         foreach (array("four", "4", "52") as $val) {
            $input->setValue($val);
            print "$val:\n";
            $statement->interpret($context);
            if ($context->lookup($statement)) {
                print "top marks\n\n";
            } else {
                print "dunce hat on\n\n";
            }
        }
    }

    function interpret(\InterpreterContext $context) {
        $this->l_op->interpret($context);
        $this->r_op->interpret($context);
        $result_l = $context->lookup($this->l_op);
        $result_r = $context->lookup($this->r_op);
        $this->doInterpret($context, $result_l, $result_r);
    }

    protected abstract function doInterpret(InterpreterContext $context, $result_l, $result_r);
}

class EqualsExpression extends OperatorExpression {

    protected function doInterpret(\InterpreterContext $context, $result_l, $result_r) {
        $context->replace($this, $result_l == $result_r);
    }

}

class BooleanOrExpression extends OperatorExpression {

    protected function doInterpret(\InterpreterContext $context, $result_l, $result_r) {
        $context->replace($this, $result_l || $result_r);
    }

}

class BooleAndExpression extends OperatorExpression {

    protected function doInterpret(\InterpreterContext $context, $result_l, $result_r) {
        $context->replace($this, $result_l && $result_r);
    }

}

$context = new InterpreterContext();
$literal = new LiteralExpression('four');
$literal->interpret($context);
print $context->lookup($literal) . '<br />';

$myvar = new variableExpression('input', 'four');
$myvar->interpret($context);
print $context->lookup($myvar) . '<br />';

$newvar = new variableExpression('input');
$newvar->interpret($context);
print $context->lookup($newvar) . '<br />';

$myvar->setValue('five');
$myvar->interpret($context);
print $context->lookup($myvar) . '<br />';
print $context->lookup($newvar) . '<br />';

$input = new variableExpression('input');
$statement = new BooleanOrExpression(new EqualsExpression($input, new LiteralExpression('four')), new EqualsExpression($input, new LiteralExpression('4')));
