@extends('Admin.lay.Edit')

<style>
    #content{
        margin-bottom:14px !important;
    }        

	input[name=Art_St]::-webkit-input-placeholder{ /* Chrome/Opera/Safari */        
        font-size: 14px;
    }

	.lista_js{
		left: 349px !important;
    	top: 461px !important;
		width:253px !important;
	}

    .cambiar2{
        display:inline !important;
    }
</style>

@section('titulo')
    Editar Materiales
@endsection

@section('navegacion_1')
	<div id="este">
		<button class="boton eliminar primer" id="borrar" onclick="
			<?php 
			// $materiales=0;
			if($produccion>0 || $pedidos>0 || $compras>0){ ?>;
				$('#rechazo').show().delay(1500).fadeOut(0);
			<?php }else{ ?>;
				$('#confirm').css('display','block');
			<?php } ?>;
		">Eliminar</button>		
		<a href="{{url('/Materiales/'.$material->Id_Mat)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
		<a href="{{url('/Materiales')}}" class="listado"><button class="boton lista" id="lista">Lista</button></a>
	</div>
@endsection

@section('contenido')
	@include('Admin.Material.session_div.edit')

	{!! Form::model($material, ['method'=>'PATCH', 'action'=>['MaterialesController@update', $material->Id_Mat], 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		<table id="principal" spellcheck="false">
			<tr>
				<td><label for="id_art">Id de artículo:</label></td>
				<td><input type="text" size="4" value="{{$material->Id_Art}}" disabled></td>
			</tr>

			<tr>
				<td><label for="cod_mat">Id de material:</label></td>
				<td><input type="text" size="4" value="{{$material->Id_Mat}}" disabled></td>
			</tr>			

			<tr>
				<td><label for="descripcion">Descripción:</label></td>				
				<td>
					@if($errors->any())						
						<input type="text" name="Art_DesLar" class="primero" placeholder="obligatorio" size="35" maxlength="35" value="{{old('Art_DesLar')}}" required autofocus>
						@if($errors->has('Art_DesLar'))
						<span class="help-block">{{$errors->first('Art_DesLar')}}</span>						
						@endif													
					@else			
						<input type="text" name="Art_DesLar" class="primero" placeholder="obligatorio" size="35" maxlength="35" value="{{$material->Art_DesLar}}" required autofocus>
					@endif												
				</td>
			</tr>	

			<tr>
				<td><label for="pre_com">Precio:</label></td>				
				<td>
					@if($errors->any())						
						<input type="number" name="Art_PreCom" placeholder="obligatorio" min="500" max="1000000" step="500" value="{{old('Art_PreCom')}}" onKeyPress="if(this.value.length==7) return false;" required>
						@if($errors->has('Art_PreCom'))
						<span class="help-block">{{$errors->first('Art_PreCom')}}</span>						
						@endif
					@else			
						<input type="number" name="Art_PreCom" placeholder="obligatorio" min="500" max="1000000" step="500" value="{{$material->Art_PreCom}}" onKeyPress="if(this.value.length==7) return false;" required>
					@endif												
				</td>
			</tr>		

			<tr>
				<td><label for="medida">Medición:</label></td>				
				<td>
					@if($errors->any())						
						<input type="text" name="Art_UniMed" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Art_UniMed')}}" required>
						@if($errors->has('Art_UniMed'))
						<span class="help-block">{{$errors->first('Art_UniMed')}}</span>						
						@endif
					@else			
						<input type="text" name="Art_UniMed" placeholder="obligatorio" size="20" maxlength="20" value="{{$material->Art_UniMed}}" required>
					@endif												
				</td>
			</tr>									
			
			<tr>
				<td><label for="existencia">Existencia:</label></td>				
				<td>
					@if($errors->any())						
						<input type="number" name="Art_St" placeholder="obligatorio" min="0" max="9999" step="0.5" onKeyPress="if(this.value.length==4) return false;" value="{{old('Art_St')}}" required>
						@if($errors->has('Art_St'))
						<span class="help-block">{{$errors->first('Art_St')}}</span>						
						@endif
					@else			
						<input type="number" name="Art_St" placeholder="obligatorio" min="0" max="9999" step="0.5" onKeyPress="if(this.value.length==4) return false;" value="{{$material->Art_St}}" required>
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
							@if($proveedor->Id_Prov==$material->Id_Prov)
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
                <input type="hidden" name="Id_Prov" id="id_prov" size="4" maxlength="2" value="{{$material->Id_Prov}}">                
            </td></tr>  	

			<tr>
				<td><label for="impuesto">Impuesto:</label></td>
				<td>
					<select class="seleccion" name="Id_Imp" required>
						@php
							$imp_1 = 1;
							$imp_2 = 2;
							$imp_3 = 3;

							switch($material->Id_Imp){
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
				<td><label for="estado">Estado:</label></td>
				<td>
					@php
						$est_1='Activo';
						$est_2='Inactivo';
					@endphp
					<select class="seleccion" name="Art_Est" minlength="6" maxlength="8" required>
						@if($material->Art_Est == $est_1)
							<option value="{{$est_1}}">{{$est_1}}</option>
							<option value="{{$est_2}}">{{$est_2}}</option>
						@elseif($material->Art_Est == $est_2)
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
						<textarea name="Art_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{$material->Art_Obs}}</textarea>
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
			<a href="{{url('/Materiales')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
		</div>

	<div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el material, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">
                {!! Form::open(['method'=>'DELETE', 'action'=>['MaterialesController@destroy', $material->Id_Art]]) !!}
                    {{csrf_field()}}
                    <button class="botones confirmar" id="confirmar" type="submit" onclick="$('#busca_prov').attr('disabled',false)">Confirmar</button>
                {!! Form::close() !!}
                </td>
                <td class="left"><button class="botones cancelar" id="c_cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

<script src="{{asset('js/vistas/create_edit/material.js')}}"></script>