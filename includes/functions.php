<?php 
// funckja walidująca imię
function validateFirstname($firstname) {
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

function validateLastname($lastname) {
    $nameRegex = '/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/';
    $trimmedLastname = trim($lastname);

    if(!preg_match($nameRegex,$trimmedLastname)){
        return 'Nazwisko powinno zawierać tylko litery.';
    } else {
        $firstSpaceIndex = strpos($trimmedLastname, ' ');
        if ($firstSpaceIndex !== false) {
            $trimmedLastname = substr($trimmedLastname, 0, $firstSpaceIndex);
          }
          return $trimmedLastname;
    }
}

function validateAddress($address) {
    GLOBAL $connection;
    $trimmedAddress = trim($address);
  
    // ucieczka znaków specjalnych SQL
    $escapedAddress = mysqli_real_escape_string($connection, $trimmedAddress);
  
    // zamiana znaków specjalnych HTML na ich encje
    $escapedAddress = htmlspecialchars($escapedAddress, ENT_QUOTES, 'UTF-8');
  
    return $escapedAddress;
  }
  
function validatePostCode($postCode) {
  // usuwamy spacje z początku i końca ciągu
$postcode = trim($postCode);

// sprawdzamy, czy kod pocztowy ma co najmniej 5 znaków
if (strlen($postcode) < 5) {
  return "Kod pocztowy musi składać się z co najmniej 5 znaków";
} else {
  return $postcode;
}
}
?>