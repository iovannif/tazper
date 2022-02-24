@extends('Admin.lay.Edit')

<style>
    #content{
        margin-bottom: 59px !important;
    }
</style>

@section('titulo')
    Editar Clientes
@endsection

@section('navegacion_1')
	<div id="este">
		{!! Form::open(['method'=>'DELETE', 'action'=>['ClientesController@destroy', $cliente->Id_Cli]]) !!}
			{{csrf_field()}}
			<input class="boton eliminar primer" type="submit" id="eliminar" value="Eliminar">
        {!! Form::close() !!}
        
        <a href="{{url('Clientes/'.$cliente->Id_Cli)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
        <a href="{{url('Clientes')}}" class="listado"><button class="boton lista" id="volver">Lista</button></a>
	</div>
@endsection

@section('contenido')
	{!! Form::model($cliente, ['method'=>'PATCH', 'action'=>['ClientesController@update', $cliente->Id_Cli]]) !!}
	<table id="principal">
		<tr>
            <td><label for="des_lar">Id de cliente:</label></td>
            <td><input type="text" size="4" value="{{$cliente->Id_Cli}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Nombres:</label></td>
            <td><input type="text" name="Cli_Nom" size="20" maxlength="20" value="{{$cliente->Cli_Nom}}" required autofocus></td>
        </tr>

        <tr>
            <td><label for="des_lar">Apellidos:</label></td>
            <td><input type="text" name="Cli_Ape" size="20" maxlength="20" value="{{$cliente->Cli_Ape}}" required></td>
        </tr>

        <tr>
            <td><label for="des_lar">RUC o CI:</label></td>
            <td><input type="text" name="Cli_Ruc" size="15" maxlength="15" value="{{$cliente->Cli_Ruc}}" required></td>
        </tr>

        <tr>
            <td><label for="categoria">Categoría:</label></td>
            <td>
                <select class="seleccion" name="Id_Lp">
                    @php
                        $lp_1 = 1;
                        $lp_2 = 2;
                        $lp_3 = 3;

                        switch($cliente->Id_Lp){
                            case $lp_1: echo
                                "<option value='$lp_1'>Ocasional</option>
                                <option value='$lp_2'>Frecuente</option>
                                <option value='$lp_3'>Fiel</option>";
                                break;
                            case $lp_2: echo
                                "<option value='$lp_2'>Frecuente</option>
                                <option value='$lp_3'>Fiel</option>
                                <option value='$lp_1'>Ocasional</option>";
                                break;
                            case $lp_3: echo
                                "<option value='$lp_3'>Fiel</option>
                                <option value='$lp_2'>Frecuente</option>
                                <option value='$lp_1'>Ocasional</option>";
                                break;
                        }
                    @endphp
                </select>
            </td>
        </tr>
        {{--
        <tr>
            <td><label for="des_lar">Fecha de nacimiento:</label></td>
            <td><input type="date" name="Cli_FeNac" size="10" maxlength="10" value="{{$cliente->Cli_FeNac}}" required></td>
        </tr>

        <tr>
            <td><label for="des_lar">Género:</label></td>
            <td>
                @php
                    $gen_1='Femenino';
                    $gen_2='Masculino';
                @endphp
                <select class="seleccion" name="Cli_Gen">
                    @if($cliente->Cli_Gen == $gen_1)
                        <option value="{{$gen_1}}">{{$gen_1}}</option>
                        <option value="{{$gen_2}}">{{$gen_2}}</option>
                    @elseif($cliente->Cli_Gen == $gen_2)
                        <option value="{{$gen_2}}">{{$gen_2}}</option>
                        <option value="{{$gen_1}}">{{$gen_1}}</option>
                    @endif
                </select>
            </td>
        </tr>

        <tr>
            <td><label for="des_lar">Celular:</label></td>
            <td><input type="text" name="Cli_Cel" size="15" maxlength="10" value="{{$cliente->Cli_Cel}}" required></td>
        </tr>
        
        <tr>
            <td><label for="des_lar">Dirección:</label></td>
            <td><input type="text" name="Cli_Dir" size="40" maxlength="10" value="{{$cliente->Cli_Dir}}" required></td>
        </tr>
        
        <tr>
            <td><label for="des_lar">Ciudad:</label></td>
            <td><input type="text" name="Cli_Ciu" size="30" maxlength="10" value="{{$cliente->Cli_Ciu}}" required></td>
        </tr>

        <tr>
            <td><label for="des_lar">Barrio:</label></td>
            <td><input type="text" name="Cli_Bar" size="30" maxlength="10" value="{{$cliente->Cli_Bar}}" required></td>
        </tr>
        --}}
        <tr>
            <td><label for="estado">Estado:</label></td>
            <td>
                @php
                    $est_1='Activo';
                    $est_2='Inactivo';
                @endphp
                <select class="seleccion" name="Cli_Est">
                    @if($cliente->Cli_Est == $est_1)
                        <option value="{{$est_1}}">{{$est_1}}</option>
                        <option value="{{$est_2}}">{{$est_2}}</option>
                    @elseif($cliente->Cli_Est == $est_2)
                        <option value="{{$est_2}}">{{$est_2}}</option>
                        <option value="{{$est_1}}">{{$est_1}}</option>
                    @endif
                </select>
            </td>
        </tr>

        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
            <td><textarea rows="4" cols="50" name="Cli_Obs" id="obs" placeholder="opcional" maxlength="140"></textarea></td>
        </tr>
	</table>
@endsection
        
@section('navegacion_2')
		<div class="arriba">
			<input class="boton" type="submit" id="actualizar" value="Actualizar">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="/Tazper/public/Clientes"><button class="boton lista" id="cancelar">Cancelar</button></a>
		</div>
@endsection