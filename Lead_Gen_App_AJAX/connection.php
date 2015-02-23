<?php
  //connection page
  session_start();
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "root";
  $dbname = "leads_db";

  $connection =  mysql_connect($dbhost, $dbuser, $dbpass) or die("Error in connection");
  $db_selected = mysql_select_db($dbname, $connection) or die("Could not connect");


  function fetch_all($query)
  {
    $data = array();

    $result = mysql_query($query);
    while($row = mysql_fetch_assoc($result))
    {
      $data[] = $row;
    }

    return $data;
  }

  function fetch_record($query)
  {
    $result = mysql_query($query);

    return mysql_fetch_assoc($result);
  }

?>