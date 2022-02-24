<!-- Cuadro Eliminado -->
<div id="eliminado">
    <table>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Compra eliminada</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
    </table>
</div>
<!-- Cuadro Agregado -->
<div id="agregado">
    <table>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Compra registrada</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
    </table>
</div>

@if(Session::has('compra_borrada')) <!-- ELiminado -->
    <script>
        window.addEventListener("load", function(){
            $('#eliminado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@elseif(Session::has('compra_agregada')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $('#agregado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@endif