const checkbox = document.getElementById('show-form');
const formContainer = document.getElementById('form-container');

checkbox.addEventListener('change', function () {
  if (checkbox.checked) {
    formContainer.style.display = 'block';
  } else {
    formContainer.style.display = 'none';
  }
});

// Form script

function sendData(event){
  const formData = new FormData(event.target);
  event.preventDefault();
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'includes/process_forms.php');
  xhr.onload = function () {
    alert(xhr.responseText);
    // window.location.href = 'podsumowanie.php';
  };
  xhr.send(formData);
  event.target.reset();
} 

// kod rabatowy

function showDiscountCode() {
  var discountDiv = document.getElementById('discount-code-container');
  discountDiv.style.display = 'block';
}

function applyDiscount() {
  var discountCode = document.getElementById('discount-input');

  discountAmount = parseInt(discountCode.innerText.replace(/[^0-9]/g, ''));

  roundedAmount = Math.floor(discountAmount * 0.9) + ' zł';
  console.log(roundedAmount);
  discountCode.innerHTML = roundedAmount;
  console.log(discountAmount, discountCode);
  document.getElementById('apply-discount').disabled = true;
}
