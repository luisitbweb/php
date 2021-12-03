<?php

$email = 'email@dominio.com.br';
$assunto = 'senha';
$messagem = "Olá aluno\n
             Este e-mail serve para lembrá-lo...\n
             Programação se aprende digitando códigos!";
if (mail($email,$assunto,$messagem)){
	echo 'Sucesso no envio!';
}