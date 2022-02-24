@extends('Admin.lay.Index')

<style>
    .agregar{
        position: absolute;
        top: 105px;
        font-family: Raleway;
    }
    #nav{
        text-align:center;    
        height:32px;     
    }
    #pag{
        margin-right: 16px;
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

@if($cant==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
@endif

@section('titulo')
    Listado de Timbrados
@endsection

@section('navegacion_1')
    <div id="nav">                        
        <button class="boton total_reg" id="total_reg">Total: {{$cant}}</button>

        @if($cant>0)
        <button class="boton total_reg" id="most">Mostrados: {{$mostrados}}</button>
        <button class="boton total_reg" id="pag">Página {{$timbrados->currentPage()}} de {{$lastPage}}</button>
        @endif            

        @if($lastPage>1)
        <div id="pag_bot">
            <a href="{{url('Timbrado?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$timbrados->links('vendor\pagination\simple-default')}}
            <a href="{{url('Timbrado?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div>
        @endif  
    </div>
@endsection

@section('contenido')
    <a href="Timbrado/create" class="agregar"><button class="boton" id="agregar">Agregar</button></a>    
    
    @include('Admin.Descuento.session_div.index')
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Timbrado Nº</td>
            <td>Estado</td>
            <td>Inicio de vigencia</td>
            <td>Fin de vigencia</td>
            <td>Facturación</td>
            <td id="opciones">Opciones</td>
        </tr>
        
        @foreach($timbrados as $timbrado)
            <tr class="registro">
                <td><input type="text" size="4" value="{{$timbrado->Id_Timb}}" disabled></td>
                <td><input type="text" size="10" value="{{$timbrado->Timb_Num}}" disabled></td>
                <td><input type="text" size="10" value="{{$timbrado->Timb_Est}}" disabled></td>
                <td><input type="text" size="10" value="{{date('d/m/Y', strtotime($timbrado->Timb_IniVig))}}" disabled></td>
                <td><input type="text" size="10" value="{{date('d/m/Y', strtotime($timbrado->Timb_FinVig))}}" disabled></td>
                <td><input type="text" size="17" value="{{str_pad($timbrado->Timb_IniFact,7,'0',STR_PAD_LEFT).' a '.str_pad($timbrado->Timb_FinFact,7,'0',STR_PAD_LEFT)}}" disabled></td>
                
                <td class="operacion">
                    <a href="Timbrado/{{$timbrado->Id_Timb}}"><button class="botones" id="ver">Ver</button></a>
                </td>                
            </tr>
        @endforeach

            @php
                $linea=1;
                $relleno=20-$mostrados; //$paginacion
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" value="" disabled></td>
                    <td><input type="text" size="10" value="" disabled></td>
                    <td><input type="text" size="10" value="" disabled></td>
                    <td><input type="text" size="10" value="" disabled></td>
                    <td><input type="text" size="10" value="" disabled></td>
                    <td><input type="text" size="17" value="" disabled></td>
                </tr>
            @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection