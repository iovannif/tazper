<div id="rechazo">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">No se puede eliminar, el personal es usuario</td></tr>  
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('categoria_rechazo'))
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#rechazo').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif