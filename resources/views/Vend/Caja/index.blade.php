@extends('Vend.lay.Index')

<style>
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

    .operacion .botones{
        width:fit-content !important;
    }
</style>

@section('titulo')
    Listado de Cajas
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
            <td>Fondo</td>            
            <td id="opciones">Opciones</td>
        </tr>
        
        @if($cajas)
        @foreach($cajas as $caja)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$caja->Id_Caj}}" disabled></td>
            <td><input type="text" size="20" value="{{$caja->Caj_Des}}" disabled></td>
            <td><input type="text" size="8" value="{{$caja->Caj_Est}}" disabled></td>
            <td><input type="text" size="7" value="{{number_format($caja->Caj_Fon,0,',','.')}}" disabled></td>            

            <td class="operacion"><a href="{{url('Caja/'.$caja->Id_Caj)}}"><button class="botones" id="ver">Ver</button></a></td>
        </tr>
        @endforeach
        @endif

            @php
                $linea=1;
                $relleno=20-$cajas->count();
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="20" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="7" disabled></td>        
                </tr>
            @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection