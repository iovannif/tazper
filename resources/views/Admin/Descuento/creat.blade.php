@extends('Admin.lay.Create')

<style>
	body{
		height:100.1%;
		/* height:101%; */
	}
	/* #content{
		margin-bottom:129px !important;
	} */

	#contenido{
	padding-top: 25px !important;
	padding-bottom: 20px !important;
	}

	#detalle{
		font-family: Raleway;
		color: #C90000;
		font-size:20px;
		font-weight:bold;
		text-shadow: 1px 1px 1px lightgray;    
		cursor:default;
		margin-bottom:10px !important;		
	}

	.para,.sobre{
		display: inline-block;
		/* border:1px solid black;		 */
		border-radius:1%;
		vertical-align:top;		
		/* width:-webkit-fill-available; */
		width:430px;
		/* box-shadow: 0px 0px 1px 0px grey; */
		box-shadow: 0px 0px 3px 1px #E6E6E6;
		margin-right:10px;
		/* height:auto; */
		margin-bottom:10px;		
	}

	.benef,.item{
		padding-right:10px;
	}

	table{
		cursor:default;			
	}

	.cuadro{
		margin-top:15px;
		margin-left:5px;
		display:none;
	}

	.head{
		background: #F9F9F9;
		color:#C90000;    
		text-align:center;
		font-size:15px;    		
	}
	.head td{
		text-shadow: 1px 1px 1px #808080;
		padding-top: 4px !important;
		padding-bottom: 4px !important;    
		/* box-shadow: 0px 0px 1px 0px grey; */
		border: 1px solid darkgray;
	}

	.reg input{
		margin:0 !important;
		border:none !important;
		box-shadow:none !important;
		/* text-shadow: 0 0 0 lightgray; */
		/* margin-right:-5px !important;
		padding-right:15px !important; */
		/* background:none !important; */
	}	

	.porc{
		margin:0 !important;
		margin-top:-1px !important;
		margin-left:2px !important;		
	}

	.porc, .porc_todos input{
		width:57px !important;
	}

	input[type=radio]{
		cursor:hand;		
	}

	/* input[type=checkbox]{
		cursor:hand;		
	} */

	.middle{
		padding-bottom:5px !important;
		padding-right:10px !important;				
	}	
	
	td{
		/* text-align:center !important; */
	}

	.reg{
		border-right:none !important;
	}

	.check{
		padding:0 !important;
		/* margin:0 !important; */
		padding-right:5px !important;
		border-left:none !important;
	}

	.listas{
	list-style: none;
    padding: 2px 0 0 7px;
    border: 1px solid lightgray;
	height: 27px;
	}

	.porc_todos td:first-child{
		padding-left:15px;
	}
</style>

@section('titulo')
    Agregar Descuento
@endsection

@section('contenido')		
	{!! Form::open(['url'=>'/Descuento', 'method'=>'post', 'autocomplete'=>'off', 'spelcheck'=>'false']) !!}
		{{csrf_field()}}			
		<table id="principal">
		{{--@if(Session::has('lp')){{session('lp')}}@endif--}}
			<tr>
				<td><label for="tipo">Tipo:</label></td>
				<td>
					<input type="text" name="Desc_Tip" class="primer" placeholder="obligatorio" size="15" maxlength="15" value="{{old('Cli_Nom')}}" required autofocus>
					<span class="error error_tip"></span>
				</td>
			</tr>

			<tr>
				<td><label for="des">Descripción:</label></td>
				<td>
					<input type="text" name="Desc_Des" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Cli_Nom')}}" required>
					<span class="error error_des"></span>
				</td>
			</tr>

			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>
					<textarea rows="4" cols="50" name="Desc_Obs" id="obs" placeholder="opcional" maxlength="140">{{old('Cli_Obs')}}</textarea><br>
					<span class="error error_obs obs_err"></span>
				</td>
			</tr>
						
			<tr><td>&nbsp;</td></tr>
		</table>	

		<h3 id="detalle">Detalle</h3>		
		<table class="para">
			<tr><td>		
				<table>			
					<tr>
						<td class="benef"><label for="benef">Para:<!-- Beneficiario --></label></td>

						<td><label for="cli_cat">Categorías</label></td>		
						<td class="middle"><input type="radio" name="para" id="cli_cat"></td>								
					
						<td><label for="cli">Clientes</label></td>	
						<td class="middle"><input type="radio" name="para" id="cli_cli"></td>										
					
						<td><label for="cli_tod">Todos</label></td>	
						<td class="middle"><input type="radio" class="0" name="para" id="cli_tod" checked></td>										
					</tr>						
				</table>	

				<!-- seleccionar -->
				<table class="cuadro categorias_cli">
					<tr class="head"><td colspan="2">Categorías de Cliente</td></tr>

					@foreach($listas as $lp)
						<tr>
							<td class="listas reg"><input type="text" size="20" value="{{$lp->Lp_Cat}}" disabled></td>		
							<td class="listas check"><input type="checkbox" class="{{$lp->Id_Lp}}" disabled></td>
						</tr>
					@endforeach				
					<tr><td>&nbsp;</td></tr>		
				</table>

				<table class="cuadro clientes_cli">
					<tr class="head"><td colspan="2">Clientes</td></tr>

					@foreach($clientes as $cliente)
					<tr>						
						<td class="listas reg"><input type="text" size="40" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled></td>	
						<td class="listas check"><input type="checkbox" class="{{$cliente->Id_Cli}}" disabled></td>
					</tr>
					@endforeach		
					<tr><td>&nbsp;</td></tr>
				</table>				
			</td></tr>
		</table>

		<table class="sobre">
			<tr><td>
				<table>					
					<tr>
						<td class="item"><label for="item">Sobre:<!-- Ítems	--></label></td>

						<td><label for="prod_cat">Categorías</label></td>		
						<td class="middle"><input type="radio" name="sobre" id="prod_cat"></td>								
					
						<td><label for="prod">Productos</label></td>	
						<td class="middle"><input type="radio" name="sobre" id="prod_prod"></td>										
					
						<td><label for="tod_prod">Todos</label></td>	
						<td class="middle"><input type="radio" class="0" name="sobre" id="prod_tod" checked></td>										
					</tr>			
				</table>

				<!-- seleccionar -->
				<table class="cuadro categorias_prod">
					<tr class="head">
						<td colspan="2">Categorías de Producto</td>
						<!-- <td colspan="2">Porcentaje</td> -->
					</tr>

					@foreach($categorias as $categoria)
					<tr class="cat">
						<td class="listas reg"><input type="text" size="20" value="{{$categoria->Cat_Des}}" disabled></td>				
						<td class="listas check"><input type="checkbox" class="{{$categoria->Id_Cat}}" disabled></td>
						<!-- <td class="listas"><input type="number" class="porc {{$categoria->Id_Cat}}" max="99" min="0" onkeypress="if(this.value.length==2) return false;" disabled> %</td>										 -->
					</tr>
					@endforeach						
					<tr><td>&nbsp;</td></tr>
				</table>

				<table class="cuadro productos_prod">
					<tr class="head">
						<td colspan="2">Productos</td>
						<!-- <td colspan="2">Porcentaje</td> -->
					</tr>					

					@foreach($productos as $producto)
					<tr class="prod">
						<td class="listas reg"><input type="text" size="35" value="{{$producto->Art_DesLar}}" disabled></td>
						<td class="listas check"><input type="checkbox" class="{{$producto->Id_Art}}" disabled></td>	
						<!-- <td class="listas"><input type="number" class="porc {{$producto->Id_Art}}" max="99" min="0" onkeypress="if(this.value.length==2) return false;" disabled> %</td>													 -->
					</tr>
					@endforeach		
					<tr><td>&nbsp;</td></tr>
				</table>	

				<tr class="porc_todos"><td>Porcentaje: <input type="number" id="porc_tod" max="95" min="5" step="5" onkeypress="if(this.value.length==2) return false;"> %</td></tr>	
				<!-- Aplicar porcentaje a todos -->
			</td></tr>	
		</table>
@endsection
        
@section('navegacion_2')
		<div class="arriba">
			<input class="boton" type="submit" id="registrar" value="Registrar">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="{{url('Descuento')}}"><button class="boton lista" id="volver">Volver</button></a>
			<a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>			
		</div>
@endsection

<script src="{{asset('js/vistas/descuento.js')}}"></script>