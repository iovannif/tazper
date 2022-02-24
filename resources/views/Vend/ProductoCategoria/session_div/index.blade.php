<!-- sesionados -->
<!-- Cuadro Eliminado -->
<div id="eliminado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Categoría eliminada</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>
<!-- ajax -->
<!-- Cuadro Producto -->
<div id="rechazo">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No se puede eliminar una categoría con productos</td></tr>        
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>
<!-- Cuadro Hay Productos/s -->
<div id="producto_eliminados">
    <table>            
        <tr><td class="center" colspan="2">No se puede eliminar una categoría con productos</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center productos" colspan="2"></td></tr>
        <tr><td class="center prod_cant" colspan="2"></td></tr>
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
        <tr><td class="center" colspan="2">No ha seleccionado ninguna categoría</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('categoria_eliminada')) <!-- Eliminado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#eliminado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif