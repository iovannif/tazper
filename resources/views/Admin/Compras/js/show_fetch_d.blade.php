<table class="detalle">            
    <tr class="head">
        <td>Id Art</td>				
        <td>Descripción</td>					
        <td>Precio</td>	
        <td>Cantidad</td>					
        <td>Exentas</td>					
        <td>5%</td>					
        <td>10%</td>												
    </tr>

    @php
        $i=0;
    @endphp

    @foreach($compra_det as $detalle)
        @foreach($articulos as $articulo)          
        @if($articulo->Id_Art==$det_art[$i]->Id_Art)
        <tr class="linea">
            <td><input type="text" size="4" value="{{$det_art[$i]->Id_Art}}" disabled></td>
            <td><input type="text" size="35" value="{{$articulo->Art_DesLar}}" disabled></td>
            <td><input type="text" class="precio" size="6" value="{{$articulo->Art_PreCom}}" disabled></td>
            <td>
                <input type="text" size="4" value="{{$detalle->CD_ArtCant}}" style="text-align:right" disabled>
                <input type="text" class="unimed" size="15" value="{{$articulo->Art_UniMed}}" disabled>
            </td>
            <td><input type="text" class="exentas" size="6" value="{{$detalle->CD_ArtExen}}" disabled></td>
            <td><input type="text" class="iva_5" size="6" value="{{$detalle->CD_ArtIva5}}" disabled></td>
            <td><input type="text" class="iva10" size="6" value="{{$detalle->CD_ArtIva10}}" disabled></td>            
        </tr>
        @endif  
        @endforeach

        @php
            $i++;
        @endphp
    @endforeach

        @php
            $linea=1;
            $relleno=8-$compra_det->count();
        @endphp      

        @for($linea==1;$linea<=$relleno;$linea++)
        <tr class="linea">
            <td><input type="text" size="4" disabled></td>
            <td><input type="text" size="35" disabled></td>
            <td><input type="text" size="7" disabled></td>
            <td>
                <input type="text" size="4" disabled>
                <input type="text" size="16" disabled>
            </td>
            <td><input type="text" size="7" disabled></td>
            <td><input type="text" size="7" disabled></td>
            <td><input type="text" size="7" disabled></td>            
        </tr>     
        @endfor
</table>