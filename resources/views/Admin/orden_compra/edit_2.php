@extends('Admin.lay.OrdenCompra')

<style>
    div{
        cursor:default;
    }

    #titulo{
        margin-bottom:6px;
    }

    .help-block,.error{
        color:#C90000;
        text-shadow: 0 0 1px #C8C8C8;
        cursor:default;
        padding-left: 6px;
        font-family:Raleway;
        font-size:13px;
    }

    .error::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color:#C90000;
        text-shadow: 0 0 1px #C8C8C8;        
        font-family:Raleway;
        font-size:13px;
        opacity: 1; /* Firefox */
    }
    
    #auditoria{
        display:none !important;
    }
</style>

@section('titulo')
    Editar Orden
@endsection

@section('navegacion_1')
    <div id="este">
        @if($orden->OC_Est=='Pendiente')
            <button class="boton eliminar primer" id="eliminar" onclick="$('#cancela').css('display','block');">Cancelar</button>		
        @else
            <button class="boton eliminar primer" id="eliminar" onclick="$('#confirm').css('display','block');">Eliminar</button>		
        @endif
        <a href="{{url('/OrdenCompra/'.$orden->Id_OC)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
		<a href="{{url('/OrdenCompra')}}" class="listado"><button class="boton lista" id="lista">Lista</button></a>
    </div>
@endsection

@section('contenido')
    {!! Form::model($orden, ['method'=>'PATCH', 'action'=>['OrdenCompraController@update', $orden->Id_OC], 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
    <!-- Orden -->
    <div class="oc_titulo">
        <table id="oc_titulo">
            <tr><td>ORDEN DE COMPRA</td></tr>
        </table>
    </div>

    <div class="empresa_orden">
        <div class="empresa">
            <table id="empresa">
            @foreach($sucursales as $sucursal)
            @if($sucursal->Id_Suc==$sucursal->Id_Suc)
                <tr>
                    <td><input type="text" size="40" value="{{$sucursal->Suc_NomFan}}" disabled></td>
                </tr>

                <tr>
                    <td><input type="text" size="40" value="{{$sucursal->Suc_Dir}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" size="40" value="{{$sucursal->Suc_Tel}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" size="40" value="{{'facebook: '.$sucursal->Suc_Red1.' · instagram: '.$sucursal->Suc_Red2}}" disabled></td>
                </tr>
            @endif
            @endforeach 
            </table>
        </div>

        <div class="orden">
            <table id="orden">
                <tr>
                    <td>Fecha de orden:</td>
                    <td><input type="text" size="10" value="{{date('d/m/y', strtotime($orden->OC_Fe))}}" disabled></td>
                </tr>

                <tr>
                    <td>Número de orden:</td>
                    <td><input type="text" size="10" value="{{$orden->Id_OC}}" disabled></td>
                </tr>
                
                <tr>
                    <td>Cliente Nº:</td>
                    <td>
                        @if($errors->any())				
                        <input type="text" name="OC_CliNum" class="primero" size="10" maxlength="" value="{{old('OC_CliNum')}}" autofocus>                            
                        @else			
                        <input type="text" name="OC_CliNum" class="primero" size="10" maxlength="" value="{{$orden->OC_CliNum}}" autofocus>
                        @endif
                    </td>                    
                </tr>
                @if($errors->has('OC_CliNum'))<tr><td colspan="2" class="help-block">{{$errors->first('OC_CliNum')}}</td></tr>@endif
            </table>
        </div>
    </div>

    <div class="vendedor_enviar-a">
        <div class="vendedor">
            <table id="vendedor">
                @foreach($proveedores as $proveedor)
                @if($proveedor->Id_Prov==$orden->Id_Prov)
                <tr class="head">
                    <td colspan="2" class="td_tl td_tr">Vendedor</td>
                </tr>

                <tr>
                    <td>Empresa:</td>
                    <td><input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled></td>
                </tr>
                
                <tr>
                    <td>Departamento de:</td>
                    <td><input type="text" size="30" value="Ventas" disabled></td>
                </tr>
                
                <tr>
                    <td>Dirección:</td>
                    <td><input type="text" size="30" value="{{$proveedor->Prov_Dir}}" disabled></td>
                </tr>
                
                <tr>
                    <td>Teléfono:</td>
                    <td><input type="text" size="30" value="{{$proveedor->Prov_Tel}}" disabled></td>
                </tr>
                
                <tr>
                    <td>E-mail:</td>
                    <td><input type="text" size="30" value="{{$proveedor->Prov_Email}}" disabled></td>
                </tr>
                @endif
                @endforeach
            </table>
        </div>

        <div class="enviar-a">
            <p class="head td_tl td_tr" style="margin:0">Enviar a:</p>
            <table id="enviar-a">
                @foreach($sucursales as $sucursal)
                @if($sucursal->Id_Suc==$sucursal->Id_Suc)
                <tr>
                    <td><input type="text" size="35" value="{{$sucursal->Suc_Enc}}" disabled></td>
                </tr>

                <tr>
                    <td><input type="text" size="35" value="{{$sucursal->Suc_Des}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" size="35" value="{{$sucursal->Suc_Dir}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" size="35" value="{{$sucursal->Suc_Tel}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" size="35" value="{{$sucursal->Suc_Email}}" disabled></td>
                </tr>
                @endif
                @endforeach
            </table>
        </div>
    </div>

    <div class="envio">
        <table id="envio">
            <tr class="head">
                <td class="td_tl">Medio de Envío</td>
                <td>F.O.B.</td>
                <td>Condiciones de Envío</td>
                <td class="td_tr">Fecha de Entrega</td>
            </tr>                
            
            <tr>
                <td>
                    @if($errors->any())                                                
                        @if($errors->has('OC_MedEnv'))                        
                        <textarea class="tx_bl" rows="3" maxlength="" name="OC_MedEnv" class="error">{{$errors->first('OC_MedEnv')}}</textarea>
                        @else
                        <textarea class="tx_bl" rows="3" maxlength="" name="OC_MedEnv">{{old('OC_MedEnv')}}</textarea>
                        @endif
                    @else
                        <textarea class="tx_bl" rows="3" maxlength="" name="OC_MedEnv">{{$orden->OC_MedEnv}}</textarea>
                    @endif
                </td>

                <td>                    
                    @if($errors->any())
                        @if($errors->has('OC_FOB'))                        
                        <textarea class="tx_bl" rows="3" maxlength="70" name="OC_FOB" class="error" placeholder="{{$errors->first('OC_FOB')}}"></textarea>
                        @else
                        <textarea class="tx_bl" rows="3" maxlength="70" name="OC_FOB">{{old('OC_FOB')}}</textarea>
                        @endif
                    @else
                        <textarea class="tx_bl" rows="3" maxlength="70" name="OC_MedEnv">{{$orden->OC_FOB}}</textarea>
                    @endif
                </td>

                <td>                    
                    @if($errors->any())
                        @if($errors->has('OC_CondEnv'))                        
                        <textarea class="tx_bl" rows="3" maxlength="70" name="OC_FOB" class="error" placeholder="{{$errors->first('OC_CondEnv')}}"></textarea>
                        @else
                        <textarea class="tx_bl" rows="3" maxlength="70" name="OC_FOB">{{old('OC_CondEnv')}}</textarea>
                        @endif
                    @else
                        <textarea class="tx_bl" rows="3" maxlength="70" name="OC_MedEnv">{{$orden->OC_CondEnv}}</textarea>
                    @endif
                </td>

                <td><textarea class="tx_br" rows="3" disabled>{{date('d/m/y', strtotime($orden->OC_FeEnt))}}</textarea></td>
            </tr>
        </table>
    </div>

    <div class="detalle">
        <table id="detalle">
            <tr class="head">
                <td class="td_tl">Artículo #</td>
                <td>Descripción</td>
                <td>Cantidad</td>
                <td>Precio Unitario</td>
                <td class="td_tr">Total</td>
            </tr>

            @php
                $i=0;
            @endphp
            
            @if($o_detalle)
            @foreach($o_detalle as $detalle)   
                @foreach($articulos as $articulo)   
                @if($articulo->Id_Art==$ocd_a[$i]->Id_Art) 
                <tr>
                    <td><input type="text" size="7" value="{{$ocd_a[$i]->Id_Art}}" disabled></td>
                    <td><input type="text" size="35" value="{{$articulo->Art_DesLar}}" disabled></td>
                    <td>
                        @if($articulo->Art_UniMed!='Unidades' && $articulo->Art_UniMed!='unidades')
                        <input type="text" size="20" value="{{$detalle->OCD_ArtCant.' '.$articulo->Art_UniMed}}" disabled>
                        @else
                        <input type="text" size="20" value="{{$detalle->OCD_ArtCant}}" disabled>
                        @endif
                    </td>
                    <td class="art_pre"><input type="text" size="7" value="{{$articulo->Art_PreCom}}" disabled></td>
                    <td><input type="text" size="7" value="{{$detalle->OCD_ArtTot}}" disabled></td>
                </tr>
                @endif            
                @endforeach                

                @php                 
                    $i++;                    
                @endphp
            @endforeach
            @endif
            
                @php
                    $i=1;
                @endphp

                @for($i==1; $i<=12-$o_detalle->count(); $i++)
                    <tr>
                        <td><input type="text" size="7" disabled></td>
                        <td><input type="text" size="35" disabled></td>
                        <td><input type="text" size="20" disabled></td>
                        <td><input type="text" size="7" disabled></td>
                        <td><input type="text" size="7" disabled></td>
                    </tr>
                @endfor
            
            <tr>
                <td colspan="2" class="m_l">Condiciones o instrucciones especiales</td>
                <td colspan="2" class="m_l">Subtotal</td>
                <td><input type="number" name="OC_SubTot" value="{{$orden->OC_SubTot}}" disabled style="background: #fff;"></td>
            </tr>

            <tr>
                <td colspan="2" rowspan="4">
                    <textarea class="tx_bl" disabled>{{$orden->OC_Obs}}</textarea>
                </td>
                <td colspan="2" class="m_l">Iva</td>
                <td>                
                    @if($errors->any())				                        
                        @if($errors->has('OC_Iva'))
                        <input type="number" class="help-block" name="OC_Iva" step="500" max="1000000" min="0" value="{{$errors->first('OC_Iva')}}">
                        @else
                        <input type="number" name="OC_Iva" step="500" max="1000000" min="0" value="{{old('OC_Iva')}}">
                        @endif                        
                    @else			
                        <input type="number" name="OC_Iva" step="500" max="1000000" min="0" value="{{$orden->OC_Iva}}">
                    @endif
                </td>
            </tr>            
            
            <tr>
                <td colspan="2" class="m_l">Envío</td>
                <td>
                    @if($errors->any())				
                        <input type="number" name="OC_Env" step="500" max="1000000" min="0" value="{{old('OC_Env')}}">
                        @if($errors->has('OC_Env'))
                        <span class="help-block">{{$errors->first('OC_Env')}}</span>						
                        @endif
                    @else			
                        <input type="number" name="OC_Iva" step="500" max="1000000" min="0" value="{{$orden->OC_Env}}">
                    @endif
                </td>
            </tr>
            
            <tr>
                <td colspan="2" class="m_l">Otro</td>
                <td>                    
                    @if($errors->any())				
                        <input type="number" name="OC_Otr" step="500" max="1000000" min="0" value="{{old('OC_Otr')}}">
                        @if($errors->has('OC_Otr'))
                        <span class="help-block">{{$errors->first('OC_Otr')}}</span>						
                        @endif
                    @else			
                        <input type="number" name="OC_Iva" step="500" max="1000000" min="0" value="{{$orden->OC_Otr}}">
                    @endif
                </td>
            </tr>
            
            <tr>
                <td colspan="2" class="m_l">Total</td>
                <td>
                    @if($errors->any())				
                        <input type="number" name="OC_Tot" step="500" max="1000000" min="0" value="{{old('OC_Tot')}}">
                        @if($errors->has('OC_Tot'))
                        <span class="help-block">{{$errors->first('OC_Tot')}}</span>						
                        @endif
                    @else			
                        <input type="number" name="OC_Iva" step="500" max="1000000" min="0" value="{{$orden->OC_Tot}}">
                    @endif
                </td>
            </tr>
        </table>
    </div>    
@endsection

@section('navegacion_2')
    <div class="arriba">
        <input class="boton" type="submit" id="actualizar" value="Actualizar">
        <input class="boton" type="reset" id="limpiar" value="Limpiar" onclick="$('.primero').focus();">
    {!! Form::close() !!}
        <a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>

        <div id="cancela">
            <table>
                <tr><td class="center" colspan="2">Está a punto de cancelar la orden, desea continuar?</td></tr>            
                <tr>                    
                    <td class="right">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['OrdenCompraController@destroy', $orden->Id_OC]]) !!}            
                        <input class="botones borrar" type="submit" value="Confirmar">
                        {!! Form::close() !!}
                    </td>                    
                    <td class="left"><button class="botones cancelar" onclick="$('#cancela').hide(); $('.primero').focus();">Cancelar</button></td>
                </tr>
            </table>
        </div>

        <div id="confirm">
            <table>
                <tr><td class="center" colspan="2">Está a punto de eliminar la orden, desea continuar?</td></tr>            
                <tr>                    
                    <td class="right">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['OrdenCompraController@destroy', $orden->Id_OC]]) !!}            
                        <input class="botones borrar" type="submit" value="Confirmar">
                        {!! Form::close() !!}
                    </td>                                                                
                    <td class="left"><button class="botones cancelar" id="cancelar" onclick="$('#confirm').hide(); $('.primero').focus();">Cancelar</button></td>
                </tr>
            </table>
        </div>  
	</div>
@endsection