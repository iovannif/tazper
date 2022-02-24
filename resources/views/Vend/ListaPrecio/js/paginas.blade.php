<h3 id="detalle">Detalle</h3>
{{$productos->links('vendor\pagination\simple-default')}}
<table class="detalle">
    <tr class="head">
        <td>Id Art</td>                        
        <td>Id Prod</td>                                
        <td>Productos</td>                                    
        <td>Precio Original</td>
        <td>Descuento gs.</td>
        <td>Precio por Categoría</td>
        <td>Compra</td>
        <td>Ganancia</td>      
    </tr>

        @php
            switch($lista->Lp_Desc){
                case '0%':
                    $desc="0";
                    break;
                case '10%':
                    $desc="10";
                    break;
                case '20%':
                    $desc="20";
                    break;
            }
        @endphp
    
    @foreach($detalles as $detalle)
        @foreach($productos as $producto)    
            <tr class="body">                                                  
                <td><input type="text" size="4" value="{{$producto->Id_Art}}" disabled></td>
                <td><input type="text" size="4" value="{{$producto->Id_Prod}}" disabled></td>
                <td><input type="text" size="30" value="{{$producto->Art_DesLar}}" disabled></td>
                <td><input type="text" class="der" size="7" value="{{number_format($producto->Art_PreVen,0,',','.')}}" disabled></td>
                <td><input type="text" class="der" size="7" value="{{number_format($desc_art=$desc*$producto->Art_PreVen/100,0,',','.')}}" disabled></td>
                <td><input type="text" class="der" size="7" value="{{number_format($pre_cat=$producto->Art_PreVen-$desc_art,0,',','.')}}" disabled></td>
                <td><input type="text" class="der" size="7" value="{{number_format($producto->Art_PreCom,0,',','.')}}" disabled></td>
                <td><input type="text" class="der" size="7" value="{{number_format($pre_cat-$producto->Art_PreCom,0,',','.')}}" disabled></td>                                                                        
            </tr> 
        @endforeach                            
    @endforeach

        @php
            $linea=1;
            $relleno=20-$productos->count();
        @endphp

        @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="body">
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="30" disabled></td>
                <td><input type="text" size="7" disabled></td>                
                <td><input type="text" size="7" disabled></td>
                <td><input type="text" size="7" disabled></td>
                <td><input type="text" size="7" disabled></td>
                <td><input type="text" size="7" disabled></td>       
            </tr>
        @endfor
</table>