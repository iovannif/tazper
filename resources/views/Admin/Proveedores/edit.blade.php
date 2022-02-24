@extends('Admin.lay.Edit')

@section('titulo')
    Editar Proveedores
@endsection

@section('navegacion_1')
	<div id="este">						
		<input class="boton eliminar primer" type="submit" id="borrar" value="Eliminar" onclick="
            if($('.foreign').val()!=''){
				$('#rechazo').show().delay(1500).fadeOut(0);
			}else{
				$('#confirm').css('display','block');
			}            
        ">		
        <a href="{{url('Proveedores/'.$proveedor->Id_Prov)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
        <a href="{{url('Proveedores')}}" class="listado"><button class="boton lista" id="lista">Lista</button></a>    
	</div>
@endsection

@section('contenido')
    @include('Admin.Proveedores.session_div.edit')        

	{!! Form::model($proveedor, ['method'=>'PATCH', 'action'=>['ProveedoresController@update', $proveedor->Id_Prov], 'spellcheck'=>'false','autocomplete'=>'off']) !!}
        <table id="principal">
            <tr>
                <td><label for="codigo">Id de provedor:</label></td>
                <td><input type="text" size="4" value="{{$proveedor->Id_Prov}}" disabled></td>
            </tr>

            <tr>
                <td><label for="descripcion">Descripción:</label></td>            
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_Des" class="primero" placeholder="obligatorio" size="30" maxlength="24" value="{{old('Prov_Des')}}"  autofocus>
                        @if($errors->has('Prov_Des'))
                        <span class="help-block">{{$errors->first('Prov_Des')}}</span>
                        @endif			
                    @else
                        <input type="text" name="Prov_Des" class="primero" placeholder="obligatorio" size="30" maxlength="24" value="{{$proveedor->Prov_Des}}"  autofocus>
                    @endif	
                </td>      
            </tr>

            <tr>
                <td><label for="raz_soc">Razón Social:</label></td>
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_RazSoc" placeholder="obligatorio" size="40" maxlength="40" value="{{old('Prov_RazSoc')}}" >
                        @if($errors->has('Prov_RazSoc'))
                        <span class="help-block">{{$errors->first('Prov_RazSoc')}}</span>		
                        @endif	
                    @else
                        <input type="text" name="Prov_RazSoc" placeholder="obligatorio" size="40" maxlength="40" value="{{$proveedor->Prov_RazSoc}}" >
                    @endif	                    
                </td>
            </tr>

            <tr>
                <td><label for="ruc">RUC:</label></td>
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_Ruc" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Prov_Ruc')}}" >
                        @if($errors->has('Prov_Ruc'))
                        <span class="help-block">{{$errors->first('Prov_Ruc')}}</span>		
                        @endif    
                    @else
                        <input type="text" name="Prov_Ruc" placeholder="obligatorio" size="20" maxlength="20" value="{{$proveedor->Prov_Ruc}}" >
                    @endif                    
                </td>
            </tr>
            
            <tr>
                <td><label for="telefono">Teléfono:</label></td>
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_Tel" placeholder="obligatorio" size="15" minlength="8" maxlength="15" value="{{old('Prov_Tel')}}" >
                        @if($errors->has('Prov_Tel'))
                        <span class="help-block">{{$errors->first('Prov_Tel')}}</span>		
                        @endif   
                    @else
                        <input type="text" name="Prov_Tel" placeholder="obligatorio" size="15" minlength="8" maxlength="15" value="{{$proveedor->Prov_Tel}}" >
                    @endif                       
                </td>
            </tr>
            
            <tr>
                <td><label for="celular">Celular:</label></td>
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_Cel" placeholder="opcional" size="15" maxlength="15" value="{{old('Prov_Cel')}}">
                        @if($errors->has('Prov_Cel'))
                        <span class="help-block">{{$errors->first('Prov_Cel')}}</span>		
                        @endif
                    @else
                        <input type="text" name="Prov_Cel" placeholder="opcional" size="15" maxlength="15" value="{{$proveedor->Prov_Cel}}">
                    @endif                     
                </td>
            </tr>

            <tr>
                <td><label for="email">E-mail:</label></td>
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_Email" placeholder="opcional" size="30" maxlength="30" value="{{old('Prov_Email')}}">
                        @if($errors->has('Prov_Email'))
                        <span class="help-block">{{$errors->first('Prov_Email')}}</span>		
                        @endif   
                    @else
                        <input type="text" name="Prov_Email" placeholder="opcional" size="30" maxlength="30" value="{{$proveedor->Prov_Email}}">
                    @endif                     
                </td>
            </tr>

            <tr>
                <td><label for="web">Sitio web:</label></td>
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_Web" placeholder="opcional" size="40" maxlength="45" value="{{old('Prov_Web')}}">
                        @if($errors->has('Prov_Web'))
                        <span class="help-block">{{$errors->first('Prov_Web')}}</span>		
                        @endif  
                    @else
                        <input type="text" name="Prov_Web" placeholder="opcional" size="40" maxlength="45" value="{{$proveedor->Prov_Web}}">
                    @endif                     
                </td>
            </tr>

            <tr>
                <td><label for="direccion">Dirección:</label></td>
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_Dir" placeholder="obligatorio" size="45" maxlength="50" value="{{old('Prov_Dir')}}" >
                        @if($errors->has('Prov_Web'))
                        <span class="help-block">{{$errors->first('Prov_Web')}}</span>		
                        @endif  
                    @else
                        <input type="text" name="Prov_Dir" placeholder="obligatorio" size="45" maxlength="50" value="{{$proveedor->Prov_Dir}}" >
                    @endif                     
                </td>
            </tr>

            <tr>
                <td><label for="ciudad">Ciudad:</label></td>
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_Ciu" placeholder="opcional" size="30" maxlength="30" value="{{old('Prov_Ciu')}}">
                        @if($errors->has('Prov_Ciu'))
                        <span class="help-block">{{$errors->first('Prov_Ciu')}}</span>		
                        @endif  
                    @else
                        <input type="text" name="Prov_Ciu" placeholder="opcional" size="30" maxlength="30" value="{{$proveedor->Prov_Ciu}}">
                    @endif                    
                </td>
            </tr>

            <tr>
                <td><label for="barrio">Barrio:</label></td>
                <td>
                    @if($errors->any())
                        <input type="text" name="Prov_Bar" placeholder="opcional" size="30" maxlength="30" value="{{old('Prov_Bar')}}">
                        @if($errors->has('Prov_Bar'))
                        <span class="help-block">{{$errors->first('Prov_Bar')}}</span>		
                        @endif     
                    @else
                        <input type="text" name="Prov_Bar" placeholder="opcional" size="30" maxlength="30" value="{{$proveedor->Prov_Bar}}">
                    @endif                    
                </td>
            </tr>

            <tr>
				<td><label for="horario">Horario:</label></td>
				<td>
                    @if($errors->any())
                        <input type="text" name="Prov_Ho" placeholder="obligatorio" size="55" minlength="5" maxlength="60" value="{{old('Prov_Ho')}}" >
                        @if($errors->has('Prov_Ho'))
                        <span class="help-block">{{$errors->first('Prov_Ho')}}</span>		
                        @endif  
                    @else
                        <input type="text" name="Prov_Ho" placeholder="obligatorio" size="55" minlength="5" maxlength="60" value="{{$proveedor->Prov_Ho}}" >
                    @endif                      
                </td>
			</tr>

            <tr>
				<td><label for="estado">Estado:</label></td>
				<td>
					@php
						$est_1='Activo';
						$est_2='Inactivo';
					@endphp
					<select class="seleccion" name="Prov_Est" minlength="6" maxlength="8" >
						@if($proveedor->Prov_Est == $est_1)
							<option value="{{$est_1}}">{{$est_1}}</option>
							<option value="{{$est_2}}">{{$est_2}}</option>
						@elseif($proveedor->Prov_Est == $est_2)
							<option value="{{$est_2}}">{{$est_2}}</option>
							<option value="{{$est_1}}">{{$est_1}}</option>
						@endif
					</select>
                    @if($errors->has('Prov_Est'))<span class="help-block">{{$errors->first('Prov_Est')}}</span>@endif
				</td>
			</tr>                    

            <tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>										
					@if($errors->any())		
						<textarea name="Prov_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{old('Prov_Obs')}}</textarea>	
						@if($errors->has('Prov_Obs'))
						<br><span class="help-block" id="obs">{{$errors->first('Prov_Obs')}}</span>
						@endif
					@else
						<textarea name="Prov_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{$proveedor->Prov_Obs}}</textarea>
					@endif

                        <!-- fk -->
                        @php
                            $foreign='';
                        
                            {{--
                            foreach($productos as $producto){
                                if($producto->Id_Prov==$proveedor->Id_Prov){
                                    $foreign='true';
                                    break;
                                }
                            }
                            --}}

                            if($articulos>0 || $compras>0 || $pedidos>0){
                                $foreign='true';
                            }
                        @endphp
                        <input type="hidden" class="foreign" value="{{$foreign}}" disabled></td>
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
                <tr><td class="center" colspan="2">Está a punto de eliminar el proveedor, no lo podrá recuperar</td></tr>
                <tr><td class="center" colspan="2">Desea continuar?</td></tr>
                <tr>
                    <td class="right">                
                    {!! Form::open(['method'=>'DELETE', 'action'=>['ProveedoresController@destroy', $proveedor->Id_Prov]]) !!}
                        {{csrf_field()}}
                        <input class="botones confirmar" type="submit" id="confirmar" value="Confirmar">
                    {!! Form::close() !!}		
                    </td>
                    <td class="left"><button class="botones cancelar" id="c_cancelar">Cancelar</button></td>
                </tr>
            </table>
        </div>    
@endsection