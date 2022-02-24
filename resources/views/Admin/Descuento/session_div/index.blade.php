<!-- Cuadro Eliminado -->
<div id="eliminado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Descuento eliminado</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>
<!-- Cuadro Agregado -->
<div id="agregado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Descuento agregado</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>

<!-- ajax -->
<!-- son referenciados en otras tablas-->
<div id="rechazo">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No se puede eliminar el descuento, está referenciado</td></tr>        
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

@if(Session::has('descuento_borrado')) <!-- ELiminado -->
    <script>
        window.addEventListener("load", function(){
            $('#eliminado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@elseif(Session::has('descuento_agregado')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $('#agregado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@endif

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
