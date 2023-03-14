<?php
// funckja walidująca imię
function validateFirstname($firstname)
{
  $nameRegex = '/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/';
  $trimmedFirstname = trim($firstname);

  if (!preg_match($nameRegex, $trimmedFirstname)) {
    return 'Imię powinno zawierać tylko litery.';
  } else {
    $firstSpaceIndex = strpos($trimmedFirstname, ' ');
    if ($firstSpaceIndex !== false) {
      $trimmedFirstname = substr($trimmedFirstname, 0, $firstSpaceIndex);
    }
    return $trimmedFirstname;
  }
}

function validateLastname($lastname)
{
  $nameRegex = '/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/';
  $trimmedLastname = trim($lastname);

  if (!preg_match($nameRegex, $trimmedLastname)) {
    return 'Nazwisko powinno zawierać tylko litery.';
  } else {
    $firstSpaceIndex = strpos($trimmedLastname, ' ');
    if ($firstSpaceIndex !== false) {
      $trimmedLastname = substr($trimmedLastname, 0, $firstSpaceIndex);
    }
    return $trimmedLastname;
  }
}

function validateAddress($address)
{
  global $connection;
  $trimmedAddress = trim($address);

  // ucieczka znaków specjalnych SQL
  $escapedAddress = mysqli_real_escape_string($connection, $trimmedAddress);

  // zamiana znaków specjalnych HTML na ich encje
  $escapedAddress = htmlspecialchars($escapedAddress, ENT_QUOTES, 'UTF-8');

  return $escapedAddress;
}

function validatePostCode($postCode)
{
  // usuwamy spacje z początku i końca ciągu
  $postcode = trim($postCode);

  // sprawdzamy, czy kod pocztowy ma co najmniej 5 znaków
  if (strlen($postcode) < 5) {
    return "Kod pocztowy musi składać się z co najmniej 5 znaków";
  } else {
    return $postcode;
  }
}

function validateCity($city)
{
  $city = trim($city);
  // Sprawdzenie, czy miasto zostało podane
  if (empty($city)) {
    return "Proszę podać miasto.";
  }
  // Sprawdzenie, czy miasto składa się tylko z liter i białych znaków
  if (!preg_match("/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ\s-]+$/", $city)) {
    return "Miasto powinno składać się tylko z liter.";
  }
  // Sprawdzenie, czy miasto ma co najmniej 2 znaki
  if (strlen($city) < 2) {
    return "Miasto powinno mieć co najmniej 2 litery.";
  }
  return $city;
}

function validatePhoneNumber($phonenumber)
{
  // Usunięcie białych znaków na początku i końcu
  $phonenumber = trim($phonenumber);

  // Sprawdzenie, czy wartość zawiera tylko cyfry
  if (!ctype_digit($phonenumber)) {
    return "Numer telefonu powinien składać się tylko z cyfr.";
  }

  // Sprawdzenie minimalnej długości
  else if (strlen($phonenumber) < 9) {
    return "Numer telefonu powinien mieć minimum 9 cyfr.";
  } else {
    return $phonenumber;
  }
}
?>