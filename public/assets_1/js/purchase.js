// Spec Section
$('#spec-type').on('change',function(){
 var amount = $(this).find('option:selected').attr("data-id");
    var rate = $('#charges').val();
    var cashback =$('#ch-back').val();
    // alert(rate);
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) + Number(percentage) 
  $('#spec-amount').val(total_amount);
  $('#t-amount').val(total_amount);
   var per_age = Math.round((amount * cashback) / 100);
      $('#cash-back').val(per_age);
      $('#spe-cb').text(per_age);
      $('#spe-cb-1').css({"display":"block"});
})

// Smile Section
$('#smile-type').on('change',function(){
 var amount = $(this).find('option:selected').attr("data-id");
  var rate = $('#charges').val();
  var cashback =$('#ch-back').val();
    // alert(rate);
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) + Number(percentage) 
  $('#spec-amount').val(total_amount);
  $('#t-amount').val(total_amount);
   var per_age = Math.round((amount * cashback) / 100);
      $('#cash-back').val(per_age);
      $('#cas-b').css({'display':'block'});
      $('#cash-b').text(per_age);
      

})


// Dstv Section
$('#dstv-type').on('change', function(){
  var amount = $(this).find('option:selected').attr("data-id");
  var rate = $('#charges').val();
  $('#amount').val('')
var percentage = Math.round((amount * rate) / 100);
var total_amount = Number(amount) - Number(percentage) 
$('#dstv-amount').val(total_amount);
$('#t-amount').val(total_amount);

})

$('#amount').on('keyup', function(){
  var amount = $('#amount').val()
  var rate = $('#charges').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#dstv-amount').val(total_amount);
  $('#t-amount').val(total_amount);
})


// Section Gotv
$('#gotv-type').on('change',function(){
 var amount = $(this).find('option:selected').attr("data-id");
  var rate = $('#charges').val();
 $('#go-amount').val('')
var percentage = Math.round((amount * rate) / 100);
var total_amount = Number(amount) - Number(percentage) 
$('#gotv-amount').val(total_amount);
$('#gt-amount').val(total_amount);

})


$('#go-amount').on('keyup', function(){
  var amount = $('#go-amount').val()
  var rate = $('#charges').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#gotv-amount').val(total_amount);
  $('#gt-amount').val(total_amount);
})


// StarTimes Sections
$('#star-times').on('change', function(){
  var amount = $(this).find('option:selected').attr("data-id");
  $('#sts-amount').val('')
  var rate = $('#charges').val();

var percentage = Math.round((amount * rate) / 100);
var total_amount = Number(amount) - Number(percentage) 
$('#star-time-amount').val(total_amount);
$('#st-amount').val(total_amount);

})

$('#sts-amount').on('keyup', function(){
  var amount = $('#sts-amount').val()
  var rate = $('#charges').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#star-time-amount').val(total_amount);
  $('#st-amount').val(total_amount);
})


// showmax Section

$('#smax-type').on('change', function(){
    
  var amount = $(this).find('option:selected').attr("data-id");

  var rate = $('#charges').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#smax-amount').val(total_amount);
  $('#xmax-amount').val(total_amount);

})

// Electricity Section
$('#ts-amount').on('keyup',function(){
  var rate = $('#charges').val();
  var amount = $('#ts-amount').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#amount').val(total_amount);
  $('#t-amount').val(total_amount);
})


// weace registration
$('#ex-phone').on('keyup',function(){
  var rate = $('#charges').val();
  var amount = $('#wea-amount').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#amount').val(total_amount);
  $('#t-amount').val(total_amount);
})


$('#re-phone').on('keyup',function(){
  var rate = $('#charges').val();
  var amount = $('#wea-amount-1').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#amount-1').val(total_amount);
  $('#t-amount-1').val(total_amount);
})


// Data SECTION
$("#mtn-plan-1").on ('change', function(){
  var plan = $("#mtn-plan-1").val();
  var amount = $(this).find('option:selected').attr("data-id");
  $.ajax({
    url:"amount-pay",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        type:plan,
    },

    success:function(data){
      var rate = $('#charges').val();
      var cashback = $('#ch-back').val();
    //   if(data.data.data_type == 4){
    //     var rate = 1;
    //   var percentage = Math.round((amount * rate) / 100);
    //   var total_amount = Number(amount) + Number(percentage) 
    //   $('#amount').val(total_amount);
    //   $('#t-amount').val(total_amount);
    //   $('#tamount').val(amount);
    //   }
      var percentage = Math.round((amount * rate) / 100);
        // alert(percentage);
      var total_amount = Number(amount) + Number(percentage) 
      $('#amount').val(total_amount);
      $('#t-amount').val(total_amount);
      $('#tamount').val(amount);
      var per_age = Math.round((amount * cashback) / 100);
      $('#cash-back').val(per_age);
      $('#mtn-cb').text(per_age);
      $('#mtn-cb-1').css({"display":"block"});
      
    }

});

})

$('#gol-plan-1').on('change', function(){
  var plan = $("#gol-plan-1").val();
  var amount = $(this).find('option:selected').attr("data-id");
  $.ajax({
    url:"amount-pay",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        type:plan,
    },

    success:function(data){
     var rate = $('#charges').val();
      var cashback = $('#ch-back').val();
    //   if(data.data.data_type == 4){
    //   var rate = 1;
    //   var percentage = Math.round((amount * rate) / 100);
    //   var total_amount = Number(amount) + Number(percentage) 
    //   $('#gamount').val(total_amount);
    //   $('#gt-amount').val(total_amount);
    //   $('#gtamount').val(amount);
    //   }
      
      var percentage = Math.round((amount * rate) / 100);
      var total_amount = Number(amount) + Number(percentage) 
      $('#gamount').val(total_amount);
      $('#gt-amount').val(total_amount);
      $('#gtamount').val(amount);
    //   var percentage = Math.round((data.data.amount * rate) / 100);
    //   var total_amount = Number(data.data.amount) + Number(percentage) 
    //   $('#gamount').val(total_amount);
    //   $('#gt-amount').val(total_amount);
    //   $('#gtamount').val(data.data.amount);
      var per_age = Math.round((amount * cashback) / 100);
      $('#gcash-back').val(per_age);
      $('#glo-cb').text(per_age);
      $('#glo-cb-1').css({"display":"block"});
    }

});
})


$('#airtel-plan-1').on('change', function(){
  var plan = $("#airtel-plan-1").val();
   var amount = $(this).find('option:selected').attr("data-id");
  $.ajax({
    url:"amount-pay",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        type:plan,
    },

    success:function(data){
     var rate = $('#charges').val();
     var cashback = $('#ch-back').val();
    //   if(data.data.data_type == 4){
    //   var rate = 1;
    //   var percentage = Math.round((amount * rate) / 100);
    //   var total_amount = Number(amount) + Number(percentage) 
    //   $('#a-amount').val(total_amount);
    //   $('#at-amount').val(total_amount);
    //   $('#atamount').val(amount);
    //   }
      var percentage = Math.round((amount * rate) / 100);
      var total_amount = Number(amount) + Number(percentage) 
      $('#a-amount').val(total_amount);
      $('#at-amount').val(total_amount);
      $('#atamount').val(amount);
    
      // var percentage = Math.round((data.data.amount * rate) / 100);
      // var total_amount = Number(data.data.amount) + Number(percentage) 
      // $('#a-amount').val(total_amount);
      // $('#at-amount').val(total_amount);
      // $('#atamount').val(data.data.amount);

      var per_age = Math.round((amount * cashback) / 100);
      $('#aircash-back').val(per_age);
      $('#air-cb').text(per_age);
      $('#air-cb-1').css({"display":"block"});
    }

});
})


$('#nine-plan-1').on('change', function(){
  var plan = $("#nine-plan-1").val();
  var amount = $(this).find('option:selected').attr("data-id");
  $.ajax({
    url:"amount-pay",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        type:plan,
    },

    success:function(data){
      var rate = $('#charges').val();
      var cashback = $('#ch-back').val();
    //   if(data.data.data_type == 4){
    //   var rate = 1;
    //   var percentage = Math.round((amount * rate) / 100);
    //   var total_amount = Number(amount) + Number(percentage) 
    //   $('#n-amount').val(total_amount);
    //   $('#nt-amount').val(total_amount);
    //   $('#ntamount').val(amount);
    //   }
      var percentage = Math.round((amount * rate) / 100);
      var total_amount = Number(amount) + Number(percentage) 
      $('#n-amount').val(total_amount);
      $('#nt-amount').val(total_amount);
      $('#ntamount').val(amount);
    
    // var percentage = Math.round((data.data.amount * rate) / 100);
    //   var total_amount = Number(data.data.amount) + Number(percentage) 
    //   $('#n-amount').val(total_amount);
    //   $('#nt-amount').val(total_amount);
    //   $('#ntamount').val(data.data.amount);
      
       var per_age = Math.round((amount * cashback) / 100);
      $('#ncash-back').val(per_age);
      $('#nine-cb').text(per_age);
      $('#nine-cb-1').css({"display":"block"});
    }

});
})

$('#mtn-amount').on('keyup', function(){
  var rate = $('#charges').val();
   var cashback = $('#ch-back').val();
  var amount = $('#mtn-amount').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#t-amount').val(total_amount);
  $('#mtn-pay').text(total_amount)
  $('#mtn-pay-1').show();
   var per_age = Math.round((amount * cashback) / 100);
      $('#cash-back').val(per_age);
      $('#mtn-cb').text(per_age);
      $('#mtn-cb-1').css({"display":"block"});
})

$('#glo-amount').on('keyup', function(){
  var rate = $('#charges').val();
  var amount = $('#glo-amount').val();
  var cashback = $('#ch-back').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#gt-amount').val(total_amount);
  $('#glo-pay').text(total_amount)
  $('#glo-pay-1').show();
   var per_age = Math.round((amount * cashback) / 100);
    $('#gcash-back').val(per_age);
    $('#glo-cb').text(per_age);
    $('#glo-cb-1').css({"display":"block"});
})

$('#tel-amount').on('keyup', function(){
  var rate = $('#charges').val();
  var amount = $('#tel-amount').val();
  var cashback = $('#ch-back').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#ttel-amount').val(total_amount);
  $('#tel-pay').text(total_amount)
  $('#tel-pay-1').show();
     var per_age = Math.round((amount * cashback) / 100);
      $('#aircash-back').val(per_age);
      $('#air-cb').text(per_age);
      $('#air-cb-1').css({"display":"block"});
})

$('#eti-amount').on('keyup', function(){
  var rate = $('#charges').val();
  var cashback = $('#ch-back').val();
  var amount = $('#eti-amount').val();
  var percentage = Math.round((amount * rate) / 100);
  var total_amount = Number(amount) - Number(percentage) 
  $('#teti-amount').val(total_amount);
  $('#eti-pay').text(total_amount)
  $('#eti-pay-1').show();
  var per_age = Math.round((amount * cashback) / 100);
   $('#ncash-back').val(per_age);
   $('#nine-cb').text(per_age);
   $('#nine-cb-1').css({"display":"block"});
})

$('#r-bonus').on('click',function(){
  let id = $(this).attr('data-id');
  let type = $(this).attr('data-type');
  $.ajax({
    url:"clam-bonus",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        type:type,
        id:id
    },
    success:function(response){
      if(response.success ==true){
        toastr.success(response.message,{
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
        window.location.href = "home";
      }, 2000);
      }

      if(response.success ==false){
        toastr.success(response.message,{
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
      //   window.location.href = "home";
      // }, 2000);
      }
    }

});

})

$('#copy-link').on('click',function(){
  $(this).siblings('input.ref').select();      
  document.execCommand("copy");
  toastr.success("Copied",{
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
})

$('#cash-back').on('click',function(){
    
    $.ajax({
    url:"cash_back",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    success:function(response){
      if(response.success ==true){
        toastr.success(response.message,{
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
        window.location.href = "home";
      }, 2000);
      }

      if(response.success ==false){
        toastr.success(response.message,{
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
    }

}); 
})

$('#code').on('click',function(){
    $('#coupon').css({'display':'block'});
})

$('#glo-code').on('click',function(){
    $('#coupon-2').css({'display':'block'});
})

$('#tel-code').on('click',function(){
    $('#coupon-3').css({'display':'block'});
})

$('#nin-code').on('click',function(){
    $('#coupon-4').css({'display':'block'});
})

$('#coupon-1').on('keyup',function(){
   var coupon =  $('#coupon-1').val();
    
 $.ajax({
    url:"apply_coupon",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        coupon:coupon,
    },
    success:function(response){
    if(response.success ==false){
    var rate = $('#charges').val();
    var amount = $('#mtn-amount').val();
    var percentage = Math.round((amount * rate) / 100);
    var total_amount = Number(amount) - Number(percentage) 
    $('#t-amount').val(total_amount);
    $('#mtn-pay').text(total_amount);
        toastr.success(response.data,{
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
     
      }else{
    var rate_2 = response.data;
    var amt = $('#t-amount').val();
    var percentage = Math.round((amt * rate_2) / 100);
    var total_amt = Number(amt) - Number(percentage) 
    $('#t-amount').val(total_amt);
    $('#mtn-pay').text(total_amt); 
      }
    }

}); 
})

$('#coupon-11').on('keyup',function(){
   var coupon =  $('#coupon-11').val();
    
 $.ajax({
    url:"apply_coupon",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        coupon:coupon,
    },
    success:function(response){
    
    if(response.success ==false){
        toastr.success(response.data,{
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
     
      }else{
    var rate_2 = response.data;
    var amt = $('#t-amount').val();
    var percentage = Math.round((amt * rate_2) / 100);
    var total_amt = Number(amt) - Number(percentage) 
    $('#t-amount').val(total_amt);
    $('#amount').val(total_amt);
   
      }
    
      
    }

}); 
})



$('#coupon-i').on('keyup',function(){
   var coupon =  $('#coupon-i').val();
    
 $.ajax({
    url:"apply_coupon",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        coupon:coupon,
    },
    success:function(response){
     if(response.success ==false){
    var rate = $('#charges').val();
    var amount = $('#glo-amount').val();
    var percentage = Math.round((amount * rate) / 100);
    var total_amount = Number(amount) - Number(percentage) 
    $('#gt-amount').val(total_amount);
    $('#glo-pay').text(total_amount);
        toastr.success(response.data,{
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
     
      }else{
    var rate_2 = response.data;
    var amt = $('#gt-amount').val();
    var percentage = Math.round((amt * rate_2) / 100);
    var total_amt = Number(amt) - Number(percentage) 
    $('#gt-amount').val(total_amt);
    $('#glo-pay').text(total_amt);  
      }
    }

}); 
})

$('#coupon-22').on('keyup',function(){
   var coupon =  $('#coupon-22').val();
    
 $.ajax({
    url:"apply_coupon",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        coupon:coupon,
    },
    success:function(response){
    
    if(response.success ==false){
        toastr.success(response.data,{
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
     
      }else{
    var rate_2 = response.data;
    var amt = $('#gt-amount').val();
    var percentage = Math.round((amt * rate_2) / 100);
    var total_amt = Number(amt) - Number(percentage) 
    $('#gt-amount').val(total_amt);
    $('#gamount').val(total_amt);
   
      }
    
      
    }

}); 
})

$('#coupon-ii').on('keyup',function(){
   var coupon =  $('#coupon-ii').val();
    
 $.ajax({
    url:"apply_coupon",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        coupon:coupon,
    },
    success:function(response){
    if(response.success ==false){
    var rate = $('#charges').val();
    var amount = $('#tel-amount').val();
    var percentage = Math.round((amount * rate) / 100);
    var total_amount = Number(amount) - Number(percentage) 
     $('#ttel-amount').val(total_amount);
     $('#tel-pay').text(total_amount)
        toastr.success(response.data,{
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
     
      }else{
    var rate_2 = response.data;
    var amt = $('#ttel-amount').val();
    var percentage = Math.round((amt * rate_2) / 100);
    var total_amt = Number(amt) - Number(percentage) 
    $('#ttel-amount').val(total_amt);
    $('#tel-pay').text(total_amt);
      }
  
  
     
    }

}); 
})

$('#coupon-33').on('keyup',function(){
   var coupon =  $('#coupon-33').val();
    
 $.ajax({
    url:"apply_coupon",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        coupon:coupon,
    },
    success:function(response){
    
    if(response.success ==false){
        toastr.success(response.data,{
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
     
      }else{
    var rate_2 = response.data;
    var amt = $('#at-amount').val();
    var percentage = Math.round((amt * rate_2) / 100);
    var total_amt = Number(amt) - Number(percentage)
    // alert(total_amt);
    $('#at-amount').val(total_amt);
    $('#a-amount').val(total_amt);
   
      }
    
      
    }

}); 
})

$('#coupon-iii').on('keyup',function(){
   var coupon =  $('#coupon-iii').val();
    
 $.ajax({
    url:"apply_coupon",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        coupon:coupon,
    },
    success:function(response){
    
     if(response.success ==false){
        toastr.success(response.data,{
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
     
      }else{
    var rate_2 = response.data;
    var amt = $('#teti-amount').val();
    var percentage = Math.round((amt * rate_2) / 100);
    var total_amt = Number(amt) - Number(percentage) 
    $('#teti-amount').val(total_amt);
    $('#eti-pay').text(total_amt);  
      }   
    
   
  
     
    }

}); 
})

$('#coupon-44').on('keyup',function(){
   var coupon =  $('#coupon-44').val();
    
 $.ajax({
    url:"apply_coupon",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        coupon:coupon,
    },
    success:function(response){
    
    if(response.success ==false){
        toastr.success(response.data,{
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
     
      }else{
    var rate_2 = response.data;
    var amt = $('#nt-amount').val();
    var percentage = Math.round((amt * rate_2) / 100);
    var total_amt = Number(amt) - Number(percentage)
    // alert(total_amt);
    $('#nt-amount').val(total_amt);
    $('#n-amount').val(total_amt);
   
      }
    
      
    }

}); 
})
