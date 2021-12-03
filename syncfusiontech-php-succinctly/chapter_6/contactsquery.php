<?php

  function ContactsDataSet()
  {
     $dbhost = 'localhost';
     $dbuser = 'luisitb';
     $dbpass = '$tr@wb3rry';
     $database = 'contactinfo';
     $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $database);

     if ($mysqli->connect_errno) {
		 return null;
     }

     $sql = "SELECT contacts.* FROM contacts ORDER BY contacts.name";
     $resultset = $mysqli->query($sql);
     $mysqli->close();

     return $resultset;
  }