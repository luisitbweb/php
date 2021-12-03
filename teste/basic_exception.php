<?php
try
{
 throw new Exception(' Um erro terrrivel Ocorreu! ', 42);
}
 catch (Exception $e)
{
 echo 'Exception '.$e->getCode(). ':' .$e->getMessage()
         .'in'. $e->getFile(). ' on line '. $e->getLine().'<br />';
}