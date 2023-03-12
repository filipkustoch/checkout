<?php 
include "db.php";
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$country = $_POST['country'];
$address = $_POST['address'];
$postcode = $_POST['postcode'];
$city = $_POST['city'];
$phonenumber = $_POST['phonenumber'];
$stmt = $connection->prepare("INSERT INTO zamowienia (imie, nazwisko, kraj, adres, kod_pocztowy, miasto, telefon) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$firstname, $lastname, $country, $address, $postcode, $city, $phonenumber]);
?>