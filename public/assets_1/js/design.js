function vpay(){
   const vpay = $('#v-pay').val();
      if (vpay == "1") {
          $(document).ready(function(){  
        $("#exampleModalCenter").modal("show");
        }) 
      }
}
vpay();