<!-- sesionados -->
<!-- Cuadro Eliminado -->
<div id="eliminado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Usuario eliminado</td></tr>
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
        <tr><td class="center" colspan="2">Usuario agregado</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>
<!-- ajax -->
<!-- Cuadro Admin -->
<div id="rechazo">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No se puede eliminar al administrador del sistema</td></tr>
        <tr><td class="center" colspan="2">mientras queden usuarios</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>
<!-- Cuadro Hay Admin -->
<div id="admin_eliminados">
    <table>            
        <tr><td class="center" colspan="2">No se puede eliminar al administrador del sistema</td></tr>
        <tr><td class="center" colspan="2">mientras queden usuarios</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center admin_cant" colspan="2"></td></tr>
    </table>
</div>
<!-- Cuadro Eliminados -->
<div id="eliminados">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center eliminados_cant" colspan="2"></td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>
<!-- Cuadro No hay marcados -->
<div id="vacio">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No ha seleccionado ningún usuario</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('user_agregado')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#agregado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('user_borrado')) <!-- Eliminado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#eliminado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif