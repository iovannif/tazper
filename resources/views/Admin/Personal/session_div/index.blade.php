<!-- sesionados -->
<!-- Cuadro Eliminado -->
<div id="eliminado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Personal eliminado</td></tr>
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
        <tr><td class="center" colspan="2">Personal agregado</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>
<!-- ajax -->
<!-- Cuadro User -->
<div id="rechazo">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No se puede eliminar, el personal es usuario</td></tr>        
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>
<!-- Cuadro Hay User -->
<div id="usuario_eliminados">
    <table>            
        <tr><td class="center" colspan="2">No se puede eliminar un personal que pertenezca a un usuario</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center users" colspan="2"></td></tr>
        <tr><td class="center usu_cant" colspan="2"></td></tr>
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
        <tr><td class="center" colspan="2">No ha seleccionado ningún personal</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('personal_agregado')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#agregado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('personal_eliminado')) <!-- Eliminado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#eliminado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif