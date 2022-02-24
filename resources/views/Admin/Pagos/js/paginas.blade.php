@section('navegacion_1') <!-- paginacion -->
    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 4, " ", STR_PAD_LEFT))}}</button>    
    
    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
    <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($pagos->currentPage(), 3, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 3, " ", STR_PAD_LEFT))}}</button>    
    @endif

    @if($lastPage>1)        
    <div id="pag_bot"><div class="records">
        <a href="{{url('/Pagos?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a> 
        {{$pagos->links('vendor\pagination\simple-default')}}
        <a href="{{url('/Pagos?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
    </div></div>            
    @endif
@endsection

@section('contenido')    
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Arqueo</td>
            <td>Compra</td>
            <td>Proveedor</td>
            <td>Egreso</td>            
            <td>Registro</td>         
            <td id="opciones">Opciones</td>
        </tr>
        
        @if($pagos)
        @foreach($pagos as $pago)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$pago->Id_Pag}}" disabled></td>                        
            <td><input type="text" size="4" value="{{$pago->Id_Arq}}" disabled></td>
            <td><input type="text" size="4" value="{{$pago->Id_Com}}" disabled></td>        
            <td><input type="text" size="30" value="{{$pago->Pag_Prov}}" disabled></td>
            <td><input type="text" style="text-align:right" size="7" value="{{number_format($pago->Pag_Eg,0,',','.')}}" disabled></td>
            <td><input type="text" size="14" value="{{$pago->created_at->format('d/m/y H:i')}}" disabled></td>

            <td class="operacion"><a href="{{url('/Pagos/'.$pago->Id_Pag.'/informe')}}"><button class="botones" id="ver">Ver</button></a></td>                        
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
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="30" disabled></td>
                    <td><input type="text" size="7" disabled></td>
                    <td><input type="text" size="14" disabled></td>
                </tr>
            @endfor
    </table>
@endsection