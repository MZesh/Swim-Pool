
$(document).ready(function(){ 
    $("#postcode").keypress(function(e){
        var keyCode = e.keyCode || e.which;
        
        $("#lblError").html("");

        //Regex for Valid Characters i.e. Numbers.
        var regex = /^[0-9]+$/;

        //Validate TextBox value against the Regex.
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lblError").html("Only Numbers allowed.");
            return false;
        }else{ 
            if(this.value.length > 4){
                $("#lblError").html("Only 5 digit number are allowed.");
                return false;
            }
        }
    });

    $("#telephone").keypress(function(e){
        var keyCode = e.keyCode || e.which;
        
        $("#lblErrortel").html("");
    
        //Regex for Valid Characters i.e. Numbers.
        var regex = /^[0-9]+$/;
    
        //Validate TextBox value against the Regex.
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lblErrortel").html("Only Numbers allowed.");
            return false;
        }else{ 
             
        }
      });

      $('.tabs').click(function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        var $this = $(this);
        if($('.tb-content').is($this.attr('href')))
        {  
            $('.tb-content').addClass('show');
            $('.tb-content').siblings().removeClass('show');
        } 
      });

      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
 
});

