<table class="detalle">            
    <tr class="head">
        <td rowspan="2">Id Art</td>		
        <td rowspan="2">Cant.</td>				
        <td rowspan="2">Descripción</td>					
        <td rowspan="2">Precio</td>	
        <td colspan="4">Descuento</td>								
        <td rowspan="2">Exentas</td>					
        <td rowspan="2">5%</td>					
        <td rowspan="2">10%</td>												
    </tr>
    <tr class="head">
        <td>Cliente</td>				
        <td>Mayorista</td>		
        <td>Día</td>		
        <td>Saldo</td>														
    </tr>

        @php
            $i=0;
        @endphp

    @foreach($venta_det as $detalle)
        @foreach($articulos as $articulo)          
        @if($articulo->Id_Art==$det_art[$i]->Id_Art)            
        <tr class="linea">
            <td><input type="text" size="4" value="{{$det_art[$i]->Id_Art}}" disabled></td>
            <td><input type="text" class="der" size="3" value="{{$detalle->VD_ArtCant}}" disabled></td>
            <td><input type="text" size="35" value="{{$articulo->Art_DesLar}}" disabled></td>
            <td><input type="text" class="der" size="6" value="{{$detalle->VD_ArtPre}}" disabled></td>                    
                                                                        
            <td>
                @if($venta->Ven_CliDesc!='' && $venta->Ven_CliDesc!=0)
                <input type="text" size="3" value="{{$venta->Ven_CliDesc}}%" disabled>
                @else
                <input type="text" size="3" value="" disabled>
                @endif
            </td>
            <td>
                @if($detalle->VD_ArtCant>=15)
                <input type="text" size="3" value="10%" disabled>
                    @php $may=10; @endphp
                @else
                <input type="text" size="3" value="" disabled>
                    @php $may=0; @endphp
                @endif
            </td>
            <td>
                @if($detalle->VD_ArtDesc!='')
                <input type="text" size="3" value="{{$detalle->VD_ArtDesc}}%" disabled>
                @else
                <input type="text" size="3" value="" disabled>
                @endif
            </td>

                @php
                        if($detalle->VD_ArtDesc==''){
                            $detalle->VD_ArtDesc=0;
                        }

                    $saldo = $venta->Ven_CliDesc + $may +  $detalle->VD_ArtDesc;
                                            
                    if($saldo==0){
                        $saldo=$articulo->Art_PreVen;
                    }else{
                        $saldo = $articulo->Art_PreVen * $saldo;
                        $saldo = $saldo/100;

                        $saldo = $articulo->Art_PreVen - $saldo;
                    }                    
                @endphp                                    
            
            <td><input type="text" class="der" size="6" value="{{$saldo}}" disabled></td>
            
            <td><input type="text" class="der" size="6" value="{{$detalle->VD_ArtExen}}" disabled></td>
            <td><input type="text" class="der" size="6" value="{{$detalle->VD_ArtIva5}}" disabled></td>
            <td><input type="text" class="der" size="6" value="{{$detalle->VD_ArtIva10}}" disabled></td>
        </tr>
        @endif  
        @endforeach

        @php
            $i++;
        @endphp
    @endforeach

        @php
            $linea=1;
            $relleno=8-$venta_det->count();
        @endphp      

        @for($linea==1;$linea<=$relleno;$linea++)
        <tr class="linea">
            <td><input type="text" size="4" disabled></td>
            <td><input type="text" size="4" disabled></td>
            <td><input type="text" size="35" disabled></td>
            <td><input type="text" size="7" disabled></td>

            <td><input type="text" size="3" disabled></td>
            <td><input type="text" size="3" disabled></td>
            <td><input type="text" size="3" disabled></td>     
            <td><input type="text" size="7" disabled></td>     
            
            <td><input type="text" size="7" disabled></td>
            <td><input type="text" size="7" disabled></td>
            <td><input type="text" size="7" disabled></td>  
        </tr>     
        @endfor
</table>