<!-- Cuadro Rechazo -->
<div id="rechazo"> <!-- eliminar -->
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No se puede eliminar el descuento, está referenciado</td></tr>             
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- activacion rechadaza -->
<div id="rechazo_act">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Solo puede haber un descuento activado a la vez</td></tr>        
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

@if(Session::has('descAct_rechazada'))
    <script>
        window.addEventListener("load", function(){
            $('#rechazo_act').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@endif