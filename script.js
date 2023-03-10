const checkbox = document.getElementById("show-form");
const formContainer = document.getElementById("form-container");

checkbox.addEventListener("change", function() {
  if (checkbox.checked) {
    formContainer.style.display = "block";
  } else {
    formContainer.style.display = "none";
  }
});
