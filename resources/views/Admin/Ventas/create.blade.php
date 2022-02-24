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

    #content{
        width: fit-content;
        margin: auto !important;
    }
    #cabecera{
        width:unset;            
    }
    .tabla_cabecera input:not(.bottom){
        margin-bottom:5px !important;
    }

    .productos{
        left: 129px !important;
        top: 228px !important;
    }
    #proveedores{ /* cli */
        left: 128px !important;
        top: 190px !important;
        width: 285px !important;
    }
    .id{
		display:none;
	}

    .cant{
        text-align:center !important;
    }
    .menos{
        margin:0 0px !important;
    }

    .sub_tot {
        width: 857px !important;
    }
    .filler {
        width: 123px !important;
    }
    .liq_iva input{
        border: none !important;
    }

    .min{
        visibility: visible !important;
        padding-left: 100px !important;
    }

    .precio,.saldo,.exentas,.iva_5,.iva10{
        text-align:right !important;
        margin-right:5px !important;
    }    
</style>

@section('titulo')
    Realizar Venta
@endsection

@section('cabecera')    
    {!! Form::open(['id' => 'venta_form', 'url'=>'/Ventas', 'method'=>'post', 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
        {{csrf_field()}}          
         
        {{-- 
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
            
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            $validator->errors()->keys()
        @endif--}}
   
        <table class="tabla_cabecera">            
            <tr>
                <td>Fecha:</td>
                <td><input type="text" size="6" value="{{date('d/m/y')}}" disabled></td>

                <td class="col_sep">Hora:</td>
                <td><input type="text" size="4" value="{{date('H:i')}}" disabled></td>

                <td class="col_sep">Sucursal:</td>
                <td><input type="text" size="3" value="{{$sucursal->Suc_Cod}}" disabled></td>

                <td class="col_sep">Punto Exp:</td>
                <td><input type="text" size="3" value="{{$punto->PtoExp_Cod}}" disabled></td>

                <td class="col_sep">Arqueo:</td>
                <td><input type="text" size="4" value="{{$arqueo}}" disabled></td>

                <td class="col_sep">Caja:</td>
                <td><input type="text" size="3" value="{{$caja->Id_Caj}}" disabled></td>
            </tr>

            <tr>                
                <td>Venta Nº:</td>
                <td><input type="text" size="4" value="{{$venta}}" disabled></td>

                <td class="col_sep">Factura Nº:</td>
                <td>
                    <input type="text" size="7" name="Ven_Fact" value="{{str_pad($factura,7,'0',STR_PAD_LEFT)}}" disabled>
                    <input type="hidden" name="Id_Timb" size="8" value="{{$timb->Id_Timb}}" disabled>
                </td>

                <td class="col_sep">Tipo:</td>
                <td>
                    <select class="primer" name="Ven_Tip" minlength="9" maxlength="9" autofocus required>
                        <option value="Minorista">Minorista</option>
                        <option value="Mayorista">Mayorista</option>
                    </select>
                </td>                

                <td class="col_sep">Descuento:</td>
                <td>
                    <!-- Hay o No: Muestra -->
                    <input type="text" size="15" name="descuento" value="{{$descuento}}" disabled>

                    <!-- Si Hay, guarda los datos del descuento -->                     
                    <input type="hidden" name="Id_Desc" size="2" minlength="1" maxlength="2" min="1" value="{{$id_desc}}" disabled>
                    <input type="hidden" size="15" name="desc_des" value="{{$descuento}}" disabled>
                    <!-- Si no: en blanco -->

                   <!-- Si Hay, guada el % -->
                    @if($desc_det!='')
                        <input type="hidden" size="2" name="porc" value="{{$desc_det[0]->DD_Porc}}" disabled>
                    @else 
                    <!-- Si no: en blanco -->
                        <input type="hidden" size="2" name="porc" value="" disabled>
                    @endif

                    <!-- Si Hay, guarda las lineas del detalle -->
                    @if($desc_det!='')
                        <table class="hidden">
                            @foreach($desc_det as $det)
                            <tr> <!-- para: -->
                                <td><input class="desc_lp" type="text" value="{{$det->Id_Lp}}" disabled></td> <!-- los lp -->
                                <td><input class="desc_cli" type="text" value="{{$det->Id_Cli}}" disabled></td> <!-- los cli -->
                                <td><input class="desc_art" type="text" value="{{$det->Id_Art}}" disabled></td> <!-- los prod -->
                                <td><input class="desc_cat" type="text" value="{{$det->Id_Cat}}" disabled></td> <!-- las cat -->
                                <td><input class="desc_porc" type="text" value="{{$det->DD_Porc}}" disabled></td> <!-- el % para todos -->                                                                    
                            </tr>
                            @endforeach
                        </table>
                    @endif <!-- Si No, no -->
                </td>
                
                <td class="col_sep">Condición:</td>
                <td>
                    <select>
                        <option value="Contado">Contado</option>
                    </select>
                </td>

                <td class="col_sep">Medio:</td>
                <td colspan="2">                    
                    <select name="Id_MedPag" minlength="1" maxlength="2" min="1" value="{{old('Id_MedPag')}}" required>
                        @foreach($med_pag as $medio)
                        <option value="{{$medio->Id_MedPag}}">{{$medio->MedPag_Des}}</option>
                        @endforeach                        
                    </select>
                </td>                
            </tr>

                <div id="proveedor"> <!-- cuadro -->
                </div>  
            
            <tr>                
                <td>Cliente:</td>
                <td colspan="3"><input type="text" class="bottom" id="busca_prov" name="cli_nom" size="35" maxlength="40" maxlength="1" value="{{old('cli_nom')}}" required></td>

                <td class="col_sep">Ruc:</td>
                <td><input type="text" name="cli_ruc" class="bottom" size="10" value="{{old('cli_ruc')}}" disabled></td>

                <td class="col_sep">Categoría:</td>
                <td>
                    <input type="text" name="cli_cat" class="bottom" size="15" value="{{old('cli_cat')}}" disabled>
                    <input type="hidden" name="cli_lp" class="bottom" size="1" value="{{old('cli_lp')}}" disabled>
                </td>

                <td class="col_sep">Descuento:</td>
                <td><input type="text" name="cli_desc" class="bottom" size="3" value="{{old('cli_desc')}}" disabled></td>

                <td class="col_sep">Id:</td>
                <td><input type="text" name="Id_Cli" class="bottom" size="3" minlength="1" maxlength="2" min="1" value="{{old('Id_Cli')}}" disabled></td>

                <td class="col_sep">Pedido:</td>
                <td><input type="text" name="Id_PedCli" id="ped" class="bottom" size="3" minlength="1" maxlength="4" min="1" value="{{old('Id_PedCli')}}"></td>

                <div id="pedido"> <!-- cuadro -->
                </div>  
            </tr>
        </table>
@endsection

@section('detalle')
        <div class="cont_art">
            <table id="busc_art">
                <tr>
                    <td id="articulo">Producto:</td>
                    <td><input type="text" id="busqueda" size="30" maxlength="35" disabled></td>
                </tr>
            </table>

            <div id="articulos"> <!-- cuadro -->
            </div>

            <table id="tabla_articulo">
                <tr>	
                    <td id="aviso" class="help-block" colspan="3">											                    
                    @if($errors->has('Id_Art_1'))
                        {{'Es obligatario al menos un producto para continuar'}}                                                                    
                    @else
                        @if($errors->has('Art_Cant_1'))
                            {{'Error en la cantidad de producto, línea 1'}}                                                
                        @elseif($errors->has('Art_Cant_2'))
                            {{'Error en la cantidad de producto, línea 2'}}                                                
                        @elseif($errors->has('Art_Cant_3'))
                            {{'Error en la cantidad de producto, línea 3'}}                                                
                        @elseif($errors->has('Art_Cant_4'))
                            {{'Error en la cantidad de producto, línea 4'}}                                                
                        @elseif($errors->has('Art_Cant_5'))
                            {{'Error en la cantidad de producto, línea 5'}}                                                
                        @elseif($errors->has('Art_Cant_6'))
                            {{'Error en la cantidad de producto, línea 6'}}                                                
                        @elseif($errors->has('Art_Cant_7'))
                            {{'Error en la cantidad de producto, línea 7'}}                                                
                        @elseif($errors->has('Art_Cant_8'))
                            {{'Error en la cantidad de producto, línea 8'}}                                                                                                                       
                        @else
                            {{'&nbsp;'}}                           
                        @endif                                                 
                    @endif 
                    </td>                    
                </tr>

                <tr class="head">
                    <td>Id Art</td>				
                    <td>Descripción</td>
                    <td>Precio</td>
                    <td>Stock</td>
                    <td>Impuesto</td>                    								                    
                    <td style="border-right: 1px solid lightgrey;">Cantidad</td>	
                </tr>
                
                <tr class="agregar">
                    <td><input type="text" id="id_art" size="4" disabled></td>				
                    <td>
                        <input type="text" id="art_des" size="35" disabled>
                        <input type="hidden" id="art_cat" size="20" disabled>
                    </td>                    
                    <td>
                        <input type="text" id="art_pre" size="7" disabled>
                        <input type="hidden" id="art_cost" size="7" disabled>
                    </td>
                    <td><input type="text" id="art_st" size="5" disabled></td>										
                    <td><input type="text" id="art_imp" size="8" disabled></td>
                    <td><input type="number" id="art_cant" min="1" max="9999" style="width:86px;" onKeyPress="if(this.value.length==4) return false;"></td>				                    
                    <td class="td_agregar"><button class="botones" id="agregar">agregar</button></td>                    
                </tr>
            </table>
        </div>        

        <!-- transaccion ha llegado al limite de items, puede realizar otra transaccion -->

        <table class="detalle">            
			<tr class="head">
                <td rowspan="2">Id Art</td>		
                <td rowspan="2">Cant.</td>				
				<td rowspan="2">Descripción</td>					
                <td rowspan="2">Precio</td>	
                <td colspan="4">Descuento</td>								
                <td rowspan="2">Exentas</td>					
                <td rowspan="2">5%</td>					
                <td rowspan="2">10%</td>												
            </tr>
            <tr class="head">
                <td>Cliente</td>				
                <td>Mayorista</td>		
                <td>Día</td>		
                <td>Saldo</td>														
			</tr>
			
			<tr class="linea linea_1">
				<td><input type="text" id="art_id_1" name="Id_Art_1" class="art" size="4" value="{{old('Id_Art_1')}}" required disabled></td>
                <td><input type="text" id="cant_art_1" name="Art_Cant_1" class="cant" size="4" value="{{old('Art_Cant_1')}}" required disabled></td>
                <td><input type="text" id="des_art_1" name="Des_Art_1" size="35" value="{{old('Des_Art_1')}}" disabled></td>
                <td>
                    <input type="text" id="pre_1" name="Pre_Art_1" class="precio" size="6" value="{{old('Pre_Art_1')}}" disabled>
                    <input type="hidden" id="cost_1" name="Cost_Art_1" class="costo" size="7" value="{{old('Cost_Art_1')}}" disabled>
                </td>
                <input type="hidden" id="stock_1" name="Stock_1" class="stock" size="4" value="{{old('Stock_1')}}" disabled>
                <input type="hidden" id="cat_1" name="Cat_1" class="cat" size="20" value="{{old('Cat_1')}}" disabled>
                
                <td><input type="text" id="lp_1" name="Art_Lp_1" size="3" value="{{old('Art_Lp_1')}}" disabled></td>
                <td><input type="text" class="may" id="may_1" name="Art_May_1" size="3" value="{{old('Art_May_1')}}" disabled></td>
                <td><input type="text" id="dia_1" name="Art_Dia_1" size="3" value="{{old('Art_Dia_1')}}" disabled></td>
                <td><input type="text" class="saldo" id="saldo_1" name="Art_Sal_1" size="6" value="{{old('Art_Sal_1')}}" disabled></td>
                
                <td>
                    <input type="text" class="exentas" id="exen_1" name="Art_Exen_1" size="7" value="{{old('Art_Exen_1')}}" disabled>
                    <input type="hidden" class="cost_exentas" id="cost_exen_1" name="ArtCost_Exen_1" size="7" value="{{old('ArtCost_Exen_1')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva_5" id="iva5_1" name="Art_Iva5_1" size="6" value="{{old('Art_Iva5_1')}}" disabled>
                    <input type="hidden" class="cost_iva_5" id="cost_iva5_1" name="ArtCost_Iva5_1" size="7" value="{{old('ArtCost_Iva5_1')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva10" id="iva10_1" name="Art_Iva10_1" size="6" value="{{old('Art_Iva10_1')}}" disabled>
                    <input type="hidden" class="cost_iva10" id="cost_iva10_1" name="ArtCost_Iva10_1" size="7" value="{{old('ArtCost_Iva10_1')}}" disabled>
                </td>

                <td class="opciones"><button class="botones mas" id="mas_1">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_1">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_1">quitar</button></td>
            </tr>
            
            <tr class="linea linea_2">
				<td><input type="text" id="art_id_2" name="Id_Art_2" class="art" size="4" value="{{old('Id_Art_2')}}" disabled></td>
                <td><input type="text" id="cant_art_2" name="Art_Cant_2" class="cant" size="4" value="{{old('Art_Cant_2')}}" disabled></td>
                <td><input type="text" id="des_art_2" name="Des_Art_2" size="35" value="{{old('Des_Art_2')}}" disabled></td>
                <td>
                    <input type="text" id="pre_2" class="precio" name="Pre_Art_2" size="6" value="{{old('Pre_Art_2')}}" disabled>
                    <input type="hidden" id="cost_2" class="costo" name="Cost_Art_2" size="7" value="{{old('Cost_Art_2')}}" disabled>
                </td>
                <input type="hidden" id="stock_2" name="Stock_2" class="stock" size="4" value="{{old('Stock_2')}}" disabled>
                <input type="hidden" id="cat_2" name="Cat_2" class="cat" size="20" value="{{old('Cat_2')}}" disabled>
                
                <td><input type="text" id="lp_2" name="Art_Lp_2" size="3" value="{{old('Art_Lp_2')}}" disabled></td>
                <td><input type="text" class="may" id="may_2" name="Art_May_2" size="3" value="{{old('Art_May_2')}}" disabled></td>
                <td><input type="text" id="dia_2" name="Art_Dia_2" size="3" value="{{old('Art_Dia_2')}}" disabled></td>
                <td><input type="text" class="saldo" id="saldo_2" name="Art_Sal_2" size="6" value="{{old('Art_Sal_2')}}" disabled></td>                
                
                <td>
                    <input type="text" class="exentas" id="exen_2" name="Art_Exen_2" size="7" value="{{old('Art_Exen_2')}}" disabled>
                    <input type="hidden" class="cost_exentas" id="cost_exen_2" name="ArtCost_Exen_2" size="7" value="{{old('ArtCost_Exen_2')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva_5" id="iva5_2" name="Art_Iva5_2" size="6" value="{{old('Art_Iva5_2')}}" disabled>
                    <input type="hidden" class="cost_iva_5" id="cost_iva5_2" name="ArtCost_Iva5_2" size="7" value="{{old('ArtCost_Iva5_2')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva10" id="iva10_2" name="Art_Iva10_2" size="6" value="{{old('Art_Iva10_2')}}" disabled>
                    <input type="hidden" class="cost_iva10" id="cost_iva10_2" name="ArtCost_Iva10_2" size="7" value="{{old('ArtCost_Iva10_2')}}" disabled>
                </td>

                <td class="opciones"><button class="botones mas" id="mas_2">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_2">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_2">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_3">
				<td><input type="text" id="art_id_3" name="Id_Art_3" class="art" size="4" value="{{old('Id_Art_3')}}" disabled></td>
                <td><input type="text" id="cant_art_3" name="Art_Cant_3" class="cant" size="4" value="{{old('Art_Cant_3')}}" disabled></td>
                <td><input type="text" id="des_art_3" name="Des_Art_3" size="35" value="{{old('Des_Art_3')}}" disabled></td>
                <td>
                    <input type="text" id="pre_3" class="precio" name="Pre_Art_3" size="6" value="{{old('Pre_Art_3')}}" disabled>
                    <input type="hidden" id="cost_3" class="costo" name="Cost_Art_3" size="7" value="{{old('Cost_Art_3')}}" disabled>
                </td>
                <input type="hidden" id="stock_3" name="Stock_3" class="stock" size="4" value="{{old('Stock_3')}}" disabled>
                <input type="hidden" id="cat_3" name="Cat_3" class="cat" size="20" value="{{old('Cat_3')}}" disabled>
                
                <td><input type="text" id="lp_3" name="Art_Lp_3" size="3" value="{{old('Art_Lp_3')}}" disabled></td>
                <td><input type="text" class="may" id="may_3" name="Art_May_3" size="3" value="{{old('Art_May_3')}}" disabled></td>
                <td><input type="text" id="dia_3" name="Art_Dia_3" size="3" value="{{old('Art_Dia_3')}}" disabled></td>
                <td><input type="text" class="saldo" id="saldo_3" name="Art_Sal_3" size="6" value="{{old('Art_Sal_3')}}" disabled></td>
                
                <td>
                    <input type="text" class="exentas" id="exen_3" name="Art_Exen_3" size="7" value="{{old('Art_Exen_3')}}" disabled>
                    <input type="hidden" class="cost_exentas" id="cost_exen_3" name="ArtCost_Exen_3" size="7" value="{{old('ArtCost_Exen_3')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva_5" id="iva5_3" name="Art_Iva5_3" size="6" value="{{old('Art_Iva5_3')}}" disabled>
                    <input type="hidden" class="cost_iva_5" id="cost_iva5_3" name="ArtCost_Iva5_3" size="7" value="{{old('ArtCost_Iva5_3')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva10" id="iva10_3" name="Art_Iva10_3" size="6" value="{{old('Art_Iva10_3')}}" disabled>
                    <input type="hidden" class="cost_iva10" id="cost_iva10_3" name="ArtCost_Iva10_3" size="7" value="{{old('ArtCost_Iva10_3')}}" disabled>
                </td>

                <td class="opciones"><button class="botones mas" id="mas_3">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_3">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_3">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_4">
				<td><input type="text" id="art_id_4" name="Id_Art_4" class="art" size="4" value="{{old('Id_Art_4')}}" disabled></td>
                <td><input type="text" id="cant_art_4" name="Art_Cant_4" class="cant" size="4" value="{{old('Art_Cant_4')}}" disabled></td>
                <td><input type="text" id="des_art_4" name="Des_Art_4" size="35" value="{{old('Des_Art_4')}}" disabled></td>
                <td>
                    <input type="text" id="pre_4" class="precio" name="Pre_Art_4" size="6" value="{{old('Pre_Art_4')}}" disabled>
                    <input type="hidden" id="cost_4" class="costo" name="Cost_Art_4" size="7" value="{{old('Cost_Art_4')}}" disabled>
                </td>
                <input type="hidden" id="stock_4" name="Stock_4" class="stock" size="4" value="{{old('Stock_4')}}" disabled>
                <input type="hidden" id="cat_4" name="Cat_4" class="cat" size="20" value="{{old('Cat_4')}}" disabled>
                
                <td><input type="text" id="lp_4" name="Art_Lp_4" size="3" value="{{old('Art_Lp_4')}}" disabled></td>
                <td><input type="text" class="may" id="may_4" name="Art_May_4" size="3" value="{{old('Art_May_4')}}" disabled></td>
                <td><input type="text" id="dia_4" name="Art_Dia_4" size="3" value="{{old('Art_Dia_4')}}" disabled></td>
                <td><input type="text" class="saldo" id="saldo_4" name="Art_Sal_4" size="6" value="{{old('Art_Sal_4')}}" disabled></td>
				
                <td>
                    <input type="text" class="exentas" id="exen_4" name="Art_Exen_4" size="7" value="{{old('Art_Exen_4')}}" disabled>
                    <input type="hidden" class="cost_exentas" id="cost_exen_4" name="ArtCost_Exen_4" size="7" value="{{old('ArtCost_Exen_4')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva_5" id="iva5_4" name="Art_Iva5_4" size="6" value="{{old('Art_Iva5_4')}}" disabled>
                    <input type="hidden" class="cost_iva_5" id="cost_iva5_4" name="ArtCost_Iva5_4" size="7" value="{{old('ArtCost_Iva5_4')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva10" id="iva10_4" name="Art_Iva10_4" size="6" value="{{old('Art_Iva10_4')}}" disabled>
                    <input type="hidden" class="cost_iva10" id="cost_iva10_4" name="ArtCost_Iva10_4" size="7" value="{{old('ArtCost_Iva10_4')}}" disabled>
                </td>

                <td class="opciones"><button class="botones mas" id="mas_4">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_4">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_4">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_5">
				<td><input type="text" id="art_id_5" name="Id_Art_5" class="art" size="4" value="{{old('Id_Art_5')}}" disabled></td>
                <td><input type="text" id="cant_art_5" name="Art_Cant_5" class="cant" size="4" value="{{old('Art_Cant_5')}}" disabled></td>
                <td><input type="text" id="des_art_5" name="Des_Art_5" size="35" value="{{old('Des_Art_5')}}" disabled></td>
                <td>
                    <input type="text" id="pre_5" class="precio" name="Pre_Art_5" size="6" value="{{old('Pre_Art_5')}}" disabled>
                    <input type="hidden" id="cost_5" class="costo" name="Cost_Art_5" size="7" value="{{old('Cost_Art_5')}}" disabled>
                </td>
                <input type="hidden" id="stock_5" name="Stock_5" class="stock" size="4" value="{{old('Stock_5')}}" disabled>
                <input type="hidden" id="cat_5" name="Cat_5" class="cat" size="20" value="{{old('Cat_5')}}" disabled>
                
                <td><input type="text" id="lp_5" name="Art_Lp_5" size="3" value="{{old('Art_Lp_5')}}" disabled></td>
                <td><input type="text" class="may" id="may_5" name="Art_May_5" size="3" value="{{old('Art_May_5')}}" disabled></td>
                <td><input type="text" id="dia_5" name="Art_Dia_5" size="3" value="{{old('Art_Dia_5')}}" disabled></td>
                <td><input type="text" class="saldo" id="saldo_5" name="Art_Sal_5" size="6" value="{{old('Art_Sal_5')}}" disabled></td>
				
                <td>
                    <input type="text" class="exentas" id="exen_5" name="Art_Exen_5" size="7" value="{{old('Art_Exen_5')}}" disabled>
                    <input type="hidden" class="cost_exentas" id="cost_exen_5" name="ArtCost_Exen_5" size="7" value="{{old('ArtCost_Exen_5')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva_5" id="iva5_5" name="Art_Iva5_5" size="6" value="{{old('Art_Iva5_5')}}" disabled>
                    <input type="hidden" class="cost_iva_5" id="cost_iva5_5" name="ArtCost_Iva5_5" size="7" value="{{old('ArtCost_Iva5_5')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva10" id="iva10_5" name="Art_Iva10_5" size="6" value="{{old('Art_Iva10_5')}}" disabled>
                    <input type="hidden" class="cost_iva10" id="cost_iva10_5" name="ArtCost_Iva10_5" size="7" value="{{old('ArtCost_Iva10_5')}}" disabled>
                </td>

                <td class="opciones"><button class="botones mas" id="mas_5">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_5">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_5">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_6">
				<td><input type="text" id="art_id_6" name="Id_Art_6" class="art" size="4" value="{{old('Id_Art_6')}}" disabled></td>
                <td><input type="text" id="cant_art_6" name="Art_Cant_6" class="cant" size="4" value="{{old('Art_Cant_6')}}" disabled></td>
                <td><input type="text" id="des_art_6" size="35" name="Des_Art_6" value="{{old('Des_Art_6')}}" disabled></td>
                <td>
                    <input type="text" id="pre_6" class="precio" name="Pre_Art_6" size="6" value="{{old('Pre_Art_6')}}" disabled>
                    <input type="hidden" id="cost_6" class="costo" name="Cost_Art_6" size="7" value="{{old('Cost_Art_6')}}" disabled>
                </td>
                <input type="hidden" id="stock_6" name="Stock_6" class="stock" size="4" value="{{old('Stock_6')}}" disabled>
                <input type="hidden" id="cat_6" name="Cat_6" class="cat" size="20" value="{{old('Cat_6')}}" disabled>
                
                <td><input type="text" id="lp_6" name="Art_Lp_6" size="3" value="{{old('Art_Lp_6')}}" disabled></td>
                <td><input type="text" class="may" id="may_6" name="Art_May_6" size="3" value="{{old('Art_May_6')}}" disabled></td>
                <td><input type="text" id="dia_6" name="Art_Dia_6" size="3" value="{{old('Art_Dia_6')}}" disabled></td>
                <td><input type="text" class="saldo" id="saldo_6" name="Art_Sal_6" size="6" value="{{old('Art_Sal_6')}}" disabled></td>
                
                <td>
                    <input type="text" class="exentas" id="exen_6" name="Art_Exen_6" size="7" value="{{old('Art_Exen_6')}}" disabled>
                    <input type="hidden" class="cost_exentas" id="cost_exen_6" name="ArtCost_Exen_6" size="7" value="{{old('ArtCost_Exen_6')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva_5" id="iva5_6" name="Art_Iva5_6" size="6" value="{{old('Art_Iva5_6')}}" disabled>
                    <input type="hidden" class="cost_iva_5" id="cost_iva5_6" name="ArtCost_Iva5_6" size="7" value="{{old('ArtCost_Iva5_6')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva10" id="iva10_6" name="Art_Iva10_6" size="6" value="{{old('Art_Iva10_6')}}" disabled>
                    <input type="hidden" class="cost_iva10" id="cost_iva10_6" name="ArtCost_Iva10_6" size="7" value="{{old('ArtCost_Iva10_6')}}" disabled>
                </td>

                <td class="opciones"><button class="botones mas" id="mas_6">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_6">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_6">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_7">
				<td><input type="text" id="art_id_7" name="Id_Art_7" class="art" size="4" value="{{old('Id_Art_7')}}" disabled></td>
                <td><input type="text" id="cant_art_7" name="Art_Cant_7" class="cant" size="4" value="{{old('Art_Cant_7')}}" disabled></td>
                <td><input type="text" id="des_art_7" size="35" name="Des_Art_7" value="{{old('Des_Art_7')}}" disabled></td>
				<td>
                    <input type="text" id="pre_7" class="precio" name="Pre_Art_7" size="6" value="{{old('Pre_Art_7')}}" disabled>
                    <input type="hidden" id="cost_7" class="costo" name="Cost_Art_7" size="7" value="{{old('Cost_Art_7')}}" disabled>
                </td>
                
                <td><input type="text" id="lp_7" name="Art_Lp_7" size="3" value="{{old('Art_Lp_7')}}" disabled></td>
                <td><input type="text" class="may" id="may_7" name="Art_May_7" size="3" value="{{old('Art_May_7')}}" disabled></td>
                <td><input type="text" id="dia_7" name="Art_Dia_7" size="3" value="{{old('Art_Dia_7')}}" disabled></td>
                <td><input type="text" class="saldo" id="saldo_7" name="Art_Sal_7" size="6" value="{{old('Art_Sal_7')}}" disabled></td>                
                <input type="hidden" id="stock_7" name="Stock_7" class="stock" size="4" value="{{old('Stock_7')}}" disabled>
                <input type="hidden" id="cat_7" name="Cat_7" class="cat" size="20" value="{{old('Cat_7')}}" disabled>
                
                <td>
                    <input type="text" class="exentas" id="exen_7" name="Art_Exen_7" size="7" value="{{old('Art_Exen_7')}}" disabled>
                    <input type="hidden" class="cost_exentas" id="cost_exen_7" name="ArtCost_Exen_7" size="7" value="{{old('ArtCost_Exen_7')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva_5" id="iva5_7" name="Art_Iva5_7" size="6" value="{{old('Art_Iva5_7')}}" disabled>
                    <input type="hidden" class="cost_iva_5" id="cost_iva5_7" name="ArtCost_Iva5_7" size="7" value="{{old('ArtCost_Iva5_7')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva10" id="iva10_7" name="Art_Iva10_7" size="6" value="{{old('Art_Iva10_7')}}" disabled>
                    <input type="hidden" class="cost_iva10" id="cost_iva10_7" name="ArtCost_Iva10_7" size="7" value="{{old('ArtCost_Iva10_7')}}" disabled>
                </td>

                <td class="opciones"><button class="botones mas" id="mas_7">+</button></td>
                <td class="opciones"><button class="botones menos" id="menos_7">-</button></td>
				<td class="td_quitar"><button class="botones quitar" id="quitar_7">quitar</button></td>
            </tr>	
            
            <tr class="linea linea_8">
				<td><input type="text" id="art_id_8" name="Id_Art_8" class="art" size="4" value="{{old('Id_Art_8')}}" disabled></td>
                <td><input type="text" id="cant_art_8" name="Art_Cant_8" class="cant" size="4" value="{{old('Art_Cant_8')}}" disabled></td>
                <td><input type="text" id="des_art_8" size="35" name="Des_Art_8" value="{{old('Des_Art_8')}}" disabled></td>
				<td>
                    <input type="text" id="pre_8" class="precio" name="Pre_Art_8" size="6" value="{{old('Pre_Art_8')}}" disabled>
                    <input type="hidden" id="cost_8" class="costo" name="Cost_Art_8" size="7" value="{{old('Cost_Art_8')}}" disabled>
                </td>
                
                <td><input type="text" id="lp_8" name="Art_Lp_8" size="3" value="{{old('Art_Lp_8')}}" disabled></td>
                <td><input type="text" class="may" id="may_8" name="Art_May_8" size="3" value="{{old('Art_May_8')}}" disabled></td>
                <td><input type="text" id="dia_8" name="Art_Dia_8" size="3" value="{{old('Art_Dia_8')}}" disabled></td>
                <td><input type="text" class="saldo" id="saldo_8" name="Art_Sal_8" size="6" value="{{old('Art_Sal_8')}}" disabled></td>
                <input type="hidden" id="stock_8" name="Stock_8" class="stock" size="4" value="{{old('Stock_8')}}" disabled>
                <input type="hidden" id="cat_8" name="Cat_8" class="cat" size="20" value="{{old('Cat_8')}}" disabled>
                
                <td>
                    <input type="text" class="exentas" id="exen_8" name="Art_Exen_8" size="7" value="{{old('Art_Exen_8')}}" disabled>
                    <input type="hidden" class="cost_exentas" id="cost_exen_8" name="ArtCost_Exen_8" size="7" value="{{old('ArtCost_Exen_8')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva_5" id="iva5_8" name="Art_Iva5_8" size="6" value="{{old('Art_Iva5_8')}}" disabled>
                    <input type="hidden" class="cost_iva_5" id="cost_iva5_8" name="ArtCost_Iva5_8" size="7" value="{{old('ArtCost_Iva5_8')}}" disabled>
                </td>
                <td>
                    <input type="text" class="iva10" id="iva10_8" name="Art_Iva10_8" size="6" value="{{old('Art_Iva10_8')}}" disabled>
                    <input type="hidden" class="cost_iva10" id="cost_iva10_8" name="ArtCost_Iva10_8" size="7" value="{{old('ArtCost_Iva10_8')}}" disabled>
                </td>

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
                <td class="tot_let" colspan="2">
                    Total: guaraníes <input type="text" size="60" disabled>
                    
                    <span class="help-block min">
                    @if($errors->has('Com_Total'))                            
                        {{$errors->first('Com_Total')}}
                    @endif
                    </span>
                </td>                
                
                <td class="tot">Total</td>
                <td><input type="text" name="Com_Total" size="7" value="{{old('Com_Total')}}" required disabled></td>
                <td class="filler"></td>
            </tr>

            <tr>
                <td colspan="1" class="liq_iva">Liquidación del IVA:
                (5%) <input type="number" id="liq5" name="Com_Liq5" max="9999999" min="0" value="{{old('Com_Liq5')}}" disabled>
                (10%) <input type="number" id="liq10" name="Com_Liq10" max="9999999" min="0" value="{{old('Com_Liq10')}}" disabled> 
                Total IVA <input type="number" id="totiva" name="Com_TotIva" max="9999999" min="0" value="{{old('Com_TotIva')}}" disabled>
                </td>
                
                <td colspan="2" style="text-align:center; border-bottom:none">Recibido 
                    <input type="number" id="mont_rec" name="Mont_Rec" size="7" max="9999999" value="{{old('Mont_Rec')}}" onKeyPress="if(this.value.length==7) return false;" style="width:88px; border: 1px solid #999999;">
                </td>                         
                <td colspan="2" style="text-align:center; border-bottom:none">Cambio <input size="7" id="vuelto" name="Vuelto" value="{{old('Vuelto')}}" disabled></td>                                          
            </tr>
        </table>

        @if($errors->any())		
			<script>
				window.addEventListener("load", function(){                    
                    $('.tabla_cabecera input:not(#busca_prov):not(#ped)').prop('disabled',true);                    
                    $('#detalle input:not(#busqueda):not(#art_cant)').prop('disabled',true);      
                    $('#compra_total input:not([name=Mont_Rec])').prop('disabled',true);      
				});
			</script>                        
		@endif   
@endsection

@section('navegacion_2')
        <button type="submit" class="boton" id="registrar" onclick="
            event.preventDefault();
            if($('#art_id_1').val()!=''){                
                $('#venta_form').submit();
            }
        ">Registrar</button>
        <input class="boton" type="reset" id="limpiar" value="Limpiar" onclick="$('.primer').focus();" style="font-family:Raleway !important">
    {!! Form::close() !!}
        <a href="/Tazper/public/Inicio"><button class="boton lista" id="cancelar">Cancelar</button></a>
        <a href="/Tazper/public/Ventas"><button class="boton lista" id="listado">Ver listado</button></a>                
@endsection

<script src="{{asset('js/vistas/detalle/venta.js')}}"></script>
<script src="{{asset('js/vistas/detalle/venta_detalle.js')}}"></script>
<script src="{{asset('js/vistas/detalle/venta_pedido.js')}}"></script>