@section('navegacion_1') <!-- paginacion -->
    <style onload="
        window.cantidad=<?php echo $cant; ?>;
        window.pagina_actual=<?php echo $clientes->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;
    "></style>    

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
@endsection

@section('contenido')    
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Nombres, Apellidos</td>
            <td>Estado</td>
            <td>Categoría</td>
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
            </td>
            
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
            <td><input type="text" size="4" value="{{$vent_cli}}" disabled></td>  

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

            <!-- <td><input type="checkbox"></td> -->
            <td class="operacion td_ver"><a href="Clientes/{{$cliente->Id_Cli}}"><button class="botones" id="ver">Ver</button></a></td>
            <!-- <td class="operacion td_editar"><a href="Clientes/{{$cliente->Id_Cli}}/edit"><button class="botones" id="editar">Editar</button></a></td> -->
            <td class="operacion td_eliminar">
                <input type="submit" class="botones" id="eliminar" value="Eliminar" onclick="
                    window.id=$('.registro:hover').find($('.foreign')).attr('id');
                                    
                    var foreign=$('.registro:hover').find($('.foreign')).val();
                    if(foreign=='true'){
                        $('#rechazo').show().delay(1500).fadeOut(0);
                    }else{
                        $('#confirm').css('display','block');
                    }
                ">
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
                    <td><input type="text" size="4" value="" disabled></td>
                    <td><input type="text" size="40" value="" disabled></td>
                    <td><input type="text" size="10" value="" disabled></td>
                    <td><input type="text" size="20" value="" disabled></td>
                    <td><input type="text" size="4" value="" disabled></td>                                                                         
                    @if($cant==0)
                    <td class="operacion td_ver"></td>
                    <td class="operacion td_eliminar"></td>
                    @endif   
                </tr>
            @endfor        
    </table>    
@endsection