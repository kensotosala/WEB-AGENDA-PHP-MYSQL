// Create a new instance of JustValidate for form validation
const validation = new JustValidate("#signup");

// Add validation rules for the fields
validation
  .addField("#name", [
    {
      rule: "required",
    },
  ])
  .addField("#email", [
    {
      rule: "required",
    },
    {
      rule: "email",
    },
    {
      // Define a custom asynchronous validator function for email availability
      validator: (value) => () => {
        // Construct the URL for the validation PHP script with the encoded email value
        return fetch("validate-email.php?email=" + encodeURIComponent(value))
          .then(function (response) {
            // Convert the response to JSON
            return response.json();
          })
          .then(function (json) {
            // Return the 'available' property from the JSON response
            return json.available;
          });
      },
      errorMessage: "email already taken", // Error message for unavailable email
    },
  ])
  .addField("#password", [
    {
      rule: "required",
    },
    {
      rule: "password",
    },
  ])
  .addField("#password_confirmation", [
    {
      // Define a custom validator function for password confirmation
      validator: (value, fields) => {
        return value === fields["#password"].elem.value;
      },
      errorMessage: "Passwords should match", // Error message for mismatched passwords
    },
  ])
  .onSuccess((event) => {
    // When the form is successfully validated, submit the form
    document.getElementById("signup").submit();
  });
