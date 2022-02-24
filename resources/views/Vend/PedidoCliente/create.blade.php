@extends('Vend.lay.Create')

<link href="{{asset('css/vistas/pedido_proveedor.css')}}" rel="stylesheet">
<style>
	#clientes{
		top:152px !important;
		left:372px !important;
		width:288px !important;
	}
	#producto{
		top:606px !important;
		left:366px !important;	
		width:288px !important;
	}

	.cli_cat,.cli_desc,.id,.lp{
		display:none;
	}		
	
	.art,.may{
		text-align:center;
	}
	.der{
		text-align:right;
	}
</style>

@section('titulo')
    Registrar Pedido
@endsection

@section('contenido')	
	{!! Form::open(['id' => 'pedcli_form', 'url'=>'/PedidoCliente', 'method'=>'post', 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		{{csrf_field()}}	
		<table id="principal">							
			@if($clientes->count()>0)				
				<tr class="cli">
					<td><label for="cliente">Cliente:</label></td>
                    @if(old('Id_Cli')!='')
                        @foreach($clientes as $cliente)
                            @if($cliente->Id_Cli==old('Id_Cli'))
                            <td>
                                <input type="text" class="busca" id="busca_cli" size="35" maxlength="40" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled>
								<button class="cambiar cambiar2">cambiar</button>                                								
								@if($errors->has('Id_Cli'))<span class="help-block">{{$errors->first('Id_Cli')}}</span>@endif
                            </td>
                            @endif
                        @endforeach
                    @else
                    <td>
                        <input type="text" class="busca primer" id="busca_cli" size="35" maxlength="40" placeholder="obligatorio" required autofocus>                        
						<button class="cambiar">cambiar</button> 
						
						@if($errors->has('Id_Cli'))<span class="help-block">{{$errors->first('Id_Cli')}}</span>@endif
                    </td>
					@endif					
                </tr>
                
                <tr>
                    <td class="resultado"> <!-- cuadro js -->
                        <div id="cliente"></div>
                    </td>
                </tr>                
                
                <tr class="hidden"><td> <!-- id -->
                    <input type="hidden" name="Id_Cli" id="id_cli" size="4" minlength="1" maxlength="4" min="1" value="{{old('Id_Cli')}}">
                </td></tr>
			@else
				<tr>
					<td><label for="cliente">Cliente:</label></td>				
					<td>
						<input type="text" id="cli" class="no_hay" placeholder="No hay clientes agregados" size="30" disabled>																							
					</td>
				</tr>			
			@endif
			
			<tr class="cli_cat"> 
				<td><label for="cli_cat">Categoría:</label></td>
				<td><input type="text" id="cli_cat" name="PedCli_CliLp" size="15" disabled></td>
			</tr>			

			<tr class="cli_desc"> 
				<td><label for="cli_desc">Descuento:</label></td>
				<td><input type="text" id="cli_desc" name="PedCli_CliDesc" size="3" disabled></td>
			</tr>

			<tr> 
				<td><label for="tip">Tipo:</label></td>
				<td>
					<select name="PedCli_Tip" class="seleccion" minlength="9" maxlength="9" value="{{old('PedCli_Tip')}}" required><!-- size="9" --> <!-- val si list no --> 					
						<option value="Minorista">Minorista</option>		
						<option value="Mayorista">Mayorista</option>					
					</select>	
				</td>
			</tr>		

			<tr>
				<td><label for="fe_ent">Fecha de entrega:</label></td>
				<td>
					<input type="date" name="PedCli_FeEnt" id="fe_ent" placeholder="obligatorio" value="{{old('PedCli_FeEnt')}}" required>					
					@if($errors->has('PedCli_FeEnt'))<span class="help-block">{{$errors->first('PedCli_FeEnt')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="condicion">Condición:</label></td>				
				<td>
					<select class="seleccion" name="PedCli_CondCob" id="cond_cob" min="7" max="7" required> 
						<option value="Contado">Contado</option>						
					</select>					
					@if($errors->has('PedCli_CondCob'))<span class="help-block">{{$errors->first('PedCli_CondCob')}}</span>@endif
				</td>
			</tr>		
			
			<tr>
				<td><label for="med_cob">Medio de cobro:</label></td>				
				<td>
					<select name="Id_MedPag" class="seleccion" minlength="1" maxlength="2" min="1" value="{{old('Id_MedCob')}}" required>
                        @foreach($med_pag as $medio)
                        <option value="{{$medio->Id_MedPag}}">{{$medio->MedPag_Des}}</option>
                        @endforeach                        
                    </select>					
					@if($errors->has('Id_MedPag'))<span class="help-block">{{$errors->first('Id_MedPag')}}</span>@endif
				</td>
			</tr>			

			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>
					<textarea rows="4" cols="50" name="PedCli_Obs" id="obs" placeholder="opcional" maxlength="140">{{old('PedCli_Obs')}}</textarea>								
					@if($errors->has('PedCli_Obs'))<br><span class="help-block top" id="obs">{{$errors->first('PedCli_Obs')}}</span>@endif
				</td>
			</tr>						
		</table>
		
		<!-- Detalle -->
		<h3 id="detalle">Detalle</h3>

		<table id="busc_art">			
			@if($productos->count()>0)				
				<tr class="prod">
					<td><label for="producto">Buscar producto:</label></td>                    
                    <td>
                        <input type="text" class="busca" id="busca_producto" size="35" maxlength="35" disabled>                        
						<button class="cambiar cambiar2">cambiar</button>             						
                    </td>                    
                </tr>
                
                <tr>
                    <td class="resultado"> <!-- cuadro js -->
                        <div id="productos"></div>
                    </td>
                </tr>                                                
			@else
				<tr>
					<td><label for="producto">Buscar</label></td>				
					<td>
						<input type="text" id="prod" class="no_hay" placeholder="No hay productos agregados" size="35" disabled>																							
					</td>
				</tr>			
			@endif			
		</table>			

		<table id="tabla_articulo">
			<tr>												
				@if($errors->has('Id_Art_1'))
					<td id="aviso" class="help-block" colspan="3">Es obligatario al menos un producto para continuar</td>							
					<script>
						window.addEventListener("load", function(){
							$( "#busca_cli" ).prop( "disabled", false ).val('').focus();
						});
					</script>
				@elseif($errors->has('Art_Cant_1'))
					<td id="aviso" class="help-block" colspan="3">Error en la cantidad de producto</td>							
				@else
					<td id="aviso" class="help-block" colspan="3">&nbsp;</td>
				@endif
			</tr>

			<tr class="head">
				<td>Id Art</td>				
				<td>Descripción</td>
				<td>Precio</td>
				<td>Stock</td>
				<td style="border-right: 1px solid lightgrey;">Cantidad</td>									
				<td class="blank">&nbsp;</td>
			</tr>
			
			<tr class="agregar">
				<td><input type="text" id="id_art" size="4" disabled></td>				
				<td><input type="text" id="art_des" size="35" disabled></td>
				<td><input type="text" id="art_pre" size="7" disabled></td>
				<td><input type="text" id="art_st" size="4" disabled></td>										
				<td><input type="number" id="art_cant" min="1"  max="9999" style="width:86px;" onKeyPress="if(this.value.length==4) return false;"></td>														
				<td class="td_agregar"><button class="botones" id="agregar">agregar</button></td>                    
			</tr>
		</table>
				
		<table class="detalle">
			<tr class="head">
				<td>Id Art</td>				
				<td>Descripción</td>					
				<td>Precio</td>	
				<td>Cantidad</td>									
				<td>Mayorista</td>							
				<td>Importe</td>					
				<td class="blank">&nbsp;</td>					
			</tr>
			
			<tr class="linea linea_1">
				<td><input type="text" id="art_id_1" name="Id_Art_1" class="art" size="4" required disabled></td>
				<td><input type="text" id="des_art_1" size="35" required disabled></td>
				<td><input type="text" id="pre_1" size="7" class="der" required disabled></td>
				<td><input type="text" id="cant_art_1" name="Art_Cant_1" size="3" class="der" required disabled></td>
				<td style="border-right: 0.1px solid lightgray !important;"><input type="text" id="may_1" class="may" size="3" disabled></td>				
				<td style="border: none !important;"><input type="text" id="imp_1" size="7" class="der" required disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_1">quitar</button></td>
			</tr>					

			<tr class="linea linea_2">
				<td><input type="text" id="art_id_2" name="Id_Art_2" class="art" size="4" disabled></td>
				<td><input type="text" id="des_art_2" size="35" disabled></td>
				<td><input type="text" id="pre_2" size="7" class="der" disabled></td>
				<td><input type="text" id="cant_art_2" name="Art_Cant_2" size="3" class="der" disabled></td>
				<td style="border-right: 0.1px solid lightgray !important;"><input type="text" id="may_2" class="may" size="3" disabled></td>			
				<td style="border: none !important;"><input type="text" id="imp_2" size="7" class="der" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_2">quitar</button></td>
			</tr>	

			<tr class="linea linea_3">
				<td><input type="text" id="art_id_3" name="Id_Art_3" class="art" size="4" disabled></td>
				<td><input type="text" id="des_art_3" size="35" disabled></td>
				<td><input type="text" id="pre_3" size="7" class="der" disabled></td>
				<td><input type="text" id="cant_art_3" name="Art_Cant_3" size="3" class="der" disabled></td>
				<td style="border-right: 0.1px solid lightgray !important;"><input type="text" id="may_3" class="may" size="3" disabled></td>
				<td style="border: none !important;"><input type="text" id="imp_3" size="7" class="der" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_3">quitar</button></td>
			</tr>																		

			<tr class="linea linea_4">
				<td><input type="text" id="art_id_4" name="Id_Art_4" class="art" size="4" disabled></td>
				<td><input type="text" id="des_art_4" size="35" disabled></td>
				<td><input type="text" id="pre_4" size="7" class="der" disabled></td>
				<td><input type="text" id="cant_art_4" name="Art_Cant_4" size="3" class="der" disabled></td>
				<td style="border-right: 0.1px solid lightgray !important;"><input type="text" id="may_4" class="may" size="3" disabled></td>
				<td style="border: none !important;"><input type="text" id="imp_4" size="7" class="der" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_4">quitar</button></td>
			</tr>	

			<tr class="linea linea_5">
				<td><input type="text" id="art_id_5" name="Id_Art_5" class="art" size="4" disabled></td>
				<td><input type="text" id="des_art_5" size="35" disabled></td>
				<td><input type="text" id="pre_5" size="7" class="der" disabled></td>
				<td><input type="text" id="cant_art_5" name="Art_Cant_5" size="3" class="der" disabled></td>
				<td style="border-right: 0.1px solid lightgray !important;"><input type="text" id="may_5" class="may" size="3" disabled></td>
				<td style="border: none !important;"><input type="text" id="imp_5" size="7" class="der" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_5">quitar</button></td>
			</tr>	

			<tr class="linea linea_6">
				<td><input type="text" id="art_id_6" name="Id_Art_6" class="art" size="4" disabled></td>
				<td><input type="text" id="des_art_6" size="35" disabled></td>
				<td><input type="text" id="pre_6" size="7" class="der" disabled></td>
				<td><input type="text" id="cant_art_6" name="Art_Cant_6" size="3" class="der" disabled></td>
				<td style="border-right: 0.1px solid lightgray !important;"><input type="text" id="may_6" class="may" size="3" disabled></td>
				<td style="border: none !important;"><input type="text" id="imp_6" size="7" class="der" disabled></td>
				<td class="td_quitar"><button class="botones quitar" class="unimed" id="quitar_6">quitar</button></td>
			</tr>	

			<tr class="linea linea_7">
				<td><input type="text" id="art_id_7" name="Id_Art_7" class="art" size="4" disabled></td>
				<td><input type="text" id="des_art_7" size="35" disabled></td>
				<td><input type="text" id="pre_7" size="7" class="der" disabled></td>
				<td><input type="text" id="cant_art_7" name="Art_Cant_7" size="3" class="der" disabled></td>
				<td style="border-right: 0.1px solid lightgray !important;"><input type="text" id="may_7" class="may" size="3" disabled></td>
				<td style="border: none !important;"><input type="text" id="imp_7" size="7" class="der" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_7">quitar</button></td>
			</tr>	

			<tr class="linea linea_8">
				<td><input type="text" id="art_id_8" name="Id_Art_8" class="art" size="4" disabled></td>
				<td><input type="text" id="des_art_8" size="35" disabled></td>
				<td><input type="text" id="pre_8" size="7" class="der" disabled></td>
				<td><input type="text" id="cant_art_8" name="Art_Cant_8" size="3" class="der" disabled></td>
				<td style="border-right: 0.1px solid lightgray !important;"><input type="text" id="may_8" class="may" size="3" disabled></td>
				<td style="border: none !important;"><input type="text" id="imp_8" size="7" class="der" disabled></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_8">quitar</button></td>
			</tr>				

			<tr class="blank">
				<td colspan="4"></td>
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
			<!-- <input class="boton" type="submit" id="registrar" value="Registrar"> -->
			<input class="boton" type="submit" id="registrar" value="Registrar" onclick="
			// event.preventDefault();
            // if($('#art_id_1').val()!=''){                
            //     $('#pedcli_form').submit();
            // }

			event.preventDefault();

			$('#cli_cat').prop('disabled',false);
			$('#cli_desc').prop('disabled',false);

			$('#pedcli_form').submit();
			">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="{{url('PedidoCliente')}}"><button class="boton lista" id="volver">Volver</button></a>
			<a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>			
		</div>
@endsection

<script src="{{asset('js/vistas/detalle/ped_cli.js')}}"></script>
<script src="{{asset('js/vistas/detalle/pedcli_det.js')}}"></script>