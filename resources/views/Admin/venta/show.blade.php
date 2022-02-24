@extends('Admin.lay.Transaccion')

@section('titulo')
    Venta Realizada
@endsection

<style>
    #navegacion_2{
        display:none;
    }    
    
    #navegacion_1{
        background:#E1E1E1;
    }
</style>

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Ventas/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif

        <a href="#" class="informe"><button class="boton" name="reporte" id="informe">Informe</button></a>        
        
        <button class="boton anular" id="eliminar">Anular</button>        

        @if($next)
        <a href="{{URL::to('Ventas/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Ventas')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('cabecera')
    <table class="tabla_cabecera">
        <tr>
            <td>
                Factura: <input type="text" size="10" value="{{$compra->Com_Fac}}" disabled>
                Fecha: <input type="text" size="10" value="{{$compra->Com_Fe}}" disabled>
                Hora: <input type="text" size="5" value="{{$compra->Com_Ho}}" disabled>
                
                Arqueo: <input type="text" size="4" value="{{$compra->Id_Arq}}" disabled>
                Caja: <input type="text" size="4" value="{{$compra->Id_Caj}}" disabled>
            </td>
        </tr>

        <tr>
            <td>
            @foreach($proveedores as $proveedor)
            @if($proveedor->Id_Prov==$compra->Id_Prov)
                Proveedor: <input type="text" size="20" value="{{$proveedor->Prov_Des}}" disabled>
                RUC: <input type="text" size="10" value="{{$proveedor->Prov_Ruc}}" disabled>                
                Teléfono: <input type="text" size="10" value="{{$proveedor->Prov_Tel}}" disabled>                
                Dirección: <input type="text" size="20" value="{{$proveedor->Prov_Dir}}" disabled>
            @endif
            @endforeach
                Pedido: <input type="text" size="4" value="{{$compra->Id_PedProv}}" disabled>
            </td>
        </tr>

        <tr>
            <td>
                Por: <input type="text" size="15" value="{{$compra->Com_RegPor}}" disabled>
            </td>
        </tr>
    </table>
@endsection

@section('detalle')
    <span><b>Detalle de compra</b></span>

    <table id="compra_detalle">
        <tr class="head">
            <td>Id</td>
            <td>Descripción</td>
            <td>Precio</td>
            <td>Cantidad</td>
            <td>Exenta</td>
            <td>5%</td>
            <td>10%</td>
        </tr>
        
        @foreach($compra_det as $detalle)
        <tr class="linea">
            <td><input type="text" size="4" value="{{$detalle->Id_Art}}"></td>
            <td><input type="text" size="35" value="{{$detalle->CD_ArtDes}}"></td>
            <td><input type="text" size="7" value="{{$detalle->CD_ArtPreUn}}"></td>
            <td><input type="text" size="4" value="{{$detalle->CD_ArtCant}}"></td>
            <td><input type="text" size="7" value="{{$detalle->CD_ArtExen}}"></td>
            <td><input type="text" size="7" value="{{$detalle->CD_ArtIva5}}"></td>
            <td><input type="text" size="7" value="{{$detalle->CD_ArtIva10}}"></td>
        </tr>
        @endforeach
        
        @php
            $linea=1;
            $relleno=8-$compra_det->count();
        @endphp

        @for($linea==1; $linea<=$relleno; $linea++)
        <tr class="linea">
            <td><input type="text" size="4" value=""></td>
            <td><input type="text" size="35" value=""></td>
            <td><input type="text" size="7" value=""></td>
            <td><input type="text" size="4" value=""></td>
            <td><input type="text" size="7" value=""></td>
            <td><input type="text" size="7" value=""></td>
            <td><input type="text" size="7" value=""></td>
        </tr>
        @endfor
    </table>
@endsection

@section('total')
    <table id="compra_total">
        <tr>
            <td>Subtotales:</td>
            <td width="600">&nbsp;</td>
            <td><input type="text" size="7" value="{{$compra->Com_St5}}"></td>
            <td><input type="text" size="7" value="{{$compra->Com_St10}}"></td>
            <td><input type="text" size="7" value="{{$compra->Com_StExe}}"></td>
        </tr>
        <tr>
            <td>Total:</td>
            <td>guaraníes: <input type="text" value="{{$compra->Com_Total}}"></td>
            <td>&nbsp;</td>
            <td>total</td>
            <td><input type="text" size="7" value="{{$compra->Com_Total}}"></td>
        </tr>
        <tr>
            <td>Liquidación del iva:</td>
            <td>
            (5%) <input type="text" value="{{$compra->Com_Liq5}}">
            (10%) <input type="text" value="{{$compra->Com_Liq10}}">
            Total iva <input type="text" value="{{$compra->Com_TotIva}}">
            </td>
        </tr>
    </table>
@endsection