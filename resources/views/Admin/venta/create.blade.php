@extends('Admin.lay.Transaccion')

@section('titulo')
    Registrar Venta
@endsection

<style>
    #navegacion_1{
        display:none;
    }

    /* #cabecera{
        width:fit-content;
    }

    .tabla_cabecera td{
        padding-bottom:4px;
    }

    .tabla_cabecera input{
        margin-right:6px !important;
        margin-left:2px;
        padding-left:4px !important;
    } */
</style>

@section('cabecera')
    {!! Form::open(['url'=>'/Ventas', 'method'=>'post']) !!}
        {{csrf_field()}}
        <table class="tabla_cabecera">
            <tr class="primera">
                <td>
                    Fecha: <input type="text" size="10" value="{{date('d/m/y')}}" disabled>
                    Hora: <input type="text" size="5" value="{{date('H:i')}}" disabled>
                    Sucursal: <input type="text" size="4" value="1" disabled>
                    Expedición: <input type="text" size="4" value="1" disabled>
                    Arqueo: <input type="text" size="4" value="1" disabled>
                    Caja: <input type="text" size="4" value="1" disabled>
                </td>
            </tr>

            <tr class="segunda">
                <td>
                    Factura Nº: <input type="text" size="15" maxlength="15" autofocus>
                    Condición de compra: <input type="text" value="{{'Contado'}}" size="10">
                    Pedido: <input type="text" size="4">
                    Orden de compra: <input type="text" size="10">
                </td>
            </tr>

            <tr class="tercera">
                <td>
                    Proveedor: <input type="text" size="20">
                    RUC: <input type="text" size="10">
                    Teléfono: <input type="text" size="10">
                    Dirección: <input type="text" size="20">
                </td>
            </tr>
        </table>
@endsection

@section('detalle')
        <div class="cont_art">
            <table id="busc_art">
                <tr>
                    <td>Artículo</td>
                    <td><input type="text" size="35"></td>
                </tr>
            </table>

            <table id="tabla_articulo">
                <tr class="head">
                    <td>Id</td>
                    <td>Descripción</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Stock</td>
                    <td>Impuesto</td>
                    <td class="blank">&nbsp;</td>
                </tr>
                
                <tr class="agregar">
                    <td><input type="text" size="4"></td>
                    <td><input type="text" size="35"></td>
                    <td><input type="text" size="7"></td>
                    <td><input type="text" size="4"></td>
                    <td><input type="text" size="4"></td>
                    <td><input type="text" size="10"></td>
                    <td><button class="botones" id="agregar" onclick="event.preventDefault();">agregar</button></td>
                    <td>
                        <!-- cantidad debe ser natural -->
                        <!-- excede stock -->
                        <!-- ya ha añadido este ítem -->
                    </td>
                </tr>
            </table>
        </div>

        <!-- transaccion ha llegado al limite de items
        puede realizar otra transaccion -->

        <table id="venta_detalle">
            <tr class="head">
                <td>Id</td>
                <td>Descripción</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Exenta</td>
                <td>5%</td>
                <td>10%</td>
                <td class="blank">&nbsp;</td>
                <td class="blank">&nbsp;</td>
                <td class="blank">&nbsp;</td>
            </tr>
            
            <tr class="linea">
                <td><input type="text" size="4"></td>
                <td><input type="text" size="35" name="Articulo_1" required></td>
                <td><input type="text" size="7" required></td>
                <td><input type="text" size="4" required></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><button class="botones" id="mas">+</button></td>
                <td><button class="botones" id="menos">-</button></td>
                <td><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" size="4"></td>
                <td><input type="text" size="35" name="Articulo_2"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="4"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><button class="botones" id="mas">+</button></td>
                <td><button class="botones" id="menos">-</button></td>
                <td><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" size="4"></td>
                <td><input type="text" size="35" name="Articulo_3"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="4"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><button class="botones" id="mas">+</button></td>
                <td><button class="botones" id="menos">-</button></td>
                <td><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" size="4"></td>
                <td><input type="text" size="35" name="Articulo_4"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="4"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><button class="botones" id="mas">+</button></td>
                <td><button class="botones" id="menos">-</button></td>
                <td><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" size="4"></td>
                <td><input type="text" size="35" name="Articulo_5"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="4"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><button class="botones" id="mas">+</button></td>
                <td><button class="botones" id="menos">-</button></td>
                <td><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" size="4"></td>
                <td><input type="text" size="35" name="Articulo_6"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="4"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><button class="botones" id="mas">+</button></td>
                <td><button class="botones" id="menos">-</button></td>
                <td><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" size="4"></td>
                <td><input type="text" size="35" name="Articulo_7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="4"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><button class="botones" id="mas">+</button></td>
                <td><button class="botones" id="menos">-</button></td>
                <td><button class="botones" id="quitar">quitar</button></td>
            </tr>

            <tr class="linea">
                <td><input type="text" size="4"></td>
                <td><input type="text" size="35" name="Articulo_8"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="4"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><button class="botones" id="mas">+</button></td>
                <td><button class="botones" id="menos">-</button></td>
                <td><button class="botones" id="quitar">quitar</button></td>
            </tr>
        </table>
@endsection

@section('total')
        <table id="venta_total">
            <tr>
                <td>Subtotales:</td>
                <td width="600">&nbsp;  </td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
                <td><input type="text" size="7"></td>
            </tr>
            <tr>
                <td>Total:</td>
                <td>guaraníes: <input type="text"></td>
                <td>&nbsp;</td>
                <td>total</td>
                <td><input type="text" size="7"></td>
            </tr>
            <tr>
                <td>Liquidación del iva:</td>
                <td>
                (5%) <input type="text">
                (10%) <input type="text">
                Total iva <input type="text">
                </td>
            </tr>
        </table>
@endsection

@section('navegacion_2')
        <button type="submit" class="boton" id="registrar">Registrar</button>
        <input class="boton" type="reset" id="limpiar" value="Limpiar">
    {!! Form::close() !!}
        <a href="/Tazper/public/Inicio"><button class="boton lista" id="cancelar">Cancelar</button></a>
        <a href="/Tazper/public/Ventas"><button class="boton lista" id="listado">Ver listado</button></a>
@endsection