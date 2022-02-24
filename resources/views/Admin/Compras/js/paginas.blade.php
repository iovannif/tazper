@section('navegacion_1') <!-- paginacion -->
    @if($cant==0)
    <style>        
        #buscar,#busqueda{
            visibility:hidden;
        }
        #paginacion{
            position: absolute;
            left: 46% !important;
        }
    </style>
    @endif

    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 4, " ", STR_PAD_LEFT))}}</button>
    
    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
    <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($compras->currentPage(), 3, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 3, " ", STR_PAD_LEFT))}}</button>
    @endif

    @if($lastPage>1)
    <div id="pag_bot"><div class="records">
        <a href="{{url('Compras?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
        {{$compras->links('vendor\pagination\simple-default')}}
        <a href="{{url('Compras?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
    </div></div>
    @endif
@endsection

@section('contenido')
    <style onload=" //recarga        
        window.cantidad= <?php echo $cant; ?>;
        window.pagina_actual=<?php echo $compras->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;        
    "></style>

    <table id="principal">
        <tr class="head">
            <td>Id</td>            
            <td>Fecha</td>
            <td>Factura Nº</td>
            <td>Proveedor</td>
            <td>Id Pedido</td>
            <td>Id Orden</td>                        
            <td id="opciones" colspan="2">Opciones</td>
        </tr>
        
        @foreach($compras as $compra)
        <tr class="registro">
            <td><input type="text" size="4" id="id" value="{{$compra->Id_Com}}" disabled></td>
            <td><input type="text" size="14" value="{{date('d/m/y', strtotime($compra->Com_Fe)).' '.date('H:i', strtotime($compra->Com_Ho))}}" disabled></td>                
            <td><input type="text" size="15" value="{{$compra->Com_Fac}}" disabled></td>
            <td>
                @if($compra->Id_Prov!='')
                    @foreach($proveedores as $proveedor)
                        @if($proveedor->Id_Prov==$compra->Id_Prov)
                        <input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled>
                        @endif
                    @endforeach
                @else
                    <input type="text" size="30" value="{{$compra->Id_Prov}}" disabled>
                @endif
            </td>
            <td><input type="text" size="4" value="{{$compra->Id_PedProv}}" disabled></td>
            <td><input type="text" size="4" value="{{$compra->Id_OC}}" disabled></td>         
            
            <td class="operacion td_ver"><a href="Compras/{{$compra->Id_Com}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_eliminar">
                {!! Form::open(['method'=>'DELETE', 'action'=>['ComprasController@destroy', $compra->Id_Com]]) !!}
                    {{csrf_field()}}
                    <input type="submit" class="botones" id="eliminar" value="Eliminar" onclick="
                        event.preventDefault();
                        window.id=$('.registro:hover').find('#id').val();
                        $('#confirm').css('display','block');
                    ">
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        <script src="{{asset('js/vistas/operacion.js')}}"></script>

            @php
                $linea=1;
                $relleno=20-$mostrados;
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="14" disabled></td>
                    <td><input type="text" size="15" disabled></td>
                    <td><input type="text" size="30" disabled></td>
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="4" disabled></td>
                    @if($cant==0)
                    <td class="operacion td_ver"></td>
                    <td class="operacion td_eliminar"></td>
                    @endif
                </tr>
            @endfor
    </table>    
@endsection