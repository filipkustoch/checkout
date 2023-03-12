// pokazywanie formularza "stwórz nowe konto"
function newAccount() {
  const checkbox = document.getElementById('show-form');
  const formContainer = document.getElementById('form-container');

  checkbox.addEventListener('change', function () {
    if (checkbox.checked) {
      formContainer.style.display = 'block';
    } else {
      formContainer.style.display = 'none';
    }
  });
}

// Wysłanie zapytania AJAX za pomocą vanilla JavaScript całego formularza

function sendData(event) {
  const formData = new FormData(event.target);
  let amount = document.getElementById('discount-input').innerHTML;
  amount = parseInt(amount.replace(/[^0-9]/g, ''));
  formData.append('amount', amount);
  event.preventDefault();
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'includes/process_forms.php');
  xhr.onload = function () {
    var zamowienie = xhr.responseText;
    let podziekowanie = document.getElementById('podziekowanie');
    podziekowanie.innerHTML =
      '<p id="tekst-podziekowania">Dziękujemy za złożenie zamówienia! Twój numer zamówienia to: ' +
      zamowienie +
      '</p>';
  };
  xhr.send(formData);
  event.target.reset();
}

// kod rabatowy

// pokazanie pola rabatowego
function showDiscountCode() {
  var discountDiv = document.getElementById('discount-code-container');
  discountDiv.style.display = 'block';
}

// zastosowanie pola rabatowego w tym przypadku na sztywno 10%
function applyDiscount() {
  var discountCode = document.getElementById('discount-input');
  discountAmount = parseInt(discountCode.innerText.replace(/[^0-9]/g, ''));

  roundedAmount = Math.floor(discountAmount * 0.9) + ' zł';
  console.log(roundedAmount);
  discountCode.innerHTML = roundedAmount;
  console.log(discountAmount, discountCode);
  document.getElementById('apply-discount').disabled = true;
}

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
  const nameRegex = /^[a-zA-Z]+$/;

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
  const lastnameRegex = /^[a-zA-Z]+$/;

  if (!lastnameRegex.test(lastnameValue)) {
    lastnameInput.setCustomValidity('Nazwisko powinno zawierać tylko litery.');
  } else {
    lastnameInput.setCustomValidity('');
  }
}

lastnameInput.addEventListener('input', validateLastnameInput);