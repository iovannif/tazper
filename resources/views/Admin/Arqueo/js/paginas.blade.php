@section('navegacion_1') <!-- paginacion -->
    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 4, " ", STR_PAD_LEFT))}}</button>    
    
    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
    <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($arqueos->currentPage(), 3, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 3, " ", STR_PAD_LEFT))}}</button>    
    @endif

    @if($lastPage>1)        
    <div id="pag_bot"><div class="records">
        <a href="{{url('/Arqueo?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a> 
        {{$arqueos->links('vendor\pagination\simple-default')}}
        <a href="{{url('/Arqueo?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
    </div></div>            
    @endif
@endsection

@section('contenido')    
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Estado</td>
            <td>Apertura</td>            
            <td>Cierre</td>            
            <td>Caja</td>
            <td id="opciones">Opciones</td>
        </tr>
        
        @if($arqueos)
        @foreach($arqueos as $arqueo)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$arqueo->Id_Arq}}" disabled></td>
            <td><input type="text" size="8" value="{{$arqueo->Arq_Est}}" disabled></td>
            <td><input type="text" size="14" value="{{date('d/m/y H:i', strtotime($arqueo->Arq_Ape))}}" disabled></td>
            <td>
                @if($arqueo->Arq_Cie)
                <input type="text" size="14" value="{{date('d/m/y H:i', strtotime($arqueo->Arq_Cie))}}" disabled>
                @else
                <input type="text" size="14" disabled>
                @endif
            </td>            
            <td>
                @foreach($cajas as $caja)
                    @if($caja->Id_Caj==$arqueo->Id_Caj)
                        <input type="text" size="15" value="{{$caja->Caj_Des}}" disabled>
                    @endif
                @endforeach
            </td>

            <td class="operacion"><a href="{{url('/Arqueo/'.$arqueo->Id_Arq)}}"><button class="botones" id="ver">Ver</button></a></td>
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
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="14" disabled></td>
                    <td><input type="text" size="14" disabled></td>
                    <td><input type="text" size="15" disabled></td>
                </tr>
            @endfor
    </table>
@endsection