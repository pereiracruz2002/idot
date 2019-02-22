
$(function () {
    var settings = {
        rows: 4,
        cols: 4,
        rowCssPrefix: 'row-',
        colCssPrefix: 'col-',
        seatWidth: 35,
        seatHeight: 35,
        seatCss: 'seat',
        selectedSeatCss: 'selectedSeat',
		selectingSeatCss: 'selectingSeat'
    };

    var init = function (reservedSeat) {
        var str = [], seatNo, className;
        var contador = 1;
        for (i = 0; i < settings.rows; i++) {
            for (j = 0; j < settings.cols; j++) {
                seatNo = contador;
                className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
                if ($.isArray(reservedSeat) && $.inArray(seatNo, reservedSeat) != -1) {
                    className += ' ' + settings.selectedSeatCss+'_'+settings.colCssPrefix + j.toString();
                }
                str.push('<li class="' + className + '"' +
                          'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +
                          '<a title="' + seatNo + '">' + seatNo + '</a>' +
                          '</li>');
                contador++;
            }
        }
        $('#place').html(str.join(''));
    };

    //case I: Show from starting
    //init();

    //Case II: If already booked

    //var bookedSeats = [1,2,3,4,5,6,7,8,9];
    console.log(bookedSeats)
    init(bookedSeats);


    

    $('#btnShow').click(function () {
        var str = [];
        $.each($('#place li.' + settings.selectedSeatCss + ' a, #place li.'+ settings.selectingSeatCss + ' a'), function (index, value) {
            str.push($(this).attr('title'));
        });
        alert(str.join(','));
    })

    $('#btnShowNew').click(function () {
        var str = [], item;
        $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
            item = $(this).attr('title');                   
            str.push(item);                   
        });
        alert(str.join(','));
    })

    $('.data_dia').on('click',function(){
        var data_dia = $(this).val();
        

        $.post(base_url+"/agendamento/returnDadosDia",
          {
            data_dia: data_dia

          },
          function(data, status){
             $('.dias_semana').each(function( index ) {
                if($( this ).attr('data-dias') != data){
                    $( this ).attr("disabled", true);
                }else{
                    $( this ).removeAttr("disabled", true);
                } 
            });
        });   
    })

    $('.dias_semana').on('click',function(){
        var dias_semana = $(this).val();
        var data_dia = $('.data_dia:checked').val();
        var agenda_id = $('#minha_agenda_id').val();
        $.post(base_url+"/agendamento/returnVagas",
          {
            data_dia: data_dia,
            dias_semana: dias_semana,
            agenda_id:agenda_id
          },
          function(data, status){
           console.log(Object.keys(data).length)
           if(Object.keys(data).length > 0){
            var bookedSeats = [];
            for (i = 0; i < Object.keys(data).length; i++) { 
               bookedSeats.push(parseInt(data[i].mesa));
            }
              
                console.log(bookedSeats)
               
           }else{
                var bookedSeats = [0]; 
           }
            init(bookedSeats);
             teste();
          
        });
           
    })

    function teste(){
        $('.' + settings.seatCss).on('click',function () {

        console.log('aqui no teste')
        
        if ($(this).hasClass('selectedSeat_col-0') || $(this).hasClass('selectedSeat_col-1') || $(this).hasClass('selectedSeat_col-2') || $(this).hasClass('selectedSeat_col-3')){
            alert('Esse acento esta reservado');
        }else{
            
            $( "#place li" ).each(function( index ) {
                if($(this).hasClass('selectingSeat_impar') || $(this).hasClass('selectingSeat_par')){
                   $(this).removeClass('selectingSeat_impar');
                    
                }

                if($(this).hasClass('selectingSeat_par')){
                   $(this).removeClass('selectingSeat_par');   
                }
                   
            });


            
            $('input[name=mesa]').val($(this).find('a').attr('title'))
            if ($(this).hasClass('col-0') || $(this).hasClass('col-2')){
                settings.selectingSeatCss =" selectingSeat_par";
            }else{
                 settings.selectingSeatCss =" selectingSeat_impar";
            }

            $(this).toggleClass(settings.selectingSeatCss);

            var dias_semana = $('.dias_semana:checked').val();
            var data_dia = $('.data_dia:checked').val();
            var agenda_id = $('#minha_agenda_id').val();
            var aluno_id = $('#aluno_id').val();

            $.post(base_url+"/agendamento/trocarData",
              {
                data_dia: data_dia,
                dias_semana: dias_semana,
                agenda_id:agenda_id,
                aluno_id: aluno_id
              },
              function(data, status){
               
               //if(data.status > 0){
                
                   $('.confirmar_presenca').removeClass('hide');
               
               //}  
            });
        }
        
        
    });
    }

    $('.' + settings.seatCss).on('click',function () {
        


        
        if ($(this).hasClass('selectedSeat_col-0') || $(this).hasClass('selectedSeat_col-1') || $(this).hasClass('selectedSeat_col-2') || $(this).hasClass('selectedSeat_col-3')){
            alert('Esse acento esta reservado');
        }else{

            var dias_semana = $('.dias_semana:checked').val();
            var data_dia = $('.data_dia:checked').val();
            var agenda_id = $('#minha_agenda_id').val();
            var aluno_id = $('#aluno_id').val();

            
        
            $( "#place li" ).each(function( index ) {
                if($(this).hasClass('selectingSeat_impar') || $(this).hasClass('selectingSeat_par')){
                   $(this).removeClass('selectingSeat_impar');
                    
                }

                if($(this).hasClass('selectingSeat_par')){
                   $(this).removeClass('selectingSeat_par');   
                }
                   
            });


            
            $('input[name=mesa]').val($(this).find('a').attr('title'))
            if ($(this).hasClass('col-0') || $(this).hasClass('col-2')){
                settings.selectingSeatCss =" selectingSeat_par";
            }else{
                 settings.selectingSeatCss =" selectingSeat_impar";
            }

            $(this).toggleClass(settings.selectingSeatCss);

            $.post(base_url+"/agendamento/trocarData",
              {
                data_dia: data_dia,
                dias_semana: dias_semana,
                agenda_id:agenda_id,
                aluno_id: aluno_id
              },
              function(data, status){
               
               //if(data.status > 0){
                
                   $('.confirmar_presenca').removeClass('hide');
               
               //}  
            });
        }
        
        
    });
});