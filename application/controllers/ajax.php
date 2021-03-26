 window.onload = function(){

    
        $("#addCoupons").submit(function(event) { 
            event.preventDefault();
        }).validate({
            rules: {
                
            },
            submitHandler: function(form) {
                
                $.ajax({
                    url:'<?php echo base_url(); ?>add/addCoupons',
                    type: 'POST',
                    data: $(form).serialize(),
                    dataType:'json',
                    success:function(as){
                        if(as.status==1)
                        {
                            alert(as.message);
                            location.reload();
                        }
                        else
                        {
                            alert(as.message);
                        }
                    }
                });
                
            }
        });
    }
