@extends('Admin.lay.Index')

<style>
    #nav{
        text-align:center;    
        height:32px;     
    } 
    #pag{
        margin-right: 16px;
    }
    .agregar{
        position: absolute;
        top: 105px;
        font-family: Raleway;
    }

    /* .botones{
        padding-left:7px !important;
        padding-right:7px !important;
    } */

    .botones{
        padding-left:0px !important;
        padding-right:0px !important;
        width:100%;
    }

    #eliminar{
        margin-right: 0 !important;
        /* width:110%; */
        width:118%;
    }
    #ver{
        /* margin-left: 2px; */
        /* margin-right: 1px; */        
        margin-left: 4px;
        
        width:110%;
    }
    #editar{
        /* margin-left: 1px; */   
        width:75px;             
    }

    .activar{
        background: #5981FF !important;
        border: 1px solid #2C34E8 !important;
    }
    .activar:hover{
        background: #2C34E8 !important;
    }
    .desactivar{
        background: #FF6833 !important;
        border: 1px solid #FE4C28 !important;
    }
    .desactivar:hover{
        background: #FE4C28 !important;
    }    
</style>

@if($cant==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
@endif

@section('titulo')
    Listado de Descuento
@endsection

@section('navegacion_1')
    <div id="nav">
        <div id="paginacion">            
            <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>
            
            @if($cant>0)
            <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
            <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($descuentos->currentPage(), 2, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 2, " ", STR_PAD_LEFT))}}</button>
            @endif
            
            @if($lastPage>1)
            <div id="pag_bot"><div class="records">
                <a href="{{url('Descuento?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
                {{$descuentos->links('vendor\pagination\simple-default')}}
                <a href="{{url('Descuento?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>
            @endif
        </div>
    </div>            
@endsection

@section('contenido')
    <a href="{{url('Descuento/create')}}" class="agregar"><button class="boton" id="agregar">Agregar</button></a>

    @include('Admin.Descuento.session_div.index')
    <div id="descuentos">        
        <table id="principal">
            <tr class="head">
                <td>Id</td>
                <td>Tipo</td>
                <td>Descripción</td>                
                <td>Estado</td>                
                <td id="opciones" colspan="3">Opciones</td>
            </tr>
            
            @if($descuentos)            
            @foreach($descuentos as $descuento)
            <tr class="registro">
                <td><input type="text" size="4" value="{{$descuento->Id_Desc}}" disabled></td>
                <td><input type="text" size="15" value="{{$descuento->Desc_Tip}}" disabled></td>
                <td><input type="text" size="20" value="{{$descuento->Desc_Des}}" disabled></td>            
                <td><input type="text" size="8" value="{{$descuento->Desc_Est}}" disabled></td>       

                    {{--@php
                        $foreign='';
                                            
                        foreach($ventas as $vendet){
                            if($vendet->Id_Desc==$descuento->Id_Desc){
                                $foreign='true';
                                break;
                            }
                        }
                    @endphp
                    <input type="hidden" id="{{$descuento->Id_Desc}}" class="foreign" value="{{$foreign}}" disabled></td>--}}

                @if($descuento->Desc_Est=='Desactivado')
                <td class="operacion td_editar"><a href="Descuento/{{$descuento->Id_Desc}}/activar"><button class="botones activar" id="editar">Activar</button></a></td>
                @else
                <td class="operacion td_editar"><a href="Descuento/{{$descuento->Id_Desc}}/desactivar"><button class="botones desactivar" id="editar">Desactivar</button></a></td>
                @endif                

                <td class="operacion td_ver"><a href="Descuento/{{$descuento->Id_Desc}}"><button class="botones" id="ver">Ver</button></a></td>                                                
                <td class="operacion td_eliminar">
                @if($descuento->Desc_Des!='Mayorista')
                    {!! Form::open(['method'=>'DELETE', 'action'=>['DescuentoController@destroy', $descuento->Id_Desc]]) !!}
                        {{csrf_field()}}
                        <input type="submit" class="botones borrar" id="eliminar" value="Eliminar" onclick="
                            event.preventDefault();
                            // var foreign=$('.registro:hover').find($('.foreign')).val();
                                
                            // if(foreign=='true'){                                
                            //     $('#rechazo').show().delay(1500).fadeOut(0);
                            // }else{
                                $('#confirm').css('display','block');
                            // }                            
                        ">
                    {!! Form::close() !!}
                @endif                
                </td>
                <!-- <td class="operacion td_eliminar"><input type="submit" class="botones borrar" id="eliminar" value="Eliminar"></td> -->
            </tr>
            @endforeach
            @endif            

                <!-- relleno -->
                @php
                    $linea=1;
                    $relleno=20-$mostrados;
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" value="" disabled></td>
                        <td><input type="text" size="15" value="" disabled></td>
                        <td><input type="text" size="20" value="" disabled></td>                        
                        <td><input type="text" size="8" value="" disabled></td>
                        @if($cant==0)                                           
                        <td class="operacion" style="width:60px"></td>              
                        <td class="operacion" style="width:60px"></td>                        
                        <td class="operacion" style="width:61px"></td>                            
                        @endif
                    </tr>
                @endfor
        </table>                  
    </div>
    <!-- Fuera -->
    @if($descuentos->count()>0)  
    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el descuento, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['DescuentoController@destroy', $descuento->Id_Desc]]) !!}
                        {{csrf_field()}}
                        <button class="c_botones confirmar" type="submit">Confirmar</button>
                    {!! Form::close() !!}
                </td>                
                <td class="left"><button class="c_botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div> 
    @endif
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection

<script src="{{asset('js/vistas/eliminar/descuento.js')}}"></script>