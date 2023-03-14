// Funkcja pokazująca lub ukrywająca formularze w zależności od stanu checkboxa
function newAccount() {
  // Pobieramy elementy checkbox oraz kontener z formularzem
  const checkbox = document.getElementById('show-form');
  const formContainer = document.getElementById('form-container');
  const checkboxAlt = document.getElementById('show-form_alt');
  const formContainerAlt = document.getElementById('form-container_alt');

  // Dodajemy nasłuchiwanie na zmiany stanu checkboxa
  checkbox.addEventListener('change', function () {
    if (checkbox.checked) {
      // Jeśli checkbox jest zaznaczony, pokazujemy formularz
      formContainer.style.display = 'block';
      if (checkboxAlt.checked) {
        formContainerAlt.style.display = 'block';
      }
    } else {
      // W przeciwnym razie ukrywamy formularz
      formContainer.style.display = 'none';
      if (checkboxAlt.checked) {
        formContainerAlt.style.display = 'none';
      }
    }
  });

  checkboxAlt.addEventListener('change', function () {
    if (checkboxAlt.checked && checkbox.checked) {
      // Jeśli drugi checkbox jest zaznaczony i pierwszy jest też zaznaczony, pokazujemy drugi formularz
      formContainerAlt.style.display = 'block';
    } else {
      // W przeciwnym razie ukrywamy drugi formularz
      formContainerAlt.style.display = 'none';
    }
  });
}

// Wysłanie zapytania AJAX za pomocą vanilla JavaScript całego formularza

function sendData(event) {
  // Tworzenie obiektu FormData z elementu event.target, który jest formularzem
  const formData = new FormData(event.target);

  // Pobranie wartości ceny końcowej ze strony i dodanie jej do formData
  let amount = parseFloat(document.getElementById('final-price').innerHTML.replace(',', '.').replace(/[^0-9.]/g, ''));
  formData.append('amount', amount);

  // Pobranie listy produktów z atrybutu data-list elementu products-list i dodanie jej do formData
  const listOfProducts = document
    .getElementById('products-list')
    .getAttribute('data-list');
  formData.append('listOfProducts', listOfProducts);

  // Zapobiegnięcie domyślnej akcji eventu czyli wysłania formularza, która polega na przeładowaniu strony.
  event.preventDefault();

  // Utworzenie obiektu XMLHttpRequest
  let xhr = new XMLHttpRequest();

  // Otworzenie połączenia z plikiem process_forms.php, który obsługuje przetwarzanie formularza
  xhr.open('POST', 'includes/process_forms.php');

  // Obsługa zdarzenia załadowania odpowiedzi z pliku process_forms.php
  xhr.onload = function () {
    let zamowienie = xhr.responseText;

    // Zaktualizowanie elementu podziekowanie na stronie, wyświetlając numer zamówienia zwrócony przez PHP
    let podziekowanie = document.getElementById('podziekowanie');
    podziekowanie.innerHTML =
      '<p id="tekst-podziekowania">Dziękujemy za złożenie zamówienia! Twój numer zamówienia to: ' +
      zamowienie +
      '</p>';
  };

  // Wysłanie formularza za pomocą metody send i zawartości formData
  xhr.send(formData);

  // Czyszczenie formularza po wysłaniu
  event.target.reset();
}

// KOD RABATOWY

// Wyświetl pole na kod rabatowy, jeśli została wybrana metoda dostawy i metoda płatności.
function showDiscountCode() {
  // Pobranie wybranej metody dostawy i metody płatności
  const deliverySelected = document.querySelector('input[name="delivery_method"]:checked');
  const paymentSelected = document.querySelector('input[name="payment_method"]:checked');

  // Sprawdzenie, czy obie wartości są zdefiniowane
  if (deliverySelected && paymentSelected) {
    // Jeśli tak, wyświetl pole na kod rabatowy
    document.getElementById('discount-code-container').style.display = 'block';
  } else {
    // Jeśli nie, wyświetl alert z prośbą o wybranie metody dostawy i płatności
    alert('Proszę wybrać metodę dostawy i metodę płatności.');
  }
}

// zastosowanie pola rabatowego w tym przypadku na sztywno 10%
function applyDiscount() {
  let discountCode = document.getElementById('final-price');
  discountAmount = parseFloat(discountCode.innerText.replace(/[^0-9.,]/g, ''));

  roundedAmount = (discountAmount * 0.9).toFixed(2) + ' zł';
  discountCode.innerHTML = roundedAmount;
  document.getElementById('apply-discount').disabled = true;
}

// CENY DOSTAW

const deliveryPrices = document.querySelectorAll('.delivery_price');

// zapisz ceny w osobnych zmiennych
let paczkomatPrice, kurierdpdPrice, kurierdpdPobraniePrice;

deliveryPrices.forEach(function (price) {
  const priceValue = parseFloat(price.innerText.replace('zł', ''));
  if (price.id === 'paczkomat-price') {
    paczkomatPrice = priceValue;
  } else if (price.id === 'kurierdpd-price') {
    kurierdpdPrice = priceValue;
  } else if (price.id === 'kurierdpd-pobranie-price') {
    kurierdpdPobraniePrice = priceValue;
  }
});

const finalPrice = document.getElementById('final-price');
const initialPriceFloat = parseFloat(
  finalPrice.innerText.replace(/[^0-9]/g, '')
);

function changeFinalPriceDelivery() {
  const deliveryMethod = document.querySelector(
    'input[name="delivery_method"]:checked'
  ).value;

  let deliveryPrice;
  switch (deliveryMethod) {
    case 'inpost':
      deliveryPrice = paczkomatPrice;
      break;
    case 'kurierdpd':
      deliveryPrice = kurierdpdPrice;
      break;
    case 'kurierdpd_pobranie':
      deliveryPrice = kurierdpdPobraniePrice;
      break;
    default:
      deliveryPrice = 0;
  }

  const newPrice = initialPriceFloat + deliveryPrice;
  finalPrice.innerText = newPrice.toFixed(2) + ' zł';
}

const deliveryRadios = document.querySelectorAll(
  'input[name="delivery_method"]'
);
deliveryRadios.forEach(function (radio) {
  radio.addEventListener('change', changeFinalPriceDelivery);
});

// pokazywanie odpowiednich pól płatności zależnie od dostawy
function paymentMethods() {
  const deliveryMethod = document.querySelector(
    'input[name="delivery_method"]:checked'
  ).value;
  const payu = document.getElementById('payu-container');
  const zwykly = document.getElementById('zwykly-container');
  if (deliveryMethod == 'kurierdpd_pobranie') {
    payu.style.display = 'none';
    zwykly.style.display = 'none';
  } else {
    payu.style.display = 'flex';
    zwykly.style.display = 'flex';
  }
}

const radioButtons = document.querySelectorAll('input[name="delivery_method"]');
radioButtons.forEach((radioButton) => {
  radioButton.addEventListener('click', paymentMethods);
});

// walidacja imienia

const firstnameInput = document.querySelector('input[name="firstname"]');

function validateFirstnameInput() {
  const firstnameValue = firstnameInput.value.trim();
  const nameRegex = /^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/;

  if (!nameRegex.test(firstnameValue)) {
    firstnameInput.setCustomValidity('Imię powinno zawierać tylko litery.');
  } else {
    const lastSpaceIndex = firstnameValue.lastIndexOf(' ');
    if (lastSpaceIndex !== -1) {
      firstnameInput.value = firstnameValue.substring(0, lastSpaceIndex);
    }
    firstnameInput.setCustomValidity('');
  }
}

firstnameInput.addEventListener('input', validateFirstnameInput);

// walidacja nazwiska

const lastnameInput = document.querySelector('input[name="lastname"]');

function validateLastnameInput() {
  const lastnameValue = lastnameInput.value.trim();
  const lastnameRegex = /^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/;

  if (!lastnameRegex.test(lastnameValue)) {
    lastnameInput.setCustomValidity('Nazwisko powinno zawierać tylko litery.');
  } else {
    lastnameInput.setCustomValidity('');
  }
}

lastnameInput.addEventListener('input', validateLastnameInput);

// walidacja adresu

const addressInput = document.querySelector('input[name="address"]');

function validateAddressInput() {
  const addressValue = addressInput.value.trim();
  const addressRegex = /^[0-9a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ\s\.,-]+$/;

  if (!addressRegex.test(addressValue)) {
    addressInput.setCustomValidity('Wprowadź poprawny adres');
  } else {
    addressInput.setCustomValidity('');
  }
}

addressInput.addEventListener('input', validateAddressInput);

// walidacja kodu pocztowego
const postcodeInput = document.querySelector('input[name="postcode"]');

function validatePostcodeInput() {
  const postcodeValue = postcodeInput.value.trim();
  const postcodeRegex = /^[0-9-]+$/;


  if (postcodeValue.length < 5) {
    postcodeInput.setCustomValidity('Kod pocztowy musi składać się z co najmniej 5 znaków.');
  } else if (!postcodeRegex.test(postcodeValue)) {
    postcodeInput.setCustomValidity('Kod pocztowy może zawierać tylko cyfry.');
  } else {
    postcodeInput.setCustomValidity('');
  }
}

postcodeInput.addEventListener('input', validatePostcodeInput);

//walidacja miasta
const cityInput = document.querySelector('input[name="city"]');

function validateCityInput() {
  const cityValue = cityInput.value.trim();
  const cityRegex = /^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ\s-]+$/;

  if (!cityRegex.test(cityValue)) {
    cityInput.setCustomValidity('Wprowadź poprawną nazwę miasta, zawierającą tylko litery, myślniki i spacje.');
  } else {
    cityInput.setCustomValidity('');
  }
}

cityInput.addEventListener('input', validateCityInput);

//walidacja numeru telefonu 

const phoneInput = document.querySelector('input[name="phonenumber"]');

function validatePhoneInput() {
  const phoneValue = phoneInput.value.trim();
  const phoneRegex = /^[\d+\s-]{9,}$/;

  if (!phoneRegex.test(phoneValue)) {
    phoneInput.setCustomValidity('Wprowadź poprawny numer telefonu, składający się z co najmniej 9 cyfr');
  } else {
    phoneInput.setCustomValidity('');
  }
}

phoneInput.addEventListener('input', validatePhoneInput);

// walidacja alt adresu

const addressInputAlt = document.querySelector('input[name="address_alt"]');

function validateAddressInputAlt() {
  const addressValueAlt = addressInputAlt.value.trim();
  const addressRegexAlt = /^[0-9a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ\s\.,-]+$/;

  if (!addressRegexAlt.test(addressValueAlt)) {
    addressInputAlt.setCustomValidity('Wprowadź poprawny adres');
  } else {
    addressInputAlt.setCustomValidity('');
  }
}

addressInputAlt.addEventListener('input', validateAddressInputAlt);

// walidacja alt kodu pocztowego
const postcodeInputAlt = document.querySelector('input[name="postcode_alt"]');

function validatePostcodeInputAlt() {
  const postcodeValueAlt = postcodeInputAlt.value.trim();
  const postcodeRegexAlt = /^[0-9-]+$/;


  if (postcodeValueAlt.length < 5) {
    postcodeInputAlt.setCustomValidity('Kod pocztowy musi składać się z co najmniej 5 znaków.');
  } else if (!postcodeRegexAlt.test(postcodeValueAlt)) {
    postcodeInputAlt.setCustomValidity('Kod pocztowy może zawierać tylko cyfry.');
  } else {
    postcodeInputAlt.setCustomValidity('');
  }
}

postcodeInputAlt.addEventListener('input', validatePostcodeInputAlt);

//walidacja alt miasta
const cityInputAlt = document.querySelector('input[name="city_alt"]');

function validateCityInputAlt() {
  const cityValueAlt = cityInputAlt.value.trim();
  const cityRegexAlt = /^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ\s-]+$/;

  if (!cityRegexAlt.test(cityValueAlt)) {
    cityInputAlt.setCustomValidity('Wprowadź poprawną nazwę miasta, zawierającą tylko litery, myślniki i spacje.');
  } else {
    cityInputAlt.setCustomValidity('');
  }
}

cityInputAlt.addEventListener('input', validateCityInputAlt);

//walidacja numeru telefonu 

const phoneInputAlt = document.querySelector('input[name="phonenumber_alt"]');

function validatePhoneInputAlt() {
  const phoneValueAlt = phoneInputAlt.value.trim();
  const phoneRegexAlt = /^[\d+\s-]{9,}$/;

  if (!phoneRegexAlt.test(phoneValueAlt)) {
    phoneInputAlt.setCustomValidity('Wprowadź poprawny numer telefonu, składający się z co najmniej 9 cyfr');
  } else {
    phoneInputAlt.setCustomValidity('');
  }
}

phoneInputAlt.addEventListener('input', validatePhoneInputAlt);