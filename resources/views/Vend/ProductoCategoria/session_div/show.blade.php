<!-- sesionados -->
<div id="actualizado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Categoría modificada</td></tr>
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
        <tr><td class="center" colspan="2">No se puede eliminar una categoría con productos</td></tr>        
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('categoria_modificada'))
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#actualizado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif