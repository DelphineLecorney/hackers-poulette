<?php
include('connect.php');

$name = $_POST['name'];
$firstname = $_POST['firstname'];
$addressEmail = $_POST['addressEmail'];
$confirmAddressEmail = $_POST['confirmAddressEmail'];
$concerns = $_POST['concerns'];
$description = $_POST['description'];
$fileName = $_FILES['files']['name'];

$to = $addressEmail;
$subject = "Form Submission Confirmation";
$message = "Thank you for submitting the form!";
$headers = "From: lecorney.delphine@gmail.com";


if (mail($to, $subject, $message, $headers)) {
    echo "Confirmation email sent.";
} else {
    echo "Failed to send confirmation email.";
}
?>
