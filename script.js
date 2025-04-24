document.getElementById("registrationForm").addEventListener("submit", function (e) {
  let isValid = true;

  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const address = document.getElementById("address").value.trim();

  // Name: Only letters and spaces
  if (!/^[A-Za-z\s]+$/.test(name)) {
    alert("Please enter a valid name (letters and spaces only).");
    isValid = false;
  }

  // Email: Simple format check
  if (!/^\S+@\S+\.\S+$/.test(email)) {
    alert("Please enter a valid email address.");
    isValid = false;
  }

  // Phone: Must be 10 digits
  if (!/^\d{10}$/.test(phone)) {
    alert("Phone number must be exactly 10 digits.");
    isValid = false;
  }

  // Address: At least 10 characters
  if (address.length < 10) {
    alert("Address must be at least 10 characters long.");
    isValid = false;
  }

  if (!isValid) {
    e.preventDefault(); // Stop form from submitting
  }
});
