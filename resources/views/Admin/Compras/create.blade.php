@extends('Admin.lay.Transaccion')

<link href="{{asset('css/vistas/Compra.css')}}" rel="stylesheet">
<style>
    #navegacion_1{
        display:none;
    }    
    .tot_let{
        visibility:hidden;
    }
    #navegacion_2{
        background: #EEEEEE;        
    }    
    
    .err_fac{
        text-align:right !important;
    }

    .precio,.exentas,.iva_5,.iva10{
        text-align:right !important;
        margin-right:5px !important;
    }

    #art_med,.unimed{
        text-align:left !important;
        margin-left:5px !important;
    }

    #prov_dir{
        margin-left:-70px !important;
    }
    #prov_ruc{
        margin-left: -35px !important; 
    }        
</style>

@section('titulo')
    Registrar Compra
@endsection

@section('cabecera')
    @include('Admin.Compras.session_div.create')

    {!! Form::open(['id' => 'compra_form', 'url'=>'/Compras', 'method'=>'post', 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
        {{csrf_field()}}            
        <table class="tabla_cabecera">                        
            <tr>
                <td>Fecha:</td>
                <td><input type="text" size="6" value="{{date('d/m/y')}}" disabled></td>

                <td class="col_sep">Hora:</td>
                <td><input type="text" size="4" value="{{date('H:i')}}" disabled></td>

                <td class="col_sep">Factura Nº:</td>
                <td><input type="text" class="primer" name="Com_Fac" id="fac" size="10" maxlength="10" value="{{old('Com_Fac')}}" autofocus required></td>

                <td class="col_sep">Condición de compra:</td>
                <td>
                    <select>
                        <option value="Contado">Contado</option>
                    </select>
                </td>
            </tr>

            <div id="pedido"> <!-- cuadro -->
            </div>   

            <tr>
                <td>Pedido:</td>
                <td><input type="text" name="Id_PedProv" id="ped" size="4" maxlength="4" value="{{old('Id_PedProv')}}"></td>                

                <td class="col_sep">Orden de compra:</td>
                <td><input type="text" name="Id_OC" size="4" value="{{old('Id_OC')}}" disabled></td>

                <td class="err_fac help-block" colspan="2">                    
                    @if($errors->has('Com_Fac'))
                        <script>
                            $('input[name=Com_Fac]').focus();
                        </script>

                        {{$errors->first('Com_Fac')}}    
                        {{--
                        <td id="aviso" class="help-block" colspan="3">Es obligatario al menos un artículo para continuar</td>
                        a--}}
                    @endif                    
                </td>

                <td class="col_sep">Medio de pago:</td>
                <td>
                    <select name="Id_MedPag" minlength="1" maxlength="2" min="1" value="{{old('Id_MedPag')}}" required> <!-- guarda val pero no option -->
                        @foreach($med_pag as $medio)
                        <option value="{{$medio->Id_MedPag}}">{{$medio->MedPag_Des}}</option>
                        @endforeach
                        <!-- <option value="2">2</option> -->
                    </select>
                </td>                
            </tr>

            <div id="proveedor"> <!-- cuadro -->
            </div>            

            <tr>
                <td>Proveedor:</td>
                <td>
                    <input type="text" id="busca_prov" name="Prov_Des" class="bottom" size="25" value="{{old('Prov_Des')}}"> <!-- para error -->
                    <input type="hidden" name="Id_Prov" value="{{old('Id_Prov')}}">
                </td>                

                <td class="col_sep">RUC:</td>
                <td><input type="text" id="prov_ruc" name="Prov_Ruc" class="bottom" size="10" value="{{old('Prov_Ruc')}}" disabled></td>

                <td class="col_sep">Teléfono:</td>
                <td><input type="text" id="prov_tel" name="Prov_Tel" class="bottom" size="10" value="{{old('Prov_Tel')}}" disabled></td>

                <td class="col_sep">Dirección:</td>
                <td><input type="text" id="prov_dir" name="Prov_Dir" class="bottom" size="42" value="{{old('Prov_Dir')}}" disabled></td>
            </tr>                                                          
        </table>
@endsection

@section('detalle')
        <div class="cont_art">
            <table id="busc_art">
                <tr>
                    <td id="articulo">Artículo:</td>
                    <td><input type="text" id="busqueda" size="30" maxlength="35"></td>
                </tr>
            </table>

            <div id="articulos"> <!-- cuadro -->
            </div>

            <table id="tabla_articulo">
                <tr>												
                    @if($errors->has('Id_Art_1'))
                        <td id="aviso" class="help-block" colspan="3">Es obligatario al menos un artículo para continuar</td>							
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
                    <td>Impuesto</td>                    								                    
                    <td style="border-right: 1px solid lightgrey;">Cantidad</td>	
                    <td style="display:none"><input type="hidden" id="tipo" disabled></td>
                </tr>
                
                <tr class="agregar">
                    <td><input type="text" id="id_art" size="4" disabled></td>				
                    <td><input type="text" id="art_des" size="35" disabled></td>
                    <td><input type="text" id="art_pre" size="7" disabled></td>
                    <td><input type="text" id="art_st" size="5" disabled></td>										
                    <td><input type="text" id="art_imp" size="8" disabled></td>
                    <td style="background:white">
                        <input type="number" id="art_cant" min="0.5"  max="9999" step="0.5" style="width:86px;" onKeyPress="if(this.value.length==4) return false;">
                        <input type="text" id="art_med" size="15" disabled>
                    </td>				                    
                    <td class="td_agregar"><button class="botones" id="agregar">agregar</button></td>                    
                </tr>
            </table>
        </div>        

        <!-- transaccion ha llegado al limite de items, puede realizar otra transaccion -->

        <table class="detalle">            
			<tr class="head">
				<td>Id Art</td>				
				<td>Descripción</td>					
				<td>Precio</td>	
				<td>Cantidad</td>					
                <td>Exentas</td>					
                <td>5%</td>					
                <td>10%</td>												
			</tr>
			
			<tr class="linea linea_1">
				<td><input type="text" id="art_id_1" name="Id_Art_1" class="art" size="4" value="{{old('Id_Art_1')}}" required disabled></td>
				<td><input type="text" id="des_art_1" name="Des_Art_1" size="35" value="{{old('Des_Art_1')}}" disabled></td>
				<td><input type="text" id="pre_1" name="Pre_Art_1" class="precio" size="6" value="{{old('Pre_Art_1')}}" disabled></td>
				<td>
					<input type="text" id="cant_art_1" name="Art_Cant_1" class="cant" size="4" value="{{old('Art_Cant_1')}}" required disabled>
					<input type="text" id="unmed_art_1" size="15" name="UniMed_Art_1" class="unimed" value="{{old('UniMed_Art_1')}}" disabled>
				</td>
                <td><input type="text" class="exentas" id="exen_1" name="Art_Exen_1" size="6" value="{{old('Art_Exen_1')}}" disabled></td>
                <td><input type="text" class="iva_5" id="iva5_1" name="Art_Iva5_1" size="6" value="{{old('Art_Iva5_1')}}" disabled></td>
                <td><input type="text" class="iva10" id="iva10_1" name="Art_Iva10_1" size="6" value="{{old('Art_Iva10_1')}}" disabled></td>

                <td class="opciones"><button class="botones mas" id="mas_1">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_1">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_1">quitar</button></td>
            </tr>
            
            <tr class="linea linea_2">
				<td><input type="text" id="art_id_2" name="Id_Art_2" class="art" size="4" value="{{old('Id_Art_2')}}" disabled></td>
				<td><input type="text" id="des_art_2" name="Des_Art_2" size="35" value="{{old('Des_Art_2')}}" disabled></td>
				<td><input type="text" id="pre_2" class="precio" name="Pre_Art_2" size="6" value="{{old('Pre_Art_2')}}" disabled></td>
				<td>
					<input type="text" id="cant_art_2" name="Art_Cant_2" class="cant" size="4" value="{{old('Art_Cant_2')}}" disabled>
					<input type="text" id="unmed_art_2" size="15" name="UniMed_Art_2" class="unimed" value="{{old('UniMed_Art_2')}}" disabled>
				</td>
                <td><input type="text" class="exentas" id="exen_2" name="Art_Exen_2" size="6" value="{{old('Art_Exen_2')}}" disabled></td>
                <td><input type="text" class="iva_5" id="iva5_2" name="Art_Iva5_2" size="6" value="{{old('Art_Iva5_2')}}" disabled></td>
                <td><input type="text" class="iva10" id="iva10_2" name="Art_Iva10_2" size="6" value="{{old('Art_Iva10_2')}}" disabled></td>

                <td class="opciones"><button class="botones mas" id="mas_2">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_2">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_2">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_3">
				<td><input type="text" id="art_id_3" name="Id_Art_3" class="art" size="4" value="{{old('Id_Art_3')}}" disabled></td>
				<td><input type="text" id="des_art_3" name="Des_Art_3" size="35" value="{{old('Des_Art_3')}}" disabled></td>
				<td><input type="text" id="pre_3" class="precio" name="Pre_Art_3" size="6" value="{{old('Pre_Art_3')}}" disabled></td>
				<td>
					<input type="text" id="cant_art_3" name="Art_Cant_3" class="cant" size="4" value="{{old('Art_Cant_3')}}" disabled>
					<input type="text" id="unmed_art_3" size="15" name="UniMed_Art_3" class="unimed" value="{{old('UniMed_Art_3')}}" disabled>
				</td>
                <td><input type="text" class="exentas" id="exen_3" name="Art_Exen_3" size="6" value="{{old('Art_Exen_3')}}" disabled></td>
                <td><input type="text" class="iva_5" id="iva5_3" name="Art_Iva5_3" size="6" value="{{old('Art_Iva5_3')}}" disabled></td>
                <td><input type="text" class="iva10" id="iva10_3" name="Art_Iva10_3" size="6" value="{{old('Art_Iva10_3')}}" disabled></td>

                <td class="opciones"><button class="botones mas" id="mas_3">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_3">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_3">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_4">
				<td><input type="text" id="art_id_4" name="Id_Art_4" class="art" size="4" value="{{old('Id_Art_4')}}" disabled></td>
				<td><input type="text" id="des_art_4" name="Des_Art_4" size="35" value="{{old('Des_Art_4')}}" disabled></td>
				<td><input type="text" id="pre_4" class="precio" name="Pre_Art_4" size="6" value="{{old('Pre_Art_4')}}" disabled></td>
				<td>
					<input type="text" id="cant_art_4" name="Art_Cant_4" class="cant" size="4" value="{{old('Art_Cant_4')}}" disabled>
					<input type="text" id="unmed_art_4" size="15" name="UniMed_Art_4" class="unimed" value="{{old('UniMed_Art_4')}}" disabled>
				</td>
                <td><input type="text" class="exentas" id="exen_4" name="Art_Exen_4" size="6" value="{{old('Art_Exen_4')}}" disabled></td>
                <td><input type="text" class="iva_5" id="iva5_4" name="Art_Iva5_4" size="6" value="{{old('Art_Iva5_4')}}" disabled></td>
                <td><input type="text" class="iva10" id="iva10_4" name="Art_Iva10_4" size="6" value="{{old('Art_Iva10_4')}}" disabled></td>

                <td class="opciones"><button class="botones mas" id="mas_4">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_4">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_4">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_5">
				<td><input type="text" id="art_id_5" name="Id_Art_5" class="art" size="4" value="{{old('Id_Art_5')}}" disabled></td>
				<td><input type="text" id="des_art_5" name="Des_Art_5" size="35" value="{{old('Des_Art_5')}}" disabled></td>
				<td><input type="text" id="pre_5" class="precio" name="Pre_Art_5" size="6" value="{{old('Pre_Art_5')}}" disabled></td>
				<td>
					<input type="text" id="cant_art_5" name="Art_Cant_5" class="cant" size="4" value="{{old('Art_Cant_5')}}" disabled>
					<input type="text" id="unmed_art_5" name="UniMed_Art_5" size="15" class="unimed" value="{{old('UniMed_Art_5')}}" disabled>
				</td>
                <td><input type="text" class="exentas" id="exen_5" name="Art_Exen_5" size="6" value="{{old('Art_Exen_5')}}" disabled></td>
                <td><input type="text" class="iva_5" id="iva5_5" name="Art_Iva5_5" size="6" value="{{old('Art_Iva5_5')}}" disabled></td>
                <td><input type="text" class="iva10" id="iva10_5" name="Art_Iva10_5" size="6" value="{{old('Art_Iva10_5')}}" disabled></td>

                <td class="opciones"><button class="botones mas" id="mas_5">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_5">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_5">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_6">
				<td><input type="text" id="art_id_6" name="Id_Art_6" class="art" size="4" value="{{old('Id_Art_6')}}" disabled></td>
				<td><input type="text" id="des_art_6" size="35" name="Des_Art_6" value="{{old('Des_Art_6')}}" disabled></td>
				<td><input type="text" id="pre_6" class="precio" name="Pre_Art_6" size="6" value="{{old('Pre_Art_6')}}" disabled></td>
				<td>
					<input type="text" id="cant_art_6" name="Art_Cant_6" class="cant" size="4" value="{{old('Art_Cant_6')}}" disabled>
					<input type="text" id="unmed_art_6" size="15" name="UniMed_Art_6" class="unimed" value="{{old('UniMed_Art_6')}}" disabled>
				</td>
                <td><input type="text" class="exentas" id="exen_6" name="Art_Exen_6" size="6" value="{{old('Art_Exen_6')}}" disabled></td>
                <td><input type="text" class="iva_5" id="iva5_6" name="Art_Iva5_6" size="6" value="{{old('Art_Iva5_6')}}" disabled></td>
                <td><input type="text" class="iva10" id="iva10_6" name="Art_Iva10_6" size="6" value="{{old('Art_Iva10_6')}}" disabled></td>

                <td class="opciones"><button class="botones mas" id="mas_6">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_6">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_6">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_7">
				<td><input type="text" id="art_id_7" name="Id_Art_7" class="art" size="4" value="{{old('Id_Art_7')}}" disabled></td>
				<td><input type="text" id="des_art_7" size="35" name="Des_Art_7" value="{{old('Des_Art_7')}}" disabled></td>
				<td><input type="text" id="pre_7" class="precio" name="Pre_Art_7" size="6" value="{{old('Pre_Art_7')}}" disabled></td>
				<td>
					<input type="text" id="cant_art_7" name="Art_Cant_7" class="cant" size="4" value="{{old('Art_Cant_7')}}" disabled>
					<input type="text" id="unmed_art_7" name="UniMed_Art_7" size="15" class="unimed" value="{{old('UniMed_Art_7')}}" disabled>
				</td>
                <td><input type="text" class="exentas" id="exen_7" name="Art_Exen_7" size="6" value="{{old('Art_Exen_7')}}" disabled></td>
                <td><input type="text" class="iva_5" id="iva5_7" name="Art_Iva5_7" size="6" value="{{old('Art_Iva5_7')}}" disabled></td>
                <td><input type="text" class="iva10" id="iva10_7" name="Art_Iva10_7" size="6" value="{{old('Art_Iva10_7')}}" disabled></td>

                <td class="opciones"><button class="botones mas" id="mas_7">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_7">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_7">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_8">
				<td><input type="text" id="art_id_8" name="Id_Art_8" class="art" size="4" value="{{old('Id_Art_8')}}" disabled></td>
				<td><input type="text" id="des_art_8" size="35" name="Des_Art_8" value="{{old('Des_Art_8')}}" disabled></td>
				<td><input type="text" id="pre_8" class="precio" name="Pre_Art_8" size="6" value="{{old('Pre_Art_8')}}" disabled></td>
				<td>
					<input type="text" id="cant_art_8" name="Art_Cant_8" class="cant" size="4" value="{{old('Art_Cant_8')}}" disabled>
					<input type="text" id="unmed_art_8" name="UniMed_Art_8" size="15" class="unimed" value="{{old('UniMed_Art_8')}}" disabled>
				</td>
                <td><input type="text" class="exentas" id="exen_8" name="Art_Exen_8" size="6" value="{{old('Art_Exen_8')}}" disabled></td>
                <td><input type="text" class="iva_5" id="iva5_8" name="Art_Iva5_8" size="6" value="{{old('Art_Iva5_8')}}" disabled></td>
                <td><input type="text" class="iva10" id="iva10_8" name="Art_Iva10_8" size="6" value="{{old('Art_Iva10_8')}}" disabled></td>

                <td class="opciones"><button class="botones mas" id="mas_8">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_8">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_8">quitar</button></td>
            </tr>	            
		</table>	                     
@endsection

@section('total')
        <table id="compra_total">
            <tr>
                <td class="sub_tot">Subtotales:</td>                
                <td><input type="text" name="Com_StExe" size="7" value="{{old('Com_StExe')}}" disabled></td>
                <td><input type="text" name="Com_St5" size="7" value="{{old('Com_St5')}}" disabled></td>
                <td><input type="text" name="Com_St10" size="7" value="{{old('Com_St10')}}" disabled></td>
                <td class="filler"></td>
            </tr>

            <tr>
                <td class="tot_let" colspan="2">Total: guaraníes <input type="text" size="60" disabled></td>                
                <td class="tot">Total</td>
                <td><input type="text" name="Com_Total" size="7" value="{{old('Com_Total')}}" required disabled></td>
                <td class="filler"></td>
            </tr>

            <tr>
                <td colspan="4" class="liq_iva">Liquidación del IVA:
                (5%) <input type="number" name="Com_Liq5" max="9999999" min="0" step="500" onKeyPress="if(this.value.length==9) return false;" value="{{old('Com_Liq5')}}">
                (10%) <input type="number" name="Com_Liq10" max="9999999" min="0" step="500" onKeyPress="if(this.value.length==9) return false;" value="{{old('Com_Liq10')}}"> 
                Total IVA <input type="number" name="Com_TotIva" max="9999999" min="0" step="500" onKeyPress="if(this.value.length==9) return false;" value="{{old('Com_TotIva')}}">
                </td>
            </tr>
        </table>

        @if($errors->any())		
			<script>
				window.addEventListener("load", function(){
                    // $('input[name=Id_OC]').prop('disabled',true);
                    // $('.detalle input').prop('disabled',true);
                    // $('input[name=Com_StExe],input[name=Com_St5],input[name=Com_St10],input[name=Com_Total]').prop('disabled',true);                                     

                    $('.tabla_cabecera input:not(#fac):not(#ped):not(#busca_prov)').prop('disabled',true);                    
                    $('#detalle input:not(#busqueda):not(#art_cant)').prop('disabled',true);      
                    $('#compra_total input:not([name=Com_Liq5]):not([name=Com_Liq10]):not([name=Com_TotIva])').prop('disabled',true);      
				});
			</script>
            
            {{--errores campos form sin name--}}
		@endif   
@endsection

@section('navegacion_2')
        <button type="submit" class="boton" id="registrar">Registrar</button>
        <input class="boton" type="reset" id="limpiar" value="Limpiar" onclick="$('.primer').focus();" style="font-family:Raleway !important">
    {!! Form::close() !!}
        <a href="/Tazper/public/Inicio"><button class="boton lista" id="cancelar">Cancelar</button></a>
        <a href="/Tazper/public/Compras"><button class="boton lista" id="listado">Ver listado</button></a>
        
        <table class="masiva">
            <tr>
                <td>
                    <label for="masiva">Inserción masiva</label>
                    <input type="checkbox" id="masiva">
                </td>
            </tr>
        </table>
@endsection

<script src="{{asset('js/vistas/detalle/compra.js')}}"></script>
<script src="{{asset('js/vistas/detalle/compra_detalle.js')}}"></script>
<script src="{{asset('js/vistas/detalle/compra_pedido.js')}}"></script>
<script src="{{asset('js/vistas/masiva/compra.js')}}"></script>