@section('navegacion_1')            
    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 3, " ", STR_PAD_LEFT))}}</button>

    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
    <button class="boton trans" id="pag">Página {{$ordenes->currentPage()}} de {{$lastPage}}</button>
    @endif

    @if($lastPage>1)
    <div id="pag_bot">
        <a href="{{url('OrdenCompra?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
        {{$ordenes->links('vendor\pagination\simple-default')}}
        <a href="{{url('OrdenCompra?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
    </div>
    @endif
@endsection

@section('contenido')
    @if($cant==0)
        <link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
    @endif

    <style onload="
        window.cantidad=<?php echo $cant; ?>;
        window.pagina_actual=<?php echo $ordenes->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;  
    "></style>
    
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Proveedor</td>            
            <td>Pedido</td>
            <td>Estado</td>
            <td>Fecha de entrega</td>
            <td>Registro</td>
            <td id="opciones" colspan="2">Opciones</td>
        </tr>

        @if($ordenes)
        @foreach($ordenes as $orden)
        <tr class="registro">            
            <td><input type="text" size="4" value="{{$orden->Id_OC}}" disabled></td>
            <td>
                @foreach($proveedores as $proveedor)
                    @if($proveedor->Id_Prov==$orden->Id_Prov)
                    <input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled>
                    @endif
                @endforeach                    
            </td>
            <td><input type="text" size="4" value="{{$orden->Id_PedProv}}" disabled></td>
            <td><input type="text" size="7" value="{{$orden->OC_Est}}" disabled></td>
            <td><input type="text" size="8" value="{{date('d/m/y', strtotime($orden->OC_FeEnt))}}" disabled></td>
            <td><input type="text" size="14" value="{{$orden->created_at->format('d/m/y H:i')}}" disabled></td>

            <td class="operacion td_ver"><a href="OrdenCompra/{{$orden->Id_OC}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_eliminar">
                {!! Form::open(['method'=>'DELETE', 'action'=>['OrdenCompraController@destroy', $orden->Id_OC]]) !!}
                    {{csrf_field()}}
                    @if($orden->OC_Est=='Pendiente')
                    <input type="submit" class="botones borrar" id="eliminar" value="Cancelar" onclick="
                        event.preventDefault();
                        window.id=$('.registro:hover').find('input').val();    
                        
                        if($(this).val()=='Cancelar'){
                            $('#cancela').css('display','block');
                            window.mensaje='cancelado';     
                        }else{
                            $('#confirm').css('display','block');
                            window.mensaje='eliminado';
                        }
                    ">
                    @else
                    <input type="submit" class="botones borrar" id="eliminar" value="Eliminar" onclick="
                        event.preventDefault();
                        window.id=$('.registro:hover').find('input').val();    
                        
                        if($(this).val()=='Cancelar'){
                            $('#cancela').css('display','block');   
                            window.mensaje='cancelado'; 
                        }else{
                            $('#confirm').css('display','block');
                            window.mensaje='eliminado';
                        }
                    ">
                    @endif
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        @endif
        <script src="{{asset('js/vistas/operacion.js')}}"></script>

            @php
                $linea=1;
                $relleno=20-$mostrados;
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="blank">
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="30" disabled></td>
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="7" disabled></td>
                <td><input type="text" size="8" disabled></td>
                <td><input type="text" size="14" disabled></td>
                @if($cant==0)
                <td class="operacion td_ver"></td>
                <td class="operacion td_eliminar"></td>
                @endif
            </tr>
            @endfor
    </table>
@endsection