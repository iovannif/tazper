@extends('Admin.lay.Transaccion')

@section('titulo')
    Registrar Pedido
@endsection

@section('cabecera')
	{!! Form::open(['url'=>'/Articulos', 'method'=>'post']) !!}
		{{csrf_field()}}
		<table class="tabla_cabecera">
            <tr class="primera">
                <td>
                    Fecha: <input type="text" size="10" name="Com_Fe" value="{{date('d/m/y')}}" disabled>
                    Hora: <input type="text" size="5" name="Com_Ho" value="{{date('H:i')}}" disabled>
                    Sucursal: <input type="text" size="4" name="Id_Suc" value="{{$sucursal}}" disabled>
                    Expedición: <input type="text" size="4" name="Id_PtoExp"  value="{{$punto}}" disabled>
                    
                </td>
            </tr>

            <tr class="segunda">
                <td>
                    Factura Nº: <input type="text" name="Com_Fac" size="7" maxlength="7" value="7777777">
                    Categoría: <input type="text" size="20">
                    Descuento: <input type="text" size="20">
                    Tipo: <input type="text" size="20">
                </td>
            </tr>

            <tr class="tercera">
                <td>
                    Cliente: <input type="text" size="20">
                    RUC: <input type="text" size="10" disabled>
                    Teléfono: <input type="text" size="10" disabled>
                    Dirección: <input type="text" size="20" disabled>
                    Id: <input type="text" name="Id_Prov" size="4" maxlength="4">
                </td>
            </tr>
        </table>
@endsection
        
@section('navegacion_2')
		<div class="arriba">
			<input class="boton" type="submit" id="registrar" value="Registrar">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="/Tazper/public/Inicio"><button class="boton lista" id="cancelar">Cancelar</button></a>
		</div>
@endsection

@section('detalle')
        <div class="cont_art">
            <table id="busc_art">
                <tr>
                    <td>Producto</td>
                    <td><input type="text" id="busqueda" size="35" maxlength="35" spellcheck="false"></td>
                </tr>
            </table>

            <div id="articulos">
            </div>

            <table id="tabla_articulo">
                <tr class="head">
                    <td>Id</td>
                    <td>Descripción</td>
                    <td>Precio</td>
                    <td>Stock</td>
                    <td>Impuesto</td>
                    <td>Cantidad</td>
                    <td class="blank">&nbsp;</td>
                </tr>
                
                <tr class="agregar">
                    <td><input type="text" id="id_art" size="4"></td>
                    <td><input type="text" id="art_des" size="35"></td>
                    <td><input type="text" id="art_pre" size="7"></td>
                    <td><input type="text" id="art_st" size="4"></td>
                    <td><input type="text" id="art_imp" size="10"></td>
                    <td><input type="text" id="art_cant" size="4"></td>
                    <td><button class="botones" id="agregar" onclick="event.preventDefault();">agregar</button></td>                    
                </tr>
            </table>
        </div>

        <!-- transaccion ha llegado al limite de items
        puede realizar otra transaccion -->

        <table id="compra_detalle">
            <tr class="head">
                <td>Id</td>
                <td>Descripción</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Importe</td>
                <td class="blank">&nbsp;</td>
                <td class="blank">&nbsp;</td>
                <td class="blank">&nbsp;</td>
            </tr>
            
            <tr class="linea">
                <td><input type="text" name="Id_Art" id="art_id_1" size="4" disabled></td>
                <td><input type="text" name="Articulo_1" id="des_art_1" size="35" required disabled></td>
                <td><input type="text" name="CD_ArtPreUn" id="pre_art_1" size="7" required disabled></td>
                <td><input type="text" name="CD_ArtCant" id="cant_art_1" size="4" required disabled></td>
                <td><input type="text" name="CD_ArtIpt" id="cant_art_1" size="4" required disabled></td>

                <td class="opciones"><button class="botones" id="mas" onclick="event.preventDefault();">+</button></td>
                <td class="opciones"><button class="botones" id="menos" onclick="event.preventDefault();">-</button></td>
                <td class="opciones"><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" name="Id_Art" id="art_id_2" size="4" disabled></td>
                <td><input type="text" name="Articulo_2" id="des_art_2" size="35" required disabled></td>
                <td><input type="text" name="CD_ArtPreUn" id="pre_art_2" size="7" required disabled></td>
                <td><input type="text" name="CD_ArtCant" id="cant_art_2" size="4" required disabled></td>
                <td><input type="text" name="CD_ArtIpt" id="cant_art_1" size="4" required disabled></td>

                <td class="opciones"><button class="botones" id="mas">+</button></td>
                <td class="opciones"><button class="botones" id="menos">-</button></td>
                <td class="opciones"><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" name="Id_Art" id="art_id_3" size="4" disabled></td>
                <td><input type="text" name="Articulo_3" id="des_art_3" size="35" required disabled></td>
                <td><input type="text" name="CD_ArtPreUn" id="pre_art_3" size="7" required disabled></td>
                <td><input type="text" name="CD_ArtCant" id="cant_art_3" size="4" required disabled></td>
                <td><input type="text" name="CD_ArtIpt" id="cant_art_1" size="4" required disabled></td>

                <td class="opciones"><button class="botones" id="mas">+</button></td>
                <td class="opciones"><button class="botones" id="menos">-</button></td>
                <td class="opciones"><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" name="Id_Art" id="art_id_4" size="4" disabled></td>
                <td><input type="text" name="Articulo_4" id="des_art_4" size="35" required disabled></td>
                <td><input type="text" name="CD_ArtPreUn" id="pre_art_4" size="7" required disabled></td>
                <td><input type="text" name="CD_ArtCant" id="cant_art_4" size="4" required disabled></td>
                <td><input type="text" name="CD_ArtIpt" id="cant_art_1" size="4" required disabled></td>

                <td class="opciones"><button class="botones" id="mas">+</button></td>
                <td class="opciones"><button class="botones" id="menos"> - </button></td>
                <td class="opciones"><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" name="Id_Art" id="art_id_5" size="4" disabled></td>
                <td><input type="text" name="Articulo_5" id="des_art_5" size="35" required disabled></td>
                <td><input type="text" name="CD_ArtPreUn" id="pre_art_5" size="7" required disabled></td>
                <td><input type="text" name="CD_ArtCant" id="cant_art_5" size="4" required disabled></td>
                <td><input type="text" name="CD_ArtIpt" id="cant_art_1" size="4" required disabled></td>

                <td class="opciones"><button class="botones" id="mas">+</button></td>
                <td class="opciones"><button class="botones" id="menos">-</button></td>
                <td class="opciones"><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" name="Id_Art" id="art_id_6" size="4" disabled></td>
                <td><input type="text" name="Articulo_6" id="des_art_6" size="35" required disabled></td>
                <td><input type="text" name="CD_ArtPreUn" id="pre_art_6" size="7" required disabled></td>
                <td><input type="text" name="CD_ArtCant" id="cant_art_6" size="4" required disabled></td>
                <td><input type="text" name="CD_ArtIpt" id="cant_art_1" size="4" required disabled></td>

                <td class="opciones"><button class="botones" id="mas">+</button></td>
                <td class="opciones"><button class="botones" id="menos">-</button></td>
                <td class="opciones"><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" name="Id_Art" id="art_id_7" size="4" disabled></td>
                <td><input type="text" name="Articulo_7" id="des_art_7" size="35" required disabled></td>
                <td><input type="text" name="CD_ArtPreUn" id="pre_art_7" size="7" required disabled></td>
                <td><input type="text" name="CD_ArtCant" id="cant_art_7" size="4" required disabled></td>
                <td><input type="text" name="CD_ArtIpt" id="cant_art_1" size="4" required disabled></td>

                <td class="opciones"><button class="botones" id="mas">+</button></td>
                <td class="opciones"><button class="botones" id="menos">-</button></td>
                <td class="opciones"><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" name="Id_Art" id="art_id_8" size="4" disabled></td>
                <td><input type="text" name="Articulo_8" id="des_art_8" size="35" required disabled></td>
                <td><input type="text" name="CD_ArtPreUn" id="pre_art_8" size="7" required disabled></td>
                <td><input type="text" name="CD_ArtCant" id="cant_art_8" size="4" required disabled></td>
                <td><input type="text" name="CD_ArtIpt" id="cant_art_1" size="4" required disabled></td>

                <td class="opciones"><button class="botones" id="mas">+</button></td>
                <td class="opciones"><button class="botones" id="menos">-</button></td>
                <td class="opciones"><button class="botones" id="quitar">quitar</button></td>
            </tr>
        </table>
@endsection

@section('total')
        <table id="compra_total">
            <tr>                
                <td width="600">&nbsp;</td>
                <td>total</td>
                <td><input type="text" name="Com_Total" size="7"></td>
            </tr>            
        </table>
@endsection

@section('navegacion_2')
        <button type="submit" class="boton" id="registrar"
        onclick="$('#des_art_1').attr('disabled',false)">
            Registrar
        </button>
        <input class="boton" type="reset" id="limpiar" value="Limpiar">
    {!! Form::close() !!}
        <a href="/Tazper/public/Inicio"><button class="boton lista" id="cancelar">Cancelar</button></a>
        <a href="/Tazper/public/Compras"><button class="boton lista" id="listado">Ver listado</button></a>
@endsection

<style>
    #content{
        padding: 10px 30px !important;
        margin: 4px 152px 10px 152px !important;        
    }

    #titulo{
        box-shadow: 0px 1px 3px 1px #000 !important;
        padding: 6px 0 !important;
        margin-right:-10px !important;
        margin-left:-10px !important;
        margin-top: 0 !important;
        margin-bottom: 8px !important;
    }
</style>

<script src="{{asset('js/create_transaccion.js')}}"></script>