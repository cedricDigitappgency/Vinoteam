$( document ).ready(function() {
    var resultTemplate,
    order_items_cnt = $('#order_item_number_new').val(),
    test,
    resultTemplateNewWine,
    resultTemplateAddWine,
    resultTemplateReadWine,
    templateHistory,
    closeModal = false,
    base_url = location.origin+'/';
    //base_url = 'http://localhost:8081/vinoteam/vinoteam-api/public/';
    // base_url = 'http://localhost/vinoteam/vinoteam-api/public/';

    //base_url = 'http://localhost:8888/vinoteam/public/';

    $.get(base_url+'js/order_item.html', function(data) {
      resultTemplate = data;
    });
    $.get(base_url+'js/readWine.html', function(data) {
      resultTemplateReadWine = data;
    });

    $("#destinataires").chosen();

    setTimeout(function(){
        manageInfobulle();
        changeOldMini();
    },400);

    function changeOldMini() {
      $('.wine_old_mini').each(function(index,value){
        $.get(base_url+"wines/"+$(value).attr('data-id'), function(data, status){
           if(data[0].path == null){
               var url = base_url+'images/bouteille-vinoteam.png';
           }
           else{
               var url = 'https://storage.googleapis.com/vino-team.appspot.com/storage'+data[0].path;
           }
           mini = '<div class="col-md-12" style="border: #d4d4d4 2px;"><div class="col-md-5"><img style="max-height:100px;" id="img_mini" src="'+url+'"></div><div class="col-md-7" style="padding-top:5px;"><div id="name_cru_mini">'+data[0].name_cru+' </div>';
            mini = mini + '<div id="year_mini">'+data[0].year+'</div>';
            mini = mini + '<div id="region_mini">'+data[0].region+'</div>';
            mini = mini + '<div id="productor_mini">'+data[0].productor+'</div></div></div>';
            $(value).append(mini);
        });
      });

    }

    function manageInfobulle() {
        if($('#order_item_zone').children().length != 0 || $('#number').text() != 1){
            $('#infobull').hide();
            $('#tableau_donnees').show();
        } else {
            $('#infobull').show();
            $('#tableau_donnees').hide();
        }
    }

    function getFrenchStatus(status) {
        if(status == 'unpaid')
            return 'En attente';

        if(status == 'paid')
            return '<div style="background-color:green; color:white; text-align:center;">Payé</div>';

        if(status == 'draft')
            return 'Brouillon';

        if(status == 'canceled')
            return 'Annulé';

        if(status == 'inprogress')
            return '<div style="background-color:green; color:white; text-align:center;">Virement validé</div>';
    }

    $('body').on('click','.close',function(){
        if(closeModal==true){
            var id=$(this).attr('data-id');
            setTimeout(function(){
                $('#tr_'+id).remove();
                $('#choseWine_'+id).remove();
                $('#addNewWine_'+id).remove();
                calculatePrice();
                manageInfobulle();
            },300);
            closeModal = false;
        }
    });

    $('body').on('change', '#cardExpirationDateYear,#cardExpirationDateMonth', function() {
      $('#cardExpirationDate').val($('#cardExpirationDateMonth').val()+$('#cardExpirationDateYear').val());
    });

    $('#tableau_donnees').hide();
    $('body').on('change','#order_item_zone',function(){
        manageInfobulle();
    });

    $('body').on('click','#add_order_item',function(){
      console.log(order_items_cnt);

      test = resultTemplate.replace(/countid/gm, order_items_cnt);
      $('#order_item_zone').append(test);
      loadSelectWines(order_items_cnt);
      order_items_cnt++;
      $('#order_item_number_new').val(order_items_cnt);
    });

    $.get(base_url+'js/modal_new_wine.html', function(data) {
        resultTemplateNewWine = data;
      });

    $('body').on('click','.addNewWineClick',function(){
      console.log(order_items_cnt);
      console.log($('#file_'+$(this).attr('data-id')));
      var files = $('#file_'+$(this).attr('data-id'))[0].files;
        console.log('file change');
        if (files.length > 0) {
            console.log('file ok');
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0];
            var urlFile = window.URL.createObjectURL(file);
        }else{
            var urlFile = base_url+'images/bouteille-vinoteam.png';
        }
      var mini = '<div class="col-md-12" style="border: #d4d4d4 2px;"><div class="col-md-5"><img style="max-height:100px;" id="img_mini" src="'+urlFile+'"></div><div class="col-md-7" style="padding-top:5px;"><div id="name_cru_mini">'+$('#name_cru_'+$(this).attr('data-id')).val()+' </div>';
      mini = mini + '<div id="year_mini">'+$('#year_'+$(this).attr('data-id')).val()+'</div>';
      mini = mini + '<div id="region_mini">'+$('#region_'+$(this).attr('data-id')).val()+'</div>';
      mini = mini + '<div id="productor_mini">'+$('#productor_'+$(this).attr('data-id')).val()+'</div></div></div>';

      var html = '<tr id="tr_'+order_items_cnt+'">';
      html = html+'<td class="lien-fiche"><a href="#" id="miniature" data-toggle="modal" data-target="#addNewWine_'+order_items_cnt+'">'+mini+'</a></td>';
      html= html+'<td style="vertical-align:middle; text-align:center;"><input type="number" class="form-control quantity" name="quantity_'+order_items_cnt+'" id="quantity_'+order_items_cnt+'"></td>';
      html = html+'<td style="vertical-align:middle; text-align:center;"><input type="text" class="form-control price_unit" data-id="'+order_items_cnt+'" name="price_unit_'+order_items_cnt+'" id="price_unit_'+order_items_cnt+'"></td>';
      html = html+'<td style="vertical-align:middle; text-align:center;"><select class="form-control" name="container_'+order_items_cnt+'" id="container_'+order_items_cnt+'" >';
      html = html+'<option value="75cl">75cl</option>';
      html=html+'<option value="37,5cl">37,5cl</option>';
      html=html+'<option value="1,5L">1,5L</option>';
      html=html+'<option value="autres">autres</option>';
      html=html+'</select></td>';
      html=html+'<td style="vertical-align:middle; text-align:center;"><input type="text" class="form-control price_total" data-id="'+order_items_cnt+'" id="price_total_'+order_items_cnt+'"></td>'
      html = html+ '<td style="vertical-align:middle; text-align:center;"><button type="button" data-id="'+order_items_cnt+'" class="btn btn-danger del_item btn-lg"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
      //loadSelectWines(order_items_cnt);
      $('#data').append(html);
      order_items_cnt++;
      $('#order_item_number_new').val(order_items_cnt);
      closeModal = false;

      $('#addNewWine_'+(order_items_cnt-1)).children().children().children('.modal-header').children('.close').removeClass('close');
      $('#addNewWine_'+(order_items_cnt-1)).children().children().children('.modal-footer').children('.addNewWineClick').removeClass('addNewWineClick');
      //console.log($('#addNewWine_'+(order_items_cnt-1)).children().children().children('.modal-header').children('.close'));
      console.log($('#addNewWine_'+(order_items_cnt-1)).children().children().children('.modal-footer').children('.addNewWineClick'));
    });

    $('body').on('click','.addNewWine',function(){
      $(this).attr('data-target','#addNewWine_'+order_items_cnt);
      test = resultTemplateNewWine.replace(/countid/gm, order_items_cnt);
      $('#order_item_zone').append(test);
      closeModal = true;
    });

    $.get(base_url+'js/modal_add_wine.html', function(data) {
        resultTemplateAddWine = data;
      });

    $('body').on('click','.addWine',function(){
      $(this).attr('data-target','#choseWine_'+order_items_cnt);
      test = resultTemplateAddWine.replace(/countid/gm, order_items_cnt);
      $('#order_item_zone').append(test);
      closeModal = true;
      loadSelectWines(order_items_cnt);
    });

    $('body').on('click','.readWine',function(){
       $('#zoneModal').empty();
       $('#zoneModal').append(resultTemplateReadWine);
       $.get(base_url+"wines/"+$(this).attr('data-id'), function(data, status){
           if(data[0].path == null){
               var url = base_url+'images/bouteille-vinoteam.png';
           }
           else{
               var url = 'https://storage.googleapis.com/vino-team.appspot.com/storage'+data[0].path;
           }
            $('#file_show_img').attr('src',url);
            $('#name_cru').val(data[0].name_cru);
            $('#year').val(data[0].year);
            $('#region').val(data[0].region);
            $('#productor').val(data[0].productor);
            $('#message').text(data[0].message);
        });
    });

    $('body').on('click','.comment-ca-marche',function(){
        console.log('comment-ca-marche');
        window.location.href = base_url+'comment-ca-marche?tab=comment-ca-marche';

    });

    $('body').on('click','.tarifs',function(){
        console.log('tarifs');
        window.location.href = base_url+'comment-ca-marche?tab=tarifs';

    });

    $('body').on('click','.securite',function(){
        console.log('securite');
        window.location.href = base_url+'comment-ca-marche?tab=securite';

    });

    $('body').on('click','.conditions-generales',function(){
        console.log('conditions generales');
        window.location.href = base_url+'comment-ca-marche?tab=conditions-generales';

    });

    $('body').on('click','.partenaires',function(){
        console.log('parts');
        window.location.href = base_url+'comment-ca-marche?tab=partenaires';

    });

    $('body').on('click','.contact',function(){
        console.log('contact');
        window.location.href = base_url+'comment-ca-marche?tab=contact';

    });

    $('body').on('click','.professionnels-du-vin',function(){
        console.log('pro du vins');
        window.location.href = base_url+'comment-ca-marche?tab=professionnels-du-vin';

    });

    $('body').on('click','.addNewWineClickCave',function(){
        var files = $('#file')[0].files;
        console.log('file change');
        if (files.length > 0) {
            console.log('file ok');
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0];
            var urlFile = window.URL.createObjectURL(file);
        }else{
            var urlFile = base_url+'images/bouteille-vinoteam.png';
        }
        $('#img_mini').attr('src',urlFile);
        $('#name_cru_mini_text').text($('#name_cru').val());
        $('#year_mini_text').text($('#year').val());
        $('#productor_mini_text').text($('#productor').val());
        $('#region_mini_text').text($('#region').val());
        $('#typeWine').val('new');
        console.log($('#miniature'));
        $('#miniature').show();
        $('#miniature').attr('data-target','#addNewWine');
    });

    $('body').on('dragenter','.upload-drop-zone',function(){
       $(this).css('border','3px dashed red');
       //return false;
    });

    $('body').on('dragover','.upload-drop-zone',function(e){
       //e.preventDefault();
       //e.stopPropagation();
       $(this).css('border','3px dashed red');
       //return false;
    });

    $('body').on('dragleave','.upload-drop-zone',function(e){
       //e.preventDefault();
       //e.stopPropagation();
       $(this).css('border','3px dashed #BBBBBB');
       //return false;
    });

    $('body').on('drop','.upload-drop-zone',function(e){
       if(e.originalEvent.dataTransfer){
           if(e.originalEvent.dataTransfer.files.length){
               //stop the propagtion of the event
               //e.preventDefault();
               //e.stopPropagation();
               $(this).css('border','3px dashed green');
               //Main function to upload

               //upload(e.originalEvent.dataTransfer.files,$(this).attr('data-id'));
           }
       }
       else{
           $(this).css('border','3px dashed #BBBBBB');
       }
       //return false;
    });

    function upload(files,id){
        var f = files[0];
        console.log(files);
        //document.getElementById('file_'+id).val(files[0]);
        console.log(document.getElementById('file_'+id).files);
        $('#file_'+id).value = f;
        console.log($('#file_'+id)[0].files);

    }

    $('body').on('click','.addWineClickCave',function(){

        var mini = '';
      $.get(base_url+"wines/"+$('#wine_id').val(), function(data, status){
           console.log(data);
           if(data[0].path != null && data[0].path != undefined){
               var urlFile = 'https://storage.googleapis.com/vino-team.appspot.com/storage'+data[0].path;
           }else{
                var urlFile = base_url+'images/bouteille-vinoteam.png';
            }
            $('#img_mini').attr('src',urlFile);
            $('#name_cru_mini_text').text(data[0].name_cru);
            $('#year_mini_text').text(data[0].year);
            $('#productor_mini_text').text(data[0].region);
            $('#region_mini_text').text(data[0].productor);
            console.log($('#miniature'));
            $('#miniature').show();
            $('#miniature').attr('data-target','#choseWine');

      });
        $('#typeWine').val('old');
    });


    $('body').on('click','.addWineClick',function(){
      var mini = '';
      $.get(base_url+"wines/"+$('#wine_id_'+order_items_cnt).val(), function(data, status){
           console.log(data);
           if(data[0].path != null && data[0].path != undefined){
               var urlFile = 'https://storage.googleapis.com/vino-team.appspot.com/storage'+data[0].path;
           }else{
                var urlFile = base_url+'images/bouteille-vinoteam.png';
            }

            mini = '<div class="col-md-12" style="border: #d4d4d4 2px;"><div class="col-md-5"><img style="max-height:100px;" id="img_mini" src="'+urlFile+'"></div><div class="col-md-7" style="padding-top:5px;"><div id="name_cru_mini">'+data[0].name_cru+' </div>';
            mini = mini + '<div id="year_mini">'+data[0].year+'</div>';
            mini = mini + '<div id="region_mini">'+data[0].region+'</div>';
            mini = mini + '<div id="productor_mini">'+data[0].productor+'</div></div></div>';
            console.log(mini);

            console.log(mini);
            console.log(order_items_cnt);
            var html = '<tr id="tr_'+order_items_cnt+'">';
            html = html+'<td class="lien-fiche"><a id="miniature" data-toggle="modal" data-target="#choseWine_'+order_items_cnt+'" disabled>'+mini+'</a></td>';
            html= html+'<td style="vertical-align:middle; text-align:center;"><input type="number" class="form-control quantity" name="quantity_'+order_items_cnt+'" id="quantity_'+order_items_cnt+'"></td>';
            html = html+'<td style="vertical-align:middle; text-align:center;"><input type="text" class="form-control price_unit" data-id="'+order_items_cnt+'" name="price_unit_'+order_items_cnt+'" id="price_unit_'+order_items_cnt+'"></td>';
            html = html+'<td style="vertical-align:middle; text-align:center;"><select class="form-control" name="container_'+order_items_cnt+'" id="container_'+order_items_cnt+'" >';
            html = html+'<option value="75cl">75cl</option>';
            html=html+'<option value="37,5cl">37,5cl</option>';
            html=html+'<option value="1,5L">1,5L</option>';
            html=html+'<option value="autres">autres</option>';
            html=html+'</select></td>';
            html=html+'<td style="vertical-align:middle; text-align:center;"><input type="text" class="form-control price_total" data-id="'+order_items_cnt+'" id="price_total_'+order_items_cnt+'"></td>'
            html = html+ '<td style="vertical-align:middle; text-align:center;"><button type="button" data-id="'+order_items_cnt+'" class="btn del_item btn-danger btn-lg"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
            $('#data').append(html);
            loadSelectWines(order_items_cnt);
            order_items_cnt++;
            $('#order_item_number_new').val(order_items_cnt);
            closeModal = false;
            //$('#choseWine_'+(order_items_cnt-1)).children().children().children('.modal-header').children('.close').removeClass('close');
            $('#choseWine_'+(order_items_cnt-1)).children().children().children('.modal-footer').children('.addWineClick').removeClass('addWineClick');
      });
    });

    $('body').on('click','.del_item',function(){
        var id=$(this).attr('data-id');
        $('#tr_'+id).remove();
        $('#choseWine_'+id).remove();
        $('#addNewWine_'+id).remove();
        calculatePrice();
        manageInfobulle();
    });

    $('body').on('input paste propertychange','.price_unit,.quantity',function(){
       calculatePrice();
    });

    $('body').on('change','#owner_id',function(){
        if( $.isNumeric( $(this).val() )){
            $('#owner_email').hide();
        }
        else{
            $('#owner_email').show();
        }
    });

    function loadSelectWines(id){
        $('#wine_id_'+id).empty();
        $.get(base_url+"user/"+$('#user_id').val()+"/wines", function(data, status){
            console.log(data);
            console.log(status);
            $.each(data,function(index,value){
              if( value.year == '' ) {
                $('#wine_id_'+id).append('<option value="'+value.id+'">'+value.name_cru+'</option>');
              } else {
                $('#wine_id_'+id).append('<option value="'+value.id+'">'+value.name_cru+' ('+value.year+')</option>');
              }
            });
        });

    }

    function loadSelectWinesCave(){
        $.get(base_url+"user/"+$('#user_id').val()+"/wines", function(data, status){
            console.log(data);
            console.log(status);
            $.each(data,function(index,value){
              if( value.year == '' ) {
                $('#wine_id').append('<option value="'+value.id+'">'+value.name_cru+'</option>');
              } else {
                $('#wine_id').append('<option value="'+value.id+'">'+value.name_cru+' ('+value.year+')</option>');
              }
            });
        });
    }

    function calculatePrice(){
        var totalPrice = 0,qte=0;
        $('.price_unit').each(function(index,value){

            if($('#quantity_'+$(value).attr('data-id')).val() == null){
                qte=1;

            }
            else{
                qte=$('#quantity_'+$(value).attr('data-id')).val();
            }
            $('#price_total_'+$(value).attr('data-id')).val($(value).val()*qte);
            totalPrice = totalPrice + $(value).val()*qte;
        });

        $('#price').val(totalPrice);
    }

    function resetWineForm(id){
        $('#name_cru_'+id).val('');
        $('#year_'+id).val('');
        $('#region_'+id).val('');
        $('#productor_'+id).val('');
        $('#file_'+id).val('');
        $('#message_'+id).text('');
        $('#file_show_'+id).find('.cancel_file').trigger('click');
        $('#file_id_'+id).val('0');
    }

    function resetWineFormHouse(){
        $('#name_cru').val('');
        $('#year').val('');
        $('#region').val('');
        $('#productor').val('');
        $('#file').val('');
        $('#message_wine').text('');
        $('#file_show').find('.cancel_file').trigger('click');
        $('#file_id').val('0');
    }

    $('body').on('change','.wine_id_select',function(){
        console.log('load wine info');
        console.log($(this).val());
        var id_order_item = $(this).attr('data-id');
        resetWineForm(id_order_item);
       $.get(base_url+"wines/"+$(this).val(), function(data, status){
           console.log(data);


            console.log(id_order_item);
            $('#name_cru_'+id_order_item).val(data[0].name_cru);
            $('#year_'+id_order_item).val(data[0].year);
            $('#region_'+id_order_item).val(data[0].region);
            $('#productor_'+id_order_item).val(data[0].productor);
            if(data[0].file_id != null){
                $('#file_show_'+id_order_item).find('.thumbnail').removeClass('hidden');
                $('#file_show_'+id_order_item).find('img').attr('src', data[0].path);
                $('#file_show_'+id_order_item).find('h4').html(data[0].name);
                $('#file_id_'+id_order_item).val(data[0].file_id);
            }
            $('#file_'+id_order_item).val();
            $('#message_'+id_order_item).text(data[0].message);

        });
    });

    function loadOrders(){
        $.get(base_url+"orders/owner/"+$('#user_id').val(),function(data, status){
            console.log(data);
            if(data.length != 0){

                $.each(data,function(index,value){
                    var html = '<tr>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.created_at+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.price+'</td>';
                    if( value.firstname ) {
                        html = html + '<td style="vertical-align:middle; text-align:center;">'+value.firstname+' '+value.lastname+'</td>';
                    } else {
                        html = html + '<td style="vertical-align:middle; text-align:center;">'+value.email+'</td>';
                    }
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+getFrenchStatus(value.status)+'</td>';
                    if(value.status == 'unpaid'){
                        //html = html + '<td><button id="pay" type="button">Rembourser</button></td>';
                        html = html + '<td style="vertical-align:middle; text-align:center;"><input type="button" name="Consulter" class="btn btn-info" value="Consulter" onclick="self.location.href=\''+base_url+'orders/'+value.id+'/consult\'" onclick><input type="button" name="Rembourser" style="margin-left:5px;" class="btn btn-primary" value="Rembourser" onclick="self.location.href=\''+base_url+'orders/'+value.id+'/payment/validate\'" onclick></td>';
                    } else {
                        html = html + '<td style="vertical-align:middle; text-align:center;"><input type="button" name="Consulter" class="btn btn-info" value="Consulter" onclick="self.location.href=\''+base_url+'orders/'+value.id+'/consult\'" onclick></td>'
                    }
                    html=html+'</tr>';
                    $('#dataOwner').append(html);
                });
            }
            else{
                $('#dataOwner').parent().hide();
                console.log('hide');
            }
        });
        $.get(base_url+"orders/buyer/"+$('#user_id').val(),function(data, status){
            console.log(data);
            if(data.length != 0){
                $.each(data,function(index,value){
                    var html = '<tr>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.created_at+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.price+'</td>';
                    if( value.firstname ) {
                        html = html + '<td style="vertical-align:middle; text-align:center;">'+value.firstname+' '+value.lastname+'</td>';
                    } else {
                        html = html + '<td style="vertical-align:middle; text-align:center;">'+value.email+'</td>';
                    }
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+getFrenchStatus(value.status)+'</td>';
                    if(value.status == 'draft' || value.status == 'unpaid'){
                        html = html + '<td style="vertical-align:middle; text-align:center;"><input type="button" name="Consulter" class="btn btn-info" value="Consulter" onclick="self.location.href=\''+base_url+'orders/'+value.id+'/consult\'" onclick><input type="button" class="btn btn-warning" style="margin-left:5px;" name="edit" value="Modifier" onclick="self.location.href=\''+base_url+'orders/'+value.id+'/edit\'" onclick><input type="button" name="cancel" class="btn btn-danger" style="margin-left:5px;" value="Annuler" onclick="self.location.href=\''+base_url+'orders/'+value.id+'/cancel\'" onclick></td>';
                    }else{
                        html = html + '<td style="vertical-align:middle; text-align:center;"><input type="button" name="Consulter" class="btn btn-info" value="Consulter" onclick="self.location.href=\''+base_url+'orders/'+value.id+'/consult\'" onclick></td>';
                    }
                    html=html+'</tr>';
                    $('#dataBuyer').append(html);
                });
            }
            else{
                $('#dataBuyer').parent().hide();
                console.log('hide');
            }
        });
        $.get(base_url+"orders/owner/validated/"+$('#user_id').val(),function(data, status){
            console.log(data);
            if(data.length != 0){
                $.each(data,function(index,value){
                    var html = '<tr>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.created_at+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.price+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.email+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+getFrenchStatus(value.status)+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;"></td>';
                    html=html+'</tr>';
                    $('#dataOwnerValidated').append(html);
                });
            }
            else{
                $('#dataOwnerValidated').parent().hide();
                console.log('hide');
            }
        });
        $.get(base_url+"orders/buyer/validated/"+$('#user_id').val(),function(data, status){
            console.log(data);
            if(data.length != 0){
                $.each(data,function(index,value){
                    var html = '<tr>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.created_at+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.price+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.email+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+getFrenchStatus(value.status)+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;"></td>';
                    html=html+'</tr>';
                    $('#dataBuyerValidated').append(html);
                });
            }
            else{
                $('#dataBuyerValidated').parent().hide();
                console.log('hide');
            }
        });

    }
    loadOrders();

    $('body').on('click','#history',function(){
       $.get(base_url+"houses/"+$(this).attr('data-id')+"/history",function(data, status){
            console.log(data);
            if(data.length != 0){
                $('.zoneMouvement').empty();
                var html = '<table class="table table-striped"><thead><tr class="redtable"><th class="text-center">Date</th><th class="text-center">Quantité</th><th class="text-center">Emplacement</th><th class="text-center">Auteur de la modification</th></tr>';
                $.each(data,function(index,value){
                    if(value.owner_name == null){
                        var owner = value.owner_mail;
                    }
                    else{
                        var owner = value.owner_firstname + ' '+ value.owner_name;
                    }
                    if(value.buyer_name == null){
                        var buyer = value.buyer_mail;
                    }
                    else{
                        var buyer = value.buyer_firstname + ' '+ value.buyer_name;
                    }
                    html = html+'<tr><td style="vertical-align:middle; text-align:center;">'+value.created_at+'</td><td style="vertical-align:middle; text-align:center;">'+value.quantity+'</td><td style="vertical-align:middle; text-align:center;">'+buyer+'</td><td style="vertical-align:middle; text-align:center;">?</td></tr>'
                });
                html = html+'</table>';
                $('.zoneMouvement').html(html);
            }

        });
    });

    function loadHouses(){
        $.get(base_url+'js/modalMouvement.html', function(data) {

            $('#modalHistoryZone').html(data);
            console.log(templateHistory);
        });

        $.get(base_url+"houses/owner/"+$('#user_id').val(),function(data, status){
            console.log(data);
            if(data.length != 0){
                $.each(data,function(index,value){
                    if(value.path == null || value.path == undefined){
                        var urlImg = base_url+'images/bouteille-vinoteam.png';
                    }
                    else{
                        var urlImg = 'https://storage.googleapis.com/vino-team.appspot.com/storage'+value.path;
                    }

                    var html = '<tr>';
                    html = html + '<td class="lien-fiche"><a href="#" id="miniature" class="readWine" data-toggle="modal" data-id="'+value.wine_id+'" data-target="#readWine"><div class="col-md-12" style="border: #d4d4d4 2px;" ><div class="col-md-5"><img style="max-height:100px;" id="img_mini" src="'+urlImg+'"></div><div class="col-md-7" style="padding-top:5px;"><div id="name_cru_mini">'+value.name_cru+'</div>';
                    html = html + '<div id="year_mini">'+value.year+'</div>';
                    html = html + '<div id="productor_mini">'+value.productor+'</div>';
                    html = html + '<div id="region_mini">'+value.region+'</div>';
                    html = html + '</div></div></a></td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.created_at+'</td>';
                    if( value.firstname ) {
                        html = html + '<td style="vertical-align:middle; text-align:center;">'+value.firstname+' '+value.lastname+'</td>';
                    } else {
                        html = html + '<td style="vertical-align:middle; text-align:center;">'+value.email+'</td>';
                    }
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.quantity+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.container+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;"><input type="button" name="edit" value="Modifier" class="btn btn-warning" onclick="self.location.href=\''+base_url+'houses/owner/'+value.id+'/edit\'" onclick><br /><br /><input type="button" name="historique" id="history" data-toggle="modal" data-target="#modalMouvement" value="Historique" data-id="'+value.id+'" class="btn btn-warning"></td>';
                    html=html+'</tr>';
                    $('#dataOwnerHouses').append(html);
                });
            }
            else{
                $('#dataOwnerHouses').parent().hide();
                console.log('hide');
            }

        });
        $.get(base_url+"houses/buyer/"+$('#user_id').val(),function(data, status){
            console.log(data);
            if(data.length != 0){
                $.each(data,function(index,value){
                    if(value.path == null || value.path == undefined){
                        var urlImg = base_url+'images/bouteille-vinoteam.png';
                    }
                    else{
                        var urlImg = 'https://storage.googleapis.com/vino-team.appspot.com/storage'+value.path;
                    }
                    var html = '<tr>';
                    html = html + '<td class="lien-fiche"><a href="#" id="miniature" class="readWine" data-toggle="modal" data-id="'+value.wine_id+'" data-target="#readWine"><div class="col-md-12" style="border: #d4d4d4 2px;" ><div class="col-md-5"><img style="max-height:100px;" id="img_mini" src="'+urlImg+'"></div><div class="col-md-7" style="padding-top:5px;"><div id="name_cru_mini">'+value.name_cru+'</div>';
                    html = html + '<div id="year_mini">'+value.year+'</div>';
                    html = html + '<div id="productor_mini">'+value.productor+'</div>';
                    html = html + '<div id="region_mini">'+value.region+'</div>';
                    html = html + '</div></div></a></td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.created_at+'</td>';
                    if( value.firstname ) {
                        html = html + '<td style="vertical-align:middle; text-align:center;">'+value.firstname+' '+value.lastname+'</td>';
                    } else {
                        html = html + '<td style="vertical-align:middle; text-align:center;">'+value.email+'</td>';
                    }
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.quantity+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;">'+value.container+'</td>';
                    html = html + '<td style="vertical-align:middle; text-align:center;"><input type="button" name="edit" value="Modifier" class="btn btn-warning" onclick="self.location.href=\''+base_url+'houses/buyer/'+value.id+'/edit\'" onclick><br /><br /><input type="button" name="historique" id="history" data-toggle="modal" data-target="#modalMouvement" value="Historique" data-id="'+value.id+'" class="btn btn-warning"></td>';
                    html=html+'</tr>';
                    $('#dataBuyerHouses').append(html);
                });
            }
            else{
                $('#dataBuyerHouses').parent().hide();
                console.log('hide');
            }
        });
        // $.get(base_url+"houses/empty/owner/"+$('#user_id').val(),function(data, status){
        //     console.log(data);
        //     if(data.length != 0){
        //         $.each(data,function(index,value){
        //             if(value.path == null || value.path == undefined){
        //                 var urlImg = base_url+'images/bouteille-vinoteam.png';
        //             }
        //             else{
        //                 var urlImg = value.path;
        //             }
        //             var html = '<tr>';
        //             html = html + '<td>'+value.created_at+'</td>';
        //             html = html + '<td><button style="width:150px !important;" type="button" class="readWine" data-toggle="modal" data-id="'+value.wine_id+'" data-target="#readWine"><div class="col-md-6"><img style="width:200px !important; height:100px !important;" src="'+urlImg+'"></div><div class="col-md-6"><div class="col-md-2">'+value.name_cru+'</div>';
        //             html = html + '<div class="col-md-2">'+value.year+'</div>';
        //             html = html + '<div class="col-md-2">'+value.region+'</div>';
        //             html = html + '<div class="col-md-2">'+value.productor+'</div></div>';
        //             html = html + '</button></td>';
        //             html = html + '<td>'+value.email+'</td>';
        //             html = html + '<td>'+value.quantity+'</td>';
        //             html = html + '<td>'+value.container+'</td>';
        //             html = html + '<td><input type="button" name="edit" class="btn btn-warning" value="Modifier" onclick="self.location.href=\''+base_url+'houses/owner/'+value.id+'/edit\'" onclick><input type="button" name="historique" id="history" value="Historique" data-id="'+value.id+'" data-toggle="modal" data-target="#modalMouvement" class="btn btn-warning"></td>';
        //             html=html+'</tr>';
        //             $('#dataOwnerHousesEmpty').append(html);
        //         });
        //     }else{
        //         $('#dataOwnerHousesEmpty').parent().hide();
        //         console.log('hide');
        //     }
        // });
        // $.get(base_url+"houses/empty/buyer/"+$('#user_id').val(),function(data, status){
        //     console.log(data);
        //     if(data.length != 0){
        //         $.each(data,function(index,value){
        //             if(value.path == null || value.path == undefined){
        //                 var urlImg = base_url+'images/bouteille-vinoteam.png';
        //             }
        //             else{
        //                 var urlImg = value.path;
        //             }
        //             var html = '<tr>';
        //             html = html + '<td>'+value.created_at+'</td>';
        //             html = html + '<td><button style="width:150px !important;" type="button" class="readWine" data-toggle="modal" data-id="'+value.wine_id+'" data-target="#readWine"><div class="col-md-6"><img style="width:200px !important; height:100px !important;" src="'+urlImg+'"></div><div class="col-md-6"><div class="col-md-2">'+value.name_cru+'</div>';
        //             html = html + '<div class="col-md-2">'+value.year+'</div>';
        //             html = html + '<div class="col-md-2">'+value.region+'</div>';
        //             html = html + '<div class="col-md-2">'+value.productor+'</div></div>';
        //             html = html + '</button></td>';
        //             html = html + '<td>'+value.email+'</td>';
        //             html = html + '<td>'+value.quantity+'</td>';
        //             html = html + '<td>'+value.container+'</td>';
        //             html = html + '<td><input type="button" name="edit" class="btn btn-warning" value="Modifier" onclick="self.location.href=\''+base_url+'houses/buyer/'+value.id+'/edit\'" onclick><input type="button" name="historique" value="Historique" id="history" data-toggle="modal" data-target="#modalMouvement" data-id="'+value.id+'" class="btn btn-warning"></td>';
        //             html=html+'</tr>';
        //             $('#dataBuyerHousesEmpty').append(html);
        //         });
        //     }
        //     else{
        //         $('#dataBuyerHousesEmpty').parent().hide();
        //         console.log('hide');
        //     }
        // });

    }
    loadHouses();


    $('body').on('change','.wine_id_select_house',function(){
        console.log('load wine info');
        console.log($(this).val());

        resetWineFormHouse();
       $.get(base_url+"wines/"+$(this).val(), function(data, status){
           console.log(data);

            $('#name_cru').val(data[0].name_cru);
            $('#year').val(data[0].year);
            $('#region').val(data[0].region);
            $('#productor').val(data[0].productor);
            if(data[0].file_id != null){
                $('#file_show').find('.thumbnail').removeClass('hidden');
                $('#file_show').find('img').attr('src', data[0].path);
                $('#file_show').find('h4').html(data[0].name);
                $('#file_id').val(data[0].file_id);
            }
            $('#file').val();
            $('#message_wine').text(data[0].message);

        });
    });


    $('body').on('change','.file', function (e) {
        var files = $(this)[0].files;
        console.log('file change');
        if (files.length > 0) {
            console.log('file ok');
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0],
                $image_preview = $('#file_show_'+$(this).attr('data-id'));
            if(file.size < 1000000 ){
                $('#alert_size').remove();
                // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
                $image_preview.find('.thumbnail').removeClass('hidden');
                $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
                $image_preview.find('h4').html(file.name);
                $image_preview.find('.caption p:first').html(file.size +' bytes');
            }
            else{

                var html = '<div id="alert_size" class="alert alert-danger" role="alert"> Fichier trop volumineux </div>';
                $(this).after(html);
                console.log('fichier trop volumineux');
                $(this).val('');
            }
        }
    });

    // Bouton "Annuler" pour vider le champ d'upload
    $('body').on('click','.cancel_file', function (e) {
        e.preventDefault();

        $('#file_'+$(this).attr('data-id')).val('');
        $('#file_show_'+$(this).attr('data-id')).find('.thumbnail').addClass('hidden');
    });

    $('body').on('change','.file_order', function (e) {
        var files = $(this)[0].files;
        console.log('file change');
        if (files.length > 0) {
            console.log('file ok');
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0],
                $image_preview = $('#file_show_order');
            if(file.size < 1000000 ){
                $('#alert_size_order').remove();
                // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
                $image_preview.find('.thumbnail').removeClass('hidden');
                $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
                $image_preview.find('h4').html(file.name);
                $image_preview.find('.caption p:first').html(file.size +' bytes');
            }
            else{
                var html = '<div id="alert_size_order" class="alert alert-danger" role="alert"> Fichier trop volumineux </div>';
                $(this).after(html);
                console.log('fichier trop volumineux');
                $(this).val('');
            }
        }
    });



    // Bouton "Annuler" pour vider le champ d'upload
    $('body').on('click','.cancel_file_order', function (e) {
        e.preventDefault();

        $('#file').val('');
        $('#file_show_order').find('.thumbnail').addClass('hidden');
    });

    $('body').on('change','.file_house', function (e) {
        var files = $(this)[0].files;
        console.log('file change');
        if (files.length > 0) {
            console.log('file ok');
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0],
                $image_preview = $('#file_show_house');
            if(file.size < 1000000 ){
                $('#alert_size_house').remove();
                // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
                $image_preview.find('.thumbnail').removeClass('hidden');
                $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
                $image_preview.find('h4').html(file.name);
                $image_preview.find('.caption p:first').html(file.size +' bytes');
            }
            else{
                var html = '<div id="alert_size_house" class="alert alert-danger" role="alert"> Fichier trop volumineux </div>';
                $(this).after(html);
                console.log('fichier trop volumineux');
                $(this).val('');
            }
        }
    });

    // Bouton "Annuler" pour vider le champ d'upload
    $('body').on('click','.cancel_file_house', function (e) {
        e.preventDefault();

        $('#file').val('');
        $('#file_show_house').find('.thumbnail').addClass('hidden');
    });




});
