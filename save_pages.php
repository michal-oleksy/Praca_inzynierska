<?php                
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "auth";   
$con=mysqli_connect($hostname,$username,$password,$database); 

$event_name = $_POST['event_name'];
$event_start_date = date("y-m-d", strtotime($_POST['event_start_date'])); 

$test = 'test';

// $event_end_date = date("y-m-d", strtotime($_POST['event_end_date'])); 
			
// $insert_query = "insert into `calendar_event_master`(`event_name`,`event_start_date`,`event_end_date`) values ('".$event_name."','".$event_start_date."','".$event_end_date."')";      //stary

$insert_query = "insert into `calendar_event_master`(`event_name`,`event_start_date`) values ('".$event_name."','".$event_start_date."')";

if(mysqli_query($con, $insert_query))
{
	$data = array(
                'status' => true,
                'msg' => 'Event added successfully!'
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Sorry, Event not added.'				
            );
}
echo json_encode($data);	
?>
