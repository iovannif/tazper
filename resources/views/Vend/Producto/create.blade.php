@extends('Vend.lay.Create')

<style>
		tr:nth-child(5){
			display:none;
		}

	#categoria .lista_js{
		left: 374px !important;
    	top: 287px !important;
		width:183px !important;
	}	

	#proveedor .lista_js{
		left: 374px !important;
    	top: 647px !important;
		width:253px !important;
	}	

	.cambiar2{
		display:inline-block !important;
	}
	
	.masiva{
		position:absolute;
		bottom:-187px;
		left: 345px;		
	}
</style>

@section('titulo')
    Agregar Productos
@endsection

@section('contenido')
	@include('Vend.Producto.session_div.create')
	<table id="principal">
		<tr class="masiva">
			<td>
				<label for="masiva">Inserción masiva</label>
				<input type="checkbox" id="masiva">
			</td>
		</tr>
	{!! Form::open(['url'=>'/Productos', 'method'=>'post', 'autocomplete'=>'off', 'spelcheck'=>'false']) !!}
		{{csrf_field()}}		
		<tr>
			<td><label for="tipo">Tipo:</label></td>
			<td>
				<select class="seleccion" name="Art_Tip">
					<option value="Producto">Producto</option>
					<option value="Material">Material</option>
				</select>
			</td>
		</tr>				                                              

			<tr>
				<td><label for="des_lar">Descripción larga:</label></td>
				<td>
					<input type="text" name="Art_DesLar" class="primer" id="des_lar" placeholder="obligatorio" size="35" maxlength="35" value="{{old('Art_DesLar')}}" required autofocus>					
					<span class="error error_deslar"></span> <!-- ajax -->

					@if($errors->has('Art_DesLar'))
						<span class="help-block">{{$errors->first('Art_DesLar')}}</span>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="des_cor">Descripción corta:</label></td>
				<td>
					<input type="text" name="Art_DesCor" id="des_cor" placeholder="opcional" size="25" maxlength="25" value="{{old('Art_DesCor')}}">					
					<span class="error error_descor"></span>

					@if($errors->has('Art_DesCor'))
						<span class="help-block">{{$errors->first('Art_DesCor')}}</span>
					@endif
				</td>
			</tr>		
			
			<tr>
				<td><label for="produccion">Tipo de producto:</label></td>
				<td>										
					<select class="seleccion" name="Tip_Prod" id="tip_prod">
						<option value="Tazper">Tazper</option>							
						<option value="Comprado">Comprado</option>							
					</select>
				</td>
			</tr>

			@if($categorias->count()>0)				
				<tr class="cat">
					<td><label for="categoria">Categoría:</label></td>
                    @if(old('Id_Cat')!='')
                        @foreach($categorias as $categoria)
                            @if($categoria->Id_Cat==old('Id_Cat'))
                            <td>
                                <input type="text" class="busca" id="busca_cat" size="20" maxlength="20" value="{{$categoria->Cat_Des}}" disabled>
                                <button class="cambiar cambiar2">cambiar</button>                                
                            </td>
                            @endif
                        @endforeach
                    @else
                    <td>
                        <input type="text" class="busca" id="busca_cat" size="20" maxlength="20" placeholder="opcional">                        
                        <button class="cambiar">cambiar</button>                        
                    </td>
                    @endif
                </tr>
                
                <tr>
                    <td class="resultado"> <!-- cuadro js -->
                        <div id="categoria"></div>
                    </td>
                </tr>                
                
                <tr class="hidden"><td> <!-- id -->
                    <input type="hidden" name="Id_Cat" id="id_cat" size="4" maxlength="2" value="{{old('Id_Cat')}}">
                </td></tr>
			@else
				<tr>
					<td><label for="categoria">Categoría:</label></td>				
					<td>
						<input type="text" class="no_hay" placeholder="No hay categorías agregadas" size="25" disabled>																							
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
						<!-- <option value="1">Exentas</option>
						<option value="2">Iva 5%</option>
						<option value="3">Iva 10%</option> -->						
					</select>
					<span class="error error_imp"></span>

					@if($errors->has('Id_Imp'))
						<span class="help-block">{{$errors->first('Id_Imp')}}</span>
					@endif
				</td>
			</tr>				                			

			<tr>
				<td><label for="p_com">Precio de compra:</label></td>
				<td>
					<input type="number" name="Art_PreCom" id="pre_com" placeholder="obligatorio" min="500" max="1000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{old('Art_PreCom')}}" required>
					<span class="error error_precom"></span>

					@if($errors->has('Art_PreCom'))
						<span class="help-block">{{$errors->first('Art_PreCom')}}</span>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="gan_min">Ganancia mínima:</label></td>
				<td>
					<input type="number" name="Art_GanMin" id="gan_min" placeholder="obligatorio" min="500" max="1000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{old('Art_GanMin')}}" required>
					<span class="error error_ganmin"></span>

					@if($errors->has('Art_GanMin'))
						<span class="help-block">{{$errors->first('Art_GanMin')}}</span>
					@endif	
				</td>
			</tr>
			
			<tr>
				<td><label for="p_vent">Precio de venta:</label></td>
				<td>
					<input type="number" name="Art_PreVen" id="pre_ven" placeholder="obligatorio" min="500" max="5000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{old('Art_PreVen')}}" required>
					<span class="error error_preven"></span>

					@if($errors->has('Art_PreVen'))
						<span class="help-block">{{$errors->first('Art_PreVen')}}</span>
					@endif
				</td>
			</tr>		  																				

			<tr>
				<td><label for="stock">Stock:</label></td>
				<td>
					<input type="number" name="Art_St" id="stock" placeholder="obligatorio" size="4" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" value="{{old('Art_St')}}" required>
					<span class="error error_st"></span>

					@if($errors->has('Art_St'))
						<span class="help-block">{{$errors->first('Art_St')}}</span>
					@endif	
				</td>
			</tr>

			<tr>
				<td><label for="stock_min">Stock mínimo:</label></td>
				<td>
					<input type="number" name="Art_StMn" id="st_mn" placeholder="opcional" size="4" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" value="{{old('Art_StMn')}}">
					<span class="error error_stmn"></span>

					@if($errors->has('Art_StMn'))
						<span class="help-block">{{$errors->first('Art_StMn')}}</span>
					@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="stock_max">Stock máximo:</label></td>
				<td>
					<input type="number" name="Art_StMx" id="st_mx" placeholder="opcional" size="4" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" value="{{old('Art_StMx')}}">
					<span class="error error_stmx"></span>
					
					@if($errors->has('Art_StMx'))
						<span class="help-block">{{$errors->first('Art_StMx')}}</span>
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
						<input type="text" id="prov" class="no_hay" placeholder="No hay proveedores agregados" size="30" disabled>																							
					</td>
				</tr>			
			@endif

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
			<input class="boton" type="submit" id="registrar" value="Registrar">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="{{url('Productos')}}"><button class="boton lista" id="volver">Volver</button></a>
			<a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>			
		</div>
@endsection

<script src="{{asset('js/vistas/create_edit/material.js')}}"></script>
<script src="{{asset('js/vistas/create_edit/producto.js')}}"></script>
<script src="{{asset('js/vistas/masiva/producto.js')}}"></script>