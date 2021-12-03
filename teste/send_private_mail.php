<?php
 // cria nome de variavel abreviado 

$from = $HTTP_POST_VARS['from'];
$title = $HTTP_POST_VARS['title'];
$body = $HTTP_POST_VARS['body'];
$to_email = 'luke@localhost';

// diz ao gpg onde encontrar o chaveiro
// nesse sistema, o diretorio inicial do usuario nobody e 

tmp/putenv('GNUPGHOME=/tmp/.gnupg');

// cria um nome de arquivo unico

$infile = tempnam('','pgp');
$outfile = $infile.'.asc';

// grava o texto do usuario em um arquivo

$fp = fopen($infile, 'w');
fwrite($fp, $body);
fclose($fp);

// configura nosso comando

$command = "/usr/local/bin/gpg -a \\
            --recipient 'Luke Welling<luke@tangledweb.com.au>' \\
            --encrypt -o $outfile $infile";

// executa nosso comando gpg

system($commad, $result);

// exclui o arquivo temporario nao-encriptado

unlink($infile);

if($result ==0)
{
  $fp = fopen($outfile, 'r');
  if(!$fp || filesize ($outfile)==0)
{
  $result = -1;
}
   // le o arquivo encriptado

$contents = fread ($fp, filesize ($outfile));

// exclui o arquivo temporario encriptado

unlink($outfile);

mail ($to_mail, $title, $contents, "From: $from\n");

echo '<h1> Message Sent</h1>
      <p> Your message was encrypted and sent.</p>
      <p> Thank you. </p>';
  }

if($result!=0)
{
  echo '<h1> Error:</h1>
        <p> Your message could not be encrypted, so has not been sent.</p>
        <p> Sorry. </p>';
  }