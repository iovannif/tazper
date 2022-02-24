@extends('Admin.lay.Show')

@section('titulo')
    Datos personales
@endsection

@section('navegacion_1')
    <div id="este">
        <a href="{{url('/Datos_personales/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>		
        <a href="{{url('Inicio')}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
    </div>
@endsection

@section('contenido')
	@include('Admin.Personal.session_div.show')
	<table id="principal">
		<tr>
            <td><label for="id_per">Id de personal:</label></td>
            <td><input type="text" size="4" value="{{$personal->Id_Per}}" disabled></td>
        </tr>

		<tr>
			<td><label for="nombres">Nombres:</label></td>
			<td><input type="text" size="20" value="{{$personal->Per_Nom}}" disabled></td>
		</tr>

		<tr>
			<td><label for="apellidos">Apellidos:</label></td>
			<td><input type="text" size="20" value="{{$personal->Per_Ape}}" disabled></td>
		</tr>

		<tr>
			<td><label for="ci">CI:</label></td>
			<td><input type="text" size="15" value="{{$personal->Per_CI}}" disabled></td>
		</tr>

		<tr>
			<td><label for="fe_na">Fecha de nacimiento:</label></td>
			<td>
				<input type="text" id="fe_nac" size="8" value="{{date('d/m/Y', strtotime($personal->Per_FeNac))}}" disabled>
			</td>
		</tr>

		<tr>
			<td><label for="lu_na">Lugar de nacimiento:</label></td>
			<td><input type="text" size="30" value="{{$personal->Per_LugNac}}" disabled></td>
		</tr>

		<tr>
			<td><label for="nacionalidad">Nacionalidad:</label></td>
			<td><input type="text" size="20" value="{{$personal->Per_Nac}}" disabled></td>
		</tr>

		<tr>
			<td><label for="genero">Género:</label></td>
			<td><input type="text" size="9" value="{{$personal->Per_Gen}}" disabled></td>
		</tr>

		<tr>
			<td><label for="est_civ">Estado civil:</label></td>
			<td><input type="text" size="15" value="{{$personal->Per_EstCiv}}" disabled></td>
		</tr>

		<tr>
			<td><label for="hijos">Hijos:</label></td>
			<td><input type="text" size="2" value="{{$personal->Per_Hij}}" disabled></td>
		</tr>

		<tr>
			<td><label for="telefono">Teléfono:</label></td>
			<td><input type="text" size="15" value="{{$personal->Per_Tel}}" disabled></td>
		</tr>

		<tr>
			<td><label for="celular">Celular:</label></td>
			<td><input type="text" size="15" value="{{$personal->Per_Cel}}" disabled></td>
		</tr>

		<tr>
			<td><label for="email">E-mail:</label></td>
			<td><input type="text" size="30" value="{{$personal->Per_Email}}" disabled></td>
		</tr>

		<tr>
			<td><label for="direccion">Dirección:</label></td>
			<td><input type="text" size="50" value="{{$personal->Per_Dir}}" disabled></td>
		</tr>

		<tr>
			<td><label for="ciudad">Ciudad:</label></td>
			<td><input type="text" size="30" value="{{$personal->Per_Ciu}}" disabled></td>
		</tr>

		<tr>
			<td><label for="barrio">Barrio:</label></td>
			<td><input type="text" size="30" value="{{$personal->Per_Bar}}" disabled></td>
		</tr>

		<tr>
            <td>&nbsp;</td>
        </tr>
	</table>
@endsection
	@include('Admin.Personal.user')
        
@section('navegacion_2')
    <div class="arriba_no">
    </div>    
@endsection