<!-- sesionados -->
<div id="inhabilitado">
    <table>
        <tr><td class="center" colspan="2">&nbsp;</td></tr>
        <tr><td class="center" colspan="2">Para establecer descuentos se requiere producto y cliente</td></tr>
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
    </table>
</div>

<!-- Session -->
@if(Session::has('descuento_inhabilitado'))
    {{--{{session('descuento_inhabilitado')}--}}
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#inhabilitado').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif