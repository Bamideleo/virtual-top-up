$("#eko-1").submit(function(e){
    e.preventDefault();
    $('#submit-eko-1').css({'display':'none'});
    $('#submit-eko-ii').show();
    $('.text-strong').empty();
    $.ajax({
        url: "verify-meter", 
        data: $("#eko-1").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
            // console.log(response);
            if(response.success == true){
                $('#eko-1').css({'display':'none'});
                $('#eko-2').show();
                $('#username').text(response.data.username)
                $('#address').text(response.data.address)
                $('#met-type').val(response.data.meter_type)
                $('#meter-number').val(response.data.meter_no)
                $('#m-type').val(response.data.meter_type)
                $('#m-number').val(response.data.meter_no)
            }
           


            if(response.success == false){
                toastr.error(response.data.error,{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
                $('#submit-eko-ii').css({'display':'none'});
                $('#submit-eko-1').show();
               }


        },
        error: function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-eko-ii').css({'display':'none'});
                $('#submit-eko-1').show();
            }

            if(response.responseJSON.success == 402){
                toastr.error(response.responseJSON.errors,{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

               
            }

            if(response.status == 500){
                toastr.error('Bad Network',{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                $('#submit-eko-ii').css({'display':'none'});
                $('#submit-eko-1').show();
            }
        }

    });

})





$("#eko-2").submit(function(e){
    e.preventDefault();
    $('#submit-ek').css({'display':'none'});
    $('#submit-ek-i').show();
    $.ajax({
        url: "pay-meter", 
        data: $("#eko-2").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if(response.success == true){
                toastr.success("Purchase Successfully",{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                setTimeout(function() {
                window.location.href = "purchase-history";
              }, 2000);

               }


            //   if(response.success == 402){
            //     toastr.error(response.data.status,{
            //         timeOut: 500000000,
            //         closeButton: !0,
            //         debug: !1,
            //         newestOnTop: !0,
            //         progressBar: !0,
            //         positionClass: "toast-top-right",
            //         preventDuplicates: !0,
            //         onclick: null,
            //         showDuration: "300",
            //         hideDuration: "1000",
            //         extendedTimeOut: "1000",
            //         showEasing: "swing",
            //         hideEasing: "linear",
            //         showMethod: "fadeIn",
            //         hideMethod: "fadeOut",
            //         tapToDismiss: !1
            //     })

            //     $('#submit-ek-i').css({'display':'none'});
            //     $('#submit-ek').show();                
            // }

        },
        // error: function(response){
        //     console.log(response);
        //     if(response.responseJSON.success == false){
        //         $.each(response.responseJSON.errors,function(field_name,error){
        //             $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
        //         })
        //         $('#submit-ek-i').css({'display':'none'});
        //         $('#submit-ek').show();
        //     }

        //     if(response.status == 500){
        //         toastr.error('Bad Network',{
        //             timeOut: 500000000,
        //             closeButton: !0,
        //             debug: !1,
        //             newestOnTop: !0,
        //             progressBar: !0,
        //             positionClass: "toast-top-right",
        //             preventDuplicates: !0,
        //             onclick: null,
        //             showDuration: "300",
        //             hideDuration: "1000",
        //             extendedTimeOut: "1000",
        //             showEasing: "swing",
        //             hideEasing: "linear",
        //             showMethod: "fadeIn",
        //             hideMethod: "fadeOut",
        //             tapToDismiss: !1
        //         })

        //         $('#submit-ek-i').css({'display':'none'});
        //         $('#submit-ek').show();
        //     }
        // }

    })

})


$('#exam-pin').submit(function(e){
    e.preventDefault();
    $('#submit-exam-rg').css({'display':'none'});
    $('#submit-exam-rg-i').show();

    $.ajax({
        url: "pay-wace-registration", 
        data: $("#exam-pin").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
           
            if(response.success == true){
                toastr.success("Purchase Successfully",{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                setTimeout(function() {
                window.location.href = "purchase-history";
              }, 2000);

               }

               if(response.success == false){
                toastr.error('Bad Network',{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                $('#submit-exam-rg-i').css({'display':'none'});
                $('#submit-exam-rg').show();
            }

          
        },
        error: function(response){
          
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-exam-rg-i').css({'display':'none'});
                $('#submit-exam-rg').show();
            }

            if(response.responseJSON.success == 402){
                toastr.error(response.responseJSON.errors,{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                $('#submit-exam-rg-i').css({'display':'none'});
                $('#submit-exam-rg').show();               
            }





            if(response.status == 500){
                toastr.error('Bad Network',{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                $('#submit-exam-rg-i').css({'display':'none'});
                $('#submit-exam-rg').show();
            }
        }

    })
   
});


$('#exam-pin-1').submit(function(e){
    e.preventDefault();
    $('#submit-exam-r').css({'display':'none'});
    $('#submit-exam-r-i').show();

    $.ajax({
        url: "pay-wace-registration", 
        data: $("#exam-pin-1").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if(response.success == true){
                toastr.success("Purchase Successfully",{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                setTimeout(function() {
                window.location.href = "purchase-history";
              }, 2000);

               }


               if(response.success ==false){
                toastr.error('Bad Network',{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                $('#submit-exam-r-i').css({'display':'none'});
                $('#submit-exam-r').show();
            }


          
        },
        error: function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-exam-r-i').css({'display':'none'});
                $('#submit-exam-r').show();
            }

            if(response.responseJSON.success == 402){
                toastr.error(response.responseJSON.errors,{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                $('#submit-exam-r-i').css({'display':'none'});
                $('#submit-exam-r').show();           
            }





            if(response.status == 500){
                toastr.error('Bad Network',{
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                $('#submit-exam-r-i').css({'display':'none'});
                $('#submit-exam-r').show();
            }
        }

    })
   
});





