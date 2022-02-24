@extends('Admin.lay.Index')

<style>
    #nav{
        text-align:center;
    }
    #opciones{
        width:181px;
    }
    #ver{
        margin:auto;
        padding:4px 20px;
    }

    .operacion .botones{
        width:50% !important;
    }
</style>

@section('titulo')
    Listado de Perfiles
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
            <td>Estado</td>
            <td>Nivel de Acceso</td>
            <td id="opciones">Opciones</td>
        </tr>
        
        @if($perfiles)
        @foreach($perfiles as $perfil)
        <tr class="registro">        
            <td><input type="text" size="4" value="{{$perfil->Id_Prf}}" disabled></td>
            <td><input type="text" size="20" value="{{$perfil->Prf_Des}}" disabled></td>
            <td><input type="text" size="8" value="{{$perfil->Prf_Est}}" disabled></td>
            <td><input type="text" size="40" value="{{$perfil->Prf_NivAcc}}" disabled></td>

            <td class="operacion"><a href="Perfil/{{$perfil->Id_Prf}}"><button class="botones" id="ver">Ver</button></a></td>
        </tr>
        @endforeach
        @endif

            @php
                $linea=1;
                $relleno=20-$perfiles->count();
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="20" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="40" disabled></td>
                </tr>
            @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection