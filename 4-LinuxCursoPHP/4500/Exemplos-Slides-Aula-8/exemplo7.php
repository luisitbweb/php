<?php
 
$dexter = array('admin',
   			    'include',
   			    'template', 
   				 array('backend',
   					   'frontend')
		        );

$string = serialize($dexter);
echo $string.'<hr/>';

$buscar = array_search('template', $dexter);
echo "O índice $buscar, contém 'template'.";