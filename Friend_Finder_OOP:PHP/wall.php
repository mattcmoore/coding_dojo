<?php
	session_start();

	if(!isset($_SESSION['logged_in']))
	{
		header("Location: index.php");
	}
?>

<h3>Welcome <?= $_SESSION['user_info'][0]['first_name'] ." " . $_SESSION['user_info'][0]['last_name'] ?>!</h3>

<a href="process.php">Log Off</a>

<h3>List Of Friends</h3>
<table id="friends_display" border= 1px>
	<tr>
		<th>Name</th>
		<th>Email</th>
	</tr>

<?php
// var_dump($_SESSION['display_friends']);
	foreach($_SESSION['display_friends'] as $friend){
		echo "<tr>
				<td>".$friend['first_name']." ".$friend['last_name']."</td>
				<td>".$friend['email']."</td>
			</tr>";
	}
?>
</table>

<h3> List Of Users Subscribed To Friend Finder </h3>
<table id="users_display" border= 1px>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Action</th>
	</tr>
<?php
	for($i=0;$i<count($_SESSION['users']);$i++){
			//if statement to exclude logged in user from the list
		if($_SESSION['users'][$i]['id'] != $_SESSION['user_info']['id']){
			echo "<tr> 
					<td>".$_SESSION['users'][$i]['first_name']." ".$_SESSION['users'][$i]['last_name']."</td>
					<td>".$_SESSION['users'][$i]['email']."</td>";	
					//foreach loops through logged in users friends  
			foreach($_SESSION['display_friends'] as $friend){
					//if statement looks for a match between each logged in users friend's user id and the user assigned to each row's user id 
				if($friend['id']!=$_SESSION['users'][$i]['id']){
					// echo "<td>".$_SESSION['users'][$i]['id']."</td>";
					$action = "<td>
							<form action='process.php' method='POST'>
								<input type= 'hidden' name='friend_id' value =".$_SESSION['users'][$i]['id']." 
								<input type= 'hidden' name='action' value='add_friend'/>
								<input type= 'submit' value= 'Add Friend'/>
							</form>
						</td>";
				}
				else{
					$action = "<td>Friend</td>";
				}
			}//end foreach
				echo $action;
				echo"</tr>";
		}//end if
	}// end for				
// var_dump($_SESSION['users'][0]);
// echo "</pre>";
?>
</table>