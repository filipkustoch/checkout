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
    } else {
      // W przeciwnym razie ukrywamy formularz
      formContainer.style.display = 'none';
    }
  });

  checkboxAlt.addEventListener('change', function () {
    if (checkboxAlt.checked) {
      // Jeśli drugi checkbox jest zaznaczony pokazujemy drugi formularz
      formContainerAlt.style.display = 'block';
    } else {
      // W przeciwnym razie ukrywamy drugi formularz
      formContainerAlt.style.display = 'none';
    }
  });
}

function makeRequired() {
  const checkbox = document.getElementById('show-form_alt');
  const formInputs = document.querySelectorAll(
    "#form-container_alt input"
  );

  if (checkbox.checked) {
    formInputs.forEach((input) => {
      input.setAttribute('required', '');
    });
  } else {
    formInputs.forEach((input) => {
      input.removeAttribute('required');
    });
  }
}

// Wysłanie zapytania AJAX za pomocą vanilla JavaScript całego formularza

function sendData(event) {
  // Tworzenie obiektu FormData z elementu event.target, który jest formularzem
  const formData = new FormData(event.target);

  // Pobranie wartości ceny końcowej ze strony i dodanie jej do formData
  let amount = parseFloat(
    document
      .getElementById('final-price')
      .innerHTML.replace(',', '.')
      .replace(/[^0-9.]/g, '')
  );
  formData.append('amount', amount);

  // Pobranie listy produktów z atrybutu data-list elementu products-list i dodanie jej do formData
  const listOfProducts = document
    .getElementById('products-list')
    .getAttribute('data-list');
  formData.append('listOfProducts', listOfProducts);

  // Pobranie informacji o newsletterze
  const newsletter = document.getElementById("newsletter");
  let newsletterState = 0;
  if (newsletter.checked){
    newsletterState = 1;
  }
  formData.append('newsletter', newsletterState);

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
  const deliverySelected = document.querySelector(
    'input[name="delivery_method"]:checked'
  );
  const paymentSelected = document.querySelector(
    'input[name="payment_method"]:checked'
  );

  // Sprawdzenie, czy obie wartości są zdefiniowane
  if (deliverySelected && paymentSelected) {
    // Jeśli tak, wyświetl pole na kod rabatowy
    document.getElementById('discount-code-container').style.display = 'block';
  } else {
    // Jeśli nie, wyświetl alert z prośbą o wybranie metody dostawy i płatności
    alert('Proszę wybrać metodę dostawy i metodę płatności.');
  }
}

//  Ta funkcja stosuje pole rabatowe o stałej wartości 10% do wartości ostatecznej ceny.
function applyDiscount() {
  // Pobranie wartości ostatecznej ceny
  let discountCode = document.getElementById('final-price');
  // Usunięcie znaków innych niż cyfry i kropki z tekstu
  discountAmount = parseFloat(discountCode.innerText.replace(/[^0-9.,]/g, ''));

  // Obniżenie ceny o 10% i dodanie końcówki "zł"
  roundedAmount = (discountAmount * 0.9).toFixed(2) + ' zł';
  // Ustawienie nowej wartości ostatecznej ceny
  discountCode.innerHTML = roundedAmount;
  // Wyłączenie przycisku stosowania kodu rabatowego aby ograniczyć użycie kodu do jednego razu
  document.getElementById('apply-discount').disabled = true;

  // Zablokowanie możliwości wyboru nowego sposobu dostawy ze względu na aktualną logikę systemu
  const deliveryOptions = document.querySelectorAll(
    'input[name="delivery_method"]'
  );
  deliveryOptions.forEach((option) => {
    option.setAttribute("onclick", "return false;");
  });
}

// CENY DOSTAW

// Pobranie elementów z ceną dostawy
const deliveryPrices = document.querySelectorAll('.delivery_price');

// Zapisanie wartości cen w osobnych zmiennych
let paczkomatPrice, kurierdpdPrice, kurierdpdPobraniePrice;

// Iteracja po wszystkich elementach z klasą .delivery_price
deliveryPrices.forEach(function (price) {
  // Pobranie wartości ceny i usunięcie "zł"
  const priceValue = parseFloat(price.innerText.replace('zł', ''));
  // Zapisanie wartości w osobnej zmiennej na podstawie identyfikatora elementu
  if (price.id === 'paczkomat-price') {
    paczkomatPrice = priceValue;
  } else if (price.id === 'kurierdpd-price') {
    kurierdpdPrice = priceValue;
  } else if (price.id === 'kurierdpd-pobranie-price') {
    kurierdpdPobraniePrice = priceValue;
  }
});

// Pobranie elementu z id final-price i zamiana jego wartości na liczbę
const finalPrice = document.getElementById('final-price');
const initialPriceFloat = parseFloat(
  finalPrice.innerText.replace(/[^0-9]/g, '')
);

// Funkcja zmieniająca wartość ostatecznej ceny w zależności od wybranej metody dostawy
function changeFinalPriceDelivery() {
  // Pobranie wybranej metody dostawy
  const deliveryMethod = document.querySelector(
    'input[name="delivery_method"]:checked'
  ).value;

  let deliveryPrice;
  // Wybór odpowiedniej wartości ceny dostawy na podstawie wybranej metody dostawy
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

  // Obliczenie nowej wartości ostatecznej ceny
  const newPrice = initialPriceFloat + deliveryPrice;
  // Ustawienie nowej wartości ostatecznej ceny z dodaniem końcówki "zł"
  finalPrice.innerText = newPrice.toFixed(2) + ' zł';
}

// Pobranie wszystkich elementów input z atrybutem name="delivery_method"
const deliveryRadios = document.querySelectorAll(
  'input[name="delivery_method"]'
);
// Dodanie event listenera dla każdego elementu
deliveryRadios.forEach(function (radio) {
  radio.addEventListener('change', changeFinalPriceDelivery);
});

// Funkcja pokazuje odpowiednie pola płatności w zależności od wybranego sposobu dostawy
function paymentMethods() {
  // Pobranie wartości wybranego sposobu dostawy
  const deliveryMethod = document.querySelector(
    'input[name="delivery_method"]:checked'
  ).value;
  // Pobranie kontenerów dla poszczególnych sposobów płatności
  const payu = document.getElementById('payu-container');
  const zwykly = document.getElementById('zwykly-container');

  // Jeśli wybrano opcję pobrania, to wyłącz wyświetlanie innych płatności
  if (deliveryMethod == 'kurierdpd_pobranie') {
    payu.style.display = 'none';
    zwykly.style.display = 'none';
  } else {
    // W przeciwnym wypadku, wyświetl pola płatności
    payu.style.display = 'flex';
    zwykly.style.display = 'flex';
  }
}

// Dodanie event listenera dla każdego wyboru sposobu dostawy
const radioButtons = document.querySelectorAll('input[name="delivery_method"]');
radioButtons.forEach((radioButton) => {
  radioButton.addEventListener('change', paymentMethods);
});

// Funkcja odpowiedzialna za walidację imienia

// Pobranie elementu input odpowiadającego za imię
const firstnameInput = document.querySelector('input[name="firstname"]');

function validateFirstnameInput() {
  // Pobranie wartości imienia z pola formularza i usunięcie białych znaków na początku i końcu
  const firstnameValue = firstnameInput.value.trim();
  // Wyrażenie regularne do dopasowania tylko liter z polskimi znakami
  const nameRegex = /^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/;

  // Sprawdzenie, czy wartość imienia pasuje do wyrażenia regularnego
  if (!nameRegex.test(firstnameValue)) {
    // Ustawienie komunikatu o błędzie
    firstnameInput.setCustomValidity('Imię powinno zawierać tylko litery.');
  } else {
    // Usunięcie komunikatu o błędzie
    firstnameInput.setCustomValidity('');
  }
}

// Dodanie event listenera
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
    postcodeInput.setCustomValidity(
      'Kod pocztowy musi składać się z co najmniej 5 znaków.'
    );
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
    cityInput.setCustomValidity(
      'Wprowadź poprawną nazwę miasta, zawierającą tylko litery, myślniki i spacje.'
    );
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
    phoneInput.setCustomValidity(
      'Wprowadź poprawny numer telefonu, składający się z co najmniej 9 cyfr'
    );
  } else {
    phoneInput.setCustomValidity('');
  }
}

phoneInput.addEventListener('input', validatePhoneInput);

// Funkcja odpowiedzialna za walidację alt imienia

// Pobranie elementu input odpowiadającego za imię
const firstnameInputAlt = document.querySelector('input[name="firstname_alt"]');

function validateFirstnameInputAlt() {
  // Pobranie wartości imienia z pola formularza i usunięcie białych znaków na początku i końcu
  const firstnameValueAlt = firstnameInputAlt.value.trim();
  // Wyrażenie regularne do dopasowania tylko liter z polskimi znakami
  const nameRegexAlt = /^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/;

  // Sprawdzenie, czy wartość imienia pasuje do wyrażenia regularnego
  if (!nameRegexAlt.test(firstnameValueAlt)) {
    // Ustawienie komunikatu o błędzie
    firstnameInputAlt.setCustomValidity('Imię powinno zawierać tylko litery.');
  } else {
    // Usunięcie komunikatu o błędzie
    firstnameInputAlt.setCustomValidity('');
  }
}

// Dodanie event listenera
firstnameInputAlt.addEventListener('input', validateFirstnameInputAlt);

// walidacja alt nazwiska

const lastnameInputAlt = document.querySelector('input[name="lastname_alt"]');

function validateLastnameInputAlt() {
  const lastnameValueAlt = lastnameInputAlt.value.trim();
  const lastnameRegexAlt = /^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/;

  if (!lastnameRegexAlt.test(lastnameValueAlt)) {
    lastnameInputAlt.setCustomValidity('Nazwisko powinno zawierać tylko litery.');
  } else {
    lastnameInputAlt.setCustomValidity('');
  }
}

lastnameInputAlt.addEventListener('input', validateLastnameInputAlt);

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
    postcodeInputAlt.setCustomValidity(
      'Kod pocztowy musi składać się z co najmniej 5 znaków.'
    );
  } else if (!postcodeRegexAlt.test(postcodeValueAlt)) {
    postcodeInputAlt.setCustomValidity(
      'Kod pocztowy może zawierać tylko cyfry.'
    );
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
    cityInputAlt.setCustomValidity(
      'Wprowadź poprawną nazwę miasta, zawierającą tylko litery, myślniki i spacje.'
    );
  } else {
    cityInputAlt.setCustomValidity('');
  }
}

cityInputAlt.addEventListener('input', validateCityInputAlt);

//walidacja alt numeru telefonu

const phoneInputAlt = document.querySelector('input[name="phonenumber_alt"]');

function validatePhoneInputAlt() {
  const phoneValueAlt = phoneInputAlt.value.trim();
  const phoneRegexAlt = /^[\d+\s-]{9,}$/;

  if (!phoneRegexAlt.test(phoneValueAlt)) {
    phoneInputAlt.setCustomValidity(
      'Wprowadź poprawny numer telefonu, składający się z co najmniej 9 cyfr'
    );
  } else {
    phoneInputAlt.setCustomValidity('');
  }
}

phoneInputAlt.addEventListener('input', validatePhoneInputAlt);