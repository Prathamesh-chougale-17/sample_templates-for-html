<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $to = 'contact@example.com';
  $from_name = $_POST['name'];
  $from_email = $_POST['email'];
  $subject = 'New table booking request from the website';
  $message = "Name: $from_name\nEmail: $from_email\nPhone: {$_POST['phone']}\nDate: {$_POST['date']}\nTime: {$_POST['time']}\nNumber of People: {$_POST['people']}\nMessage: {$_POST['message']}";

  $headers = "From: $from_name <$from_email>";

  if (mail($to, $subject, $message, $headers)) {
    echo 'success';
  } else {
    echo 'error';
  }
}
?>