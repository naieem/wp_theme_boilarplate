// Wait for the DOM to be ready
jQuery(document).ready(function($) {
  /**
   * for first demo registration form
   * @type {String}
   */
  jQuery("form[name='demo_registration1']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      emailOrPhone: "required",
      name: "required",
      restaurantName: 'required'
      // email: {
      //   required: true,
      //   // Specify that email should be validated
      //   // by the built-in "email" rule
      //   email: true
      // },
      // password: {
      //   required: true,
      //   minlength: 5
      // }
    },
    // Specify validation error messages
    messages: {
      emailOrPhone: "Please enter Email or Phone",
      name: "Please enter Name",
      // password: {
      //   required: "Please provide a password",
      //   minlength: "Your password must be at least 5 characters long"
      // },
      restaurantName: "Please enter a restaurant name"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      var data = $(this).serialize(); // make validator false so that we can fire actions from main.js
      form.submit();
    }
  });
  /**
   * for second demo registration form
   * @type {String}
   */
  jQuery("form[name='demo_registration2']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      emailOrPhone: "required",
      name: "required",
      restaurantName: 'required'
      // email: {
      //   required: true,
      //   // Specify that email should be validated
      //   // by the built-in "email" rule
      //   email: true
      // },
      // password: {
      //   required: true,
      //   minlength: 5
      // }
    },
    // Specify validation error messages
    messages: {
      emailOrPhone: "Please enter Email or Phone",
      name: "Please enter Name",
      // password: {
      //   required: "Please provide a password",
      //   minlength: "Your password must be at least 5 characters long"
      // },
      restaurantName: "Please enter a restaurant name"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      
      var data = $(this).serialize(); // make validator false so that we can fire actions from main.js
      form.submit();
    }
  });
});