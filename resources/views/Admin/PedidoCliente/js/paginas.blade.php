@section('navegacion_1')            
    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 3, " ", STR_PAD_LEFT))}}</button>

    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
    <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($pedidos->currentPage(), 2, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 2, " ", STR_PAD_LEFT))}}</button>
    @endif

    @if($lastPage>1)
    <div id="pag_bot">
        <a href="{{url('PedidoCliente?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
        {{$pedidos->links('vendor\pagination\simple-default')}}
        <a href="{{url('PedidoCliente?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
    </div>
    @endif
@endsection

@section('contenido')
    <style onload="
        window.cantidad=<?php echo $cant; ?>;
        window.pagina_actual=<?php echo $pedidos->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;  
    "></style>
    
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Cliente</td>
            <!-- <td>Descuento</td> -->
            <td>Tipo</td>
            <td>Fecha de Entrega</td>
            <td>Estado</td>
            <td>Registro</td>                
            <td id="opciones" colspan="2">Opciones</td>
        </tr>

        @if($pedidos)
        @foreach($pedidos as $pedido)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$pedido->Id_PedCli}}" disabled></td>
            <td>
                @foreach($clientes as $cliente)
                    @if($cliente->Id_Cli==$pedido->Id_Cli)
                    <input type="text" size="35" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled>
                    @endif
                @endforeach
            </td>   
            {{--
            <td>
                @foreach($clientes as $cliente)
                    @if($cliente->Id_Cli==$pedido->Id_Cli)
                        @foreach($listas as $lp)
                            @if($cliente->Id_Lp==$lp->Id_Lp)
                                @if($cliente->Id_Lp!=1)
                                <input type="text" size="3" value="{{$lp->Lp_Desc}}%" disabled>
                                @else
                                <input type="text" size="3" value="" disabled>
                                @endif    
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </td>
            --}}         
            <td><input type="text" size="9" value="{{$pedido->PedCli_Tip}}" disabled></td>
            <td><input type="text" size="8" value="{{date('d/m/y', strtotime($pedido->PedCli_FeEnt))}}" disabled></td>
            <td><input type="text" size="9" value="{{$pedido->PedCli_Est}}" disabled></td>
            <td><input type="text" size="14" value="{{$pedido->created_at->format('d/m/y H:i')}}" disabled></td>                

            <td class="operacion td_ver"><a href="{{url('PedidoCliente/'.$pedido->Id_PedCli)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_eliminar">
                {!! Form::open(['method'=>'DELETE', 'action'=>['PedidosClientesController@destroy', $pedido->Id_PedCli]]) !!}
                    {{csrf_field()}}
                    @if($pedido->PedCli_Est=='Pendiente')
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
                $relleno=20-$pedidos->count();
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="blank">
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="35" disabled></td>
                <!-- <td><input type="text" size="3" disabled></td> -->
                <td><input type="text" size="9" disabled></td>
                <td><input type="text" size="8" disabled></td>
                <td><input type="text" size="9" disabled></td>
                <td><input type="text" size="14" disabled></td>                  
                @if($cant==0)
                <td class="operacion td_ver"></td>
                <td class="operacion td_eliminar"></td>
                @endif
            </tr>
            @endfor
    </table>
@endsection