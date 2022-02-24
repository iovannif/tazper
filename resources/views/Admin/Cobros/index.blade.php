@extends('Admin.lay.Index')

@if($cant==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">

<style>
    #nav a,#buscar,#busqueda{
        display:none;
    }
    #nav{
        text-align:center;
    }
</style>
@endif

<style>    
    /* Navegacion */
    #navegacion_1{
        padding-right:0 !important;
    }
    #pag{
        margin-right: 16px;
    }

    #buscar{
        margin: 0px 8px 1px 20px !important;
        cursor: hand !important;
        border-color: #0267D3 !important;
    }
    #buscar:hover{
        background: #0267D3 !important;
    }
    #busqueda{
        font-family:arial;
        cursor: hand;
    }    

    /* Contenido */
    #opciones{
        width:181px;
    }
    #ver{
        margin:auto;
        padding:4px 20px;
    }
</style>

<style>
    
</style>

@section('titulo')
    Cobros
@endsection

@section('navegacion_1')
    <div id="nav">                
        <button class="boton" id="buscar">Buscar</button>
        <input type="date" id="busqueda" placeholder="Fecha" size="8" maxlength="8" spellcheck="false" autocomplete="off" autofocus>                               
            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

        <div id="paginacion">            
            <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 4, " ", STR_PAD_LEFT))}}</button>            
            
            @if($cant>0)
            <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
            <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cobros->currentPage(), 3, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 3, " ", STR_PAD_LEFT))}}</button>            
            @endif
            
            @if($lastPage>1)        
            <div id="pag_bot"><div class="records">
                <a href="{{url('/Cobros?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a> 
                {{$cobros->links('vendor\pagination\simple-default')}}
                <a href="{{url('/Cobros?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>            
            @endif
        </div>
    </div>
@endsection

@section('contenido')                
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Arqueo</td>
            <td>Venta</td>
            <td>Cliente</td>
            <td>Ingreso</td>            
            <td>Registro</td>     
            <td>Estado</td>                                    
            <td id="opciones">Opciones</td>
        </tr>
        
        @if($cobros)
        @foreach($cobros as $cob)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$cob->Id_Cob}}" disabled></td>           
            @foreach($ventas as $venta)
            @if($venta->Id_Ven==$cob->Id_Ven)
            <td><input type="text" size="4" value="{{$venta->Id_Arq}}" disabled></td>
            <td><input type="text" size="4" value="{{$cob->Id_Ven}}" disabled></td>                
                @foreach($clientes as $cli)
                @if($venta->Id_Cli==$cli->Id_Cli)
                <td><input type="text" size="30" value="{{$cli->Cli_Nom.' '.$cli->Cli_Ape}}" disabled></td>
                @endif
                @endforeach
            <td><input type="text" style="text-align:right" size="7" value="{{number_format($venta->Ven_Tot,0,',','.')}}" disabled></td>
            @endif
            @endforeach
            <td><input type="text" size="14" value="{{$cob->created_at->format('d/m/y H:i')}}" disabled></td>
            <td><input type="text" size="7" value="{{$cob->Cob_Est}}" disabled></td> 

            <td class="operacion"><a href="{{url('/Cobros/'.$cob->Id_Cob.'/informe')}}"><button class="botones" id="ver">Ver</button></a></td>                        
        </tr>
        @endforeach
        @endif

            @php
                $linea=1;
                $relleno=20-$mostrados;
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="30" disabled></td>
                    <td><input type="text" size="7" disabled></td>
                    <td><input type="text" size="14" disabled></td>
                    <td><input type="text" size="7" disabled></td>
                </tr>
            @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba_no">        
    </div>
@endsection

<script src="{{asset('js/vistas/paginacion_busqueda/cobro.js')}}"></script>