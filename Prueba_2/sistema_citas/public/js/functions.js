$(document).ready(function()
{

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
    })

    $('#email').blur(function(){
        // Validar email;
        const regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

        if(!regex.test($('#email').val().trim())) {
            $('#email').val('');
            $('#emailHelp').removeClass('d-none');
            $('#emailHelp').text('El email no es válido');
        }
        else{
            $('#emailHelp').addClass('d-none');
            $('#emailHelp').empty();
        }

    });

    $('#nif').blur(function(){
        let nif = $('#nif').val();
        
        if(nif != "" && nif.length > 8 ){
            nif = nif.replace(/[^a-z0-9\s]/gi, '');
            nif = nif.replace(/\s+/g, '')
            nif = nif.toUpperCase();

            $.ajax({
            url:'ajax_query_comprobarnif',
            data:{
                'field':'nif',
                'value':nif         
                },
            type:'post',
            success: function (response) {
                    console.log(response);
                    $('#tipo_cita').empty();
                    $('#tipo_cita').append($("<option>", {
                        value: 'PRIMERA CONSULTA',
                        text: 'PRIMERA CONSULTA'
                    }));                
                    if(response.length > 0){
                        $('#tipo_cita').append($("<option>", {
                            value: 'REVISION',
                            text: 'REVISION'
                        }));
                    }
                        
            },
            statusCode: {
                404: function() {
                    $('#tipo_cita').empty();
                    alert('web not found');
                }
            },
            error:function(x,xs,xt){
                //nos dara el error si es que hay alguno
                //window.open(JSON.stringify(x));
                $('#tipo_cita').empty();
                alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            }
            });
        }
    });

});