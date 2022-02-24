window.addEventListener("load", function(){
    $(document).ready(function(){
        // masiva
        //set
        if(sessionStorage.getItem('proveedor_masiva')!=null){
            var check=document.getElementById('masiva');
            var chequeado=sessionStorage.getItem('proveedor_masiva');
            check.checked=chequeado; //marca

                $('input[name=masiva]').val('si'); //al cargar pag
        }else{
            $('input[name=masiva]').val('no');
        }
        //get
        $('#masiva').click(function(){
            if($(this).is(':checked')){
                var check=document.getElementById('masiva');
                sessionStorage.setItem('proveedor_masiva', check.checked);  
                
                    $('input[name=masiva]').val('si');
                    // console.log('si');
            }else{
                sessionStorage.removeItem('proveedor_masiva');

                    $('input[name=masiva]').val('no');
                    // console.log('no');
            }

            $('#des').focus();
        });

        // ejemplos
        //email
        $('input[name=Prov_Email]').focus(function(){
            $('.email').css('display','inline');
        });
        $('input[name=Prov_Email]').blur(function(){
            $('.email').css('display','none');
        });
        //web
        $('input[type=url]').focus(function(){
            $('.web').css('display','inline');
        });
        $('input[type=url]').blur(function(){
            $('.web').css('display','none');
        });

        //ajax
    // $('#registrar').click(function(){
    //     if($('#masiva').is(':checked')){
    //         $('input[name=masiva]').val('si');

                // event.preventDefault();

                // var des=$('#des').val();
                // var raz_soc=$('#raz_soc').val();
                // var ruc=$('#ruc').val();
                // var tel=$('#tel').val();
                // var cel=$('#cel').val();
                // var email=$('#email').val();
                // var web=$('#web').val();
                // var dir=$('#dir').val();                
                // var ciu=$('#ciu').val();
                // var bar=$('#bar').val();                
                // var ho=$('#ho').val();                
                // var est=$('#est').val();                
                // var obs=$('#obs').val();                                

                // var route="/Tazper/public/Proveedores";

                // $.ajax({
                //     async:false,
                //     url: route,
                //     type: 'POST',
                //     headers: {
                //         "X-CSRF-TOKEN":$("input[name=_token]").val()
                //     },
                //     data: {
                //         //campos        
                //         // 'Prov_Des': des,                                                    
                //         'des': des,
                //         'raz_soc': raz_soc,
                //         'ruc': ruc,
                //         'tel': tel,
                //         'cel': cel,
                //         'email': email,
                //         'web': web,
                //         'dir': dir,
                //         'ciu': ciu,
                //         'bar': bar,
                //         'ho': ho,                             
                //         'est': est,        
                //         'obs': obs,        
                //     },
                //     success: function(){
                //         console.log('success');
                        
                //         $('#des').val('').focus();
                //         $('#raz_soc').val('');
                //         $('#ruc').val('');
                //         $('#tel').val('');
                //         $('#cel').val('');
                //         $('#email').val('');
                //         $('#web').val('');
                //         $('#dir').val('');                
                //         $('#bar').val('');                
                //         $('#ho').val('');                
                //         $('#est').val('');                
                //         $('#obs').val('');                                                 
                //     },
                //     error: function (err) {
                //         if (err.status == 422) { // when status code is 422, it's a validation issue
                //             // console.log(err.responseJSON);
                //             $('.ajax_error').fadeIn().html(JSON.stringify(err.responseJSON));                                                                                                
                //         }
                //     }                                            
                // });                                                
    //     }else{
    //         $('input[name=masiva]').val('no');
    //     }
    // });
    });
});