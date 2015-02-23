<?php
    require("connection.php");

    // var_dump($_POST);
    // die();
    if ($_POST['from_date']!="")
     {
      $from_date=date("Y-m-d", strtotime($_POST['from_date']));


    }
    else
    {
      $from_date="1950-01-13 14:22:58";
    }
    $data = array();


    if($_POST['to_date']!="")
    {
      $to_date=date("Y-m-d", strtotime($_POST['to_date']));
    }
    else
    {
      $to_date="2950-01-13 14:22:58";
    }

      // var_dump($from_date);
    $query = "SELECT * FROM leads 
WHERE (first_name LIKE '{$_POST['name']}%' OR last_name LIKE '{$_POST['name']}%') and registered_datetime > '{$from_date}' and registered_datetime < 
    '{$to_date}' ";
    // var_dump($query);
// echo $query;
  
    $date_time= date("Y-m-d", strtotime($_POST['from_date']));
    $date_time_two= date("Y-m-d", strtotime($_POST['to_date']));
    $users = fetch_all($query);
var_dump($users);
// var_dump($users[1]['first_name']);
  $html = NULL;
  $num = 10;
  $pages = ceil(count($users)/$num);
  // die();
  for($i=0;$i<$pages;$i++){
    $html.="<div id= '".$i."'>
            <thead>
                  <tr>
                      <th>leads_id</th>
                      <th>first_name</th>
                      <th>last_name</th>
                      <th>registered_datetime</th>
                      <th>email</th>
                  </tr> 
             </thead>
               <tbody>
               ";
    $val=0;          
    for($j=1;$j<10;$j++){
      $val = ($i * $num + $j)-1;
      echo $users[$val]['first_name'];
      echo "----";

    };
  };

  // foreach($users as $user)
  // {
  //    $html = "
  //    <table border='1'>
  //         <thead>
  //              <tr>
  //                  <th>leads_id</th>
  //                  <th>first_name</th>
  //                  <th>last_name</th>
  //                  <th>registered_datetime</th>
  //                  <th>email</th>
  //              </tr> 
  //         </thead>
  //         <tbody>


  //    ";}

  //    foreach($users as $user)
  //    {
  //    	$html .= "
  //    	     <tr>
  //               <td>{$user['leads_id']}</td>
  //               <td>{$user['first_name']}</td>
  //               <td>{$user['last_name']}</td>
  //               <td>{$user['registered_datetime']}</td>
  //               <td>{$user['email']}</td>
  //               <td>{$user['leads_id']}</td>
  //    	     </tr>
  //    	     ";
  //    }

     $html .="

          </tbody>
        </table>
        </div>
    ";



    $data['html'] = $html;
    echo json_encode($data);
?>