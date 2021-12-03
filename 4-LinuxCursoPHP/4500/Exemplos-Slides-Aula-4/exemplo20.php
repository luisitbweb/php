<?php
   
$infra = array(
 			  'L' => 'Linux',
		      'A' => 'Apache',
		      'M' => 'MySQL',
		      'P' => 'PHP');

echo "{$infra['M']}<hr/>";   
$infra['M'] = 'PostgreSQL';
echo $infra['M'];