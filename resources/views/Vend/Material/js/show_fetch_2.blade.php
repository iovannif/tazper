@include('Admin.Material.session_div.show')
<table id="principal">
    <tr>
        <td><label for="cod_art">Id de artículo:</label></td>
        <td><input type="text" size="4" value="{{$material->Id_Art}}" disabled></td>
    </tr>

    <tr>
        <td><label for="cod_mat">Id de material:</label></td>
        <td><input type="text" size="4" value="{{$material->Id_Mat}}" disabled></td>
    </tr>

    <tr>
        <td><label for="des_lar">Descripción:</label></td>
        <td><input type="text" size="35" value="{{$material->Art_DesLar}}" disabled></td>
    </tr>    

    <tr>
        <td><label for="p_comp">Precio:</label></td>
        <td><input type="text" size="7" value="{{number_format($material->Art_PreCom,0,',','.')}}" disabled></td>
    </tr>  

    <tr>
        <td><label for="uni_med">Medición:</label></td>
        <td><input type="text" size="20" value="{{$material->Art_UniMed}}" disabled></td>
    </tr>  

    <tr>
        <td><label for="existencia">Existencia:</label></td>
        <td><input type="text" size="5" value="{{$material->Art_St}}" disabled></td>
    </tr>         

    <tr>
        <td><label for="proveedor">Proveedor:</label></td>
        <td>                
            @if(!$material->Id_Prov)
                <input type="text" size="30" disabled>
            @else
                <input type="text" class="id" size="4" value="Id: {{$material->Id_Prov}}" disabled>
                @foreach($proveedores as $proveedor)
                    @if($proveedor->Id_Prov==$material->Id_Prov)                        
                    <input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled>
                    @php $no='false'; @endphp
                        @break
                    @else
                        @php $no='true'; @endphp
                    @endif
                @endforeach

                @if($no=='true')
                    <input type="text" size="30" disabled>
                @endif
            @endif
        </td>
    </tr>

    <tr>
        <td><label for="impuesto">Impuesto:</label></td>
        <td>
            @foreach($impuestos as $impuesto)
                @if($impuesto->Id_Imp==$material->Id_Imp)
                    <input type="text" size="10" value="{{$impuesto->Imp_Des}}" disabled>
                @endif
            @endforeach
        </td>
    </tr>

    <tr>
        <td><label for="estado">Estado:</label></td>
        <td><input type="text" size="8" value="{{$material->Art_Est}}" disabled></td>
    </tr>        
    
    <tr>
        <td class="obs"><label for="observacion">Observación:</label></td>
        <td><textarea rows="4" cols="50" id="obs">{{$material->Art_Obs}}</textarea></td>
    </tr>

    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
@include('Admin.Material.js.user')

<div id="confirm">
    <table>
        <tr><td class="center" colspan="2">Está a punto de eliminar el material, no lo podrá recuperar</td></tr>
        <tr><td class="center" colspan="2">Desea continuar?</td></tr>
        <tr>
            <td class="right">                								
            {!! Form::open(['method'=>'DELETE', 'action'=>['MaterialesController@destroy', $material->Id_Art]]) !!}
                {{csrf_field()}}
                <input class="botones eliminar" type="submit" id="eliminar" value="Confirmar">
            {!! Form::close() !!}
            </td>
            <td class="left"><button class="botones cancelar" id="cancelar" onclick="$('#confirm').css('display','none');">Cancelar</button></td>
        </tr>
    </table>
</div>