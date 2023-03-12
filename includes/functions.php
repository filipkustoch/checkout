<?php 
// funckja walidująca imię
function validateFirstname($firstname) {
    $nameRegex = '/^[a-zA-Z]+$/';
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
    $nameRegex = '/^[a-zA-Z]+$/';
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
?>