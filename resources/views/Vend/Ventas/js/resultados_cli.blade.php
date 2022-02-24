@section('navegacion_1') <!-- paginacion -->
    <style onload>
        #no_match{
            position: relative;
            top: 116px;
            right: 146px;
            text-shadow:none;
        }        
        
        #inicio,#fin,#anterior,#anterior_inactivo,#siguiente_inactivo,#siguiente{
            background:#0075F3 !important;
            border-color:#006BDE !important;
        }
        #inicio:hover,#fin:hover,#anterior:hover,#siguiente:hover{
            background:#006BDE !important;
            border-color:#006BDE !important;
        }
    </style>                        

            @php // filtro clientes  
            /*
            $todos=count($ventas_cli);       
            echo $todos;

            echo $paginacion;
                if($ventas_cli!=''){                                                
                    
                    
                    $resultados=
                    $todos/simplePaginate($paginacion=1);
                }            
            */       
            @endphp    

            {{--$a
            
            quitar de collection  --}}

            
        @php 
            $todos=count($ventas_cli);             
            $lastPage=ceil($todos/$paginacion=5); 
            $count=ceil($todos/$lastPage);           
        @endphp

    @if($resultados->count()==0)
        <button class="boton trans" id="total_reg">Resultados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($todos, 4, " ", STR_PAD_LEFT))}}</button>        
        <button class="boton trans" id="no_match">{{'No hay coincidencias'}}</button>
    @else    
        <button class="boton trans" id="total_reg">Resultados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($todos, 4, " ", STR_PAD_LEFT))}}</button>
                
        @if($todos>0)
        <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($count, 2, " ", STR_PAD_LEFT))}}</button>
        <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($resultados->currentPage(), 3, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 3, " ", STR_PAD_LEFT))}}</button>
        @endif                        
        
        @if($lastPage>1)                
        <div id="pag_bot"><div class="resultados">
            <a href="{{url('Ventas?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$resultados->links('vendor\pagination\simple-default')}}
            <a href="{{url('Ventas?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div></div>
        @endif                  
    @endif
@endsection

@section('contenido')
      
        {{--
        @php
            //print_r($id_clientes); 
            
            $ventas_cli=[];                                     
            foreach($ventas as $venta){
                foreach($id_clientes as $id_cli){
                    if($venta->Id_Cli==$id_cli){
                        //echo $id_cli;                    
                        //echo $venta->Id_Ven;                    
                        //array_push($ventas_cli,$venta->Id_Ven);                                
                        //array_push($ventas_cli,$venta);                                
                    }                                
                }
            }                 

            foreach($ventas_cli as $vc){
                echo $vc;
            }                                                                                    
        @endphp
        --}}

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

            @php // filtro clientes        
            /*
                if($ventas_cli!=''){                                                
                    $todos=count($ventas_cli);
                    
                    $resultados=$todos->simplePaginate($paginacion=1);
                }            
            */       
            @endphp    

            
        
        @foreach($resultados as $venta)
            @foreach($ventas_cli as $vc)            
            @if($venta->Id_Ven==$vc)                                                
            <tr class="registro">
                <td><input type="text" size="4" value="{{$venta->Id_Ven}}" disabled></td>
                <td><input type="text" size="14" value="{{date('d/m/y', strtotime($venta->Ven_Fe)).' '.date('H:i', strtotime($venta->Ven_Ho))}}" disabled></td>                
                <td><input type="text" size="7" value="{{$venta->Ven_Fact}}" disabled></td>    
                <td><input type="text" size="4" value="{{$venta->Id_PedCli}}" disabled></td>        
                <td><input type="text" size="9" value="{{$venta->Ven_Tip}}" disabled></td>
                    @foreach($clientes as $cliente)
                    @if($cliente->Id_Cli==$venta->Id_Cli)
                        <td><input type="text" size="35" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled></td>                    
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
            @endif                        
            @endforeach
        @endforeach
        <script src="{{asset('js/vistas/operacion.js')}}"></script>

            @php
                $linea=1;
                $relleno=20-$count;
                //$relleno=20-count($ventas_cli);
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
                    @if($todos==0)
                    <td class="operacion td_ver"></td>
                    <td class="operacion td_eliminar"></td>
                    @endif
                </tr>
            @endfor
    </table> 
@endsection