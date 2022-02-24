<div id="actualizado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Sucursal modificada</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('sucursal_modificada'))
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#actualizado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif