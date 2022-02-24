<table class="tabla_cabecera">  
    <tr>        
        <td>Compra:</td>
        <td><input type="text" size="4" value="Id: {{$compra->Id_Com}}" disabled></td> 
        
        <td class="col_sep">Sucursal:</td>
        <td><input type="text" size="4" value="{{$compra->Id_Suc}}" disabled></td>                

        <td class="col_sep">Punto Exp:</td>
        <td><input type="text" size="4" value="{{$compra->Id_PtoExp}}" disabled></td>                

        <td class="col_sep">Registro:</td>
        <td><input type="text" size="10" value="{{$compra->Com_RegUser}}" disabled></td>                             
    </tr>      
        
    <tr>
        <td>Fecha:</td>
        <td><input type="text" size="6" value="{{date('d/m/y', strtotime($compra->Com_Fe))}}" disabled></td>
        
        <td class="col_sep">Hora:</td>
        <td><input type="text" size="4" value="{{date('H:i', strtotime($compra->Com_Ho))}}" disabled></td>

        <td class="col_sep">Factura Nº:</td>
        <td><input type="text" size="10" value="{{$compra->Com_Fac}}" disabled></td>   
        
        <td colspan="2" class="col_sep">
            Pedido: <input type="text" id="ped" size="4" value="{{$compra->Id_PedProv}}" disabled>
            Orden: <input type="text" size="4" value="{{$compra->Id_OC}}" disabled>
        </td>            
    </tr>                       

    <tr>
        @if($compra->Id_Prov!='')
            @foreach($proveedores as $proveedor)       
            @if($proveedor->Id_Prov==$compra->Id_Prov)
            <td>Proveedor:</td>
            <td><input type="text" size="25" value="{{$proveedor->Prov_Des}}" disabled></td>                

            <td class="col_sep">RUC:</td>
            <td><input type="text" size="10" value="{{$proveedor->Prov_Ruc}}" disabled></td>

            <td class="col_sep">Teléfono:</td>
            <td><input type="text" size="10" value="{{$proveedor->Prov_Tel}}" disabled></td>

            <td class="col_sep">Dirección:</td>
            <td><input type="text" id="prov_dir" size="42" value="{{$proveedor->Prov_Dir}}" disabled></td>
            @endif
            @endforeach
        @else
            <td>Proveedor:</td>
            <td><input type="text" size="25" disabled></td>                

            <td class="col_sep">RUC:</td>
            <td><input type="text" size="10" disabled></td>

            <td class="col_sep">Teléfono:</td>
            <td><input type="text" size="10" disabled></td>

            <td class="col_sep">Dirección:</td>
            <td><input type="text" id="prov_dir" size="42" disabled></td>
        @endif
    </tr>             
    
    <tr>
        <td>Arqueo:</td>
        <td><input type="text" class="bottom" size="4" value="{{$compra->Id_Arq}}" disabled></td>                

        <td class="col_sep">Pago:</td>
        <td><input type="text" class="bottom" size="4" value="Id: {{$compra->Id_Pag}}" disabled></td>                                       

        <td class="col_sep">Condición:</td>
        <td><input type="text" class="bottom" size="7" value="{{$compra->Com_ConPag}}" disabled></td>

        <td class="col_sep">Medio de pago:</td>            
        <td>
        @foreach($medios_pag as $med_pag)          
            @if($med_pag->Id_MedPag==$compra->Id_MedPag)
            <input type="text" class="bottom" size="7" value="{{$med_pag->MedPag_Des}}" disabled>
            @endif
        @endforeach
        </td>                                               
    </tr>

    <!-- <tr>
        <td>Fecha:</td>
        <td><input type="text" size="8" value="{{$compra->Com_Fe}}" disabled></td>

        <td class="col_sep">Hora:</td>
        <td><input type="text" size="5" value="{{$compra->Com_Ho}}" disabled></td>

        <td class="col_sep">Factura Nº:</td>
        <td><input type="text" size="10" value="{{$compra->Com_Fac}}" disabled></td>

        <td class="col_sep">Condición de compra:</td>
        <td>
            <input type="text" size="7" value="{{$compra->Com_ConPag}}" disabled>
        </td>
    </tr>        

    <tr>
        <td>Pedido:</td>
        <td><input type="text" size="4" value="{{$compra->Id_PedProv}}"></td>                

        <td class="col_sep">Orden de compra:</td>
        <td><input type="text" size="4" value="{{$compra->Id_OC}}" disabled></td>

        <td></td>
        <td></td>

        <td class="col_sep">Medio de pago:</td>            
        <td>
        @foreach($medios_pag as $med_pag)          
            @if($med_pag->Id_MedPag==$compra->Id_MedPag)
            <input type="text" size="7" value="{{$med_pag->MedPag_Des}}" disabled>
            @endif
        @endforeach
        </td>                            
    </tr>            

    <tr>
    @foreach($proveedores as $proveedor)          
        @if($proveedor->Id_Prov==$compra->Id_Prov)
        <td>Proveedor:</td>
        <td><input type="text"  class="bottom" size="20" value="{{$proveedor->Prov_Des}}" disabled></td>                

        <td class="col_sep">RUC:</td>
        <td><input type="text" class="bottom" size="15" value="{{$proveedor->Prov_Ruc}}" disabled></td>

        <td class="col_sep">Teléfono:</td>
        <td><input type="text" class="bottom" size="10" value="{{$proveedor->Prov_Tel}}" disabled></td>

        <td class="col_sep">Dirección:</td>
        <td><input type="text" id="prov_dir" class="bottom" size="30" value="{{$proveedor->Prov_Dir}}" disabled></td>
        @endif
    @endforeach
    </tr>                           

    <tr>
        <td></td>
        <td><input type="text"  class="bottom" size="20" value="" disabled></td>                
    </tr>                            -->
</table>