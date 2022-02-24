<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tazper</title>
    <style>
        body{
            font-family:arial;
            font-size:13px;
        }

        #factura{
            padding:.3cm;
            border:1px dotted gray;
            width: fit-content;
            /* margin:auto; */
        }

        table, tr, td{
            margin:0;
            padding:0;            
        }

        #izq,#der, #cabecera, #contenido
        {
            border:1px solid black;
            border-radius:4px;            
        }

        #izq, #der{
            padding: 5px;
        }

        #izq_cont, #der_cont{
            border-collapse:collapse;
            text-align:center;
        }

        .logo{
            border-radius:5%;
            display:table-cell;
            opacity: .8;
        }

        #cabecera{
            padding: 3px 7px;
        }

        #cabecera_cont{
            border-collapse:collapse;
            width:100%;
            height:65px;
        }

        .cab_izq{
            width:430px;        
        }

        #der_cont{
            height:80px;
        }

        .pad{
            padding-left:5px;
        }

        span{
            color:gray;
        }

        .separador{
            height:1px;
            font-size:1px;
        }

        #tabla_det{
            border-collapse:collapse;
        }

        #tabla_det td:last-child{
            border-right:none;
        }

        #tabla_det{
            height:fit-content;
            text-align:center;
            width:100%;
        }

        #head td, #head2 td, #head3 td{
            border-bottom:1px solid black;
            border-right:1px solid black;
            background:#CF0000;
            opacity: .9;
            color:white;
        }

        #head2 td:nth-child(5){
            border-right:none;
        }

        #head2 td:nth-child(4){
            border-right:none;
        }

        #head3 td:nth-child(1),
        #head3 td:nth-child(2),
        #head3 td:nth-child(3){
            border-right:none;
        }
        
        .linea td{        
            border-right:1px solid black;
            padding: 2px 0;
            vertical-align:top;
        }

        .linea td:nth-child(4), .linea td:nth-child(5),
        .linea td:nth-child(6), .linea td:nth-child(7)
        {        
            border:none;
        }

        .codigo{
            width: 31px;
        }
        .cantidad{
            width: 34px;
        }
        .descripcion{
            width: 221px;
        }
        .normal{
            width: 54px;
        }
        .cliente{
            width: 55px;
        }
        .mayorista{
            width: 61px;
        }
        .dia{
            width: 55px;
        }
        .saldo{
            width: 55px;
        }
        .exentas{
            width: 55px;
        }
        .iva5{
            width: 56px;
        }
        .iva10{
            width: 58px;
        }

        #totales{
            border-collapse:collapse;
            width:100%;
        }

        #totales td{
            border-bottom:1px solid black;
            border-right:1px solid black;
            padding-left: 6px;
        }

        #totales tr:last-child td{
            border-bottom: none;
        }
        #totales td:last-child{
            border-right: none;
        }

        .total{        
            text-align:left;
            padding: 2px 6px;
        }

        .sub_totales{
            padding-right:0;
        }

        #total1{
            border-top:1px solid black;
            border-right:1px solid black;
        }

        #total2,#total3{
            border-top:1px solid black;
        }

        #total3 span{
            margin-right:80px;
            margin-left:5px;
        }    

        .sub_totales{
            border-top:1px solid black;border-right:1px solid black;
        }

        .sub_totales:last-child{
            border-right:none;
        }

        #total_ef{
            border-top:1px solid black;
            text-align:right;
            padding-right:6px;
        }

        /* span{
            border:1px solid green;
        } */
        .iva10,.iva5,.exenta,.saldo,.cantidad,.normal,.cliente,.mayorista,.dia,.sub_totales{
            text-align:right !important;
        }
        .cantidad span{
            margin-right:3px;
        }
    </style>
</head>

<body>
    <div id="factura">
        <table id="contenedor">
            <!-- titulos -->
            <tr>
                <td id="izq">                    
                    <table id="izq_cont">
                        <tr><td rowspan="4"><img class="logo" src="{{asset('images/logo.jpg')}}" width="80"></td>
                            <td>{{$suc->Suc_NomFan}} · Cel: {{$suc->Suc_Tel}}</td>                            
                        </tr>
                        <tr><td>facebook: {{$suc->Suc_Red1}} · instagram: {{$suc->Suc_Red2}}</td></tr>
                        <tr><td class="pad">{{$suc->Suc_Dir}} - {{$suc->Suc_Ciu}}</td></tr>
                    </table>
                </td>
                <td></td> <!-- separador -->
                <td id="der">
                    <table id="der_cont">
                        <tr><td>TIMBRADO Nº: <span> {{$timbrado->Timb_Num}} </span></td></tr>
                        <tr><td>Vigencia: Inicio <span> {{date('d/m/Y', strtotime($timbrado->Timb_IniVig))}} </span> · Fin <span> {{date('d/m/Y', strtotime($timbrado->Timb_FinVig))}} </span></td></tr>
                        <tr><td>RUC: <span> {{$suc->Suc_Ruc}} </span> · FACTURA: <span> {{$suc->Suc_Cod}} </span> - <span> {{$punto->PtoExp_Cod}} </span> - <span> {{$venta->Ven_Fact}} </span></td></tr>
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

                        <!-- relleno -->
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
                        @include('Admin.funcion_letras')
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

    <a href="{{URL::to('Ventas/factura/'.$id)}}"><button>PDF</button></a>
    <a href="{{URL::to('Ventas/'.$id)}}"><button>Volver</button></a>
</body>
</html>