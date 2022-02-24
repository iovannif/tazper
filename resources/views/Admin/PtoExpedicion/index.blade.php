@extends('Admin.lay.Index')

<style>
    /* Navegacion */
    #nav{
        text-align:center;
    }   
    #opciones{
        width:181px;
    }
    #ver{
        padding:4px 20px;
        margin:auto;
    }

    /* .registro .botones{
        margin:auto;
        padding:4px 10px;
    }     */

    .operacion .botones{
        width:50% !important;
    }
</style>

@section('titulo')
    Punto de Expedición
@endsection

@section('navegacion_1')
    <div id="nav">
        <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>
    </div>
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Descripción</td>            
            <td>Sucursal</td>
            <td>Estado</td>
            <td id="opciones">Opciones</td>
        </tr>
        
        @if($puntos)
        @foreach($puntos as $punto)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$punto->Id_PtoExp}}" disabled></td>
            <td><input type="text" size="20" value="{{$punto->PtoExp_Des}}" disabled></td>
            <td>
                @foreach($sucursales as $sucursal)
                    @if($punto->Id_Suc==$sucursal->Id_Suc)
                    <input type="text" size="30" value="{{$sucursal->Suc_Des}}" disabled>
                    @endif
                @endforeach
            </td>
            <td><input type="text" size="8" value="{{$punto->PtoExp_Est}}" disabled></td>

            <td class="operacion"><a href="PtoExpedicion/{{$punto->Id_PtoExp}}"><button class="botones" id="ver">Ver</button></a></td>
        </tr>
        @endforeach
        @endif

            @php
                $linea=1;
                $relleno=20-$puntos->count();
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="20" disabled></td>
                    <td><input type="text" size="30" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                </tr>
            @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection