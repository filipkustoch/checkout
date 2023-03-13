<?php
include "db.php";
include "functions.php";

// sanitize wartości przesyłanych z formularza
$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
$country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
$postcode = filter_var($_POST['postcode'], FILTER_SANITIZE_STRING);
$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
$phonenumber = filter_var($_POST['phonenumber'], FILTER_SANITIZE_STRING);
$delivery_method = filter_var($_POST['delivery_method'], FILTER_SANITIZE_STRING);
$payment_method = filter_var($_POST['payment_method'], FILTER_SANITIZE_STRING);
$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
$amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

$errors = [];
// walidacja $firstname
$validatedFirstname = validateFirstname($firstname);
if (is_string($validatedFirstname)) {
  $errors[] = $validatedFirstname;
}

//walidacja $lastname
$validatedLastname = validateLastname($lastname);
if (is_string($validatedLastname)) {
  $errors[] = $validatedLastname;
}

//walidacja $address
$validatedAddress = validateAddress($address);


// sprawdzenie wartości liczbowych pola "amount"
if (!is_numeric($amount) || $amount <= 0) {
    die("Nieprawidłowa wartość pola 'amount'");
  }

// przygotowanie zapytania SQL
$query = "INSERT INTO zamowienia (imie, nazwisko, kraj, adres, kod_pocztowy, miasto, telefon, dostawa, platnosc, komentarz, kwota) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $connection->prepare($query);
$stmt->execute([$validatedFirstname, $validatedLastname, $country, $validatedAddress, $postcode, $city, $phonenumber, $delivery_method, $payment_method, $comment, $amount]);

// zwrócenie numeru zamówienia i kwoty
echo mysqli_insert_id($connection) . " na kwotę " . $amount . " zł";
?>