$(document).ready(function () {
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
        console.log('aqui')
        var elm = $(this);
         $('select[name=modulo_id]').html('<option value="">Modulos</option>');
        var retornoramos = function(result){
            var html = '<option value="">Modulos</option>';
            $.each(result, function(key, value){
                html += '<option value="'+value.modulo_id+'">'+value.titulo+'</option>';
            });
            $('select[name=modulo_id]').html(html);
        }
        $.getJSON(base_url+"/modulos/return_modulos_by_curso/"+elm.val(), retornoramos);

    });
});
