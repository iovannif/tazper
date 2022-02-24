@php
use Tazper\Arqueo;
$a=Arqueo::orderBy('Id_Arq','desc')->first();
{{--$a->Arq_Est--}}
    $c='Cerrado';
@endphp

<!-- ventaja de tener estilo aca, no afecta a lo demas, interno, locol, este documento,
a menos que incluyas en otro, ahi les aplica
puede causar problemas si afuer hay elementos con los mismos nombres -->
<style>
    .l_boton{
        text-shadow: 1px 1px 1px #000;
        color: white;
        text-align: center;
        vertical-align: middle;
        padding: 4px 6px;
        border-radius: 2px;
        box-shadow: 1px 1px 2px 0 #131313;
        margin-top: 10px;
    }

    .l_der{
        margin-right: 5px;
    }

    #l_aceptar{
        background: #24B800;
        border: 1px solid #22AB00;
    }
    #l_aceptar:hover{
        background: #22AB00;        
    }

    #l_rechazar{
        background: red;
        border: 1px solid #E10000;
    }
    #l_cancelar:hover{
        background: #E10000;        
    }

    #l_cancelar{
        background: #dc3545;
        border: 1px solid #CC3140;
    }
    #l_cancelar:hover{
        background: #CC3140;
        border: 1px solid #CC3140;
    }
</style>

<!-- Logout, Cerrar Caja? -->
<div id="logout_arqueo">
    <table>          
        <tr><td class="center">Cerrar Caja?</td></tr>                                
        <tr><td class="center">
            <a href="{{url('/Arqueo_logout')}}" class="l_der">
                <button class="l_boton" id="l_aceptar">Aceptar</button>
            </a>
            <button class="l_boton l_der" id="l_rechazar">Rechazar</button>            
            <button class="l_boton" id="l_cancelar">Volver</button>
        </td></tr>                  
    </table>
    <input type="hidden" id="arq" value="{{$a->Arq_Est}}" disabled> {{--$c--}}
</div>

<script>
    //el documento (window) tiene que estar a la escucha
    //pone a los elementos del documento a la escucha
    // sino no detectan eventos que disparan triggers
    window.addEventListener("load", function(){ //los eventos
        //Logout
        $('#cerrar_sesion').click(function(e){
            if($('#arq').val()=='Abierto'){
                $('#logout_arqueo').show(); //anula efecto                     
            }else{
                document.getElementById('logout-form').submit();    
            }                
        });  

        //logout sin cerrar
        $('#l_rechazar').click(function(){        
            document.getElementById('logout-form').submit();
        });   
        //volver (cancelar)
        $('#l_cancelar').click(function(){        
            $('#logout_arqueo').hide();            
            // alert('test');
        });                         

            //css
            $('.l_boton').click(function(){ //focus        
                $(this).css('outline','none');
            });                         
    });
</script>