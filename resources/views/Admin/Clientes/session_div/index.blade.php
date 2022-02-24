<!-- Cuadro Eliminado -->
<div id="eliminado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Cliente eliminado</td></tr>
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
        <tr><td class="center" colspan="2">Cliente agregado</td></tr>
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
        <tr><td class="center" colspan="2">No se puede eliminar el cliente, está refrenciado</td></tr>        
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

@if(Session::has('cliente_borrado')) <!-- ELiminado -->
    <script>
        window.addEventListener("load", function(){
            $('#eliminado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@elseif(Session::has('cliente_agregado')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $('#agregado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@endif