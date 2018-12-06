$(document).ready(function() {
    $('.date').mask('00/00/0000');
    $('[name=cnpj]').mask('00.000.000/0000-00');
    $('.telefone').mask(function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    }, {
        onKeyPress: function(val, e, field, options) {
            field.mask(maskBehavior.apply({}, arguments), options);
        }
    });
    $('.cep').mask('00000-000', {
        onComplete: function(val){
            if(!$('.loading').get(0)){
                $('.cep').after('<i class="fa fa-refresh fa-spin loading"></i>');
                $.post(base_url+'api/cep', {cep: val}, function(result){
                    $('.loading').remove();
                    $.each(result, function(name, value){
                        $('[name='+name+']').val(value);
                    });
                    new dgCidadesEstados({estado: $('[name=estado]').get(0), 
                        cidade: $('[name=cidade]').get(0),
                        estadoVal: result.estado,
                        cidadeVal: result.cidade
                    });
                    $('[name=numero]').focus();
                }, 'json')
            }
        }
    });
    if($('[name=cidade]').get(0)){
         new dgCidadesEstados({
            estado: $('[name=estado]').get(0), 
            cidade: $('[name=cidade]').get(0),
            estadoVal: $('#estado_val').val(),
            cidadeVal: $('#cidade_val').val()
        });
    }

    $('.btn-remove-img').on('click', function(e){
        e.preventDefault();
        if(confirm('Você tem certeza que gostaria de remover essa imagem?')){
            var elm = $(this);
            elm.parents('.thumbnail').fadeOut();
            $.getJSON(elm.attr('href'), function(data){
                if(data.status == 'erro'){
                    alert(data.msg);
                }
            });
        }
    });

    $('.delete').on('click', function(e){
        e.preventDefault();
        if(confirm('Você tem certeza que gostaria de remover esse registro?')){
            var elm = $(this);
            elm.parents('tr').fadeOut(function(){ $(this).remove(); });
            $.get(elm.attr('href'), function(data){
                if(data != 'ok'){
                    alert(data);
                }
            });
        }
    });

    $('.cbox_iframe').fancybox({
        type: 'iframe',
        width: '100%',
        height: '100%'
    });
    $('.cbox').fancybox({
        type: 'ajax'
    });
    $('a.gerar_fatura').on('click', function(e){
        e.preventDefault();
        var elm = $(this);
        $.get(elm.attr('href'), function(data){
            alert(data);
        });
    });
});


