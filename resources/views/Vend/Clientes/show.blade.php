@extends('Vend.lay.Show')

<style>
    #auditoria{
        display:none;
    }

    /* sin detalle */
</style>

@section('titulo')
    Clientes
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Clientes/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif                        
        
        @if($next)
        <a href="{{URL::to('Clientes/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Clientes')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    @include('Vend.Clientes.session_div.show')
    <table id="principal">
        <tr>
            <td><label for="des_lar">Id de cliente:</label></td>
            <td><input type="text" size="4" value="{{$cliente->Id_Cli}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Nombres:</label></td>
            <td><input type="text" size="20" value="{{$cliente->Cli_Nom}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Apellidos:</label></td>
            <td><input type="text" size="20" value="{{$cliente->Cli_Ape}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">RUC o CI:</label></td>
            <td><input type="text" size="15" value="{{$cliente->Cli_Ruc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Categoría:</label></td>
            <td>
                @foreach($listas as $lp)
                    @if($lp->Id_Lp==$cliente->Id_Lp)
                        <input type="text" size="20" value="{{$lp->Lp_Cat}}" disabled>
                    @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td><label for="des_lar">Descuento:</label></td>
            <td>
                @foreach($listas as $lp)
                    @if($lp->Id_Lp==$cliente->Id_Lp)
                        <input type="text" size="3" value="{{$lp->Lp_Desc}}%" disabled>
                    @endif
                @endforeach
            </td>
        </tr>               

        <tr>
            <td><label for="ven">Ventas:</label></td>
            <td><input type="text" size="4" value="{{$ventas}}" disabled></td>
        </tr>

        <tr>
            <td><label for="desde">Cliente desde:</label></td>
            <td>
            <input type="text" size="10" value="{{$cliente->created_at->format('d/m/Y')}}" disabled>
            </td>
        </tr>

        <tr>
            <td><label for="antiguedad">Antigüedad:</label></td>
            <td>
                @php
                    $años=\Carbon\Carbon::now()->diffinYears($cliente->created_at);
                    $y_meses=floor(\Carbon\Carbon::now()->diffInMonths($cliente->created_at)%12);

                    if($años==1){
                        $a='año';
                    }elseif($años>1){
                        $a='años';
                    }

                    if($y_meses==1){
                        $y_m='mes';
                    }elseif($y_meses>1){
                        $y_m='meses';
                    }

                    if($años>=1 && $y_meses==0){
                        echo "<input type='text' size='20' value='$años $a' disabled>";
                    }elseif($años>=1 && $y_meses>0){
                        echo "<input type='text' size='20' value='$años $a $y_meses $y_m' disabled>";
                    }

                    if($años==0){
                        $meses=\Carbon\Carbon::now()->diffInMonths($cliente->created_at);

                        if($meses==1){
                            $m='mes';
                        }elseif($meses>1){
                            $m='meses';
                        }

                        if($meses>0){
                            echo "<input type='text' size='20' value='$meses $m' disabled>";
                        }
                    }

                    if($años==0 && $meses==0){
                        $semanas=\Carbon\Carbon::now()->diffInWeeks($cliente->created_at);

                        if($semanas==1){
                            $s='semana';
                        }elseif($semanas>1){
                            $s='semanas';
                        }

                        if($semanas>0){
                            echo "<input type='text' size='20' value='$semanas $s' disabled>";
                        }
                    }
                    
                    if($años==0 && $meses==0 && $semanas==0){
                        $dias=\Carbon\Carbon::now()->diffInDays($cliente->created_at);
                        
                        if($dias==1){
                            $d='día';
                        }elseif($dias>1){
                            $d='días';
                        }

                        if(!\Carbon\Carbon::now()==$cliente->created_at){
                            echo "<input type='text' size='20' value='$dias $d' disabled>";
                        }else{
                            echo "<input type='text' size='20' value='Desde hoy' disabled>";
                        }
                    }
                @endphp
            </td>
        </tr>        

        <tr>
            <td><label for="estado">Estado:</label></td>
            <td><input type="text" size="8" value="{{$cliente->Cli_Est}}" disabled></td>
        </tr>

        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
            <td><textarea rows="4" cols="50" id="obs" disabled>{{$cliente->Cli_Obs}}</textarea></td>
        <tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>    
        
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection

<script src="{{asset('js/vistas/paginacion_show/cliente.js')}}"></script>