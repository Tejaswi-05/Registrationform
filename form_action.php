<?php require_once("config.php");
if(isset($_POST['form_submit']))
{
	$name=trim($_POST['name']);
	$address=trim($_POST['address']);
	$email=trim($_POST['email']);
    $relation=trim($_POST['relation']);
	$personname=trim($_POST['personname']);
    $source=trim($_POST['source']);
    $income=trim($_POST['income']);
	$sql="INSERT into application(name,address,email,relation,personname,source,income) VALUES(:name,:address,:email,:relation,:personname,:source,:income)";
	$stmt = $db->prepare($sql);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':address', $address, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':relation', $relation, PDO::PARAM_STR);
      $stmt->bindParam(':personname', $personname, PDO::PARAM_STR);
      $stmt->bindParam(':source', $source, PDO::PARAM_STR);
      $stmt->bindParam(':income', $income, PDO::PARAM_STR);
      $stmt->execute();
      $last_id = $db->lastInsertId();
      if($last_id!='')
      {
    header("location:preview.php?id=".$name);
      }
      else 
      {
      	echo 'Something went wrong';
      }
}
?> 