<?php

echo <<<opt
<table border="1" style="text-align: left">
    <caption>Table 4: PHP Arithmetic Operators Summary</caption>
    <thead>
        <tr style="text-align: center">
            <th>Operator</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>+</td>
            <td>Adds the values of two operands</td>
        </tr>
        <tr>
            <td>-</td>
            <td>Subtracts the value of the second operant from the first one</td>
        </tr>
        <tr>
            <td>*</td>
            <td>Multiplies two operands</td>
        </tr>
        <tr>
            <td>/</td>
            <td>Divides a numerator operand (placed at the left) by a de-numerator operand (placed at the right)</td>
        </tr>
        <tr>
            <td>%</td>
            <td>Gets the remainder of an integer division between two operands</td>
        </tr>
        <tr>
            <td>++</td>
            <td>Increases the value of an integer operator by 1</td>
        </tr>
        <tr>
            <td>--</td>
            <td>Decreases the value of an integer operator by 1</td>
        </tr>
    </tbody>
</table>

<br />

<table border="1" style="text-align: left">
    <caption>Table 5: PHP Comparison Operators Summary</caption>
    <thead>
        <tr style="text-align: center">
            <th>Operator</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>==</td>
            <td>Checks if the value of two operands are equal</td>
        </tr>
        <tr>
            <td>!=</td>
            <td>Checks if the value of the operand placed at the left is not equal to the value of the operand placed at the right</td>
        </tr>
        <tr>
            <td>></td>
            <td>Checks if the value of the operand placed at the left is greater than the value of the operand placed at the right</td>
        </tr>
        <tr>
            <td><</td>
            <td>Checks if the value of the operand placed at the left is less than the value of the operand placed at the right</td>
        </tr>
        <tr>
            <td>>=</td>
            <td>Checks if the value of the operand placed at the left is greater than or equal to the value of the operand placed at the right</td>
        </tr>
        <tr>
            <td><=</td>
            <td>Checks if the value of the operand placed at the left is less than or equal to the value of the operand placed at the right</td>
        </tr>
    </tbody>
</table>

<br />

<table border="1" style="text-align: left">
    <caption>Table 6: Logical Operators Summary</caption>
    <thead>
        <tr style="text-align: center">
            <th>Operator</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>and</td>
            <td>Logical AND. Returns true if both operands are true.</td>
        </tr>
        <tr>
            <td>or</td>
            <td>Logical OR. Returns true if any of the two operands is true.</td>
        </tr>
        <tr>
            <td>xor</td>
            <td>Returns true if any of the two operands are true, but not both.</td>
        </tr>
        <tr>
            <td>&&</td>
            <td>Logical AND. Returns true if both operands are true.</td>
        </tr>
        <tr>
            <td>||</td>
            <td>Logical OR. Returns true if any of the two operands is true.</td>
        </tr>
        <tr>
            <td>!</td>
            <td>Logical NOT. Reverses the logical state of its operand; if the operand is true, it becomes false, and vice versa.</td>
        </tr>
    </tbody>
</table>

<br />

<table border="1" style="text-align: left">
    <caption>Table 7: Assignment Operators Summary</caption>
    <thead>
        <tr style="text-align: center">
            <th>Operator</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>=</td>
            <td>The simple assignment operator. Stores values from the right side to the left-side operand.</td>
        </tr>
        <tr>
            <td>+=</td>
            <td>Add and assign operator. Adds the value of the operand placed at the right side to the value of the operand placed at the left, then assigns the result to the left operand.</td>
        </tr>
        <tr>
            <td>-=</td>
            <td>Subtract and assign operator. Subtracts the value of the operand placed at the right side from the value of the operand placed at the left, then assigns the result to the left operand.</td>
        </tr>
        <tr>
            <td>*=</td>
            <td>Multiply and assign operator. Multiplies the value of the operand placed at the right side by the value of the operand placed at the left, then assigns the result to the left operand.</td>
        </tr>
        <tr>
            <td>/=</td>
            <td>Divide and assign operator. Divides the value of the operand placed at the left side by the value of the operand placed at the right, then assigns the result to the left operand.</td>
        </tr>
        <tr>
            <td>%/</td>
            <td>Modulus and assign operator. Divides the value of the operand placed at the left side by the value of the operand placed at the right, then assigns the remainder to the left operand.</td>
        </tr>
    </tbody>
</table>

<p>The conditional operator (expressed as ? :) performs an inline decision-making process. It evaluates the logical state of an expression placed at the left side of the ? sign, and then executes one of two given expressions, both separated by the : sign. If the logical state of the expression is true, the expression placed at the left side of the : sign is executed; otherwise, the right-side expression is performed. The following code sample illustrates this.</p>

<p>This expression will perform three kind of operations: subtraction, multiplication, and assignment. The important thing to find out here is the order in which the computer will execute the operations. This depends on the operators’ precedence.
To get a better understanding of operator precedence, we should classify the operators into the following categories.</p>

<ol style="list-style-type: disc">
    <li>Unary operators: Operators that precede a single operand</li>
    <li>Binary operators: Operators that take two operands</li>
    <li>Ternary operators: Operators that take three operands and evaluate either the second or the third operand, depending on the value of the first one</li>
    <li>Assignment operators: Operators that assign a value to an operand</li>
</ol>

<p>Taking these categories into account, the following table dictates the order in which operators are executed within an expression, from top to bottom.</p>

<table border="1" style="text-align: left">
    <caption>Table 8: Operator Precedence Table</caption>
    <thead>
        <tr style="text-align: center">
            <th>Associativity</th>
            <th>Operator</th>
            <th>Additional Information</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>non-associative</td>
            <td>clone new</td>
            <td>clone and new</td>
        </tr>
        <tr>
            <td>left</td>
            <td>[</td>
            <td>array()</td>
        </tr>
        <tr>
            <td>right</td>
            <td>**</td>
            <td>arithmetic</td>
        </tr>
        <tr>
            <td>right</td>
            <td>++ -- ~ (int) (float) (string) (array) (object) (bool) @</td>
            <td>types and increment/decrement</td>
        </tr>
        <tr>
            <td>non-associative</td>
            <td>instanceof</td>
            <td>types</td>
        </tr>
        <tr>
            <td>right</td>
            <td>!</td>
            <td>logical</td>
        </tr>
        <tr>
            <td>left</td>
            <td>* / %</td>
            <td>arithmetic</td>
        </tr>
        <tr>
            <td>left</td>
            <td>+ - .</td>
            <td>arithmetic and string</td>
        </tr>
        <tr>
            <td>left</td>
            <td><< >></td>
            <td>bitwise</td>
        </tr>
        <tr>
            <td>non-associative</td>
            <td>< <= > >=</td>
            <td>comparison</td>
        </tr>
        <tr>
            <td>non-associative</td>
            <td>== != === !== <> <=></td>
            <td>comparison</td>
        </tr>
        <tr>
            <td>left</td>
            <td>&</td>
            <td>bitwise and references</td>
        </tr>
        <tr>
            <td>left</td>
            <td>^</td>
            <td>bitwise</td>
        </tr>
        <tr>
            <td>left</td>
            <td>|</td>
            <td>bitwise</td>
        </tr>
        <tr>
            <td>left</td>
            <td>&&</td>
            <td>logical</td>
        </tr>
        <tr>
            <td>left</td>
            <td>||</td>
            <td>logical</td>
        </tr>
        <tr>
            <td>right</td>
            <td>??</td>
            <td>comparison</td>
        </tr>
        <tr>
            <td>left</td>
            <td>?:</td>
            <td>ternary</td>
        </tr>
        <tr>
            <td>right</td>
            <td>= += -= *= **= /= .= %= &= |= ^= <<= >>=</td>
            <td>assignment</td>
        </tr>
        <tr>
            <td>left</td>
            <td>and</td>
            <td>logical</td>
        </tr>
        <tr>
            <td>left</td>
            <td>xor</td>
            <td>logical</td>
        </tr>
        <tr>
            <td>left</td>
            <td>or</td>
            <td>logical</td>
        </tr>
    </tbody>
</table>

<p>Like “Welcome to PHP Succinctly e-book samples”, that can be assigned to a variable or processed directly by a PHP statement.</p>
opt;

$salutation = 'Good morning';
echo $salutation . ", today is " . date("l F jS \of Y") . "<br />";

echo <<<op
<p>A string may be delimited either by single (‘) or double (“) quotes, but there’s a big difference in how the strings are treated, depending on the delimiter employed. Strings delimited with single quotes are treated literally, while double-quoted strings re"place variables with their values in case a string contains variable names within it. Also, double-quoted strings interpret certain character sequences that begin with the backslash (\), also known as escape-sequence replacements. These sequences are summarized in the following table.</p>

<table border="1" style="text-align: left">
    <caption>Table 9: Escape Sequence Replacements Summary</caption>
    <thead>
        <tr style="text-align: center">
            <th>Escape Sequence</th>
            <th>Replacement</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>\\n</td>
            <td>Replaced with the newline character</td>
        </tr>
        <tr>
            <td>\\r</td>
            <td>Replaced with the carriage-return character</td>
        </tr>
        <tr>
            <td>\\t</td>
            <td>Replaced with the tab character</td>
        </tr>
        <tr>
            <td>\\$</td>
            <td>Replaced with the dollar sign itself. This avoids the interpretation of the dollar sign as the variable name starting character.</td>
        </tr>
        <tr>
            <td>\"</td>
            <td>Replaced by a single double-quote</td>
        </tr>
        <tr>
            <td>\'</td>
            <td>Replaced by a single quote</td>
        </tr>
        <tr>
            <td>\\\</td>
            <td>Replaced by a backslash</td>
        </tr>
    </tbody>
</table>
op;
