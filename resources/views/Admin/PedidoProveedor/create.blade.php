@extends('Admin.lay.Create')

<link href="{{asset('css/vistas/pedido_proveedor.css')}}" rel="stylesheet">

<style>
	.der{
		text-align:right;
	}
	.art{
		text-align:center;
	}	
</style>

@section('titulo')
    Registrar Pedido
@endsection

@section('contenido')
	@include('Admin.PedidoProveedor.session_div.create')
	<table id="principal">
		<tr class="masiva">
			<td>
				<label for="masiva">Inserción masiva</label>
				<input type="checkbox" id="masiva">
			</td>
		</tr>

	{!! Form::open(['id' => 'pedprov_form', 'url'=>'/PedidoProveedor', 'method'=>'post', 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		{{csrf_field()}}	
				
			@if($proveedores->count()>0)				
				<tr class="prov">
					<td><label for="proveedor">Proveedor:</label></td>
                    @if(old('Id_Prov')!='')
                        @foreach($proveedores as $proveedor)
                            @if($proveedor->Id_Prov==old('Id_Prov'))
                            <td>
                                <input type="text" class="busca" id="busca_prov" size="30" maxlength="30" value="{{$proveedor->Prov_Des}}" disabled>
								<button class="cambiar cambiar2">cambiar</button>                                

								<span class="error error_prov"></span> <!-- ajax -->
								@if($errors->has('Id_Prov'))<span class="help-block">{{$errors->first('Id_Prov')}}</span>@endif
                            </td>
                            @endif
                        @endforeach
                    @else
                    <td>
                        <input type="text" class="busca primer" id="busca_prov" size="30" maxlength="30" placeholder="obligatorio" required autofocus>                        
						<button class="cambiar">cambiar</button> 
						
						@if($errors->has('Id_Prov'))<span class="help-block">{{$errors->first('Id_Prov')}}</span>@endif
						<span class="error error_prov"></span>                       
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
				<td><label for="cantidad">Fecha de entrega:</label></td>
				<td>
					<input type="date" name="PedProv_FeEnt" id="fe_ent" placeholder="obligatorio" value="{{old('PedProv_FeEnt')}}" required>
					<span class="error error_fe"></span> <!-- ajax -->
					@if($errors->has('PedProv_FeEnt'))<span class="help-block">{{$errors->first('PedProv_FeEnt')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="condicion">Condición de pago:</label></td>				
				<td>
					<select class="seleccion" name="PedProv_ConPag" id="cond_pag" min="7" max="7" required> 
						<option value="Contado">Contado</option>						
					</select>
					<span class="error error_conpag"></span> <!-- ajax -->
					@if($errors->has('PedProv_ConPag'))<span class="help-block">{{$errors->first('PedProv_ConPag')}}</span>@endif
				</td>
			</tr>		
			
			<tr>
				<td><label for="med_pag">Medio de pago:</label></td>				
				<td>
					<!-- <select class="seleccion" name="PedProv_MedPag" id="med_pag" min="8" max="8" required> 
						<option value="Efectivo">Efectivo</option>						
					</select> -->
					<select name="Id_MedPag" class="seleccion" minlength="1" maxlength="2" min="1" value="{{old('Id_MedPag')}}" required>
                        @foreach($med_pag as $medio)
                        <option value="{{$medio->Id_MedPag}}">{{$medio->MedPag_Des}}</option>
                        @endforeach
                        <!-- <option value="2">2</option> -->
                    </select>
					<span class="error error_medpag"></span> <!-- ajax -->
					@if($errors->has('Id_MedPag'))<span class="help-block">{{$errors->first('Id_MedPag')}}</span>@endif
				</td>
			</tr>			

			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>
					<textarea rows="4" cols="50" name="PedProv_Obs" id="obs" placeholder="opcional" maxlength="140">{{old('PedProv_Obs')}}</textarea>
					<br><span class="error error_obs top" id="obs"></span>					
					@if($errors->has('PedProv_Obs'))<br><span class="help-block top" id="obs">{{$errors->first('PedProv_Obs')}}</span>@endif
				</td>
			</tr>						
		</table>
		
		<!-- Detalle -->
		<h3 id="detalle">Detalle</h3>

		<table id="busc_art">			
			@if($materiales->count()>0)				
				<tr class="mat">
					<td><label for="material">Buscar artículo:</label></td>                    
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
						<input type="text" id="mat" class="no_hay" placeholder="No hay artículos agregados" size="35" disabled>																							
					</td>
				</tr>			
			@endif			
		</table>			

		<table id="tabla_articulo">
			<tr>												
				@if($errors->has('Id_Art_1'))
					<td id="aviso" class="help-block" colspan="3">Es obligatario al menos un artículo para continuar</td>							
					<script>
						window.addEventListener("load", function(){
							$( "#busca_prov" ).prop( "disabled", false );
						});
					</script>
				@elseif($errors->has('Art_Cant_1'))
					<td id="aviso" class="help-block" colspan="3">Error en la cantidad de artículo</td>							
				@else
					<td id="aviso" class="help-block" colspan="3">&nbsp;</td>
				@endif
			</tr>

			<tr class="head">
				<td>Id Art</td>				
				<td>Descripción</td>
				<td>Precio</td>
				<td>Existencia</td>
				<td style="border-right: 1px solid lightgrey;">Cantidad</td>									
				<!-- <td class="blank">&nbsp;</td> -->
				<td style="display:none"><input type="hidden" id="tipo" disabled></td>
			</tr>
			
			<tr class="agregar">
				<td><input type="text" id="id_art" size="4" disabled></td>				
				<td><input type="text" id="art_des" size="35" disabled></td>
				<td><input type="text" id="art_pre" size="7" disabled></td>
				<td><input type="text" id="art_st" size="4" disabled></td>										
				<td>
					<input type="number" id="art_cant" min="0.5"  max="9999" step="0.5" style="width:86px;" onKeyPress="if(this.value.length==4) return false;">
					<input type="text" id="art_med" size="16" disabled style="margin-left: -3px !important;">
				</td>														
				<td class="td_agregar"><button class="botones" id="agregar">agregar</button></td>                    
			</tr>
		</table>
				
		<table class="detalle">
			<tr class="head">
				<td>Id Art</td>				
				<td>Descripción</td>					
				<td>Precio</td>	
				<td>Cantidad</td>					
				<td>Importe</td>					
				<td class="blank">&nbsp;</td>					
			</tr>
			
			<tr class="linea linea_1">
				<td><input type="text" id="art_id_1" name="Id_Art_1" class="art" size="4" required disabled></td>
				<td><input type="text" class="des" id="des_art_1" size="35" required disabled></td>
				<td><input type="text" class="der" id="pre_1" size="6" required disabled></td>
				<td>
					<input type="text" class="der" id="cant_art_1" name="Art_Cant_1" size="3" required disabled>
					<input type="text" id="unmed_art_1" size="17" class="unimed" disabled>
				</td>
				<td><input type="text" class="der" id="imp_1" size="6" required disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_1">quitar</button></td>
			</tr>					

			<tr class="linea linea_2">
				<td><input type="text" id="art_id_2" name="Id_Art_2" class="art" size="4" disabled></td>
				<td><input type="text" class="des" id="des_art_2" size="35" disabled></td>
				<td><input type="text" class="der" id="pre_2" size="6" disabled></td>
				<td>
					<input type="text" class="der" id="cant_art_2" name="Art_Cant_2" size="3" disabled>
					<input type="text" id="unmed_art_2" size="17" class="unimed" disabled>
				</td>
				<td><input type="text" class="der" id="imp_2" size="6" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_2">quitar</button></td>
			</tr>	

			<tr class="linea linea_3">
				<td><input type="text" id="art_id_3" name="Id_Art_3" class="art" size="4" disabled></td>
				<td><input type="text" class="des" id="des_art_3" size="35" disabled></td>
				<td><input type="text" class="der" id="pre_3" size="6" disabled></td>
				<td>
					<input type="text" class="der" id="cant_art_3" name="Art_Cant_3" size="3" disabled>
					<input type="text" id="unmed_art_3" size="17" class="unimed" disabled>
				</td>
				<td><input type="text" class="der" id="imp_3" size="6" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_3">quitar</button></td>
			</tr>																		

			<tr class="linea linea_4">
				<td><input type="text" id="art_id_4" name="Id_Art_4" class="art" size="4" disabled></td>
				<td><input type="text" class="des" id="des_art_4" size="35" disabled></td>
				<td><input type="text" class="der" id="pre_4" size="6" disabled></td>
				<td>
					<input type="text" class="der" id="cant_art_4" name="Art_Cant_4" size="3" disabled>
					<input type="text" id="unmed_art_4" size="17" class="unimed" disabled>
				</td>
				<td><input type="text" class="der" id="imp_4" size="6" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_4">quitar</button></td>
			</tr>	

			<tr class="linea linea_5">
				<td><input type="text" id="art_id_5" name="Id_Art_5" class="art" size="4" disabled></td>
				<td><input type="text" class="des" id="des_art_5" size="35" disabled></td>
				<td><input type="text" class="der" id="pre_5" size="6" disabled></td>
				<td>
					<input type="text" class="der" id="cant_art_5" name="Art_Cant_5" size="3" disabled>
					<input type="text" id="unmed_art_5" size="17" class="unimed" disabled>
				</td>
				<td><input type="text" class="der" id="imp_5" size="6" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_5">quitar</button></td>
			</tr>	

			<tr class="linea linea_6">
				<td><input type="text" id="art_id_6" name="Id_Art_6" class="art" size="4" disabled></td>
				<td><input type="text" class="des" id="des_art_6" size="35" disabled></td>
				<td><input type="text" class="der" id="pre_6" size="6" disabled></td>
				<td>
					<input type="text" class="der" id="cant_art_6" name="Art_Cant_6" size="3" disabled>
					<input type="text" id="unmed_art_6" size="17" class="unimed" disabled>
				</td>
				<td><input type="text" class="der" id="imp_6" size="6" disabled></td>
				<td class="td_quitar"><button class="botones quitar" class="unimed" id="quitar_6">quitar</button></td>
			</tr>	

			<tr class="linea linea_7">
				<td><input type="text" id="art_id_7" name="Id_Art_7" class="art" size="4" disabled></td>
				<td><input type="text" class="des" id="des_art_7" size="35" disabled></td>
				<td><input type="text" class="der" id="pre_7" size="6" disabled></td>
				<td>
					<input type="text" class="der" id="cant_art_7" name="Art_Cant_7" size="3" disabled>
					<input type="text" id="unmed_art_7" size="17" class="unimed" disabled>
				</td>
				<td><input type="text" class="der" id="imp_7" size="6" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_7">quitar</button></td>
			</tr>	

			<tr class="linea linea_8">
				<td><input type="text" id="art_id_8" name="Id_Art_8" class="art" size="4" disabled></td>
				<td><input type="text" id="des_art_8" size="35" disabled></td>
				<td><input type="text" class="der" id="pre_8" size="6" disabled></td>
				<td>
					<input type="text" class="der" id="cant_art_8" name="Art_Cant_8" size="3" disabled>
					<input type="text" id="unmed_art_8" size="17" class="unimed" disabled>
				</td>
				<td><input type="text" class="der" id="imp_8" size="6" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_8">quitar</button></td>
			</tr>			

			<tr class="blank">
				<td colspan="3"></td>
				<td colspan="2">Total: <input type="text" id="total" size="7" style="text-align:right !important" disabled> Gs.</td>				
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
			<input class="boton" type="submit" id="registrar" value="Registrar">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="{{url('PedidoProveedor')}}"><button class="boton lista" id="volver">Volver</button></a>
			<a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>			
		</div>
@endsection

<script src="{{asset('js/vistas/detalle/ped_prov.js')}}"></script>
<script src="{{asset('js/vistas/detalle/pedprov_detalle.js')}}"></script>
<script src="{{asset('js/vistas/masiva/pedido_proveedor.js')}}"></script>