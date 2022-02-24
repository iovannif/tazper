<table class="tabla_cabecera">    
    <tr>        
        <td>Venta:</td>
        <td><input type="text" size="4" value="Id: {{$venta->Id_Ven}}" disabled></td> 

        <td class="col_sep">Fecha:</td>
        <td><input type="text" size="6" value="{{date('d/m/y', strtotime($venta->Ven_Fe))}}" disabled></td>
        
        <td class="col_sep">Hora:</td>
        <td><input type="text" size="4" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" disabled></td>

        <td class="col_sep">Tipo:</td>
        <td><input type="text" size="9" value="{{$venta->Ven_Tip}}" disabled></td>   
        
        <td colspan="2" class="col_sep">
            Estado: <input type="text" id="est" size="7" value="{{$venta->Ven_Est}}" disabled>
            Pedido: <input type="text" size="4" value="{{$venta->Id_PedCli}}" disabled>
        </td>        
    </tr>      
        
    <tr>
        <td>Sucursal</td>
        <td><input type="text" size="3" value="{{$sucursal->Suc_Cod}}" disabled></td>                

        <td class="col_sep">Punto Exp:</td>
        <td><input type="text" size="3" value="{{$punto->PtoExp_Cod}}" disabled></td>

        <td class="col_sep">Factura Nº:</td>
        <td><input type="text" size="7" value="{{$venta->Ven_Fact}}" disabled></td>   

        <td class="col_sep">Timbrado:</td>
        <td><input type="text" size="8" value="{{$timb->Timb_Num}}" disabled></td>   

        <td class="col_sep">Arqueo:</td>
        <td><input type="text" class="last" size="3" value="{{$venta->Id_Arq}}" disabled></td>                             
    </tr>                                     
    
    <tr>                   
        <td>Cobro:</td>
        <td><input type="text" size="4" value="Id: {{$venta->Id_Ven}}" disabled></td>                                       

        <td class="col_sep">Condición:</td>
        <td><input type="text" size="7" value="{{$venta->Ven_CondCob}}" disabled></td>

        <td class="col_sep">Medio:</td>            
        <td><input type="text" size="9" value="{{$medio_pag->MedPag_Des}}" disabled></td>    
        
        <td class="col_sep">Caja:</td>            
        <td><input type="text" size="3" value="1" disabled></td>    

        <td class="col_sep">Registro:</td>
        <td><input type="text" class="last" size="15" value="{{$venta->Ven_RegUser}}" disabled></td>                              
    </tr>     

    <tr>        
        <td>Cliente:</td>
        <td colspan="3"><input type="text" class="bottom" size="35" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled></td>                

        <td class="col_sep">RUC:</td>
        <td><input type="text" class="bottom" size="10" value="{{$cliente->Cli_Ruc}}" disabled></td>

        <td class="col_sep">Categoría:</td>
        <td><input type="text" class="bottom" size="15" value="{{$venta->Ven_CliLp}}" disabled></td>

        <td class="col_sep">Descuento:</td>
        <!-- <td><input type="text" class="bottom last" size="3" value="{{$venta->Ven_CliDesc}}%" disabled></td>  -->
        <td><input type="text" class="bottom last" size="15" value="{{$venta->Ven_DescDia}}" disabled></td>                 
    </tr>  
</table>