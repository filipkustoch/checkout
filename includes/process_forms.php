<?php
include "db.php";
include "functions.php";

// sanitize wartości przesyłanych z formularza
$firstname = htmlspecialchars($_POST['firstname'], ENT_QUOTES);
$lastname = htmlspecialchars($_POST['lastname'], ENT_QUOTES);
$country = htmlspecialchars($_POST['country'], ENT_QUOTES);
$address = htmlspecialchars($_POST['address'], ENT_QUOTES);
$postcode = htmlspecialchars($_POST['postcode'], ENT_QUOTES);
$city = htmlspecialchars($_POST['city'], ENT_QUOTES);
$phonenumber = htmlspecialchars($_POST['phonenumber'], ENT_QUOTES);
$delivery_method = htmlspecialchars($_POST['delivery_method'], ENT_QUOTES);
$payment_method = htmlspecialchars($_POST['payment_method'], ENT_QUOTES);
$comment = htmlspecialchars($_POST['comment'], ENT_QUOTES);
$amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$listOfProducts = htmlspecialchars($_POST['listOfProducts'], ENT_QUOTES);
// Inny adres
$firstname_alt = htmlspecialchars($_POST['firstname_alt'], ENT_QUOTES);
$lastname_alt = htmlspecialchars($_POST['lastname_alt'], ENT_QUOTES);
$country_alt = htmlspecialchars($_POST['country_alt'], ENT_QUOTES);
$address_alt = htmlspecialchars($_POST['address_alt'], ENT_QUOTES);
$postcode_alt = htmlspecialchars($_POST['postcode_alt'], ENT_QUOTES);
$city_alt = htmlspecialchars($_POST['city_alt'], ENT_QUOTES);
$phonenumber_alt = htmlspecialchars($_POST['phonenumber_alt'], ENT_QUOTES);
$newsletter = $_POST['newsletter'];


// Nadpisywanie jeżeli nie są puste pola
$alternateFields = array(
  'firstname' => $firstname_alt,
  'lastname' => $lastname_alt,
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
$query = "INSERT INTO zamowienia (imie, nazwisko, kraj, adres, kod_pocztowy, miasto, telefon, dostawa, platnosc, komentarz, kwota, lista, newsletter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $connection->prepare($query);
$stmt->execute([$validatedFirstname, $validatedLastname, $country, $validatedAddress, $validatedPostcode, $validatedCity, $validatedPhoneNumber, $delivery_method, $payment_method, $comment, $amount, $listOfProducts, $newsletter]);

// zwrócenie numeru zamówienia i kwoty
echo mysqli_insert_id($connection) . " na kwotę " . $amount . " zł";
?>