@extends('Admin.lay.Edit')

<style>
	#categoria .lista_js{
		left: 374px !important;
    	top: 416px !important;
		width:183px !important;
	}	

	#proveedor .lista_js{
		left: 374px !important;
    	top: 776px !important;
		width:253px !important;
	}

	.cambiar2{
        display:inline !important;
    }
</style>

@section('titulo')
    Editar Productos
@endsection

@section('navegacion_1')
	<div id="este">				
		<button class="boton eliminar primer" id="borrar" onclick="
			<?php 
			// $productos=0;
			if($produccion>0 || $ped_prov>0 || $compras>0 || $ped_cli>0 || $ventas>0 || $descuentos>0){ ?>;
				$('#rechazo').show().delay(1500).fadeOut(0);
			<?php }else{ ?>;
				$('#confirm').css('display','block');
			<?php } ?>;
		">Eliminar</button>				
		<a href="{{url('Productos/'.$producto->Id_Prod)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a> 
		<a href="{{url('Productos')}}" class="listado"><button class="boton lista" id="volver">Lista</button></a> 
	</div>
@endsection

@section('contenido')
	@include('Admin.Producto.session_div.edit')

	{!! Form::model($producto, ['method'=>'PATCH', 'action'=>['ProductosController@update', $producto->Id_Prod], 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		<table id="principal">
			<tr>
				<td><label for="cod_art">Id de artículo:</label></td>
				<td><input type="text" size="4" value="{{$producto->Id_Art}}" disabled></td>
			</tr>

			<tr>
				<td><label for="cod_art">Id de producto:</label></td>
				<td><input type="text" size="4" value="{{$producto->Id_Prod}}" disabled></td>
			</tr>			

			<tr>
				<td><label for="des_lar">Descripción larga:</label></td>				
				<td>
					@if($errors->any())						
						<input type="text" name="Art_DesLar" class="primero" placeholder="obligatorio" size="35" maxlength="35" value="{{old('Art_DesLar')}}" required autofocus>
						@if($errors->has('Art_DesLar'))
						<span class="help-block">{{$errors->first('Art_DesLar')}}</span>						
						@endif													
					@else			
						<input type="text" name="Art_DesLar" class="primero" placeholder="obligatorio" size="35" maxlength="35" value="{{$producto->Art_DesLar}}" required autofocus>
					@endif												
				</td>
			</tr>

			<tr>
				<td><label for="des_cor">Descripción corta:</label></td>
				<td>
					@if($errors->any())						
						<input type="text" name="Art_DesCor" placeholder="opcional" size="25" maxlength="25" value="{{old('Art_DesCor')}}">
						@if($errors->has('Art_DesCor'))
						<span class="help-block">{{$errors->first('Art_DesCor')}}</span>						
						@endif													
					@else			
						<input type="text" name="Art_DesCor" placeholder="opcional" size="25" maxlength="25" value="{{$producto->Art_DesCor}}">
					@endif						
				</td>
			</tr>

			<tr>
				<td><label for="tipo_prod">Tipo de producto:</label></td>
				<td>
					<select class="seleccion" name="Art_ProdTip" required>
						@php
							$tip_1 = 'Tazper';
							$tip_2 = 'Comprado';							

							switch($producto->Art_ProdTip){
								case $tip_1: echo
								   "<option value='$tip_1'>$tip_1</option>									
									<option value='$tip_2'>$tip_2</option>";
									break;
								case $tip_2: echo
								   "<option value='$tip_2'>$tip_2</option>									
									<option value='$tip_1'>$tip_1</option>";
									break;								
							}
						@endphp
					</select>
				</td>
			</tr>

			<tr class="cat">
                <td><label for="categoria">Categoría:</label></td>
                @if($errors->any())
                    @if(old('Id_Cat')!='')
                        @foreach($categorias as $categoria)
                            @if($categoria->Id_Cat==old('Id_Cat'))
                            <td>
                                <input type="text" class="busca" id="busca_cat" placeholder="opcional" size="20" maxlength="20" value="{{$categoria->Cat_Des}}" disabled>
                                <button class="cambiar cambiar2">cambiar</button>                                
                            </td>
                            @endif
                        @endforeach
                    @else
                    <td>
                        <input type="text" class="busca" id="busca_cat" placeholder="opcional" size="20" maxlength="20">                        
                        <button class="cambiar">cambiar</button>                        
                    </td>
                    @endif
                @else		
					@if($categorias->count()!=0)
						@php $no=''; @endphp			
						@foreach($categorias as $categoria)
							@if($categoria->Id_Cat==$producto->Id_Cat)
								<td>
									<input type="text" class="busca" placeholder="opcional" id="busca_cat" size="20" maxlength="20" value="{{$categoria->Cat_Des}}" disabled>
									<button class="cambiar cambiar2">cambiar</button>                            
								</td>
								@php $no='false'; @endphp
								@break 
							@else
								@php $no='true'; @endphp
							@endif
						@endforeach			

						@if($no=='true')
							<td>		
								<input type="text" class="busca" id="busca_cat" placeholder="opcional" size="20" maxlength="20">                        
								<button class="cambiar">cambiar</button>
							</td>
						@endif
					@else
						<td>
							<input type="text" id="cat" class="no_hay" placeholder="No hay categorías agregadas" size="25" disabled>																							
						</td>
					@endif
                @endif
            </tr>
                        
            <tr> <!-- cuadro js -->
                <td class="resultado">
                    <div id="categoria"></div>
                </td>
            </tr>   

            <tr class="hidden"><td> <!-- id -->                            
                <input type="hidden" name="Id_Cat" id="id_cat" size="4" maxlength="2" value="{{$producto->Id_Cat}}">                
            </td></tr>			

			<tr>
				<td><label for="impuesto">Impuesto:</label></td>
				<td>
					<select class="seleccion" name="Id_Imp" required>
						@php
							$imp_1 = 1;
							$imp_2 = 2;
							$imp_3 = 3;

							switch($producto->Id_Imp){
								case $imp_1: echo
								   "<option value='$imp_1'>Exentas</option>
									<option value='$imp_2'>IVA 5%</option>
									<option value='$imp_3'>IVA 10%</option>";
									break;
								case $imp_2: echo
								   "<option value='$imp_2'>IVA 5%</option>
									<option value='$imp_3'>IVA 10%</option>
									<option value='$imp_1'>Exentas</option>";
									break;
								case $imp_3: echo
								   "<option value='$imp_3'>IVA 10%</option>
									<option value='$imp_2'>IVA 5%</option>
									<option value='$imp_1'>Exentas</option>";
									break;
							}
						@endphp
					</select>
				</td>
			</tr>			

			<tr>
				<td><label for="p_comp">Precio de compra:</label></td>				
				<td>
					@if($errors->any())						
						<input type="number" name="Art_PreCom" placeholder="obligatorio" min="500" max="1000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{old('Art_PreCom')}}" required>
						@if($errors->has('Art_PreCom'))
						<span class="help-block">{{$errors->first('Art_PreCom')}}</span>						
						@endif
					@else			
						<input type="number" name="Art_PreCom" placeholder="obligatorio" min="500" max="1000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{$producto->Art_PreCom}}" required>
					@endif												
				</td>
			</tr>	

			<tr>
				<td><label for="gan_min">Ganancia mínima:</label></td>				
				<td>
					@if($errors->any())						
						<input type="number" name="Art_GanMin" placeholder="obligatorio" min="500" max="4000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{old('Art_GanMin')}}" required>
						@if($errors->has('Art_GanMin'))
						<span class="help-block">{{$errors->first('Art_GanMin')}}</span>						
						@endif
					@else			
						<input type="number" name="Art_GanMin" placeholder="obligatorio" min="500" max="4000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{$producto->Art_GanMin}}" required>
					@endif												
				</td>
			</tr>			

			<tr>
				<td><label for="p_vent">Precio de venta:</label></td>				
				<td>
					@if($errors->any())						
						<input type="number" name="Art_PreVen" placeholder="obligatorio" min="500" max="5000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{old('Art_PreVen')}}" required>
						@if($errors->has('Art_PreVen'))
						<span class="help-block">{{$errors->first('Art_PreVen')}}</span>						
						@endif
					@else			
						<input type="number" name="Art_PreVen" placeholder="obligatorio" min="500" max="4000000" step="500" onKeyPress="if(this.value.length==7) return false;" value="{{$producto->Art_PreVen}}" required>
					@endif												
				</td>
			</tr>							

			<tr>
				<td><label for="stock">Stock:</label></td>				
				<td>
					@if($errors->any())						
						<input type="number" name="Art_St" placeholder="obligatorio" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" value="{{old('Art_St')}}" required>
						@if($errors->has('Art_St'))
						<span class="help-block">{{$errors->first('Art_St')}}</span>						
						@endif
					@else			
						<input type="number" name="Art_St" placeholder="obligatorio" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" value="{{$producto->Art_St}}" required>
					@endif												
				</td>
			</tr>	

			<tr>
				<td><label for="stock_min">Stock mínimo:</label></td>				
				<td>
					@if($errors->any())						
						<input type="number" name="Art_StMn" placeholder="opcional" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" value="{{old('Art_StMn')}}">						
					@else			
						<input type="number" name="Art_StMn" placeholder="opcional" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" value="{{$producto->Art_StMn}}">	
					@endif												
				</td>
			</tr>	

			<tr>
				<td><label for="stock_max">Stock máximo:</label></td>				
				<td>
					@if($errors->any())						
						<input type="number" name="Art_StMx" placeholder="opcional" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" value="{{old('Art_StMx')}}">						
					@else			
						<input type="number" name="Art_StMx" placeholder="opcional" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" value="{{$producto->Art_StMx}}">	
					@endif												
				</td>
			</tr>									

			<tr class="prov">
                <td><label for="proveedor">Proveedor:</label></td>
                @if($errors->any())
                    @if(old('Id_Prov')!='')
                        @foreach($proveedores as $proveedor)
                            @if($proveedor->Id_Prov==old('Id_Prov'))
                            <td>
                                <input type="text" class="busca" id="busca_prov" placeholder="opcional" size="30" maxlength="30" value="{{$proveedor->Prov_Des}}" disabled>
                                <button class="cambiar cambiar2">cambiar</button>                                
                            </td>
                            @endif
                        @endforeach
                    @else
                    <td>
                        <input type="text" class="busca" id="busca_prov" placeholder="opcional" size="30" maxlength="30">                        
                        <button class="cambiar">cambiar</button>                        
                    </td>
                    @endif
                @else		
					@if($proveedores->count()!=0)
						@php $no=''; @endphp			
						@foreach($proveedores as $proveedor)
							@if($proveedor->Id_Prov==$producto->Id_Prov)
								<td>
									<input type="text" class="busca" placeholder="opcional" id="busca_prov" size="30" maxlength="30" value="{{$proveedor->Prov_Des}}" disabled>
									<button class="cambiar cambiar2">cambiar</button>                            
								</td>
								@php $no='false'; @endphp
								@break 
							@else
								@php $no='true'; @endphp
							@endif
						@endforeach			

						@if($no=='true')
							<td>		
								<input type="text" class="busca" id="busca_prov" placeholder="opcional" size="30" maxlength="30">                        
								<button class="cambiar">cambiar</button>
							</td>
						@endif
					@else
						<td>
							<input type="text" id="prov" class="no_hay" placeholder="No hay proveedores agregados" size="30" disabled>																							
						</td>
					@endif
                @endif
            </tr>
                        
            <tr> <!-- cuadro js -->
                <td class="resultado">
                    <div id="proveedor"></div>
                </td>
            </tr>   

            <tr class="hidden"><td> <!-- id -->                            
                <input type="hidden" name="Id_Prov" id="id_prov" size="4" maxlength="2" value="{{$producto->Id_Prov}}">                
            </td></tr>					

			<tr>
				<td><label for="estado">Estado:</label></td>
				<td>
					@php
						$est_1='Activo';
						$est_2='Inactivo';
					@endphp
					<select class="seleccion" name="Art_Est" minlength="6" maxlength="8" required>
						@if($producto->Art_Est == $est_1)
							<option value="{{$est_1}}">{{$est_1}}</option>
							<option value="{{$est_2}}">{{$est_2}}</option>
						@elseif($producto->Art_Est == $est_2)
							<option value="{{$est_2}}">{{$est_2}}</option>
							<option value="{{$est_1}}">{{$est_1}}</option>
						@endif
					</select>
					@if($errors->has('Art_Est'))
						<span class="help-block">{{$errors->first('Art_Est')}}</span>						
					@endif
				</td>
			</tr>													

			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>										
					@if($errors->any())		
						<textarea name="Art_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{old('Art_Obs')}}</textarea>	
						@if($errors->has('Art_Obs'))
						<br><span class="help-block" id="obs">{{$errors->first('Art_Obs')}}</span>
						@endif
					@else
						<textarea name="Art_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{$producto->Art_Obs}}</textarea>
					@endif
				</td>
			</tr>
		</table>
@endsection
        
@section('navegacion_2')
		<div class="arriba">
			<input class="boton" type="submit" id="actualizar" value="Actualizar">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
		</div>

	<div id="confirm">
		<table>
			<tr><td class="center" colspan="2">Está a punto de eliminar el producto, no lo podrá recuperar</td></tr>
			<tr><td class="center" colspan="2">Desea continuar?</td></tr>
			<tr>
				<td class="right">
				{!! Form::open(['method'=>'DELETE', 'action'=>['ProductosController@destroy', $producto->Id_Art]]) !!}
					{{csrf_field()}}
					<button class="botones confirmar" id="confirmar" type="submit" onclick="
						$('#busca_prov').attr('disabled',false);
						$('#busca_cat').attr('disabled',false);
					">Confirmar</button>
				{!! Form::close() !!}
				</td>
				<td class="left"><button class="botones cancelar" id="c_cancelar">Cancelar</button></td>
			</tr>
		</table>
	</div>
@endsection

<script src="{{asset('js/vistas/create_edit/material.js')}}"></script>
<script src="{{asset('js/vistas/create_edit/producto.js')}}"></script>