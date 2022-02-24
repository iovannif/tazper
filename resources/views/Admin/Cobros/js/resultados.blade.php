@section('navegacion_1') <!-- paginacion -->
    <style>
        #no_match{
            position: relative;
            top: 77px;
            left: 318px;
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
                <a href="{{url('/Cobros?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
                {{$resultados->links('vendor\pagination\simple-default')}}
                <a href="{{url('/Cobros?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>        
        @endif
    @endif
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Arqueo</td>
            <td>Venta</td>
            <td>Cliente</td>
            <td>Ingreso</td>            
            <td>Registro</td>     
            <td>Estado</td>        
            <td id="opciones">Opciones</td>
        </tr>

        @if($resultados)
        @foreach($resultados as $cob)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$cob->Id_Cob}}" disabled></td>           
            @foreach($ventas as $venta)
            @if($venta->Id_Ven==$cob->Id_Ven)
            <td><input type="text" size="4" value="{{$venta->Id_Arq}}" disabled></td>
            <td><input type="text" size="4" value="{{$cob->Id_Ven}}" disabled></td>                
                @foreach($clientes as $cli)
                @if($venta->Id_Cli==$cli->Id_Cli)
                <td><input type="text" size="30" value="{{$cli->Cli_Nom.' '.$cli->Cli_Ape}}" disabled></td>
                @endif
                @endforeach
            <td><input type="text" style="text-align:right" size="7" value="{{number_format($venta->Ven_Tot,0,',','.')}}" disabled></td>
            @endif
            @endforeach
            <td><input type="text" size="14" value="{{$cob->created_at->format('d/m/y H:i')}}" disabled></td>
            <td><input type="text" size="7" value="{{$cob->Cob_Est}}" disabled></td> 

            <td class="operacion"><a href="{{url('/Cobros/'.$cob->Id_Cob.'/informe')}}"><button class="botones" id="ver">Ver</button></a></td>                        
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
                    <td><input type="text" size="7" disabled></td>
                </tr>
            @endfor
    </table>
@endsection