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
