@include('Vend.ProductoCategoria.session_div.show')
<table id="principal">
    <tr>
        <td><label for="id_cat">Id de categoría:</label></td>
        <td><input type="text" size="4" value="{{$cat->Id_Cat}}" disabled></td>
    </tr>

    <tr>
        <td><label for="descripcion">Descripción:</label></td>
        <td><input type="text" size="20" value="{{$cat->Cat_Des}}" disabled></td>
    </tr>

    <tr>
        <td><label for="estado">Estado:</label></td>
        <td>
            <input type="text" size="8" value="{{$cat->Cat_Est}}" disabled>
        </td>
    </tr>        
    
        @if($productos->count()!=0)                                            
            @php 
                $cant=0;
                foreach($productos as $producto){
                    if($producto->Id_Cat==$cat->Id_Cat)
                    $cant++;
                }            
            @endphp
        @else            
            @php 
                $cant=0;
            @endphp
        @endif

    <tr>
        <td><label for="productos">Productos:</label></td>
        <td><input type="text" id="prod_cant" size="4" value="{{$cant}}" disabled></td>
    </tr>        

        @if($cant==0)
            @php
                $activos=0;                
                $stock=0;                    
            @endphp            
        @else
            @php
                $activos=0;
                foreach($pro_cat as $prod){
                    if($prod->Art_Est=='Activo')
                    $activos++;
                } 

                $stock=0;
                foreach($pro_cat as $prod){
                    if($prod->Art_St>0)
                    $stock++;
                }
            @endphp   
        @endif

    <tr>
        <td><label for="activos">Activos:</label></td>
        <td><input type="text" size="4" value="{{$activos}}" disabled></td>
    </tr> 

    <tr>
        <td><label for="stok">En stock:</label></td>
        <td><input type="text" size="4" value="{{$stock}}" disabled></td>
    </tr> 

    <tr>
        <td class="obs"><label for="observacion">Observación:</label></td>
        <td><textarea cols="50" rows="4" id="obs" disabled>{{$cat->Cat_Obs}}</textarea></td>
    </tr> 

    <tr>
        <td>&nbsp;</td>
    </tr>
</table>


<div id="confirm">
    <table>
        <tr><td class="center" colspan="2">Está a punto de eliminar la categoría, no la podrá recuperar</td></tr>
        <tr><td class="center" colspan="2">Desea continuar?</td></tr>
        <tr>
            <td class="right">                				
            {!! Form::open(['method'=>'DELETE', 'action'=>['CategoriaController@destroy', $cat->Id_Cat]]) !!}
                {{csrf_field()}}
                <input class="botones confirmar" type="submit" id="confirmar" value="Confirmar">
            {!! Form::close() !!}
            </td>
            <td class="left"><button class="botones cancelar" id="cancelar" onclick="$('#confirm').css('display','none');">Cancelar</button></td>
        </tr>
    </table>
</div>

<h3 id="detalle">Detalle</h3>
<table class="detalle">
    <tr class="head">
        <td>Id Art</td>                        
        <td>Id Prod</td>                                
        <td>Productos</td>                        
        <td>Estado</td>  
        <td>Stock</td>      
        <td>Compra</td>      
        <td>Venta</td>      
        <td>Impuesto</td>      
    </tr>

    @if($cant!=0) 
        @foreach($detalles as $detalle)
            @foreach($productos as $producto)
                @if($producto->Id_Cat==$cat->Id_Cat)                    
                    <tr class="body">
                        <td><input type="text" size="4" value="{{$producto->Id_Art}}" disabled></td>
                        <td><input type="text" size="4" value="{{$producto->Id_Prod}}" disabled></td>
                        <td><input type="text" size="35" value="{{$producto->Art_DesLar}}" disabled></td>
                        <td><input type="text" size="8" value="{{$producto->Art_Est}}" disabled></td>
                        <td><input type="text" size="4" value="{{$producto->Art_St}}" disabled></td>
                        <td><input type="text" size="7" value="{{number_format($producto->Art_PreCom,0,',','.')}}" disabled></td>
                        <td><input type="text" size="7" value="{{number_format($producto->Art_PreVen,0,',','.')}}" disabled></td>                        
                        <td>
                            @foreach($impuestos as $impuesto)
                                @if($impuesto->Id_Imp==$producto->Id_Imp)
                                    <input type="text" size="10" value="{{$impuesto->Imp_Des}}" disabled>
                                @endif
                            @endforeach                                
                        </td>
                    </tr>                    
                @endif
            @endforeach                            
        @endforeach
    @else
        <tr class="body">
            <td><input type="text" size="4" disabled></td>
            <td><input type="text" size="4" disabled></td>
            <td><input type="text" size="35" value="No hay productos en esta categoría" disabled></td>
            <td><input type="text" size="8" disabled></td>
            <td><input type="text" size="4" disabled></td>
            <td><input type="text" size="7" disabled></td>
            <td><input type="text" size="7" disabled></td>                        
            <td><input type="text" size="10" disabled></td>
        </tr> 
    @endif
</table>