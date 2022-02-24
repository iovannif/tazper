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

        .iva10,.iva5,.exenta,.saldo,.cantidad,.normal,.cliente,.mayorista,.dia,.sub_totales{
            text-align:right !important;
        }
    </style>
</head>
@include('Admin.funcion_letras')
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
                        <tr><td style="padding-bottom:12px padding-top:4px;">{{$suc->Suc_NomFan}} · Cel: {{$suc->Suc_Tel}}</td></tr>                        
                        <tr><td style="padding-bottom:12px">facebook: {{$suc->Suc_Red1}} · instagram: {{$suc->Suc_Red2}}</td></tr>
                        <tr><td style="padding-bottom:0">{{$suc->Suc_Dir}} - {{$suc->Suc_Ciu}}</td></tr>
                    </table>
                </td>
                <td></td> <!-- separador -->  
                <td id="der">
                    <table id="der_cont">
                        <tr><td style="padding-bottom:12px; padding-top:4px;">TIMBRADO Nº: <span> {{$timbrado->Timb_Num}} </span></td></tr>{{--$id--}}
                        <tr><td style="padding-bottom:12px">Vigencia: Inicio <span> {{date('d/m/Y', strtotime($timbrado->Timb_IniVig))}} </span> · Fin <span> {{date('d/m/Y', strtotime($timbrado->Timb_FinVig))}} </span></td></tr>
                        <tr><td style="padding-bottom:0">RUC: <span> {{$suc->Suc_Ruc}} </span> · FACTURA: <span> {{$suc->Suc_Cod}} </span> - <span> {{$punto->PtoExp_Cod}} </span> - <span> {{$venta->Ven_Fact}} </span></td></tr>
                    </table>
                </td>
            </tr>
            <tr><td class="separador">&nbsp;</td></tr> <!-- separador -->
            
            <!-- cabecera -->
            <tr><td id="cabecera" colspan="3">
                <table id="cabecera_cont">
                    <tr>
                        <td class="cab_izq">Fecha de Emisión: <span> {{$venta->created_at->format('d/m/Y')}} </span></td>
                        <td>Condición de Venta: Contado ( <span> x </span> ) Crédito ( <span> &nbsp; </span> )</td>
                    </tr>
                    <tr>
                        <td>Nombre o Razón Social: <span> {{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}} </span></td>
                        <td>RUC o CI: <span> {{$cliente->Cli_Ruc}} </span></td>
                    </tr>
                    <tr>
                        <td>Dirección: <span>  </span> </td>
                        <td>Teléfono o Cel: <span>  </span></td>
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

                        @php
                            $i=0;
                        @endphp

                    @foreach($detalles as $det)
                        @foreach($articulos as $articulo)          
                            @if($articulo->Id_Art==$pivot[$i]->Id_Art)
                                    <!-- descuento -->                        
                                    @php
                                        //lp
                                        if($venta->Ven_CliDesc>0){
                                            $lp = $det->VD_ArtPre * $venta->Ven_CliDesc;
                                            $lp = $lp / 100;
                                        }else{
                                            $lp='';                            
                                        }                   
                                        
                                        //dia
                                        if($det->VD_ArtDesc!=''){
                                            $dia = $det->VD_ArtPre * $det->VD_ArtDesc;
                                            $dia = $dia / 100;
                                        }else{
                                            $dia='';
                                        }  
                                        
                                        //mayorista
                                        if($det->VD_ArtCant>=15){
                                            $may = $det->VD_ArtPre * 10;
                                            $may = $may / 100;
                                        }else{
                                            $may='';
                                        }                            
                                        
                                        //saldo
                                        if($lp==''){
                                            $cat=0;
                                        }else{
                                            $cat=$lp;
                                        }
                                        if($may==''){
                                            $mayo=0;
                                        }else{
                                            $mayo=$may;
                                        }
                                        if($dia==''){
                                            $day=0;    
                                        }else{
                                            $day=$dia;
                                        }
                                        $saldo=$cat+$mayo+$day;
                                        $saldo=$det->VD_ArtPre-$saldo;
                                    @endphp

                                <tr class="linea">                        
                                    <td class="codigo"><span> {{$pivot[$i]->Id_Art}} </span></td>
                                    <td class="cantidad"><span> {{$det->VD_ArtCant}} </span></td>
                                    <td class="descripcion"><span> {{$articulo->Art_DesLar}} </span></td>
                                    <td class="normal"><span> {{number_format($det->VD_ArtPre,0,',','.')}} </span></td> 

                                    <td class="cliente"><span> @if($lp!=''){{number_format($lp,0,',','.')}}@endif </span></td>           
                                    <td class="mayorista"><span> @if($may!=''){{number_format($may,0,',','.')}}@endif </span></td>           
                                    <td class="dia"><span> @if($dia!=''){{number_format($dia,0,',','.')}}@endif </span></td>           
                                                                                                            
                                    <td class="saldo"><span> {{number_format($saldo,0,',','.')}} </span></td>           
                                    
                                    <td class="exentas"><span> @if($det->VD_ArtExen!=''){{number_format($det->VD_ArtExen,0,',','.')}}@endif </span></td>           
                                    <td class="iva5"><span> @if($det->VD_ArtIva5!=''){{number_format($det->VD_ArtIva5,0,',','.')}}@endif </span></td>           
                                    <td class="iva10"><span> @if($det->VD_ArtIva10!=''){{number_format($det->VD_ArtIva10,0,',','.')}}@endif </span></td>                                                                                                                                                           
                                </tr>
                            @endif  
                        @endforeach
                        
                            @php
                                $i++;
                            @endphp
                    @endforeach

                        @php
                            $linea=1;
                            $relleno=8-$detalles->count();
                        @endphp

                        @for($linea==1;$linea<=$relleno;$linea++)
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
                        @endfor   
                    
                    <!-- total -->
                    <tr>
                        <td colspan="8" class="total" id="total1">SUBTOTALES</td>
                        <td class="sub_totales"><span> @if($venta->Ven_StExe!=''){{number_format($venta->Ven_StExe,0,',','.')}}@endif </span></td>
                        <td class="sub_totales"><span> @if($venta->Ven_St5!=''){{number_format($venta->Ven_St5,0,',','.')}}@endif </span></td>
                        <td class="sub_totales"><span> @if($venta->Ven_St10!=''){{number_format($venta->Ven_St10,0,',','.')}}@endif </span></td>
                    </tr>
                    <tr>
                        <?php $objeto=new NumeroALetras; $letras=$objeto->convertir($venta->Ven_Tot); ?>
                        <td colspan="8" class="total" id="total2">TOTAL A PAGAR GUARANÍES <span> {{$letras}} </span></td>
                        <td colspan="3" id="total_ef"><span> Gs. {{number_format($venta->Ven_Tot,0,',','.')}} </span></td>
                    </tr>
                    <tr>
                        <td colspan="11" class="total" id="total3">
                            LIQUIDACIÓN DEL IVA: (5%) <span> @if($venta->Ven_Liq5>0){{$venta->Ven_Liq5}}@endif </span>
                            (10%) <span> @if($venta->Ven_Liq10>0){{$venta->Ven_Liq10}}@endif </span>
                            TOTAL IVA: <span> @if($venta->Ven_TotIva>0){{$venta->Ven_TotIva}}@endif </span>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
        </table>
    </div>
</body>
</html>