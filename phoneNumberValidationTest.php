<?php
use PHPUnit\Framework\TestCase;

require_once 'includes/functions.php';

class PhoneNumberValidationTest extends TestCase
{
  public function testPhoneNumberValidation()
  {
    // Testowanie poprawnego numeru telefonu
    $this->assertEquals('123456789', validatePhoneNumber(' 123456789 '));

    // Testowanie numeru telefonu zawierającego znaki niebędące cyframi
    $this->assertEquals('Numer telefonu powinien składać się tylko z cyfr.', validatePhoneNumber('1234 56789'));

    // Testowanie numeru telefonu o nieprawidłowej długości
    $this->assertEquals('Numer telefonu powinien mieć minimum 9 cyfr.', validatePhoneNumber('12345678'));
  }
}
?>
