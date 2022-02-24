<!-- Cuadro Agregado -->
<div id="agregado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Timbrado agregado</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>

@if(Session::has('timbrado_agregado')) <!-- Agregado -->
    <script>
        window.addEventListener("load", function(){
            $('#agregado').show().delay(1500).fadeOut(0);
            setTimeout(function(){ location.reload(); }, 1500);  
        });
    </script>
@endif