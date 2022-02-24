@section('navegacion_1') <!-- paginacion -->
    <div id="paginacion">
        <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 4, " ", STR_PAD_LEFT))}}</button>
    
        @if($cant>0)
        <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>    
        <button class="boton total_reg" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($articulos->currentPage(), 3, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 3, " ", STR_PAD_LEFT))}}</button>        
        @endif
        
        @if($lastPage>1)       
        <div id="pag_bot"> 
            <a href="{{url('Articulos?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$articulos->links('vendor\pagination\simple-default')}}
            <a href="{{url('Articulos?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div>
        @endif
    </div>
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Id Art</td>
            <td>Id Mat</td>
            <td>Id Prod</td>
            <td>Descripción</td>            
            <td>Tipo</td>
            <td>Categoría</td>
            <td>Estado</td>
            <td>Existencia</td>
        </tr>
        
        @if($articulos)
        @foreach($articulos as $articulo)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$articulo->Id_Art}}" disabled></td>
            <td><input type="text" size="4" value="{{$articulo->Id_Mat}}" disabled></td>
            <td><input type="text" size="4" value="{{$articulo->Id_Prod}}" disabled></td>
            <td><input type="text" class="left" size="35" value="{{$articulo->Art_DesLar}}" disabled></td>
            <td><input type="text" size="8" value="{{$articulo->Art_Tip}}" disabled></td>
            <td>                                                    
                @if($categorias->count()>0)
                    @foreach($categorias as $categoria)
                        @if($categoria->Id_Cat==$articulo->Id_Cat)
                            <input type="text" class="left" size="20" value="{{$categoria->Cat_Des}}" disabled>
                            @php $no='false'; @endphp
                            @break
                        @else
                            @php $no='true'; @endphp
                        @endif
                    @endforeach

                    @if($no=='true')
                        <input type="text" size="20" disabled>
                    @endif                   
                @else
                    <input type="text" size="20" disabled>
                @endif                    
            </td>
            <td><input type="text" size="8" value="{{$articulo->Art_Est}}" disabled></td>
            <td>
                <input type="text" size="3" value="{{$articulo->Art_St}}" style="text-align:right" disabled>
                <input type="text" class="left" style="padding-left:10px" size="17" value="{{$articulo->Art_UniMed}}" disabled>
            </td>
        </tr>
        @endforeach
        @endif

            @php
                $linea=1;
                $relleno=40-$mostrados;
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" value="" disabled></td>
                    <td><input type="text" size="4" value="" disabled></td>
                    <td><input type="text" size="4" value="" disabled></td>
                    <td><input type="text" size="35" value="" disabled></td>
                    <td><input type="text" size="8" value="" disabled></td>
                    <td><input type="text" size="20" value="" disabled></td>
                    <td><input type="text" size="8" value="" disabled></td>
                    <td><input type="text" size="20" value="" disabled></td>
                </tr>
            @endfor
    </table>
@endsection