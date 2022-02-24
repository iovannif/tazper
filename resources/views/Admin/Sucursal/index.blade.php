@extends('Admin.lay.Index')

<style>
    #navegacion_1{
        padding-right:0 !important;
    }
    #nav{
        text-align:center;        
    }
    .operacion{
        width:90px !important;
    }
    .botones{
        padding:4px 16px !important;
    }
    #ver{
        margin-left:-16px;
    }

    .operacion .botones{
        width:fit-content !important;
    }
</style>

@section('titulo')
    Sucursal
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
            <td>Dirección</td>
            <td>Estado</td>
            <td id="opciones" colspan="2">Opciones</td>
        </tr>
        
        @if($sucursales)
        @foreach($sucursales as $sucursal)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$sucursal->Id_Suc}}" disabled></td>
            <td><input type="text" size="30" value="{{$sucursal->Suc_Des}}" disabled></td>
            <td><input type="text" size="40" value="{{$sucursal->Suc_Dir}}" disabled></td>
            <td><input type="text" size="8" value="{{$sucursal->Suc_Est}}" disabled></td>

            <td class="operacion"><a href="Sucursal/{{$sucursal->Id_Suc}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion"><a href="Sucursal/{{$sucursal->Id_Suc}}/edit"><button class="botones" id="editar">Editar</button></a></td>            
        </tr>
        @endforeach
        @endif

            @php
                $linea=1;
                $relleno=20-$sucursales->count();
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="30" disabled></td>
                    <td><input type="text" size="40" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                </tr>
            @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection