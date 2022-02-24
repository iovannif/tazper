@section('navegacion_1') <!-- paginacion -->
    {{--@if($lastPage>1)
        <!-- <style>
            #paginacion{
                left: 364px !important;
            }    
        </style> -->
    @else
        @if($todos>0)
            <!-- <style>
                #paginacion{
                    left: 464px !important;
                }
            </style> -->
        @else
            <!-- <style>
                #paginacion{
                    left: 610px !important;                    
                }
            </style> -->
        @endif
    @endif--}}
    <style>
        #no_match{
            position: relative;
            top: 77px;
            left: 426px;
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
                <a href="{{url('/Pagos?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
                {{$resultados->links('vendor\pagination\simple-default')}}
                <a href="{{url('/Pagos?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>        
        @endif
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

        @if($resultados)
        @foreach($resultados as $pago)
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
                $relleno=20-$count;
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