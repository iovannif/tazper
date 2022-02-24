<!-- Cuadro Eliminado -->
<div id="eliminado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Producto eliminado</td></tr>
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
        <tr><td class="center" colspan="2">Producto agregado</td></tr>
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
        <tr><td class="center" colspan="2">No se puede eliminar el producto, está refrenciado</td></tr>        
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>
<!-- Cuadro Hay -->
<div id="producto_eliminados">
    <table>            
        <tr><td class="center" colspan="2">No se puede eliminar producto referenciado</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center productos" colspan="2"></td></tr>
        <tr><td class="center prod_cant" colspan="2"></td></tr>
    </table>
</div>

<!-- Cuadro Eliminados y Modificados -->
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
        <tr><td class="center" colspan="2">No ha seleccionado ningún producto</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- Cuadro Campo vacio -->
<div id="campo_vacio">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Introduzca un valor</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

@if(Session::has('producto_borrado')) <!-- ELiminado -->
    <script>
        window.addEventListener("load", function(){
            $('#eliminado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@elseif(Session::has('producto_agregado')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $('#agregado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@endif