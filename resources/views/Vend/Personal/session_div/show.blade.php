<!-- sesionados -->
<div id="actualizado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Personal modificado</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('personal_modificado')) <!-- eliminar -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#recchazo').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif