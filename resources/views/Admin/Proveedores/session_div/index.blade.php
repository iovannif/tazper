<!-- sesionados -->
<!-- Cuadro Eliminado -->
<div id="eliminado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Proveedor eliminado</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>
<!-- Cuadro Rechazo -->
<div id="rechazo"> <!-- eliminar -->
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No se puede eliminar, el proveedor está referenciado</td></tr>        
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>
<!-- Cuadro Agregado -->
<div id="agregado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Proveedor agregado</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>
<!-- ajax -->
<!-- Cuadro Eliminados -->
<div id="eliminados">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center eliminados_cant" colspan="2"></td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>
<!-- Cuadro fk -->
<div id="articulo_eliminados">
    <table>            
        <tr><td class="center" colspan="2">No se puede eliminar un proveedor referenciado</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center articulos" colspan="2"></td></tr>
        <tr><td class="center art_cant" colspan="2"></td></tr>
    </table>
</div>
<!-- Cuadro No hay marcados -->
<div id="vacio">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No ha seleccionado ningún proveedor</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('proveedor_agregado')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#agregado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('proveedor_eliminado')) <!-- Eliminado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#eliminado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif