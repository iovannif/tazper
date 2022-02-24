@extends('Admin.lay.Create') <!-- Ajax -->

<style>
    #content{
        margin-bottom:12px !important; /* scroll */
    }
	#contenido{
		padding-top:30px !important;		
	}	

	#cant::-webkit-input-placeholder{ /* Chrome/Opera/Safari */        
        font-size: 14px;
    }	

	.lista_js{
		left: 391px !important;
    	top: 348px !important;
		width:253px !important;
	}	
	.cambiar2{
		display:inline-block !important;
	}
	
	.masiva{
		position:absolute;
		top: 602px;
		left: 345px;		
	}
</style>

@if($proveedores->count()==0)
<style>
	#prov{
		border:none;
		box-shadow:none;
		background:none;
		padding:0;
	}
</style>
@endif

@section('titulo')
    Agregar Materiales
@endsection

@section('contenido')
	@include('Admin.Material.session_div.create')
	<table id="principal">
		<tr class="masiva">
			<td>
				<label for="masiva">Inserción masiva</label>
				<input type="checkbox" id="masiva">
			</td>
		</tr>

	{!! Form::open(['url'=>'/Materiales', 'method'=>'post', 'autocomplete'=>'off', 'spellcheck'=>'false', 'id'=>'mat_form']) !!}
		{{csrf_field()}}		
			<tr>
				<td><label for="des_lar">Descripción:</label></td>
				<td>
					<input type="text" name="Art_DesLar" class="primer" id="des" placeholder="obligatorio" size="35" maxlength="35" value="{{old('Art_DesLar')}}" required autofocus>					
					<span class="error error_des"></span> <!-- ajax -->

					@if($errors->has('Art_DesLar'))
						<span class="help-block">{{$errors->first('Art_DesLar')}}</span>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="p_comp">Precio:</label></td>
				<td>
					<input type="number" name="Art_PreCom" id="pre" placeholder="obligatorio" min="500" max="1000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{old('Art_PreCom')}}" required>
					<span class="error error_pre"></span>

					@if($errors->has('Art_PreCom'))
						<span class="help-block">{{$errors->first('Art_PreCom')}}</span>
					@endif
				</td>
			</tr>	

			<tr>
				<td><label for="uni_med">Unidad de medición:</label></td>
				<td>					
					<input type="text" name="Art_UniMed" id="uni_med" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Art_UniMed')}}" required>
					<span class="error error_unimed"></span>

					@if($errors->has('Art_UniMed'))
						<span class="help-block">{{$errors->first('Art_UniMed')}}</span>
					@endif	
				</td>
			</tr>			

			<tr>
				<td><label for="stock">Existencia:</label></td>
				<td>
					<input type="number" name="Art_St" id="cant" placeholder="obligatorio" min="0" max="9999" step="0.5" value="{{old('Art_St')}}" onKeyPress="if(this.value.length==4) return false;" required>
					<!-- <input type="text" name="Art_St" id="cant" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Art_St')}}" required> -->
					<span class="error error_cant"></span>

					@if($errors->has('Art_St'))
						<span class="help-block">{{$errors->first('Art_St')}}</span>
					@endif	
				</td>
			</tr>											
			
			@if($proveedores->count()>0)				
				<tr class="prov">
					<td><label for="proveedor">Proveedor:</label></td>
                    @if(old('Id_Prov')!='')
                        @foreach($proveedores as $proveedor)
                            @if($proveedor->Id_Prov==old('Id_Prov'))
                            <td>
                                <input type="text" class="busca" id="busca_prov" size="30" maxlength="30" value="{{$proveedor->Prov_Des}}" disabled>
                                <button class="cambiar cambiar2">cambiar</button>                                
                            </td>
                            @endif
                        @endforeach
                    @else
                    <td>
                        <input type="text" class="busca" id="busca_prov" size="30" maxlength="30" placeholder="opcional">                        
                        <button class="cambiar">cambiar</button>                        
                    </td>
                    @endif
                </tr>
                
                <tr>
                    <td class="resultado"> <!-- cuadro js -->
                        <div id="proveedor"></div>
                    </td>
                </tr>                
                
                <tr class="hidden"><td> <!-- id -->
                    <input type="hidden" name="Id_Prov" id="id_prov" size="4" maxlength="2" value="{{old('Id_Prov')}}">
                </td></tr>
			@else
				<tr>
					<td><label for="proveedor">Proveedor:</label></td>				
					<td>
						<input type="text" id="prov" placeholder="No hay proveedores agregados" size="30" disabled>																							
					</td>
				</tr>			
			@endif	

			<tr>
				<td><label for="impuesto">Impuesto:</label></td>
				<td>
					<select class="seleccion" id="id_imp" name="Id_Imp" minlength="1" maxlength="2" min="1" max="99" required>
						@foreach($impuestos as $impuesto)
							<option value="{{$impuesto->Id_Imp}}">{{$impuesto->Imp_Des}}</option>							
						@endforeach						
					</select>
					<span class="error error_imp"></span>

					@if($errors->has('Id_Imp'))
						<span class="help-block">{{$errors->first('Id_Imp')}}</span>
					@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="estado">Estado:</label></td>				
				<td>
					<select class="seleccion" name="Art_Est" id="est" minlength="6" maxlength="8" required>
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
					</select>
					<span class="error error_est"></span>

					@if($errors->has('Art_Est'))
						<span class="help-block">{{$errors->first('Art_Est')}}</span>
					@endif
				</td>
			</tr>
															
			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>
					<textarea rows="4" cols="50" name="Art_Obs" id="art_obs" placeholder="opcional" maxlength="140">{{old('Art_Obs')}}</textarea>
					<br><span class="error error_obs top" id="obs"></span>
					
					@if($errors->has('Art_Obs'))<br>
						<span class="help-block top" id="obs">{{$errors->first('Art_Obs')}}</span>
					@endif
				</td>
			</tr>			
		</table>
@endsection
        
@section('navegacion_2')
		<div class="arriba">
			<input class="boton" type="submit" id="registrar" value="Registrar"> <!-- {!! Form::submit('Enviar') !!}  -->			
			<input class="boton" type="reset" id="limpiar" value="Limpiar"> <!-- {!! Form::reset('Borrar') !!} -->			
	{!! Form::close() !!}
			<a href="{{url('Materiales')}}"><button class="boton lista" id="volver">Volver</button></a>
			<a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
			<!-- <a href="#"><button class="boton" id="masivo">Agregado masivo</button></a> -->			
		</div>
@endsection

<script src="{{asset('js/vistas/masiva/material.js')}}"></script>
<script src="{{asset('js/vistas/create_edit/material.js')}}"></script>