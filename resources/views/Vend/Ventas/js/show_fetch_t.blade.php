@include('Admin.funcion_letras')

<table id="compra_total">
    <tr>
        <td class="sub_tot">Subtotales:</td>                
        <td class="ancho"><input type="text" size="7" value="{{$venta->Ven_StExe}}" disabled></td>
        <td class="ancho"><input type="text" size="7" value="{{$venta->Ven_St5}}" disabled></td>
        <td class="ancho"><input type="text" size="7" value="{{$venta->Ven_St10}}" disabled></td>            
    </tr>

        <?php $objeto=new NumeroALetras; $letras=$objeto->convertir($venta->Ven_Tot); ?>

    <tr>
        <td class="tot_let" colspan="2">Total: guaraníes <input type="text" size="60" value="{{$letras}}" style="text-align:left" disabled></td>                
        <td class="tot">Total</td>
        <td class="ancho"><input type="text" size="7" value="{{$venta->Ven_Tot}}" disabled></td>            
    </tr>

    <tr>
        <td colspan="4" class="liq_iva">Liquidación del IVA:
        (5%) <input type="text" value="{{$venta->Ven_Liq5}}" disabled>
        (10%) <input type="text" value="{{$venta->Ven_Liq10}}" disabled> 
        Total IVA <input type="text" name="Com_TotIva" value="{{$venta->Ven_TotIva}}" disabled>
        </td>
    </tr>
</table>     