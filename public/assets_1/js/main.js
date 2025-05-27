// ACTIVE USER SECTION StART
$('.act-ive').on('click',function(){
let id = $(this).attr('data-id');
let type = $(this).attr('data-type');
alert(type);
$.ajax({
    url:"active-user",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        id:id,
        type:type
    },
    success:function(data){
    if(data.data == 200){
        toastr.success("User Enable Successfully",{
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
    else{
        toastr.success("User Disable Successfully",{
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
    setTimeout(function() {
        window.location.href = "get-all-user";
      }, 2000);
    }
})

})

$('#approve').on('click',function(){
    let id = $(this).attr('data-id');
    $.ajax({
        url:"approve-transfer",
        type:"POST",
        headers: {'X-CSRF-TOKEN':token },
        data:{
            id:id
        },
        success:function(data){
        if(data.data == 200){
            toastr.success("Fund Approved Successfully",{
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
       
        setTimeout(function() {
            window.location.href = "get-transfer";
          }, 2000);
        }
    })
})

$('#revert').on('click',function(){
    let id = $(this).attr('data-id');
    $.ajax({
        url:"revert-payment",
        type:"POST",
        headers: {'X-CSRF-TOKEN':token },
        data:{
            id:id
        },
        success:function(data){
        if(data.data == 200){
            toastr.success("Fund Reverted Successfully",{
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
       
        setTimeout(function() {
            window.location.href = "payment-history";
          }, 2000);
        }
    })
})
// ACTIVE USER SECTION END




// USERS DATA SECTION START

$('#data-mtn-1').on('click',function(){
$('#vpay').show();
$('#opay').css({'display':'none'});
$('#palmpay').css({'display':'none'});
$('#wema').css({'display':'none'});
$('#sterling').css({'display':'none'});
$('#paystack').css({'display':'none'});
$('#paystack-ii').css({'display':'none'});
$('#tran-money').css({'display':'none'});
});

$('#data-mtn-2').on('click',function(){
    $('#vpay').css({'display':'none'});
    $('#opay').show();
    $('#palmpay').css({'display':'none'});
    $('#wema').css({'display':'none'});
    $('#sterling').css({'display':'none'});
    $('#paystack').css({'display':'none'});
    $('#paystack-ii').css({'display':'none'});
    $('#tran-money').css({'display':'none'});
});
$('#data-mtn-3').on('click',function(){
    $('#vpay').css({'display':'none'});
    $('#opay').css({'display':'none'});
    $('#palmpay').show();
    $('#wema').css({'display':'none'});
    $('#sterling').css({'display':'none'});
    $('#paystack').css({'display':'none'});
    $('#paystack-ii').css({'display':'none'});
    $('#tran-money').css({'display':'none'});
});
$('#data-mtn-4').on('click',function(){
    $('#vpay').css({'display':'none'});
    $('#opay').css({'display':'none'});
    $('#palmpay').css({'display':'none'});
    $('#wema').show();
    $('#sterling').css({'display':'none'});
    $('#paystack').css({'display':'none'});
    $('#paystack-ii').css({'display':'none'});
    $('#tran-money').css({'display':'none'});
});
$('#data-mtn-5').on('click',function(){
    $('#vpay').css({'display':'none'});
    $('#opay').css({'display':'none'});
    $('#palmpay').css({'display':'none'});
    $('#wema').css({'display':'none'});
    $('#sterling').show();
    $('#paystack').css({'display':'none'});
    $('#paystack-ii').css({'display':'none'});
    $('#tran-money').css({'display':'none'});
});

// ### MTN Setion  ###//
$('#data-mtn').on('click',function(){
$('.text-strong').empty();
$('#data-gol-1').css({'display':'none'});
$('#data-airtel-1').css({'display':'none'});
$('#data-nine-1').css({'display':'none'});
$('#mtn-data-1').show();

$('#mtn-airtime-1').show();
$('#airtime-gol-1').css({'display':'none'});
$('#airtime-airtel-1').css({'display':'none'});
$('#airtime-nine-1').css({'display':'none'});


$('#mtn-epin-1').show();
$('#epin-gol-1').css({'display':'none'});
$('#epin-airtel-1').css({'display':'none'});
$('#epin-nine-1').css({'display':'none'});

$('#vpay').css({'display':'none'});
$('#opay').css({'display':'none'});
$('#palmpay').css({'display':'none'});
$('#wema').css({'display':'none'});
$('#sterling').css({'display':'none'});

$('#dstv').show();
$('#dstv-1').css({'display':'none'});
$('#gotv').css({'display':'none'});
$('#startimes').css({'display':'none'});
$('#showmax').css({'display':'none'});
$('#gotv-1').css({'display':'none'});
$('#startimes-1').css({'display':'none'});
$('#tran-money').css({'display':'none'});
$('#paystack').show();
$('#sm-card').val('');

$('#exam-pin-1').css({'display':'none'});
$('#exam-pin').show();
$('#ex-phone').val('');
$('#mtn-pay-1').css({'display':'none'});
$('#gol-pay-1').css({'display':'none'});
$('#airtel-pay-1').css({'display':'none'});
$('#nine-pay-1').css({'display':'none'});
$('#mtn-no').val('');
$('#mtn-amount').val('');
$('#gol-no').val('');
$('#gol-amount').val('');
$('#airtel-no').val('');
$('#airtel-amount').val('');
$('#nine-no').val('');
$('#nine-amount').val('');

});



$("#mtn-type").on('change',function(){
    var type_1 =  $("#mtn-type").val()
    var id = $("#mtn-data").val();
    $("#mtn-plan-1").empty();
    $("#mtn-plan-1").append('<option selected disabled>Select Your Plan</option>');
    $('#mtn-plan').show();
    $('#amount').val('');
    $('#mtn-plan-1').attr('disabled', true);
    $.ajax({
        url:"mtn-data",
        type:"POST",
        headers: {'X-CSRF-TOKEN':token },
        data:{
            type:type_1,
            id:id
        },

        success:function(data){
            $.each(data.data, function(key,val) { 
                $('#mtn-plan-1').attr('disabled', false);
                if(val.network == "01"){
                   $("#mtn-plan-1").append('<option value="'+val.epincode+'" data-id="'+val.price_api+'">'+val.plan+'</option>');
                }
                
           
            })

        }

    });
})


$("#mtn-data-1").submit(function(){
    $('#submit-data').show();
    $('#submit-data-1').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-data", 
        data: $("#mtn-data-1").serialize(), 
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
                    window.location.href = "network-data";
                  }, 2000);
              }

               if(response.success == false){
                toastr.error("Network Error: Please Try again shortly",{
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
                $('#submit-data').hide();
                $('#submit-data-1').show();
               }
    
              


        },
        error:function(response){
            // console.log(response);
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data').hide();
                $('#submit-data-1').show();
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
                // setTimeout(function() {
                //     window.location.href = "network-data";
                //   }, 2000);
                $('#submit-data').hide();
                $('#submit-data-1').show();
            }
          
        }
    }); 
    return false;
});







// ### GOL Setion  ###//
$('#data-gol').on('click',function(){
    $('.text-strong').empty();
    $('#mtn-data-1').css({'display':'none'});
    $('#data-airtel-1').css({'display':'none'});
    $('#data-nine-1').css({'display':'none'});
    $('#data-gol-1').show();
    $('#paystack-ii').show();
    $('#mtn-airtime-1').css({'display':'none'});
    $('#airtime-gol-1').show();
    $('#airtime-airtel-1').css({'display':'none'});
    $('#airtime-nine-1').css({'display':'none'});

    $('#mtn-epin-1').css({'display':'none'});
    $('#epin-gol-1').show();
    $('#epin-airtel-1').css({'display':'none'});
    $('#epin-nine-1').css({'display':'none'});
    
    
    $('#vpay').css({'display':'none'});
    $('#opay').css({'display':'none'});
    $('#palmpay').css({'display':'none'});
    $('#wema').css({'display':'none'});
    $('#sterling').css({'display':'none'});

    $('#dstv').css({'display':'none'});
    $('#dstv-1').css({'display':'none'});
    $('#gotv').show();
    $('#gotv-1').css({'display':'none'});
    $('#startimes').css({'display':'none'});
    $('#startimes-1').css({'display':'none'});
    $('#showmax').css({'display':'none'});
    $('#tran-money').show();
    $('#paystack').css({'display':'none'});
    $('#sm-card-').val('');
    $('#sm-card-2').val('');
    $('#sm-card-3').val('');
    $('#sm-card-1').val('');

$('#exam-pin').css({'display':'none'});
$('#exam-pin-1').show();
$('#ex-phone').val('');
$('#mtn-pay-1').css({'display':'none'});
$('#gol-pay-1').css({'display':'none'});
$('#airtel-pay-1').css({'display':'none'});
$('#nine-pay-1').css({'display':'none'});
$('#mtn-no').val('');
$('#mtn-amount').val('');
$('#gol-no').val('');
$('#gol-amount').val('');
$('#airtel-no').val('');
$('#airtel-amount').val('');
$('#nine-no').val('');
$('#nine-amount').val('');


});

$("#gol-type").on('change',function(){
    var type_2 =  $("#gol-type").val();
    var id = $("#gol-data").val();
    $('#gol-plan').show();
    $("#gol-plan-1").empty();
    $('#gol-plan-1').attr('disabled', true);
    $("#gol-plan-1").append('<option selected disabled>Select Your Plan</option>');
    $('#amount').val('');
    $.ajax({
        url:"gol-data",
        type:"POST",
        headers: {'X-CSRF-TOKEN':token },
        data:{
            type:type_2,
            id:id
        },

        success:function(data){
            $.each(data.data, function(key,val) {
                 $('#gol-plan-1').attr('disabled', false);
                //   $("#gol-plan-1").append('<option value="'+val.var_code+'">'+val.plans+'</option>');
                 if(val.network == "02"){
              $("#gol-plan-1").append('<option value="'+val.epincode+'" data-id="'+val.price_api+'">'+val.plan+'</option>');
                 }
            })
           
        }

    });
});



$("#data-gol-1").submit(function(){
    $('#submit-data-ii').show();
    $('#submit-data-2').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-data", 
        data: $("#data-gol-1").serialize(), 
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
                    window.location.href = "network-data";
                  }, 2000);
    
               }
              if(response.success == false){
                toastr.error("Network Error: Please Try again shortly",{
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
                $('#submit-data').hide();
                $('#submit-data-1').show();
               }
        },
        error:function(response){

            if(response.responseJSON.success == false){
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
            $('#submit-data-ii').hide();
            $('#submit-data-2').show();
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
                // setTimeout(function() {
                //     window.location.href = "network-data";
                //   }, 2000);
                $('#submit-data-ii').hide();
                $('#submit-data-2').show();
            }

        }
    }); 
    return false;
});






// ### AIRTIME Setion  ###//
$('#data-airtel').on('click',function(){
    $('.text-strong').empty();
    $('#mtn-data-1').css({'display':'none'});
    $('#data-gol-1').css({'display':'none'});
    $('#data-nine-1').css({'display':'none'});
    $('#data-airtel-1').show(); 

    $('#mtn-airtime-1').css({'display':'none'});
    $('#airtime-gol-1').css({'display':'none'});
    $('#airtime-airtel-1').show();
    $('#airtime-nine-1').css({'display':'none'});

    $('#mtn-epin-1').css({'display':'none'});
    $('#epin-gol-1').css({'display':'none'});
    $('#epin-airtel-1').show();
    $('#epin-nine-1').css({'display':'none'});

    $('#dstv').css({'display':'none'});
    $('#dstv-1').css({'display':'none'});
    $('#gotv').css({'display':'none'});
    $('#gotv-1').css({'display':'none'});
    $('#startimes-1').css({'display':'none'});
    $('#startimes').show();
    $('#showmax').css({'display':'none'});
    $('#sm-card-2').val('');
    $('#sm-card-3').val('');
    $('#sm-card-1').val('');
    $('#sm-card').val('');
    $('#mtn-pay-1').css({'display':'none'});
    $('#gol-pay-1').css({'display':'none'});
    $('#airtel-pay-1').css({'display':'none'});
    $('#nine-pay-1').css({'display':'none'});
    $('#mtn-no').val('');
    $('#mtn-amount').val('');
    $('#gol-no').val('');
    $('#gol-amount').val('');
    $('#airtel-no').val('');
    $('#airtel-amount').val('');
    $('#nine-no').val('');
    $('#nine-amount').val('');
});

$("#airtel-type").on('change',function(){
    var type_3 =  $("#airtel-type").val();
    var id = $("#airtel-data").val();
    $('#airtel-plan').show();
    $("#airtel-plan-1").empty();
    $('#airtel-plan-1').attr('disabled', true);
    $("#airtel-plan-1").append('<option selected disabled>Select Your Plan</option>');
    $('#amount').val('');
    $.ajax({
        url:"airtel-data",
        type:"POST",
        headers: {'X-CSRF-TOKEN':token },
        data:{
            type:type_3,
            id:id
        },

        success:function(data){
            $.each(data.data, function(key,val) { 
                 $('#airtel-plan-1').attr('disabled', false);
                //  $("#airtel-plan-1").append('<option value="'+val.var_code+'">'+val.plans+'</option>');
                if(val.network == "04"){
                $("#airtel-plan-1").append('<option value="'+val.epincode+'" data-id="'+val.price_api+'">'+val.plan+'</option>');
                }
            })
            
             
        }

    });

});


$("#data-airtel-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-iii').show();
    $('#submit-data-3').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-data", 
        data: $("#data-airtel-1").serialize(), 
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
                    window.location.href = "network-data";
                  }, 2000);
    
               }
              if(response.success == false){
                toastr.error("Network Error: Please Try again shortly",{
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
                $('#submit-data-iii').hide();
                $('#submit-data-3').show();
               }

        },
        error:function(response){
            if(response.responseJSON.success == false){
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
            $('#submit-data-iii').hide();
            $('#submit-data-3').show();
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
            // setTimeout(function() {
            //     window.location.href = "network-data";
            //   }, 2000);
            $('#submit-data-iii').hide();
            $('#submit-data-3').show();
        }

        }
    }); 
    return false;
});



// ### 9moblie Setion  ###//
$('#data-nine').on('click',function(){
    $('.text-strong').empty();
    $('#mtn-data-1').css({'display':'none'});
    $('#data-gol-1').css({'display':'none'});
    $('#data-airtel-1').css({'display':'none'});
    $('#data-nine-1').show(); 

    $('#mtn-airtime-1').css({'display':'none'});
    $('#airtime-gol-1').css({'display':'none'});
    $('#airtime-airtel-1').css({'display':'none'});
    $('#airtime-nine-1').show(); 

    $('#mtn-epin-1').css({'display':'none'});
    $('#epin-gol-1').css({'display':'none'});
    $('#epin-airtel-1').css({'display':'none'});
    $('#epin-nine-1').show(); 
    $('#dstv').css({'display':'none'});
    $('#dstv-1').css({'display':'none'});
    $('#gotv').css({'display':'none'});
    $('#gotv-1').css({'display':'none'});
    $('#startimes-1').css({'display':'none'});
    $('#startimes').css({'display':'none'});
    $('#showmax').show();
    $('#sm-card-2').val('');
    $('#sm-card-3').val('');
    $('#sm-card-1').val('');
    $('#sm-card').val('');

    $("#nine-plan-1").val('');
    $("#nine-type").val('');
    $("#p-no").val('');
    $("#airtel-plan-1").val('');
    $("#airtel-type").val('');
    $("#gol-plan-1").val('');
    $("#gol-type").val('');
    $("#mtn-plan-1").val('');
    $("#mtn-type").val('');
    $('#mtn-pay-1').css({'display':'none'});
    $('#gol-pay-1').css({'display':'none'});
    $('#airtel-pay-1').css({'display':'none'});
    $('#nine-pay-1').css({'display':'none'});
    $('#mtn-no').val('');
    $('#mtn-amount').val('');
    $('#gol-no').val('');
    $('#gol-amount').val('');
    $('#airtel-no').val('');
    $('#airtel-amount').val('');
    $('#nine-no').val('');
    $('#nine-amount').val('');


});

$("#nine-type").on('change',function(e){
    e.preventDefault();
    var type_4 =  $("#nine-type").val();
    var id = $("#nine-data").val();
    $('#nine-plan').show();
    $("#nine-plan-1").empty();
    $('#nine-plan-1').attr('disabled', true);
    $("#nine-plan-1").append('<option selected disabled>Select Your Plan</option>');
    $('#amount').val('');
    $.ajax({
        url:"nine-data",
        type:"POST",
        headers: {'X-CSRF-TOKEN':token },
        data:{
            type:type_4,
            id:id
        },

        success:function(data){
            $.each(data.data, function(key,val) { 
             $('#nine-plan-1').attr('disabled', false);
            //   $("#nine-plan-1").append('<option value="'+val.var_code+'">'+val.plans+'</option>');
             if(val.network == "03"){
                $("#nine-plan-1").append('<option value="'+val.epincode+'" data-id="'+val.price_api+'">'+val.plan+'</option>');
                }
            })
            
            
        }

    });

});


$("#data-nine-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-iv').show();
    $('#submit-data-4').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-data", 
        data: $("#data-nine-1").serialize(), 
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
                window.location.href = "network-data";
              }, 2000);
           }

           if(response.success == false){
            toastr.error("Network Error: Please Try again shortly",{
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
            $('#submit-data-iv').hide();
            $('#submit-data-4').show();
           }

          
        },
        error:function(response){
            if(response.responseJSON.success == false){
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
            $('#submit-data-iv').hide();
            $('#submit-data-4').show();

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
                // setTimeout(function() {
                //     window.location.href = "network-data";
                //   }, 2000);
                $('#submit-data-iv').hide();
                $('#submit-data-4').show();
            }

        }
    }); 
    return false;
});


// ### Smile Setion  ###//
$("#smile-data-1").submit(function(e){
    e.preventDefault();
    $('#submit-smile-i').show();
    $('#sumbmit-smile').hide();
    $('.text-strong').empty();
     $("#smile-type").append('<option selected disabled>Select Your Plan</option>');
    $.ajax({
        url: "waveplus-smile-data", 
        data: $("#smile-data-1").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
           if(response.success == true){
            $('#smile-recharge').show();
            $('#smile-data-1').hide();
            $('#account-id').val(response.data.accountId);
            $('#username').text(response.data.username);
            var variat = response.variation;
            const lenght = variat.length;
            for(var i = 1; i < lenght; i++) {
               $("#smile-type").append('<option value="'+variat[i].variation_code+'" data-id="'+variat[i].variation_amount+'">'+variat[i].name+'</option>');
            }
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
            $('#submit-smile-i').hide();
            $('#sumbmit-smile').show();
           }

          
        },
        error:function(response){
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
            $('#submit-smile-i').hide();
            $('#sumbmit-smile').show();
        }
    }); 
    return false;
});


$("#smile-recharge").submit(function(e){
    e.preventDefault();
    $('#submit-charge-i').show();
    $('#submit-charge').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-smile-pay", 
        data: $("#smile-recharge").serialize(), 
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
                
               }

               setTimeout(function() {
                window.location.href = "smile-data";
              }, 2000);
          
        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-charge-i').hide();
                $('#submit-charge').show();
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
                setTimeout(function() {
                    window.location.href = "smile-data";
                  }, 2000);
            }
            
        }
    }); 
    return false;
});


// ### Spectranet Setion  ###//
$("#spectranet-data").submit(function(e){
    e.preventDefault();
    $('#submit-spectranet-1').show();
    $('#submit-spectranet').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-spectranet-pay", 
        data: $("#spectranet-data").serialize(), 
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
               }

               setTimeout(function() {
                window.location.href = "spectratnet-data";
              }, 2000);
          
        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-spectranet-1').hide();
                $('#submit-spectranet').show();
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

                setTimeout(function() {
                    window.location.href = "spectratnet-data";
                  }, 2000);
            }
          
        }
    }); 
    return false;
});
// USERS DATA SECTION END

// USERS AIRTIME SECTION START

$("#mtn-airtime-1").submit(function(e){
    e.preventDefault();
    $('#submit-data').show();
    $('#submit-data-1').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "pay-airtime", 
        data: $("#mtn-airtime-1").serialize(), 
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
                    window.location.href = "network-airtime";
                  }, 2000);
               }
    
               if(response.success == false){
                toastr.error("Network Error: Please Try again shortly",{
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
                $('#submit-data').hide();
                $('#submit-data-1').show();
               }


        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data').hide();
                $('#submit-data-1').show();
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

                // setTimeout(function() {
                //     window.location.href = "network-airtime";
                //   }, 2000);

                $('#submit-data').hide();
                $('#submit-data-1').show();
            }
           
        }
    }); 
    return false;
});


$("#airtime-gol-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-ii').show();
    $('#submit-data-2').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "pay-airtime", 
        data: $("#airtime-gol-1").serialize(), 
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
                    window.location.href = "network-airtime";
                  }, 2000);
               }

               if(response.success == false){
                toastr.error("Network Error: Please Try again shortly",{
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
                $('#submit-data-ii').hide();
                $('#submit-data-2').show();
               }

        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data-ii').hide();
                $('#submit-data-2').show();
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
                // setTimeout(function() {
                //     window.location.href = "network-airtime";
                //   }, 2000);

                $('#submit-data-ii').hide();
                $('#submit-data-2').show();
            }
        }
    }); 
    return false;
});


$("#airtime-airtel-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-iii').show();
    $('#submit-data-3').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "pay-airtime", 
        data: $("#airtime-airtel-1").serialize(), 
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
                    window.location.href = "network-airtime";
                  }, 2000);
               }
    
              
               if(response.success == false){
                toastr.error("Network Error: Please Try again shortly",{
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
                $('#submit-data-iii').hide();
                $('#submit-data-3').show();
               }


        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data-iii').hide();
                $('#submit-data-3').show();
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

                $('#submit-data-iii').hide();
                $('#submit-data-3').show();
            }
           
        }
    }); 
    return false;
});


$("#airtime-nine-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-iv').show();
    $('#submit-data-4').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "pay-airtime", 
        data: $("#airtime-nine-1").serialize(), 
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
                window.location.href = "network-airtime";
              }, 2000);
           }

           if(response.success == false){
            toastr.error("Network Error: Please Try again shortly",{
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
            $('#submit-data-iii').hide();
            $('#submit-data-3').show();
           }

        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data-iv').hide();
                $('#submit-data-4').show();
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

                $('#submit-data-iv').hide();
                $('#submit-data-4').show();
            }
            
        }
    }); 
    return false;
});


// USERS AIRTIME SECTION END


// USERS EPIN SECTION START

$("#mtn-epin-1").submit(function(e){
    e.preventDefault();
    $('#submit-data').show();
    $('#submit-data-1').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-epin", 
        data: $("#mtn-epin-1").serialize(), 
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
               }
    
               setTimeout(function() {
                window.location.href = "network-epin";
              }, 2000);


        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data').hide();
                $('#submit-data-1').show();
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

                setTimeout(function() {
                    window.location.href = "network-epin";
                  }, 2000);
            }
            
        }
    }); 
    return false;
});


$("#epin-gol-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-ii').show();
    $('#submit-data-2').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-epin", 
        data: $("#epin-gol-1").serialize(), 
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
               }
    
               setTimeout(function() {
                window.location.href = "network-epin";
              }, 2000);
        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data-ii').hide();
                $('#submit-data-2').show();
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

                setTimeout(function() {
                    window.location.href = "network-epin";
                  }, 2000);
            }
            
        }
    }); 
    return false;
});


$("#epin-airtel-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-iii').show();
    $('#submit-data-3').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-epin", 
        data: $("#epin-airtel-1").serialize(), 
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
               }
    
               setTimeout(function() {
                window.location.href = "network-epin";
              }, 2000);


        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data-iii').hide();
                $('#submit-data-3').show();
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

                setTimeout(function() {
                    window.location.href = "network-epin";
                  }, 2000);
            }
            
        }
    }); 
    return false;
});


$("#epin-nine-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-iv').show();
    $('#submit-data-4').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-epin", 
        data: $("#epin-nine-1").serialize(), 
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
               }
    
               setTimeout(function() {
                window.location.href = "network-epin";
              }, 2000);


        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data-iv').hide();
                $('#submit-data-4').show();
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

                setTimeout(function() {
                    window.location.href = "network-epin";
                  }, 2000);
            }
            
        }
    }); 
    return false;
});

// USERS EPIN SECTION END

// USERS TV-SUBSCRIPTION SECTION START
$("#dstv").submit(function(e){
    e.preventDefault();
    $('#submit-data').show();
    $('#submit-data-1').hide();
    $('.text-strong').empty();
    $("#dstv-type").append('<option selected disabled>Select Your Plan</option>');
    $.ajax({
        url: "waveplus-tv-subscription", 
        data: $("#dstv").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
            if(response.success == true){
                $("#dstv-1").show();
                $("#gotv-1").hide()
                $("#startimes-1").hide()
                $("#dstv").hide();
                $('#submit-data').hide();
                $('#submit-data-1').show();
                $('#smart-card-1').val(response.data.card)
                $('#s-card').val(response.data.card)
                $('#username').text(response.data.username)
                $('#bouquet').text(response.data.bouquet)
                var variat = response.variation;
                const lenght = variat.length;
                for(var i = 0; i < lenght; i++) {
                   $("#dstv-type").append('<option value="'+variat[i].variation_code+'" data-id="'+variat[i].variation_amount+'">'+variat[i].name+'</option>');
                }
    

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
                $('#submit-data').hide();
                $('#submit-data-1').show();
               }
        },
        error:function(response){
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
            $('#submit-data').hide();
            $('#submit-data-1').show();
        }
    }); 
    return false;
});


$("#dstv-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-iv').show();
    $('#submit-data-4').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-tv-subscription-pay", 
        data: $("#dstv-1").serialize(), 
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
                    window.location.href = "tv-subscription";
                  }, 2000);
               }

               if(response.success == false){
                toastr.error(response.data.status,{
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

                $('#submit-data-iv').hide();
                $('#submit-data-4').show();
               }
    
             


        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data-iv').hide();
                $('#submit-data-4').show();
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

                setTimeout(function() {
                    window.location.href = "tv-subscription";
                  }, 2000);
            }
           
        }
    }); 
    return false;
});

$("#gotv").submit(function(e){
    e.preventDefault();
    $('#submit-data-ii').show();
    $('#submit-data-2').hide();
    $('.text-strong').empty();
    $("#dstv-type").append('<option selected disabled>Select Your Plan</option>');
    $.ajax({
        url: "waveplus-tv-subscription", 
        data: $("#gotv").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
            if(response.success == true){
                $("#dstv-1").hide();
                $("#startimes-11").hide()
                $("#gotv-1").show()
                $("#gotv").hide();
                $('#submit-data-ii').hide();
                $('#submit-data-2').show();
                $('#smart-card-11').val(response.data.card)
                $('#s-card-1').val(response.data.card)
                $('#username-1').text(response.data.username)
                $('#bouquet-1').text(response.data.bouquet)
                var variat = response.variation;
                const lenght = variat.length;
                for(var i = 0; i < lenght; i++) {
                   $("#gotv-type").append('<option value="'+variat[i].variation_code+'" data-id="'+variat[i].variation_amount+'">'+variat[i].name+'</option>');
                }
    
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
                $('#submit-data-ii').hide();
                $('#submit-data-2').show();
               }
        },
        error:function(response){
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
            $('#submit-data-ii').hide();
            $('#submit-data-2').show();
        }
    }); 
    return false;
});

$("#gotv-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-go').show();
    $('#submit-data-go-1').hide();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-tv-subscription-pay", 
        data: $("#gotv-1").serialize(), 
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
               }

             if(response.success == false){
                toastr.error(response.data.status,{
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
    
               setTimeout(function() {
                window.location.href = "tv-subscription";
              }, 2000);


        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data-go').hide();
                $('#submit-data-go-1').show();
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

                setTimeout(function() {
                    window.location.href = "tv-subscription";
                  }, 2000);
            }
           
        }
    }); 
    return false;
});

$("#startimes").submit(function(e){
    e.preventDefault();
    $('#submit-data-iii').show();
    $('#submit-data-3').hide();
    $('.text-strong').empty();
    $("#star-times").append('<option selected disabled>Select Your Plan</option>');
    $.ajax({
        url: "waveplus-verify-tv", 
        data: $("#startimes").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
            if(response.success == true){
                $("#dstv-1").hide();
                $("#gotv-1").hide()
                $("#startimes").hide()
                $("#showmax-1").hide()
                $('#submit-data-iii').hide();
                $('#submit-data-3').show();
                $("#startimes-1").show()
                $('#s-card-2').val(response.data.card_nummber)
                $('#s-card-ii').val(response.data.card_nummber)
                $('#username-2').text(response.data.username)
                $('#bouquet-2').text(response.data.balance)
                var variat = response.variation;
                const lenght = variat.length;
                for(var i = 0; i < lenght; i++) {
                   $("#star-times").append('<option value="'+variat[i].variation_code+'" data-id="'+variat[i].variation_amount+'">'+variat[i].name+'</option>');
                }
    
               }

               if(response.success == false){
                toastr.error(response.data,{
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
                $('#submit-data-iii').hide();
                 $('#submit-data-3').show();
               }
        },
        error:function(response){
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
            $('#submit-data-iii').hide();
            $('#submit-data-3').show();
        }
    }); 
    return false;
});

$("#startimes-1").submit(function(e){
    e.preventDefault();
    $('#submit-data-star').hide();
    $('#submit-data-star-1').show();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus-pay-star-show", 
        data: $("#startimes-1").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {

            // console.log(response);
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
                window.location.href = "tv-subscription";
              }, 2000);
               }

               if(response.success == false){
                toastr.error(response.data.status,{
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
                $('#submit-data-star').show();
                $('#submit-data-star-1').hide();
               }
        },
        error:function(response){
            if(response.responseJSON.success == false){
                $.each(response.responseJSON.errors,function(field_name,error){
                    $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
                })
                $('#submit-data-star').show();
                $('#submit-data-star-1').hide();
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

                setTimeout(function() {
                    window.location.href = "tv-subscription";
                  }, 2000);
            }
           
        }
    }); 
    return false;
});


$("#showmax").submit(function(e){
    e.preventDefault();
    $('#submit-data-s').hide();
    $('#submit-data-sx').show();
    $.ajax({
        url: "waveplus-pay-showmax", 
        data: $("#showmax").serialize(), 
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
                window.location.href = "tv-subscription";
              }, 2000);
               }

               if(response.success == false){
                toastr.error(response.data.status,{
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
                window.location.href = "tv-subscription";
              }, 2000);
               }
        },
        error:function(response){
            
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

                setTimeout(function() {
                    window.location.href = "tv-subscription";
                  }, 2000); 
            }

            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
            
            $('#submit-data-sx').hide();
            $('#submit-data-s').show();
        }

        



    })


})


// USERS TV-SUBSCRIPTION SECTION END





// USERS WALLET SECTION END


// ADMIN Section  Start
$('#code-generator').on('click', function(){
    $('#code').val();
    $.ajax({
        url: "get-code", 
        type: "GET", 
        success: function (response) {
            $('#code').val(response.data);
        }
    });
})



$('#set-code').on('click', function(){
    $('#code').val('');
    $.ajax({
        url: "get-code-ii", 
        type: "GET", 
        success: function (response) {
            $('#code').val(response.data);
        }
    });
})

$("#acad-code").submit(function(e){
    e.preventDefault();
    $('#point-i').show();
    $('#point').hide();
    $('#point-ii').empty();
    $.ajax({
        url: "save-code", 
        data: $("#acad-code").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
                $('#point-i').hide();
                $('#point').show();
                $('#point-ii').text(response.data.point);
            //    if(response.status == false){
            //     toastr.error(response.data,{
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

            //     $('#point-i').hide();
            //     $('#point').show();
            //    }
    
             


        },
        error:function(response){
            if(response.responseJSON.status == false){
                toastr.error(response.responseJSON.data,{
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
                $('#point-i').hide();
                $('#point').show();
                // setTimeout(function() {
                //     window.location.href = "tv-subscription";
                //   }, 2000);
            }
           
        }
    }); 
    return false;
});
// ADMIN Sexction End