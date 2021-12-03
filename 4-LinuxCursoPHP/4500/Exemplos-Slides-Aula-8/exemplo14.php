<?php

$senha = 'Mudar123';

$md5 = md5($senha);
echo "Função MD5: $md5<hr/>";

$sha1 = sha1($senha);
echo "Função SHA1: $sha1<hr/>";

$crc32 = crc32($senha);
echo "Função crc32: $crc32<hr/>";

$hash = hash('sha1', $senha); 
echo "Hash: $hash";
#hash(md5|sha1|crc32, $senha)