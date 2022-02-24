<!-- Cuadro Agregado -->
<div id="agregado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Pedido registrado</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>
<!-- Cuadro Cancelado -->
<div id="cancelado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Pedido cancelado</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>        
    </table>
</div>

<!-- Session -->
@if(Session::has('pedcli_agregado')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#agregado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('pedcli_cancelado')) <!-- Cancelado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#cancelado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif