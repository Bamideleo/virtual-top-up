$('#paystack-pay').on('keyup', function(){
    let amount = $('#paystack-pay').val();
    let rate = $('#paystack-rate').val();
    var percentage = Math.round((amount * rate) / 100);
   $('#paystack-charges').val(percentage);
    var total_amount = Number(amount) - Number(percentage) 
    $('#paystack-charges-1').text(percentage);
    $('#total-amount').val(total_amount);
    $('#total-amount-1').text(total_amount);
    $('#tran').show();
    $('#tran-1').show();
});



$("#paystack-ii").submit(function(){
    $('#submit-paystack').hide();
    $('#submit-paystack-1').show();
    $('.text-strong').empty();
    $.ajax({
        url: "waveplus/transfer", 
        data: $("#paystack-ii").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
            if(response.success == true){
                toastr.success("Details Submited Successfully",{
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
                window.location.href = "credit-wallet";
              }, 2000);
        },
        error:function(response){
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('.'+field_name+'').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
            $('#submit-paystack').show();
            $('#submit-paystack-1').hide();
        }
    }); 
    return false;
});



$("#vpay-acct").submit(function(e){
     e.preventDefault();
     $('#gen-1').hide();
     $('#gen-data').show();
    $.ajax({
        url: "generate-vpay", 
        data: $("#vpay-acct").serialize(), 
        type: "POST", 
        dataType: 'json',
        success: function (response) {
                window.location.href = "credit-wallet";
        },
        error:function(response){
            $.each(response.responseJSON.errors,function(field_name,error){
                toastr.success(error,{
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
         setTimeout(function() {
                window.location.href = "credit-wallet";
              }, 2000);
        }
    }); 
    return false;
});

// Free Bonus Section
$("#free-bonus").on('click',function(){
   var free = 0;
   $("#amount").val(free);
   $("#t-amount").val(free);
})

$("#free-bonus-i").on('click',function(){
    var free = 0;
    $("#gamount").val(free);
    $("#gt-amount").val(free);
 })

 $("#free-bonus-ii").on('click',function(){
    var free = 0;
    $("#at-amount").val(free);
    $("#a-amount").val(free);
 })

 $("#free-bonus-iii").on('click',function(){
    var free = 0;
    $("#n-amount").val(free);
    $("#nt-amount").val(free);
 })


 $("#free-airtime").on('click',function(){
    var free = 100;
    $("#mtn-pay").text(free);
    $("#t-amount").val(free);
 });

 $("#free-airtime-i").on('click',function(){
    var free = 100;
    $("#glo-pay").text(free);
    $("#gt-amount").val(free);
 });


 $("#free-airtime-ii").on('click',function(){
    var free = 100;
    $("#tel-pay").text(free);
    $("#ttel-amount").val(free);
 });

 $("#free-airtime-iii").on('click',function(){
    var free = 100;
    $("#eti-pay").text(free);
    $("#teti-amount").val(free);
 });

 


 // Set the date we're counting down to
 var bonus_timer = $("#bonus-timer").val();
var countDownDate = new Date(bonus_timer).getTime();
// Update the count down every 1 second
var x = setInterval(function() {
// Get today's date and time
  var now = new Date().getTime();
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = "<div style='font-size:24px;text-align:center;color:red;'><span>Your 2GB Bonus Expire In </span>"+days+ "<span>DAYS</span> :" + hours + "<span>HOUR</span> :" +
    minutes + "<span>MIN</span> :" + seconds + "<span>SEC</span> " +"<span>Hurry!!!</span></div>" ;

  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    $.ajax({
        url: "updata-bonus", 
        type: "GET", 
        success: function (response) {
            document.getElementById("demo").innerHTML = "EXPIRED"; 
            $("#demo").hide(); 
    },
    })
  }
}, 1000);


















// filter section for admin

$('#month-filter').on('change',function(){
   var year_data =  $('#year-filter').val();
   var month_data=  $('#month-filter').val();
   $.ajax({
    url:"get-transaction",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        year_data:year_data,
        month_data:month_data,
    },
    success: function (response) {
           $('#m-income').empty();
           $('#cb-i').empty();
           $('#m-income').append("<span>&#8358;"+new Intl.NumberFormat().format(response.data)+".00</span>")
           $('#cb-i').show();
           $('#cb').hide();
           $('#cb-i').append("<span>&#8358;"+new Intl.NumberFormat().format(response.data)+".00</span>")
           
    },
});


});


$('#service-id').on('change',function(){
var service_id =  $('#service-id').val();
$('#load').show();
$.ajax({
    url:"get-vtpass-service-id",
    type:"POST",
    headers: {'X-CSRF-TOKEN':token },
    data:{
        id:service_id,
    },
    success: function (response) {
        $('#load').hide();
           $('#s-id').empty();
           $('#s-id').append("<span>Request ID:"+response.data+"</span>")       
    },
});

});

