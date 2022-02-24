@extends('Admin.lay.Index')

@section('titulo')
    Cobros
@endsection

@section('navegacion_1')
    <div id="nav">
        <button class="boton" id="buscar">Buscar</button>
        <input type="text" id="busq" placeholder="Fecha del cobro" size="35" maxlength="35">
        <button class="boton trans" id="total_reg">Total: {{$cant}}</button>
        <button class="boton trans" id="most">Mostrados: {{$mostrados}}</button>
        {{$cobros->links('vendor\pagination\simple-default')}}
        <button class="boton trans" id="pag">Página {{$cobros->currentPage()}} de {{$lastPage}}</button>
        @if($lastPage>1)        
        <a href="/Tazper/public/Pagos?page=1"><button class="boton" id="inicio">Inicio</button></a>
        <a href='{{"/Tazper/public/Pagos"."?page=$lastPage"}}'><button class="boton" id="fin">Fin</button></a>
        @endif
    </div>
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Id Cobro</td>
            <td>Id Venta</td>
            <td>Id Pedido</td>
            <td>Estado</td>
            <td>Cliente</td>
            <td>Fecha</td>
            <td>Total</td>
        </tr>
        
        @if($cobros)
        @foreach($cobros as $cobro)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$cobro->Id_Cob}}" disabled></td>
            <td><input type="text" size="4" value="{{$cobro->Id_Ven}}" disabled></td>
            <td><input type="text" size="4" value="{{$cobro->Id_PedCli}}" disabled></td>
            <td><input type="text" size="10" value="{{$cobro->Cob_Est}}" disabled></td>
            <td><input type="text" size="30" value="{{$cobro->Id_Cli}}" disabled></td>
                {{--@foreach($ventas as $venta)
                    @if($pago->Id_Ven==$venta->Id_Ven)
                    @endif
                @endforeach--}}
            <td><input type="text" size="10" value="" disabled></td>
            <td><input type="text" size="7" value="{{number_format($cobro->Ven_Total,0,',','.')}}" disabled></td>

            <td class="operacion"><button class="botones" id="ver"><a href="Cobros/{{$cobro->Id_Cob}}">Ver</a></button></td>
            <td class="operacion"><button class="botones" id="informe"><a href="">Informe</a></button></td>
        </tr>
        @endforeach
        @endif

        @php
            $linea=1;
            $relleno=20-$mostrados;
        @endphp

        @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="blank">
                <td><input type="text" size="4" value="" disabled></td>
                <td><input type="text" size="4" value="" disabled></td>
                <td><input type="text" size="4" value="" disabled></td>
                <td><input type="text" size="10" value="" disabled></td>
                <td><input type="text" size="30" value="" disabled></td>
                <td><input type="text" size="10" value="" disabled></td>
                <td><input type="text" size="7" value="" disabled></td>
            </tr>
        @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba">
        <a href="#"><button class="boton" id="arriba">Volver arriba</button></a>
    </div>
@endsection

<style>
    #buscar{
        margin-left:20px;
    }
</style>