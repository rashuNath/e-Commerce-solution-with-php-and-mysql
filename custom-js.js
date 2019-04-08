/**
 * Created by istiaq.nexabd on 5/8/2018.
 */
$(document).ready(function () {
   // $('.addToCart').on('click',function () {
   //     alert('I am clicked');
   //     var cartForm = $('.cart-form');
   //     var cartFormUrl = $(cartForm).attr('action');
   //     var serializedData = $(cartForm).serialize();
   //     $(cartForm).submit(function (event) {
   //         event.preventDefault();
   //
   //         $.ajax({
   //             type: 'POST',
   //             url: $(cartForm).attr('action'),
   //             data: serializedData
   //         })
   //
   //             .done(function(response) {
   //                 // Make sure that the formMessages div has the 'success' class.
   //                 // $(formMessages).removeClass('error');
   //                 // $(formMessages).addClass('success');
   //                 //
   //                 // // Set the message text.
   //                 // $(formMessages).text(response);
   //                 //
   //                 // // Clear the form.
   //                 // $('#name').val('');
   //                 // $('#email').val('');
   //                 // $('#message').val('');
   //
   //                 alert(response);
   //             })
   //
   //             .fail(function(data) {
   //                 // Make sure that the formMessages div has the 'error' class.
   //                 // $(formMessages).removeClass('success');
   //                 // $(formMessages).addClass('error');
   //                 //
   //                 // // Set the message text.
   //                 // if (data.responseText !== '') {
   //                 //     $(formMessages).text(data.responseText);
   //                 // } else {
   //                 //     $(formMessages).text('Oops! An error occured and your message could not be sent.');
   //                 // }
   //                 alert(data.responseText);
   //             });
   //     });
   // });


   var addCategorySubmit = $('#add_category input[type=submit]');
   $(addCategorySubmit).click(function () {

   });

    $('#add_category').submit(function (event) {
        event.preventDefault();
        var serializedData = $(this).serialize();
        // var serializedData = new FormData(this);
        // jQuery.each(jQuery('#file')[0].files, function(i, file) {
        //     serializedData.append('file-'+i, file);
        // });

        $.ajax({
            type: 'POST',
            method:'POST',
            url: $(this).attr('action'),
            data: serializedData,
            processData: false,
            contentType: false
        })

            .done(function(response) {
                // Make sure that the formMessages div has the 'success' class.
                // $(formMessages).removeClass('error');
                // $(formMessages).addClass('success');
                //
                // // Set the message text.
                // $(formMessages).text(response);
                //
                // // Clear the form.
                // $('#name').val('');
                // $('#email').val('');
                // $('#message').val('');

                alert(response);
            })

            .fail(function(data) {
                // Make sure that the formMessages div has the 'error' class.
                // $(formMessages).removeClass('success');
                // $(formMessages).addClass('error');
                //
                // // Set the message text.
                // if (data.responseText !== '') {
                //     $(formMessages).text(data.responseText);
                // } else {
                //     $(formMessages).text('Oops! An error occured and your message could not be sent.');
                // }
                alert('failed');
            });
    });

});
