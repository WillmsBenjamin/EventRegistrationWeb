<?php

require_once 'controller/Controller.php';

session_start();
$_SESSION["errorEventName"] = "";
$_SESSION["errorEventDate"] = "";
$_SESSION["errorEventStart"] = "";
$_SESSION["errorEventEnd"] = "";
$c = new Controller();
try {
	$eventName = NULL;
	if (isset($_POST['event_name'])) {
		$eventName = $_POST['event_name'];
	}
	$eventDate = NULL;
	if (isset($_POST['event_date'])) {
		$eventDate = $_POST['event_date'];
	}
	$eventStart = NULL;
	if (isset($_POST['event_start'])) {
		$eventStart = $_POST['event_start'];
	}
	$eventEnd = NULL;
	if (isset($_POST['event_end'])) {
		$eventEnd = $_POST['event_end'];
	}
	$c->createEvent($eventName, $eventDate, $eventStart, $eventEnd);
} catch (Exception $e) {
	$errors = explode("@", $e->getMessage());
	foreach ($errors as $error) {
		if (substr($error, 0, 1) == "1") {
			$_SESSION["errorEventName"] = substr($error, 1);
		}
		if (substr($error, 0, 1) == "2") {
			$_SESSION["errorEventDate"] = substr($error, 1);
		}
		if (substr($error, 0, 1) == "3") {
			$_SESSION["errorEventStart"] = substr($error, 1);
		}
		if (substr($error, 0, 1) == "4") {
			$_SESSION["errorEventEnd"] = substr($error, 1);
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=/EventRegistration/" />
	</head>
</html>
