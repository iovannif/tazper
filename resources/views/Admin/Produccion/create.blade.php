@extends('Admin.lay.Create')

<link href="{{asset('css/vistas/create_produccion.css')}}" rel="stylesheet">

@section('titulo')
    Agregar Producción
@endsection

@section('contenido')
	@include('Admin.Produccion.session_div.create')
	<table id="principal">
		<tr class="masiva">
			<td>
				<label for="masiva">Inserción masiva</label>
				<input type="checkbox" id="masiva">
			</td>
		</tr>

	{!! Form::open(['id' => 'pdc_form', 'url'=>'/Produccion', 'method'=>'post', 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		{{csrf_field()}}	
				
			@if($productos->count()>0)				
				<tr class="prod">
					<td><label for="producto">Producto:</label></td>
                    @if(old('Id_Prod')!='')
                        @foreach($productos as $producto)
                            @if($producto->Id_Art==old('Id_Prod'))
                            <td>
                                <input type="text" class="busca" id="busca_prod" size="35" maxlength="35" value="{{$producto->Art_DesLar}}" disabled autofocus>
								<button class="cambiar cambiar2 cam_prod">cambiar</button>   
								<span class="error error_prod"></span> <!-- ajax -->

								@if($errors->has('Id_Prod'))<span class="help-block">{{$errors->first('Id_Prod')}}</span>@endif                                 
                            </td>
                            @endif
                        @endforeach
                    @else
                    <td>
                        <input type="text" class="busca primer" id="busca_prod" size="35" maxlength="35" placeholder="obligatorio" autofocus required>                        
						<button class="cambiar cam_prod">cambiar</button>   
						<span class="error error_prod"></span> <!-- ajax -->

						@if($errors->has('Id_Prod'))<span class="help-block">{{$errors->first('Id_Prod')}}</span>@endif                         
                    </td>
                    @endif
                </tr>
                
                <tr>
                    <td class="resultado"> <!-- cuadro js -->
                        <div id="producto"></div>
                    </td>
                </tr>                
                
                <tr class="hidden"><td> <!-- id -->
                    <input type="hidden" name="Id_Prod" id="id_prod" size="4" maxlength="4" value="{{old('Id_Prod')}}"> <!-- pone des -->
                </td></tr>
			@else
				<tr>
					<td><label for="Producto">Producto:</label></td>				
					<td>
						<input type="text" id="prod" class="no_hay" placeholder="No hay productos agregados" size="35" disabled>																							
					</td>
				</tr>			
			@endif

			<tr>
				<td><label for="cantidad">Cantidad:</label></td>
				<td>
					<input type="number" name="Pdc_Cant" id="cant" placeholder="obligatorio" min="1" max="9999" step="1.0" value="{{old('Pdc_Cant')}}" onKeyPress="if(this.value.length==4) return false;" required>
					<span class="error error_cant"></span> <!-- ajax -->
					@if($errors->has('Pdc_Cant'))<span class="help-block">{{$errors->first('Pdc_Cant')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="concepto">Concepto:</label></td>				
				<td>
					<select class="seleccion" name="Pdc_Con" id="pdc_conc" min="5" max="6" required> 
						<option value="Stock">Stock</option>
						<option value="Pedido">Pedido</option>
					</select>
					<span class="error error_con"></span> <!-- ajax -->
					@if($errors->has('Pdc_Con'))<span class="help-block">{{$errors->first('Pdc_Con')}}</span>@endif
				</td>
			</tr>		

			<input type="hidden" name="Pdc_Est" id="pdc_est" value="Proceso">	
			<!-- <span class="error error_est"></span> ajax -->

			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>
					<textarea rows="4" cols="50" name="Pdc_Obs" id="obs" placeholder="opcional" maxlength="140">{{old('Pdc_Obs')}}</textarea>
					<br><span class="error error_obs top" id="obs"></span>					
					@if($errors->has('Pdc_Obs'))<br><span class="help-block top" id="obs">{{$errors->first('Pdc_Obs')}}</span>@endif
				</td>
			</tr>						
		</table>
		
		<!-- Detalle -->
		<h3 id="detalle">Materiales</h3>

		<table id="busc_art">			
			@if($materiales->count()>0)				
				<tr class="mat">
					<td><label for="material">Buscar</label></td>                    
                    <td>
                        <input type="text" class="busca" id="busca_material" size="35" maxlength="35">                        
						<button class="cambiar cambiar2">cambiar</button>             						
                    </td>                    
                </tr>
                
                <tr>
                    <td class="resultado"> <!-- cuadro js -->
                        <div id="materiales"></div>
                    </td>
                </tr>                                                
			@else
				<tr>
					<td><label for="material">Buscar</label></td>				
					<td>
						<input type="text" id="mat" class="no_hay" placeholder="No hay materiales agregados" size="35" disabled>																							
					</td>
				</tr>			
			@endif

			<!-- <tr>
				<td class="resultado"> cuadro js
					<div id="materiales"></div>
				</td>
			</tr> -->
		</table>			

		<table id="tabla_articulo">
			<tr>												
				@if($errors->has('Id_Art_1'))
					<td id="aviso" class="help-block" colspan="3">Es obligatario al menos un material para continuar</td>							
				@elseif($errors->has('Art_Cant_1'))
					<td id="aviso" class="help-block" colspan="3">Error en la cantidad de material</td>							
				@else
					<td id="aviso" class="help-block" colspan="3">&nbsp;</td>
				@endif
			</tr>

			<tr class="head">
				<td>Id Art</td>
				<td>Id Mat</td>
				<td>Descripción</td>
				<td>Precio</td>
				<td>Existencia</td>
				<td style="border-right: 1px solid lightgrey;">Cantidad</td>									
				<td class="blank">&nbsp;</td>
			</tr>
			
			<tr class="agregar">
				<td><input type="text" id="id_art" size="4" disabled></td>
				<td><input type="text" id="id_mat" size="4" disabled></td>
				<td><input type="text" id="art_des" size="35" disabled></td>
				<td><input type="text" id="art_pre" size="7" disabled></td>
				<td><input type="text" id="art_st" size="4" disabled></td>										
				<td>
					<input type="number" id="art_cant" min="0.5"  max="9999" step="0.5" style="width:86px;" onKeyPress="if(this.value.length==4) return false;">
					<input type="text" id="art_med" size="16" disabled>
				</td>										
				<td class="td_agregar"><button class="botones" id="agregar">agregar</button></td>                    
			</tr>
		</table>
				
		<table class="detalle">
			<tr class="head">
				<td>Id Art</td>
				<td>Id Mat</td>
				<td>Descripción</td>					
				<td>Cantidad</td>					
				<td class="blank">&nbsp;</td>					
			</tr>
			
			<tr class="linea linea_1">
				<td><input type="text" id="art_id_1" name="Id_Art_1" class="art" size="4" required disabled></td>
				<td><input type="text" id="mat_id_1" size="4" disabled></td>
				<td><input type="text" id="des_art_1" size="35" required disabled></td>
				<td>
					<input type="text" id="cant_art_1" name="Art_Cant_1" size="3" required disabled>
					<input type="text" id="unmed_art_1" size="17" disabled>
				</td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_1">quitar</button></td>
			</tr>					

			<tr class="linea linea_2">
				<td><input type="text" id="art_id_2" name="Id_Art_2" class="art" size="4" disabled></td>
				<td><input type="text" id="mat_id_2" size="4" disabled></td>
				<td><input type="text" id="des_art_2" size="35" disabled></td>
				<td>
					<input type="text" id="cant_art_2" name="Art_Cant_2" size="3" disabled>
					<input type="text" id="unmed_art_2" size="17" disabled>
				</td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_2">quitar</button></td>
			</tr>	

			<tr class="linea linea_3">
				<td><input type="text" id="art_id_3" name="Id_Art_3" class="art" size="4" disabled></td>
				<td><input type="text" id="mat_id_3" size="4" disabled></td>
				<td><input type="text" id="des_art_3" size="35" disabled></td>
				<td>
					<input type="text" id="cant_art_3" name="Art_Cant_3" size="3" disabled>
					<input type="text" id="unmed_art_3" size="17" disabled>
				</td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_3">quitar</button></td>
			</tr>																		

			<tr class="linea linea_4">
				<td><input type="text" id="art_id_4" name="Id_Art_4" class="art" size="4" disabled></td>
				<td><input type="text" id="mat_id_4" size="4" disabled></td>
				<td><input type="text" id="des_art_4" size="35" disabled></td>
				<td>
					<input type="text" id="cant_art_4" name="Art_Cant_4" size="3" disabled>
					<input type="text" id="unmed_art_4" size="17" disabled>
				</td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_4">quitar</button></td>
			</tr>	

			<tr class="linea linea_5">
				<td><input type="text" id="art_id_5" name="Id_Art_5" class="art" size="4" disabled></td>
				<td><input type="text" id="mat_id_5" size="4" disabled></td>
				<td><input type="text" id="des_art_5" size="35" disabled></td>
				<td>
					<input type="text" id="cant_art_5" name="Art_Cant_5" size="3" disabled>
					<input type="text" id="unmed_art_5" size="17" disabled>
				</td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_5">quitar</button></td>
			</tr>	

			<tr class="linea linea_6">
				<td><input type="text" id="art_id_6" name="Id_Art_6" class="art" size="4" disabled></td>
				<td><input type="text" id="mat_id_6" size="4" disabled></td>
				<td><input type="text" id="des_art_6" size="35" disabled></td>
				<td>
					<input type="text" id="cant_art_6" name="Art_Cant_6" size="3" disabled>
					<input type="text" id="unmed_art_6" size="17" disabled>
				</td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_6">quitar</button></td>
			</tr>	

			<tr class="linea linea_7">
				<td><input type="text" id="art_id_7" name="Id_Art_7" class="art" size="4" disabled></td>
				<td><input type="text" id="mat_id_7" size="4" disabled></td>
				<td><input type="text" id="des_art_7" size="35" disabled></td>
				<td>
					<input type="text" id="cant_art_7" name="Art_Cant_7" size="3" disabled>
					<input type="text" id="unmed_art_7" size="17" disabled>
				</td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_7">quitar</button></td>
			</tr>	

			<tr class="linea linea_8">
				<td><input type="text" id="art_id_8" name="Id_Art_8" class="art" size="4" disabled></td>
				<td><input type="text" id="mat_id_8" size="4" disabled></td>
				<td><input type="text" id="des_art_8" size="35" disabled></td>
				<td>
					<input type="text" id="cant_art_8" name="Art_Cant_8" size="3" disabled>
					<input type="text" id="unmed_art_8" size="17" disabled>
				</td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_8">quitar</button></td>
			</tr>			
		</table>		

		@if($errors->any())		
			<script>
				window.addEventListener("load", function(){
				$('.detalle input').prop('disabled',true);
				});
			</script>
		@endif
@endsection
        
@section('navegacion_2')
		<div class="arriba">
			<input class="boton" type="submit" id="registrar" value="Registrar" onclick=" // $('.detalle input').prop('disabled',false);				
				$('#pdc_form').submit(function(){
					$('.detalle input').prop('disabled',false); // alert('Submitted');
				});
			">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="{{url('Produccion')}}"><button class="boton lista" id="volver">Volver</button></a>
			<a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
			<!-- <a href="#"><button class="boton" id="masivo">Agregado masivo</button></a> -->
		</div>
@endsection

<!-- scripts -->
<script>
    window.productos=[];
</script>

@foreach($productos as $item)
    <script>        
        window.productos.push(<?php echo $item->Id_Art ?>);        
    </script>
@endforeach

<script src="{{asset('js/vistas/detalle/produccion.js')}}"></script>
<script src="{{asset('js/vistas/detalle/produccion_detalle.js')}}"></script>
<script src="{{asset('js/vistas/masiva/produccion.js')}}"></script>