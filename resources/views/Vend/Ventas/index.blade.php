@extends('Vend.lay.Index')

@if($cant==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
<style>
    #nav_2{
        visibility:hidden;
    }   

    #nav{   
        height:32px;
    } 
</style>
@else
<style>    
    #navegacion_1{   
        /* height:77px !important; */
        /* height:84px !important; */
        height:79px !important;
    } 
</style>
@endif

<style>
    .agregar,#nav_2{        
        position: absolute;    
        font-family: Raleway;
    }
    .agregar{
        top: 105px;
    }
    #nav_2{        
        top: 144px;
        left: 85px;
    }
    #buscar,#buscar_filtro{        
        cursor: hand !important;
        border-color: #0267D3 !important;
    }
    #buscar:hover,#buscar_filtro:hover{
        background: #0267D3 !important;
    }     
    #buscar_filtro{
        display:none;
    }     
    #busqueda{
        font-family:arial;
        cursor: hand;
        margin-bottom: -1px !important;
        width: 150px !important;
    }  
    #filtros{        
        margin-top: -2px !important;
    }   

    .filtro{
        /* margin: 7px 0px 1px 0 !important; */
        margin: 1px 0px 1px 0 !important;
        font-family:Arial;
    }

    #navegacion_1{        
        padding-right:0 !important;
    }      
    #nav{
        text-align:center;                            
    }
    #pag{
        margin-right: 16px;
    }               
                          
    .operacion{
        width:90px !important;
    }
    .botones{
        padding:4px 16px !important;
    }
    #ver{
        margin-left:-18px;
    }
    #eliminar{
        padding-left:10px !important;
        padding-right:10px !important;
        margin-right: 5px !important;
    }

    .operacion .botones{
        width:fit-content !important;
    }
</style>

@section('titulo')
    Listado de Ventas
@endsection

@section('navegacion_1')
    <div id="nav">                        
        <div id="paginacion">
            <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 4, " ", STR_PAD_LEFT))}}</button>

            @if($cant>0)
            <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
            <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($ventas->currentPage(), 3, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 3, " ", STR_PAD_LEFT))}}</button>
            @endif

            @if($lastPage>1)
            <div id="pag_bot"><div class="records">
                <a href="{{url('Ventas?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
                {{$ventas->links('vendor\pagination\simple-default')}}
                <a href="{{url('Ventas?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>
            @endif 
        </div>    
    </div>
@endsection

@section('contenido')
    <a href="Ventas/create"><button class="boton agregar" id="agregar">Agregar</button></a>
    <div id="nav_2">
        <button class="boton" id="buscar">Buscar</button>
        <button class="boton" id="buscar_filtro">Buscar</button>
        <input type="date" id="busqueda" placeholder="Fecha" autofocus>                                       

        <button class="boton" id="filtros">Filtros</button>
            <!-- filtros -->        
            <input type="text" class="filtro filtro_uno" id="filtro_idVen" placeholder="Id" size="4" maxlength="4" spellcheck="false" autocomplete="off">        
            <input type="text" class="filtro" id="filtro_Fac" placeholder="Factura" size="7" maxlength="7" spellcheck="false" autocomplete="off">
            <input type="text" class="filtro" id="filtro_Tip" placeholder="Tipo" size="9" maxlength="9" spellcheck="false" autocomplete="off">
            <input type="text" class="filtro" id="filtro_Cli" placeholder="Cliente" size="30" maxlength="40" spellcheck="false" autocomplete="off"> <!-- Id  -->
            <!-- <input type="text" class="filtro" id="filtro_Cat" placeholder="Categoría" size="20" maxlength="25" spellcheck="false" autocomplete="off">        
            <input type="text" class="filtro" id="filtro_Desc" placeholder="%" size="3" maxlength="3" spellcheck="false" autocomplete="off"> -->
            <input type="text" class="filtro" id="filtro_Est" placeholder="Estado" size="7" maxlength="7" spellcheck="false" autocomplete="off">         
        <button class="boton" id="cancelar_filtro" style="margin-left:0 !important; margin-top:-3px !important">cancelar</button>                 
    </div> 
    <!-- Nav -->
        
    <div id="ventas">
        <table id="principal">        
            <tr class="head">                                
                <td>Id</td>
                <td>Fecha</td>                                
                <td>Factura Nº</td>
                <td>Id Pedido</td>                                                                
                <td>Tipo</td>                                                                
                <td>Cliente</td>
                <!-- <td>Categoría</td> -->
                <!-- <td>Descuento</td> -->
                <td>Estado</td>
                <td id="opciones" colspan="2">Opciones</td>
            </tr>

            @foreach($ventas as $venta)
            <tr class="registro">                
                <td><input type="text" size="4" value="{{$venta->Id_Ven}}" disabled></td>
                <td><input type="text" size="14" value="{{date('d/m/y', strtotime($venta->Ven_Fe)).' '.date('H:i', strtotime($venta->Ven_Ho))}}" disabled></td>                
                <td><input type="text" size="7" value="{{$venta->Ven_Fact}}" disabled></td>        
                <td><input type="text" size="4" value="{{$venta->Id_PedCli}}" disabled></td>
                <td><input type="text" size="9" value="{{$venta->Ven_Tip}}" disabled></td>
                    @foreach($clientes as $cliente)
                    @if($cliente->Id_Cli==$venta->Id_Cli)
                    <td><input type="text" size="35" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled></td>
                        {{--@foreach($listas as $lp)
                            @if($cliente->Id_Lp==$lp->Id_Lp)
                            <td><input type="text" size="20" value="{{$lp->Lp_Cat}}" disabled></td>
                            <td><input type="text" size="3" value="{{$lp->Lp_Desc.'%'}}" disabled></td>
                            @endif
                        @endforeach--}}

                        <!-- <td><input type="text" size="20" value="{{$venta->Ven_CliLp}}" disabled></td> -->
                        <!-- <td><input type="text" size="3" value="{{$venta->Ven_CliDesc.'%'}}" disabled></td> -->
                    @endif
                    @endforeach   
                <td><input type="text" size="7" value="{{$venta->Ven_Est}}" disabled></td>             
                
                <td class="operacion td_ver"><a href="Ventas/{{$venta->Id_Ven}}"><button class="botones" id="ver">Ver</button></a></td>            
                @if($venta->Ven_Est=='Anulada')
                <td class="operacion td_eliminar"><a href="{{URL::to('Ventas/'.$venta->Id_Ven.'/desanular')}}"><button class="botones" id="eliminar" style="padding-left:6px !important; padding-right:6px !important;">Desanular</button></a></td>                
                @else
                <td class="operacion td_eliminar"><a href="{{URL::to('Ventas/'.$venta->Id_Ven.'/anular')}}"><button class="botones" id="eliminar" style="width:82.4px">Anular</button></a></td>                            
                @endif
            </tr>
            @endforeach
            
                @php
                    $linea=1;
                    $relleno=20-$mostrados;
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="14" disabled></td>
                        <td><input type="text" size="7" disabled></td>
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="9" disabled></td>
                        <td><input type="text" size="35" disabled></td>
                        <!-- <td><input type="text" size="20" disabled></td> -->
                        <!-- <td><input type="text" size="3" disabled></td> -->
                        <td><input type="text" size="7" disabled></td>
                        @if($cant==0)
                        <td class="operacion td_ver"></td>
                        <td class="operacion td_eliminar"></td>
                        @endif
                    </tr>
                @endfor        
        </table>
    </div>
    <!-- fuera -->    
@endsection

@section('navegacion_2')
    <div class="arriba_no">        
    </div>
@endsection

<!-- //pagina_actual  -->
<script src="{{asset('js/vistas/filtro/venta.js')}}"></script>
<script src="{{asset('js/vistas/paginacion_busqueda/venta.js')}}"></script>