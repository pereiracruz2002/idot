$(document).ready(function () {
    //$('select[name=encontro_id]').parent().parent().hide();

    tinymce.init({
        selector: '.mytextarea',
        powerpaste_word_import: 'prompt',
        powerpaste_html_import: 'prompt',
     });

    // tinymce.init({
    //   selector: '.mytextarea',
    //   height: 400,
    //   menubar: true,
    //   plugins: [
    //     'advlist autolink lists link image charmap print preview anchor',
    //     'searchreplace visualblocks advcode fullscreen',
    //     'insertdatetime media table contextmenu powerpaste'
    //   ],
    //   toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code',
    //   powerpaste_allow_local_images: true,
    //   powerpaste_word_import: 'prompt',
    //   powerpaste_html_import: 'prompt',
      
    // });

    $('body').on('click', '.delete', function (e) {
        e.preventDefault();
        var _self = $(this);
        var decisao = confirm("Tem certeza que deseja excluir?");
        if (decisao) {
            $.get(_self.attr('data-remove'));
            if ($('.alert-success').length == 0)
                $('.m-top-md').after('<div class="alert alert-success"><p>Removido com sucesso!</p></div>');
            _self.parents('tr').fadeOut();
        }
    });


    $('body').on('click', '.confirmar_presenca', function (e) {
        e.preventDefault();
        var _self = $(this);
        var decisao = confirm("Tem certeza que deseja confirmar presença do aluno?");
        if (decisao) {
            $.get(_self.attr('data-confirm'));
            uri = _self.attr('href')
            if ($('.alert-success').length == 0)
                $('.m-top-md').after('<div class="alert alert-success"><p>Registrado a presença do aluno!</p></div>');
            window.location= base_url+'agendamento/ver_inscritos/'+uri;
        }
    });

     $('body').on('click', '.change_status', function (e) {
        e.preventDefault();
        var _self = $(this);
        var decisao = confirm("Tem certeza que deseja confirmar essa aula como finalizada?");
        if (decisao) {
            $.get(_self.attr('href'));
            if ($('.alert-success').length == 0)
                $('.m-top-md').after('<div class="alert alert-success"><p>Status da aula alterado com sucesso!</p></div>');
            window.location= base_url+'/agendamento';
        }
    });

    $('body').on('click', '.confirmar', function (e) {
        e.preventDefault();
        var _self = $(this);
        var decisao = confirm("Tem certeza que deseja confirmar esse agendamento da aula?");
        if (decisao) {
            $.get(_self.attr('href'));
            if ($('.alert-success').length == 0)
                $('.m-top-md').after('<div class="alert alert-success"><p>Revisao da aula confirmada!</p></div>');
            window.location= base_url+'/agendamento/ver_minha_agenda';
        }
    });


    $("div.panel-show-hide").click(function () {
        var heading = $(this);
        var caret = heading.find("i");

        heading.next().fadeToggle();
        if (caret.hasClass('caret-down'))
            caret.removeClass('caret-down').removeClass('fa-caret-down').addClass('fa-caret-up').addClass('caret-up');
        else
            caret.removeClass('caret-up').removeClass('fa-caret-up').addClass('fa-caret-down').addClass('caret-down');
    });

    $('select[name=curso_id]').change(function(){
        var elm = $(this);
         $('select[name=modulo_id]').html('<option value="">--Selecione--</option>');
        var retornoramos = function(result){
            var html = '<option value="">--Selecione--</option>';
            var nivel = 1;
            $.each(result, function(key, value){
                nivel = value.nivel;
                if(value.nivel!=2){
                    html += '<option value="'+value.modulos_id+'">'+value.titulo+'</option>';
                }else{
                     html += '<option value="'+value.submodulo+'">'+value.submodulo+'</option>';  
                }
            });
            if(nivel!=2){
                $('select[name=encontro_id]').parent().hide();
                $('select[name=encontro_id]').parent().parent().hide();
                $('select[name=modulo_id]').html(html);  
            }else{
                $('select[name=encontro_id]').parent().removeClass('hide');
                $('select[name=encontro_id]').parent().parent().find( "label" ).removeClass('hide');
                $('select[name=encontro_id]').html(html); 
            }
            
        }
        $.getJSON(base_url+"/modulos/return_modulos_by_curso/"+elm.val(), retornoramos);

    });


    $('select[name=encontro_id]').change(function(){
        var elm = $(this);
        var retornoramos = function(result){
            var html = '<option value="">--Selecione--</option>';
            
            $.each(result, function(key, value){
                html += '<option value="'+value.modulos_id+'">'+value.titulo+'</option>';
    
            });
            $('select[name=modulo_id]').html(html);  
        }
        $.getJSON(base_url+"/modulos/return_modulos_by_submodulo/"+elm.val(), retornoramos);
    });


    $('select[name=modulo_id]').change(function(){
        var elm = $(this);
        //$('select[name=modulo_id]').html('<option value="">--Selecione--</option>');
        var retornoramos = function(result){
            
            if(result[0].nivel==2){
                $('select[name=encontro_id]').parent().removeClass('hide');
                $('select[name=encontro_id]').parent().parent().find( "label" ).removeClass('hide');
                var html = '<option value="">--Selecione--</option>';
                $.each(result, function(key, value){
                    html += '<option value="'+value.encontros_id+'">'+value.titulo+'</option>';
                });
                $('select[name=encontro_id]').html(html);
            }else{
                $('select[name=encontro_id]').parent().hide();
                $('select[name=encontro_id]').parent().parent().hide(); 
            }
            
        }
        $.getJSON(base_url+"/encontros/return_encontros_by_modulos/"+elm.val(), retornoramos);

    });
});
