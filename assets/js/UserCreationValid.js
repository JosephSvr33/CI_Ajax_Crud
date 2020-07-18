$(function () {
 
    $.validator.addMethod("vaildUSdate",
          function (value, element) {
              var isValid = false;
              var reg = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
              if (reg.test(value)) {
                  var splittedDate = value.split('/');
                  var dd = parseInt(splittedDate[0], 10);
                  var mm = parseInt(splittedDate[1], 10);
                  var yyyy = parseInt(splittedDate[2], 10);
                  var newDate = new Date(yyyy, mm - 1, dd);
                  if ((newDate.getFullYear() == yyyy) && (newDate.getMonth() == mm - 1)
                  && (newDate.getDate() == dd))
                      isValid = true;
                  else
                      isValid = false;
              }
              else
                  isValid = false;
              return this.optional(element) || isValid;
          },
          "Please enter a valid date (dd/MM/yyyy)");

    $.validator.addMethod("valueNotEquals", function (value, element) {
        if( value!=0)
            return true;
        else
            return false;
    }, "Please Select a Value");
    $.validator.addMethod("birth", function (value, element) {
        var year = value.split('/');
        var year1 = new Date().getFullYear()-16;
        if (value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/) && parseInt(year[2]) >= 1960 && parseInt(year[2]) <= year1)
            return true;
        else
            return false;
    },
      "Please enter a valid DateofBirth ");

    var form1 = $('#form_country');
         var errorHandler1 = $('.errorHandler', form1);
         var successHandler1 = $('.successHandler', form1);
        
       
    $("#form_country").validate({
             errorElement: "span", // contain the error msg in a span tag
             errorClass: 'help-block',
             errorPlacement: function (error, element) { // render error placement for each input type
                 if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                     error.insertAfter($(element).closest('.form-group').children('div').children().last());
                 } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                     error.insertAfter($(element).closest('.form-group').children('div'));
                 } else {
                     error.insertAfter(element);
                     // for other inputs, just perform default behavior
                 }
             },
             ignore: "",
             rules: {
                 code: {
                     minlength: 2,
                     required: true
                 },
                 country: {                       
                     required: true
                 }
             }, messages: {},
             invalidHandler: function (event, validator) { //display error alert on form submit
                 successHandler1.hide();
                 errorHandler1.show();
             },
             highlight: function (element) {
                 $(element).closest('.help-block').removeClass('valid');
                 // display OK icon
                 $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                 // add the Bootstrap error class to the control group
             },
             unhighlight: function (element) { // revert the change done by hightlight
                 $(element).closest('.form-group').removeClass('has-error');
                 // set error class to the control group
             },
             success: function (label, element) {
                 label.addClass('help-block valid');
                 // mark the current input as valid and display OK icon
                 $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
             },
             submitHandler: function (form) {
                 successHandler1.show();
                 errorHandler1.hide();
             }
         });
     });
