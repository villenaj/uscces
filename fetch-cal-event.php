<?php

//load.php
$connect = new PDO('mysql:host=localhost;dbname=epiz_33767114_uscces', 'root', '');

$data = array();

$query = "SELECT * FROM tblevent ORDER BY event_id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["event_id"],
  'title'   => $row["event_name"],
  'start'   => $row["date_start"],
  'end'   => $row["date_end"],
  'user_id' =>$row["user_id"]
 );
}

echo json_encode($data);

?>