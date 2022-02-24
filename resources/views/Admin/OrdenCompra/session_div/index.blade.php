<!-- Cuadro Cancelado -->
<div id="cancelado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Orden cancelada</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>        
    </table>
</div>
<!-- Cuadro Eliminado -->
<div id="eliminado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Orden eliminada</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>        
    </table>
</div>

<!-- Session -->
@if(Session::has('orden_cancelada')) <!-- Cancelado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#cancelado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('orden_eliminada')) <!-- Eliminado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#eliminado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif