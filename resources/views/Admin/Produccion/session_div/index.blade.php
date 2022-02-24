<!-- sesionados -->
<!-- Cuadro Eliminado -->
<div id="cancelado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Producción cancelada</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <!-- <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr> -->        
    </table>
</div>
<!-- Cuadro Agregado -->
<div id="agregado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Producción inciada</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
    </table>
</div>

<!-- Cuadro Finalizado -->
<div id="finalizado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Producto finalizado</td></tr>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <!-- tantos _ nuevos -->
    </table>
</div>

<!-- Session -->
@if(Session::has('produccion_agregada')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#agregado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('produccion_cancelada')) <!-- Eliminado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#cancelado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('produccion_finalizada')) <!-- Eliminado -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#finalizado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif