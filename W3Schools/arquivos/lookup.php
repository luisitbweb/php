<html>
<head>
 <title> Stock Quote from NASDAQ</title>
</head>
<body>
<?php
  // escolhe uma acao da bolsa para ver 

$symbol = 'AMZN';
echo "<h1> Stock Quote for $symbol</h1>";

$theurl ='http://www.cambionet.com/site/cotacoes.php?utm_source=DZ-Google&utm_medium=DZ-Ads&utm_content=Dolar&utm_campaign=Cotacao&gclid=CLm1wOqqlMQCFQ0bgQode4kAvQ';

if(!($fp = fopen($theurl, 'r')))
{
  echo 'Could not open URL';
  exit;
}

$contents = fread($fp, 1000000);
fclose($fp);

// echo $contents;

// localiza a parte da pagina que desejamos e gera sua saida

$pattern = "(\\\$[0-9]+\\.[0-9]+)";

if(eregi($pattern, $contents, $quote))
{
  echo "$symbol was last sold at: ";
  echo $quote[1];
}
 else 
{
 echo ' No quote available';
}

// reconhece a fonte

echo '<br />'

 .' This information retrieved from <br />'
 ."<a href=\"$theurl\">$theurl</a><br />"
 .'on' .(date('l jS F Y g:i a T'));
?>
</body>
</html>
