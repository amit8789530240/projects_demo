<?php
session_start();
?>

<?php
function test_input($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
$servername="localhost";
$username="root";
$password="";
$dbname="hospital_management";

$conn=new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error)
{
    die("unable to access remote database");
}
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $pid=test_input($_POST['pid']);

    $command="DELETE FROM patient_table WHERE patient_id='$pid'";
    $command2="DELETE FROM password_table WHERE user_id='$pid'";
    if($conn->query($command)===TRUE  && $conn->query($command2)===TRUE)
    {
        $conn->close();
        echo "<script>history.back()</script>";
    }
    else{
        $conn->close();
        echo "<script>if(confirm('failed to acces remote database'))history.back();else history.back()</script>";
    }
}
?>


