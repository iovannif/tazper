<!-- sesionados -->
<div id="actualizado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Usuario modificado</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>

<div id="rechazo"> <!-- eliminar -->
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No se puede eliminar al administrador del sistema</td></tr>
        <tr><td class="center" colspan="2">mientras queden usuarios</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('user_modificado')) <!-- eliminar -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#actualizado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('user_rechazo'))
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#rechazo').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif