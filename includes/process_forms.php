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
$listOfProducts = filter_var($_POST['listOfProducts'], FILTER_SANITIZE_STRING);
// Inny adres
$country_alt = filter_var($_POST['country_alt'], FILTER_SANITIZE_STRING);
$address_alt = filter_var($_POST['address_alt'], FILTER_SANITIZE_STRING);
$postcode_alt = filter_var($_POST['postcode_alt'], FILTER_SANITIZE_STRING);
$city_alt = filter_var($_POST['city_alt'], FILTER_SANITIZE_STRING);
$phonenumber_alt = filter_var($_POST['phonenumber_alt'], FILTER_SANITIZE_STRING);

// Nadpisywanie jeżeli nie są puste pola
$alternateFields = array(
  'country' => $country_alt,
  'address' => $address_alt,
  'postcode' => $postcode_alt,
  'city' => $city_alt,
  'phonenumber' => $phonenumber_alt
);

foreach ($alternateFields as $key => $value) {
  if (!empty($value)) {
    $$key = $value;
  }
}

// walidacja $firstname
$validatedFirstname = validateFirstname($firstname);

//walidacja $lastname
$validatedLastname = validateLastname($lastname);

//walidacja $address
$validatedAddress = validateAddress($address);

//walidacja $postcode
$validatedPostcode = validatePostCode($postcode);

//walidacja $city
$validatedCity = validateCity($city);

//walidacja $phonenumber
$validatedPhoneNumber = validatePhoneNumber($phonenumber);

// sprawdzenie wartości liczbowych pola "amount" czyli ceny
if (!is_numeric($amount) || $amount <= 0) {
    die("Nieprawidłowa wartość pola 'amount'");
  }

// przygotowanie zapytania SQL
$query = "INSERT INTO zamowienia (imie, nazwisko, kraj, adres, kod_pocztowy, miasto, telefon, dostawa, platnosc, komentarz, kwota,lista) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $connection->prepare($query);
$stmt->execute([$validatedFirstname, $validatedLastname, $country, $validatedAddress, $validatedPostcode, $validatedCity, $validatedPhoneNumber, $delivery_method, $payment_method, $comment, $amount, $listOfProducts]);

// zwrócenie numeru zamówienia i kwoty
echo mysqli_insert_id($connection) . " na kwotę " . $amount . " zł";
?>