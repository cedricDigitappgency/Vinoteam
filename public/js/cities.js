$( document ).ready(function() {
    // $( "#city_name" ).autocomplete({
       
    //   source: "http://dev.vinoteam.fr/cities",
    //   minLength: 3,
    //   select: function( event, ui ) {
    //     $('#city_id').val(ui.item.id);  
    //   }
    // });

    $('.input-datepicker').datepicker({
      yearRange: '1930:1998'
    });

    setTimeout(function(){
        $('#zipcode').trigger('input');
        
    },200);
    
    $('body').on('input paste propertychange','#zipcode',function(){
        var id=$(this).val();
	  var dataString = 'term='+ id;
          if($(this).val().length > 4){
              
            $.ajax ({
                  type: "GET",
                  // url: "http://localhost/vinoteam/vinoteam-api/public/cities/zipcode",
                  url: "http://localhost:8888/vinoteam/public/cities/zipcode",
                  data: dataString,
                  cache: false,
                  success: function(datas) {
                          html = '';
                          $.each(datas,function(index,value){
                              if($('#city_select_id').val() == value.id){
                                   html += '<option value="'+value.id+'" selected>'+value.label+'</option>';
                              }
                              else{
                                  html += '<option value="'+value.id+'">'+value.label+'</option>';
                              }
                                  
                          });
                    $("select#city_id").html(html);
                  } 
            });
          }
	});
    });
    
    $('body').on('change','#city_id',function(){
        if($(this).val() == 0){
            $('#city_select_id').val(0); 
        }
        else{
            $('#city_select_id').val($(this).val()); 
        }
            
    });
