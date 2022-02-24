@extends('Admin.lay.Show')

<style>
    /* #reg,#mdf{
        margin-left:91px !important;
    } */

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
        
        <!-- <a href="{{url('Clientes/'.$cliente->Id_Cli.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a> -->

        <!-- {!! Form::open(['method'=>'DELETE', 'action'=>['ClientesController@destroy', $cliente->Id_Cli]]) !!} -->
            {{csrf_field()}}
            <!-- <input class="boton eliminar" type="submit" id="eliminar" value="Eliminar"> -->
        <!-- {!! Form::close() !!} -->

        <button class="boton eliminar" id="borrar" onclick="
            <?php             
            // ->count()
            if($ventas>0 || $pedidos>0){ ?>;
                $('#rechazo').show().delay(1500).fadeOut(0);
            <?php }else{ ?>;
                $('#confirm').css('display','block');
            <?php } ?>;
        ">Eliminar</button>
        
        @if($next)
        <a href="{{URL::to('Clientes/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Clientes')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    @include('Admin.Clientes.session_div.show')
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

        <!-- <tr>
            <td><label for="des_lar">Fecha de nacimiento:</label></td>
            <td><input type="text" size="10" value="{{date('d/m/Y', strtotime($cliente->Cli_FeNac))}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Edad:</label></td>
            <td><input type="text" size="2" value="{{\Carbon\Carbon::now()->diffinYears($cliente->Cli_FeNac)}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Género:</label></td>
            <td><input type="text" size="8" value="{{$cliente->Cli_Gen}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Celular:</label></td>
            <td><input type="text" size="15" value="{{$cliente->Cli_Cel}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="des_lar">Dirección:</label></td>
            <td><input type="text" size="40" value="{{$cliente->Cli_Dir}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="des_lar">Ciudad:</label></td>
            <td><input type="text" size="30" value="{{$cliente->Cli_Ciu}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Barrio:</label></td>
            <td><input type="text" size="30" value="{{$cliente->Cli_Bar}}" disabled></td>
        </tr> -->        

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
    @include('Admin.Clientes.user')
    
    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el cliente, desea continuar?</td></tr>            
            <tr>                    
                <td class="right">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['ClientesController@destroy', $cliente->Id_Cli]]) !!}            
                    <input class="botones borrar" type="submit" value="Confirmar">
                    {!! Form::close() !!}
                </td>                                                                
                <td class="left"><button class="botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

    {{--@section('reg')
        <input type="text" id="reg" size="15" value="{{$cliente->created_at->format('d/m/y H:i')}}" disabled>
    @endsection

    @section('reg_por')
        @foreach($users as $user)
            @if($user->Id_Usu==$cliente->Cli_RegPor)
                <input type="text" id="regPor_id" size="4" value="Id: {{$user->Id_Usu}}" disabled>
                <input type="text" id="regPor_name" size="15" value="{{$user->Usu_User}}" disabled>
            @endif
        @endforeach
    @endsection

    @section('mdf')
        @if($cliente->updated_at!='' && $cliente->created_at!=$cliente->updated_at)
            <input type="text" id="mdf" size="15" value="{{$cliente->updated_at->format('d/m/y H:i')}}" disabled>
        @else
            <input type="text" id="mdf" size="15" value="" disabled>
        @endif
    @endsection

    @section('mdf_por')
        @if($cliente->updated_at!='' && $cliente->created_at!=$cliente->updated_at)
            @foreach($users as $user)
                @if($user->Id_Usu==$cliente->Cli_MdfPor)
                    <input type="text" id="mdfPor_id" size="4" value="Id: {{$user->Id_Usu}}" disabled>
                    <input type="text" id="mdfPor_name" size="15" value="{{$user->Usu_User}}" disabled>
                @endif
            @endforeach
        @else
            <input type="text" id="mdfPor_id" size="4" value="" disabled>
            <input type="text" id="mdfPor_name" size="15" value="" disabled>
        @endif
    @endsection--}}

@section('navegacion_2')
    <div class="arriba_no">
    </div>

    <!-- <div class="arriba">
        <a href="#"><button class="boton lista" id="arriba">Volver arriba</button></a>
    </div> -->
@endsection

<script src="{{asset('js/vistas/paginacion_show/cliente.js')}}"></script>