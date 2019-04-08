/**
 * Created by istiaq.nexabd on 5/8/2018.
 */
$(document).ready(function () {
   $('.addToCart').on('click',function () {
       // alert('I am clicked');
       var cartForm = $('.cart-form');
       var cartFormUrl = $(cartForm).attr('action');
       var serializedData = $(cartForm).serialize();
       $(cartForm).submit(function (event) {
           event.preventDefault();

           $.ajax({
               type: 'POST',
               url: $(cartForm).attr('action'),
               data: serializedData
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

                   // alert(response);
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
                   alert(data.responseText);
               });
       });
   });

    // $('.sendReview').on('click',function (e) {
    //     var cartForm = $('.reviewForm');
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
    //                 alert('I am clicked');
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


   // PRICE SLIDER
    $( function() {
        var lowPrice = $('#low-price').val();
        var highPrice = $('#high-price').val();
        console.log(lowPrice);
        if(lowPrice!==""){

            lowPrice = parseInt(lowPrice);
        }else{
            lowPrice=50;
        }

        if(highPrice!==""){
            highPrice=parseInt(highPrice);
        }else {
            highPrice=300;
        }

        console.log(lowPrice);
        $( "#slider-range" ).slider({
            range: true,
            min: 50,
            max: 300,
            values: [lowPrice, highPrice ],
            slide: function( event, ui ) {
                $( "#low-price" ).val( ui.values[ 0 ]);
                $("#high-price").val(ui.values[1]);
            }
        });
        // $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        //     " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    } );
   // PRICE SLIDER
});

