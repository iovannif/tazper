<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tazper</title>
    <link href="{{asset('css/vistas/factura.css')}}" rel="stylesheet">
    <style>
        @page {
            margin: 0px;            
            /* width:fit-content; */
            /* font-family:arial; */            
        }
        /* @font-face{
            font-family: Raleway;
            src:url("{{asset('css/raleway.regular.ttf')}}");
        } */
        /* body{
            font-family: Raleway;
        } */
    </style>
</head>

<body>
    <div id="factura">
        <table id="contenedor">
            <!-- titulos -->
            <tr>
                <td id="izq">
                    <img class="logo" src="{{asset('images/logo.jpg')}}" width="80" style="float:left">
                     <!-- abosoluta, aplicacion -->                    
                    <table id="izq_cont"> <!-- border 0 -->                        
                        <!-- relativa, carpeta -->
                        <!-- <tr><td rowspan="4"><img class="logo" src="C:/wamp64/www/Tazper/public/images/logo.jpg" width="80"></td>
                            <td>Sublimaciones Tazper · Cel: (0985) 723 419</td>
                        </tr> -->                        
                        <tr><td style="padding-bottom:12px padding-top:4px;">Sublimaciones Tazper · Cel: (0985) 723 419</td></tr>                        
                        <tr><td style="padding-bottom:12px">facebook: Tazper multitienda · instagram: tazperhouse</td></tr>
                        <tr><td style="padding-bottom:0">Av. Von Polesky c/ Av. Defensores del Chaco - Villa Elisa</td></tr>
                    </table>
                </td>
                <td></td> <!-- separador -->
                <td id="der">
                    <table id="der_cont">
                        <tr><td style="padding-bottom:12px; padding-top:4px;">TIMBRADO Nº: <span> 13401971 </span></td></tr>{{--$id--}}
                        <tr><td style="padding-bottom:12px">Vigencia: Inicio <span> 01/10/2019 </span> · Fin <span> 30/10/2019 </span></td></tr>
                        <tr><td style="padding-bottom:0">RUC: <span> 80041653-5 </span> · FACTURA: <span> 001 </span> - <span> 001 </span> - <span> 7777777 </span></td></tr>
                    </table>
                </td>
            </tr>
            <tr><td class="separador">&nbsp;</td></tr> <!-- separador -->
            
            <!-- cabecera -->
            <tr><td id="cabecera" colspan="3">
                <table id="cabecera_cont">
                    <tr>
                        <td class="cab_izq">Fecha de Emisión: <span> 06/04/2020 </span></td>
                        <td>Condición de Venta: Contado ( <span> x </span> ) Crédito ( <span> &nbsp; </span> )</td>
                    </tr>
                    <tr>
                        <td>Nombre o Razón Social: <span> Franco Salcedo </span></td>
                        <td>RUC o CI: <span> 4956723-2 </span></td>
                    </tr>
                    <tr>
                        <td>Dirección: <span> Salto del Guairá 190 c/ Lima </span> </td>
                        <td>Teléfono o Cel: <span> 0971 800 824 </span></td>
                    </tr>
                </table>
            </td></tr>
            
            <tr><td class="separador">&nbsp;</td></tr> <!-- separador -->
            <!-- detalle -->
            <tr>
            <td id="contenido" colspan="3">
                <table border="0" id="tabla_det">
                    <tr id="head">
                        <td colspan="3">Art.</td>
                        <td colspan="5">Precio Unitario</td> <!-- 5 col -->
                        <td colspan="3">Valor de Venta</td> <!-- 3 col -->
                    </tr>
                    <tr id="head2">
                        <td rowspan="2">Cód.</td> <!-- 2 row -->
                        <td rowspan="2">Cant.</td> <!-- 2 row -->
                        <td rowspan="2">Descripción</td> <!-- 2 row -->
                        <td rowspan="2">Normal</td>                        
                        <td colspan="3">Descuento</td>
                        <td rowspan="2">Saldo</td>
                        <td rowspan="2">Exentas</td>
                        <td rowspan="2">5%</td>
                        <td rowspan="2">10%</td>                        
                    </tr>
                    <tr id="head3">                        
                        <td>Cliente</td>
                        <td>Mayorista</td>
                        <td>Día</td>                        
                    </tr>
                    <tr class="linea">                        
                        <td class="codigo"><span> 7777 </span></td>
                        <td class="cantidad"><span> 7000 </span></td>
                        <td class="descripcion"><span> hola soy franco que tal te va?????? </span></td>
                        <td class="normal"><span> 7000000 </span></td>
                        <td class="cliente"><span> 7000000 </span></td>
                        <td class="mayorista"><span> 7000000 </span></td>
                        <td class="dia"><span> 7000000 </span></td>
                        <td class="saldo"><span> 7000000 </span></td>
                        <td class="exentas"><span> 7000000 </span></td>
                        <td class="iva5"><span> 7000000 </span></td>
                        <td class="iva10"><span> 7000000 </span></td>                    
                    </tr>
                    <tr class="linea">                        
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>                        
                    </tr>
                    <tr class="linea">                        
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>                       
                    </tr>
                    <tr class="linea">                        
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>                        
                    </tr>
                    <tr class="linea">                        
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>                        
                    </tr>
                    <tr class="linea">                        
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>                      
                    </tr>
                    <tr class="linea">                        
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>                      
                    </tr>
                    <tr class="linea">                        
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                        <td><span> &nbsp; </span></td>
                    </tr>
                    
                    <!-- total -->
                    <tr>
                        <td colspan="8" class="total" id="total1">SUBTOTALES</td>
                        <td class="sub_totales"><span> 7000000 </span></td>
                        <td class="sub_totales"><span> 7000000 </span></td>
                        <td class="sub_totales"><span> 7000000 </span></td>
                    </tr>
                    <tr>
                        <td colspan="8" class="total" id="total2">TOTAL A PAGAR GUARANÍES <span> SIETE MILLONES </span></td>
                        <td colspan="3" id="total_ef"><span> 7000000 </span></td>
                    </tr>
                    <tr>
                        <td colspan="11" class="total" id="total3">
                            LIQUIDACIÓN DEL IVA: (5%) <span> 7000000 </span>
                            (10%) <span> 7000000 </span>
                            TOTAL IVA: <span> 7000000 </span>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
        </table>
    </div>
</body>
</html>