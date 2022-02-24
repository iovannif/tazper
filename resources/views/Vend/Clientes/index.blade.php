@extends('Vend.lay.Index')

<!-- con tres -->{{--
@if($cant==0)
<style>
    #opciones{
        width:165px !important;
    }
</style>
@endif    --}}

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

    /* con tres */
    /* .operacion button{
        padding-left:9.5px !important;
        padding-right:9.5px !important;

        margin-left:1px !important;
        margin-right:1px !important;
    }     */    

    /* con dos */
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

@if($cant==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
@endif

@section('titulo')
    Listado de Clientes
@endsection

@section('navegacion_1')
    <div id="nav">
        
        <!-- <button class="boton" id="buscar">Buscar</button>
        <input type="text" id="busqueda" placeholder="Nombre del cliente" size="40" maxlength="40"> -->

        <div id="paginacion">
            <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 4, " ", STR_PAD_LEFT))}}</button>
            
            @if($cant>0)
            <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
            <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($clientes->currentPage(), 3, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 3, " ", STR_PAD_LEFT))}}</button>
            @endif

            @if($lastPage>1)
            <div id="pag_bot"><div class="records">
                <a href="{{url('Clientes?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
                {{$clientes->links('vendor\pagination\simple-default')}}
                <a href="{{url('Clientes?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>
            @endif
            
            <!-- @if($lastPage>1)        
            <div id="pag_bot"><div class="records">            
                <a href="/Tazper/public/Clientes?page=1"><button class="boton" id="inicio">Inicio</button></a>
                {{$clientes->links('vendor\pagination\simple-default')}}
                <a href='{{"/Tazper/public/Clientes"."?page=$lastPage"}}'><button class="boton" id="fin">Fin</button></a>
            </div></div>
            @endif -->
        </div>    
    </div>
@endsection

@section('contenido')
    <a href="Clientes/create"><button class="boton agregar" id="agregar">Agregar</button></a>

    @include('Vend.Clientes.session_div.index')
    <div id="clientes">    
        <table id="principal">
            <tr class="head">
                <td>Id</td>
                <td>Nombres, Apellidos</td>
                <td>Estado</td>
                <td>Categoría</td>
                <!-- <td>Desde</td>
                <td>Antigüedad</td> -->
                <td>Ventas</td>
                <td id="opciones" colspan="3">Opciones</td>
            </tr>
            
            @if($clientes)
            @foreach($clientes as $cliente)
            <tr class="registro">
                <td><input type="text" size="4" value="{{$cliente->Id_Cli}}" disabled></td>
                <td><input type="text" size="40" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled></td>
                <td><input type="text" size="10" value="{{$cliente->Cli_Est}}" disabled></td>
                <td>
                    @foreach($listas as $lp)
                        @if($lp->Id_Lp==$cliente->Id_Lp)
                            <input type="text" size="20" value="{{$lp->Lp_Cat}}" disabled>
                        @endif
                    @endforeach
                </td>{{--
                <td><input type="text" size="10" value="{{$cliente->created_at->format('d/m/Y')}}" disabled></td>
                <td>
                    @php
                        $años=\Carbon\Carbon::now()->diffinYears($cliente->created_at);
                        $y_meses=floor(\Carbon\Carbon::now()->diffInMonths($cliente->created_at)%12);

                        if($años==1){
                            $a='año';
                        }elseif($años>1){
                            $a='años';
                        }

                        if($y_meses==1){
                            $y_m='mes';
                        }elseif($y_meses>1){
                            $y_m='meses';
                        }

                        if($años>=1 && $y_meses==0){
                            echo "<input type='text' size='20' value='$años $a' disabled>";
                        }elseif($años>=1 && $y_meses>0){
                            echo "<input type='text' size='20' value='$años $a $y_meses $y_m' disabled>";
                        }

                        if($años==0){
                            $meses=\Carbon\Carbon::now()->diffInMonths($cliente->created_at);

                            if($meses==1){
                                $m='mes';
                            }elseif($meses>1){
                                $m='meses';
                            }

                            if($meses>0){
                                echo "<input type='text' size='20' value='$meses $m' disabled>";
                            }
                        }

                        if($años==0 && $meses==0){
                            $semanas=\Carbon\Carbon::now()->diffInWeeks($cliente->created_at);

                            if($semanas==1){
                                $s='semana';
                            }elseif($semanas>1){
                                $s='semanas';
                            }

                            if($semanas>0){
                                echo "<input type='text' size='20' value='$semanas $s' disabled>";
                            }
                        }
                        
                        if($años==0 && $meses==0 && $semanas==0){
                            $dias=\Carbon\Carbon::now()->diffInDays($cliente->created_at);
                            
                            if($dias==1){
                                $d='día';
                            }elseif($dias>1){
                                $d='días';
                            }

                            if(!\Carbon\Carbon::now()==$cliente->created_at){
                                echo "<input type='text' size='20' value='$dias $d' disabled>";
                            }else{
                                echo "<input type='text' size='20' value='Desde hoy' disabled>";
                            }
                        }
                    @endphp
                </td>--}}  

                    @php
                        $vent_cli=0;
                        
                        foreach($ventas as $venta){
                            if($venta->Id_Cli==$cliente->Id_Cli){
                                if($venta->Ven_Est=='Válida'){
                                $vent_cli++;
                                }                
                            }                
                        }
                    @endphp                        

                <td><input type="text" size="4" value="{{$vent_cli}}" disabled>
                <!-- coleccion [{} {} {}]                               -->

                    @php
                        $foreign='';
                        
                        foreach($ventas as $venta){
                            if($venta->Id_Cli==$cliente->Id_Cli){
                                if($venta->Ven_Est=='Válida'){
                                    $foreign='true';
                                    break;
                                }                
                            }                
                        }

                        foreach($pedidos as $pedido){
                            if($pedido->Id_Cli==$cliente->Id_Cli){
                                $foreign='true';
                                break;
                            }
                        }
                    @endphp
                    <input type="hidden" id="{{$cliente->Id_Cli}}" class="foreign" value="{{$foreign}}" disabled></td>

                <td class="operacion td_ver"><a href="Clientes/{{$cliente->Id_Cli}}"><button class="botones" id="ver">Ver</button></a></td>
                <!-- <td class="operacion td_editar"><a href="Clientes/{{$cliente->Id_Cli}}/edit"><button class="botones" id="editar">Editar</button></a></td> -->
                <td class="operacion td_eliminar">
                {{--{!! Form::open(['method'=>'DELETE', 'action'=>['ClientesController@destroy', $cliente->Id_Cli]]) !!}
                        {{csrf_field()}}
                        <input type="submit" class="botones borrar" id="eliminar" value="Eliminar">
                        <!-- <input type="submit" class="botones borrar" id="eliminar" value="Eliminar"> -->
                {!! Form::close() !!}--}}                    
                </td>
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
                    <td><input type="text" size="40" value="" disabled></td>
                    <td><input type="text" size="10" value="" disabled></td>
                    <td><input type="text" size="20" value="" disabled></td>
                        <!-- <td><input type="text" size="10" value="" disabled></td>
                        <td><input type="text" size="20" value="" disabled></td>                                            -->
                    <td><input type="text" size="4" value="" disabled></td>
                    @if($cant==0) <!-- con dos o width, tres sin:arriba -->
                    <td class="operacion td_ver"></td>                    
                    <td class="operacion td_eliminar"></td>
                    @endif                    
                </tr>
            @endfor
        </table>
    </div>   
    <!-- Fuera -->
    
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection

<!-- js -->
<script src="{{asset('js/vistas/paginacion_busqueda/cliente.js')}}"></script>