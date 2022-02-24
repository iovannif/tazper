<!-- Cuadro Agregado -->
<div id="agregado">
    <table>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Venta registrada</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
    </table>
</div>

@if(Session::has('venta_agregada')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $('#agregado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@endif