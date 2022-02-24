@include('Admin.funcion_letras')
<table id="compra_total">
    <tr>
        <td class="sub_tot">Subtotales:</td>                
        <td class="ancho"><input type="text" size="7" value="{{$compra->Com_StExe}}" disabled></td>
        <td class="ancho"><input type="text" size="7" value="{{$compra->Com_St5}}" disabled></td>
        <td class="ancho"><input type="text" size="7" value="{{$compra->Com_St10}}" disabled></td>
        <td class="filler"></td>
    </tr>

    <?php $objeto=new NumeroALetras; $letras=$objeto->convertir($compra->Com_Total); ?>

    <tr>
        <td class="tot_let" colspan="2">Total: guaraníes <input type="text" size="60" value="{{$letras}}" style="text-align:left" disabled></td>                
        <td class="tot">Total</td>
        <td class="ancho"><input type="text" size="7" value="{{$compra->Com_Total}}" disabled></td>
        <td class="filler"></td>
    </tr>

    <tr>
        <td colspan="4" class="liq_iva">Liquidación del IVA:
        (5%) <input type="text" value="{{$compra->Com_Liq5}}" disabled>
        (10%) <input type="text" value="{{$compra->Com_Liq10}}" disabled> 
        Total IVA <input type="text" name="Com_TotIva" value="{{$compra->Com_TotIva}}" disabled>
        </td>
    </tr>
</table>   