@section('navegacion_1')            
    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>

    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
    <button class="boton trans" id="pag">Página {{$produccion->currentPage()}} de {{$lastPage}}</button>
    @endif

    @if($lastPage>1)
    <div id="pag_bot">
        <a href="{{url('Produccion?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
        {{$produccion->links('vendor\pagination\simple-default')}}
        <a href="{{url('Produccion?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
    </div>
    @endif
@endsection

@section('contenido')
    <style onload="
        window.cantidad=<?php echo $cant; ?>;
        window.pagina_actual=<?php echo $produccion->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;  
    "></style>
    
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Concepto</td>
            <td>Registro</td>
            <td id="opciones" colspan="2">Opciones</td>
        </tr>

        @if($produccion)
        @foreach($produccion as $producto)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$producto->Id_Pdc}}" disabled></td>
            <td>
                @foreach($productos as $prod)
                    @if($producto->Id_Prod==$prod->Id_Art)
                    <input type="text" size="35" value="{{$prod->Art_DesLar}}" disabled>
                    @endif
                @endforeach
            </td>
            <td><input type="text" size="4" value="{{$producto->Pdc_Cant}}" disabled></td>
            <td><input type="text" size="6" value="{{$producto->Pdc_Con}}" disabled></td>
            <td><input type="text" size="14" value="{{$producto->created_at->format('d/m/Y H:i')}}" disabled></td>

            <td class="operacion td_ver"><a href="{{url('Produccion/'.$producto->Id_Pdc)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_eliminar">
                {!! Form::open(['method'=>'DELETE', 'action'=>['ProduccionController@destroy', $producto->Id_Pdc]]) !!}
                    {{csrf_field()}}
                    <input type="submit" class="botones" id="eliminar" onclick="
                        event.preventDefault();
                        window.id=$('.registro:hover').find('input').val();                     
                        $('#confirm').css('display','block');
                    " value="Cancelar">
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        @endif
        <script src="{{asset('js/vistas/operacion.js')}}"></script>

            @php
                $linea=1;
                $relleno=20-$produccion->count();
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="blank">
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="35" disabled></td>
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="6" disabled></td>
                <td><input type="text" size="14" disabled></td>
                @if($cant==0)
                <td class="operacion td_ver"></td>
                <td class="operacion td_eliminar"></td>
                @endif
            </tr>
            @endfor
    </table>
@endsection