@extends('Admin.lay.Index')

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
        width:50% !important;
    }
</style>

@section('titulo')
    Listas de Precio
@endsection

@section('navegacion_1')
    <div id="nav">
        <button class="boton trans" id="total_reg">Total: {{$cant}}</button>
    </div>
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Categoría de cliente</td>            
            <td>Estado</td>
            <td>Descuento</td>        
            <td>Clientes</td>        
            <td id="opciones">Opciones</td>
        </tr>
        
        @if($listas)
        @foreach($listas as $lp)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$lp->Id_Lp}}" disabled></td>
            <td><input type="text" size="20" value="{{$lp->Lp_Cat}}" disabled></td>
            <td><input type="text" size="8" value="{{$lp->Lp_Est}}" disabled></td>
            <td><input type="text" size="3" value="{{$lp->Lp_Desc.'%'}}" disabled></td>
            @php $cli_cant=0; @endphp
            @foreach($clientes as $cliente)
                @if($cliente->Id_Lp==$lp->Id_Lp)
                    @php $cli_cant++; @endphp
                @endif
            @endforeach     
            <td><input type="text" size="3" value="{{$cli_cant}}"></td>               
            
            <td class="operacion"><a href="{{url('ListaPrecio/'.$lp->Id_Lp)}}"><button class="botones" id="ver">Ver</button></a></td>
        </tr>
        @endforeach
        @endif

            @php
                $linea=1;
                $relleno=20-$listas->count();
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4"></td>
                    <td><input type="text" size="20"></td>
                    <td><input type="text" size="8"></td>
                    <td><input type="text" size="3"></td>        
                    <td><input type="text" size="3"></td>        
                </tr>
            @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection