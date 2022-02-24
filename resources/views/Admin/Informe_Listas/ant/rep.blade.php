<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tazper</title>
    <style>
        /* cabecera */
        .titulo{
            text-align:center;
            font-weight:bold;
            font-size:120%;
            margin-bottom:15px;
            padding-bottom:5px;     
            border-bottom:1px solid black;
        }        
        .fecha,.informe{            
            font-size:110%;
            font-weight:normal;                   
        }
        
        /* head */
        .hl{
            font-weight:bold;            
        }  
        .hl td{            
            /* border:1px solid red; */
        }
        
        /* detalle */
        td{            
            padding-bottom:10px;
            font-size:16px;               
            /* border:1px solid red; */
        }

        .ven td{
            padding-left:10px;
        }
        .com td{
            padding-left:25px;
        }
        .tod td{
            padding-left:7px;
            border-bottom:1px solid #DADADA;
            text-align:center;         
        }
        .first{
            padding-left:0 !important;
        }

        .center td{
            text-align:center;         
        }

        .det{
            margin-bottom:40px;
        }

        .hd{
             border:1px solid black; 
            text-align:center;
            margin-bottom:20px;
        }

        .ven_det td{
            padding-left:20px;
        }

        .und td{
            border-bottom:1px solid #DADADA !important;
        }

        .com_det td{
            padding-left:40px;
        }         
    </style>
</head>

<body>
    <!-- Cabecera -->
    <div class="titulo">    
        @if($ventas!='' && $compras=='')        
            {{"Lista de Ventas"}}            
        @elseif($ventas=='' && $compras!='')
            {{"Lista de Compras"}}            
        @elseif($ventas!='' && $compras!='')
            {{"Lista de Transacciones"}}            
        @endif                        
        
        <br>
        <span class="informe">    
            @if($v_det!='' || $c_det!='')   
                {{"Informe Detalle"}}
            @else
                {{"Informe Simple"}}
            @endif        
        </span>
        <br>                                            
        <span class="fecha">    
            @if($inicio==$fin)
                {{date('d/m/Y', strtotime($inicio))}}
            @else
                {{date('d/m/Y', strtotime($inicio)).' a '.date('d/m/Y', strtotime($fin))}}
            @endif        
        </span>
    </div>

    <!-- Detalle -->
    <!-- Reporte de Ventas -->
    @if($ventas!='' && $compras=='')
        @if($v_det!='')
            {{-- detalle --}}               
                @php
                    $sum=0;
                                        
                    foreach($ventas as $venta){
                        $sum+=$venta->Ven_Tot;
                    }
                @endphp

            <div class="hd"><b>
                {{'Cantidad: '.$ventas->count()}}
                &nbsp;
                {{'  Ingreso: '.$sum}}                    
            </b></div>

            @foreach($ventas as $venta)                           
                <table border="0">
                    <tr class="hl ven und">                                                                                                                                            
                        <td class="first">Id Venta</td>
                        <td>Fecha</td>
                        <td>Factura</td>                    
                        <td>Id Cobro</td>
                        <td>Cliente</td>
                        <td>Descuento</td>
                        <td>Id Pedido</td>
                        <td>Total</td>
                        <td>Por</td>
                    </tr>

                    <tr class="ven">
                        <td class="first">{{$venta->Id_Ven}}</td>
                        <td>{{date('d/m/y', strtotime($venta->Ven_Fe)).' '.date('H:i', strtotime($venta->Ven_Ho))}}</td>                    
                        <td>{{$venta->Ven_Fact}}</td>                    
                        <td>{{$venta->Id_Cob}}</td>                    
                        <td>
                            @foreach($clientes as $cli)
                                @if($cli->Id_Cli==$venta->Id_Cli)        
                                    {{$cli->Cli_Nom.' '.$cli->Cli_Ape}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if($venta->Ven_CliDesc>0)
                                {{$venta->Ven_CliDesc.'%'}}
                            @endif
                        </td>
                        <td>{{$venta->Id_PedCli}}</td>
                        <td>{{$venta->Ven_Tot}}</td>
                        <td>{{$venta->Ven_RegUser}}</td>
                    </tr>
                </table>  
                
                <b>Detalle</b>

                <table border="0" class="det">
                    <tr class="hl ven_det">                                                                                                                                                                        
                        <td class="first" style="padding-right:160px;">Artículo</td>
                        <td>Precio</td>                    
                        <td>Cantidad</td>
                        <td>Descuento (día)</td>
                        <td>Importe</td>
                    </tr>                
                
                    @foreach($v_det as $det)    
                        @if($det->Id_Ven==$venta->Id_Ven)

                            @foreach($v_det_a as $art)
                                @if($det->Id_Ven==$art->Id_Ven)

                                    @foreach($articulos as $prod)
                                        @if($art->Id_Art==$prod->Id_Art)
                                        <tr class="ven_det">
                                            <td class="first">{{$prod->Art_DesLar}}</td>
                                            <td>{{$det->VD_ArtPre}}</td>
                                            <td>{{$det->VD_ArtCant}}</td>
                                            <td>{{$det->VD_ArtDesc}}</td>

                                            @if($det->VD_ArtExen!='')
                                                <td>{{$det->VD_ArtExen}}</td>
                                            @elseif($det->VD_ArIva5!='')
                                                <td>{{$det->VD_ArIva5}}</td>
                                            @elseif($det->VD_ArtIva10!='')
                                                <td>{{$det->VD_ArtIva10}}</td>
                                            @endif
                                        </tr>
                                        @endif    
                                    @endforeach               

                                @endif
                            @endforeach    

                        @endif
                    @endforeach                     
                </table>   
                <!-- <hr style="margin-top:-30px">                        -->
            @endforeach    
        @else         
            {{-- simple --}}
            <table border="0">
                <tr class="hl ven">                                                                                                                                            
                    <td class="first">Id Venta</td>
                    <td>Fecha</td>
                    <td>Factura</td>                    
                    <td>Id Cobro</td>
                    <td>Cliente</td>
                    <td>Descuento</td>
                    <td>Id Pedido</td>
                    <td>Total</td>
                    <td>Por</td>
                </tr>

                    @php
                        $sum=0;
                    @endphp
                
                @foreach($ventas as $venta)
                <tr class="ven">
                    <td class="first">{{$venta->Id_Ven}}</td>
                    <td>{{date('d/m/y', strtotime($venta->Ven_Fe)).' '.date('H:i', strtotime($venta->Ven_Ho))}}</td>                    
                    <td>{{$venta->Ven_Fact}}</td>                    
                    <td>{{$venta->Id_Cob}}</td>                    
                    <td>
                        @foreach($clientes as $cli)
                            @if($cli->Id_Cli==$venta->Id_Cli)        
                                {{$cli->Cli_Nom.' '.$cli->Cli_Ape}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if($venta->Ven_CliDesc>0)
                            {{$venta->Ven_CliDesc.'%'}}
                        @endif
                    </td>
                    <td>{{$venta->Id_PedCli}}</td>
                    <td>{{$venta->Ven_Tot}}</td>                        
                </tr>
                    
                    @php
                        $sum+=$venta->Ven_Tot;
                    @endphp
                @endforeach                    

                <tr><td>&nbsp;</td></tr>                                                                
                <tr><td>&nbsp;</td></tr>                                                                
                <tr>
                    <td colspan="6"></td>
                    <td><b>Cantidad:</b></td>                    
                    <td>{{$ventas->count()}}</td>                                        
                </tr>
                <tr>    
                    <td colspan="6"></td>    
                    <td><b>Ingreso:</b></td> 
                    <td>{{$sum}}</td> 
                    <td>Gs.</td>                    
                </tr>
            </table>                                
        @endif
    @endif

    <!-- Reporte de Compras -->
    @if($ventas=='' && $compras!='')
                    
        @if($c_det!='')             
                @php
                    $sum=0;
                                        
                    foreach($compras as $compra){
                        $sum+=$compra->Pag_Eg;
                    }
                @endphp
                
            <div class="hd"><b>
                {{'Cantidad: '.$compras->count()}}
                &nbsp;
                {{'  Egreso: '.$sum}}                    
            </b></div>
            
            @foreach($compras as $compra)                           
                <table border="0">
                    <tr class="hl com und">                                                                                                                                            
                        <td class="first">Id Compra</td>
                        <td>Fecha</td>
                        <td style="padding-right:10px;">Factura</td>                    
                        <td>Id Pago</td>
                        <td style="padding-right:50px;">Proveedor</td>                            
                        <td>Id Pedido</td>
                        <td style="padding-right:15px;">Total</td>                            
                    </tr>
                                            
                    <tr class="com">
                        <td class="first">{{$compra->Id_Com}}</td>
                        <td>{{$compra->created_at->format('d/m/y')}} {{$compra->created_at->format('H:i')}}</td>                  
                        <td>
                            @foreach($egresos as $egreso)
                                @if($egreso->Id_Com==$compra->Id_Com)
                                    {{$egreso->Com_Fac}}
                                @endif
                            @endforeach                    
                        </td>                    
                        <td>{{$compra->Id_Pag}}</td>                    
                        <td>{{$compra->Pag_Prov}}</td>                        
                        <td>
                            @foreach($egresos as $egreso)
                                @if($egreso->Id_Com==$compra->Id_Com)
                                    {{$egreso->Id_PedProv}}
                                @endif
                            @endforeach                    
                        </td> 
                        <td>{{$compra->Pag_Eg}}</td>                        
                    </tr>                          
                </table>  

                <b>Detalle</b>
                
                <table border="0" class="det">
                    <tr class="hl com_det">                                                                                                                                                                        
                        <td class="first" style="padding-right:120px;">Artículo</td>
                        <td>Precio</td>                    
                        <td>Cantidad</td>                            
                        <td>Importe</td>
                    </tr>                
                    
                    @foreach($c_det as $det)    
                        @if($det->Id_Pag==$compra->Id_Pag)                                    
                            <tr class="com_det">                      
                                <td class="first">{{$det->PD_Art}}</td>
                                <td>{{$det->PD_ArtPre}}</td>
                                <td>{{$det->PD_ArtCant}}</td>
                                <td>{{$det->PD_ArtTot}}</td>
                            </tr>
                        @endif
                    @endforeach                                 
                </table>                                       
            @endforeach                                 
            
        <!-- Informe Simple -->
        @else                     
            <table border="0">
                <tr class="hl com">                                                                                                                                            
                    <td class="first">Id Compra</td>
                    <td>Fecha</td>
                    <td>Hora</td>
                    <td>Factura</td>                    
                    <td>Id Pago</td>
                    <td>Proveedor</td>                        
                    <td>Id Pedido</td>
                    <td>Total</td>                        
                </tr>

                    @php
                        $sum=0;
                    @endphp
                
                @foreach($compras as $compra)
                <tr class="com">
                    <td class="first">{{$compra->Id_Com}}</td>
                    <td>{{$compra->created_at->format('d/m/y')}}</td> <!-- timestamp -->      
                    <td>{{$compra->created_at->format('H:i')}}</td>                  
                    <td>
                        @foreach($egresos as $egreso)
                            @if($egreso->Id_Com==$compra->Id_Com)
                                {{$egreso->Com_Fac}}
                            @endif
                        @endforeach                    
                    </td>                    
                    <td>{{$compra->Id_Pag}}</td>                    
                    <td>{{$compra->Pag_Prov}}</td>                        
                    <td>
                        @foreach($egresos as $egreso)
                            @if($egreso->Id_Com==$compra->Id_Com)
                                {{$egreso->Id_PedProv}}
                            @endif
                        @endforeach                    
                    </td> 
                    <td>{{$compra->Pag_Eg}}</td>                        
                </tr>
                    
                    @php
                        $sum+=$compra->Pag_Eg;
                    @endphp
                @endforeach                    

                <tr><td>&nbsp;</td></tr>                                                                
                <tr><td>&nbsp;</td></tr>                                                                
                <tr>
                    <td colspan="6"></td>
                    <td><b>Cantidad:</b></td>                    
                    <td>{{$compras->count()}}</td>                                        
                </tr>
                <tr>    
                    <td colspan="6"></td>    
                    <td><b>Egreso:</b></td> 
                    <td>{{$sum.' Gs.'}}</td>                         
                </tr>
            </table>                                
        @endif
    @endif

    <!-- Reporte de Transacciones (todos) -->
    @if($ventas!='' && $compras!='')
            @php
                $eg=0;
                $ing=0;

                $fechas=[];
            
                foreach($compras as $compra){
                    array_push($fechas, $compra->created_at);        

                    $eg+=$compra->Pag_Eg;
                }                                                    
            
                foreach($ventas as $venta){
                    array_push($fechas, $venta->created_at);    

                    $ing+=$venta->Ven_Tot;
                }
            
                sort($fechas);                                                                                                                                                
            @endphp
        
        <!-- Informe Detalle -->
        @if($v_det!='' || $c_det!='')
            <div class="hd"><b>
                {{'Compras: '.$compras->count()}} &nbsp; {{'  Egreso: '.$eg}}   
                <br>
                &nbsp;{{'Ventas: '}} &nbsp;&nbsp; {{$ventas->count()}} &nbsp; {{'  Ingreso: '.$ing}}                       
            </b></div>

            @foreach($fechas as $fecha)     
                @foreach($compras as $compra)
                    @if($compra->created_at==$fecha)
                        <table border="0">
                            <tr class="hl com und">                                                                                                                                            
                                <td class="first">Id Compra</td>
                                <td>Fecha</td>
                                <td style="padding-right:10px;">Factura</td>                    
                                <td>Id Pago</td>
                                <td style="padding-right:50px;">Proveedor</td>                            
                                <td>Id Pedido</td>
                                <td style="padding-right:15px;">Total</td>                            
                            </tr>
                                                    
                            <tr class="com">
                                <td class="first">{{$compra->Id_Com}}</td>
                                <td>{{$compra->created_at->format('d/m/y')}} {{$compra->created_at->format('H:i')}}</td>                  
                                <td>
                                    @foreach($egresos as $egreso)
                                        @if($egreso->Id_Com==$compra->Id_Com)
                                            {{$egreso->Com_Fac}}
                                        @endif
                                    @endforeach                    
                                </td>                    
                                <td>{{$compra->Id_Pag}}</td>                    
                                <td>{{$compra->Pag_Prov}}</td>                        
                                <td>
                                    @foreach($egresos as $egreso)
                                        @if($egreso->Id_Com==$compra->Id_Com)
                                            {{$egreso->Id_PedProv}}
                                        @endif
                                    @endforeach                    
                                </td> 
                                <td>{{$compra->Pag_Eg}}</td>                        
                            </tr>                          
                        </table>  

                        <b>Detalle</b>                        
                        <table border="0" class="det">
                            <tr class="hl com_det">                                                                                                                                                                        
                                <td class="first" style="padding-right:120px;">Artículo</td>
                                <td>Precio</td>                    
                                <td>Cantidad</td>                            
                                <td>Importe</td>
                            </tr>                
                            
                            @foreach($c_det as $det)    
                                @if($det->Id_Pag==$compra->Id_Pag)                                    
                                    <tr class="com_det">                      
                                        <td class="first">{{$det->PD_Art}}</td>
                                        <td>{{$det->PD_ArtPre}}</td>
                                        <td>{{$det->PD_ArtCant}}</td>
                                        <td>{{$det->PD_ArtTot}}</td>
                                    </tr>
                                @endif
                            @endforeach                                 
                        </table> 
                    @endif
                @endforeach                         

                @foreach($ventas as $venta)
                    @if($venta->created_at==$fecha)
                        <table border="0">
                            <tr class="hl ven und">                                                                                                                                            
                                <td class="first">Id Venta</td>
                                <td>Fecha</td>
                                <td>Factura</td>                    
                                <td>Id Cobro</td>
                                <td>Cliente</td>
                                <td>Descuento</td>
                                <td>Id Pedido</td>
                                <td>Total</td>
                                <td>Por</td>
                            </tr>

                            <tr class="ven">
                                <td class="first">{{$venta->Id_Ven}}</td>
                                <td>{{date('d/m/y', strtotime($venta->Ven_Fe)).' '.date('H:i', strtotime($venta->Ven_Ho))}}</td>                    
                                <td>{{$venta->Ven_Fact}}</td>                    
                                <td>{{$venta->Id_Cob}}</td>                    
                                <td>
                                    @foreach($clientes as $cli)
                                        @if($cli->Id_Cli==$venta->Id_Cli)        
                                            {{$cli->Cli_Nom.' '.$cli->Cli_Ape}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if($venta->Ven_CliDesc>0)
                                        {{$venta->Ven_CliDesc.'%'}}
                                    @endif
                                </td>
                                <td>{{$venta->Id_PedCli}}</td>
                                <td>{{$venta->Ven_Tot}}</td>
                                <td>{{$venta->Ven_RegUser}}</td>
                            </tr>
                        </table>  
                        
                        <b>Detalle</b>

                        <table border="0" class="det">
                            <tr class="hl ven_det">                                                                                                                                                                        
                                <td class="first" style="padding-right:160px;">Artículo</td>
                                <td>Precio</td>                    
                                <td>Cantidad</td>
                                <td>Descuento (día)</td>
                                <td>Importe</td>
                            </tr>                
                        
                            @foreach($v_det as $det)    
                                @if($det->Id_Ven==$venta->Id_Ven)

                                    @foreach($v_det_a as $art)
                                        @if($det->Id_Ven==$art->Id_Ven)

                                            @foreach($articulos as $prod)
                                                @if($art->Id_Art==$prod->Id_Art)
                                                <tr class="ven_det">
                                                    <td class="first">{{$prod->Art_DesLar}}</td>
                                                    <td>{{$det->VD_ArtPre}}</td>
                                                    <td>{{$det->VD_ArtCant}}</td>
                                                    <td>{{$det->VD_ArtDesc}}</td>

                                                    @if($det->VD_ArtExen!='')
                                                        <td>{{$det->VD_ArtExen}}</td>
                                                    @elseif($det->VD_ArIva5!='')
                                                        <td>{{$det->VD_ArIva5}}</td>
                                                    @elseif($det->VD_ArtIva10!='')
                                                        <td>{{$det->VD_ArtIva10}}</td>
                                                    @endif
                                                </tr>
                                                @endif    
                                            @endforeach               

                                        @endif
                                    @endforeach    

                                @endif
                            @endforeach                     
                        </table>
                    @endif
                @endforeach   
            @endforeach   

        <!-- Informe Simple -->
        @else 
            <table>
                <tr class="hl tod">
                    <td class="first">Id Com</td>
                    <td>Id Ven</td>
                    <td>Fecha</td>
                    <td>Factura</td>                    
                    <td>Id Pag</td>
                    <td>Id Cob</td>
                    <td>Proveedor</td>                        
                    <td>Cliente</td>
                    <td>Descuento</td>
                    <td>Id Ped Prov</td>
                    <td>Id Ped Cli</td>
                    <td>Egreso</td>
                    <td>Ingreso</td>
                    <td>Por</td>     
                </tr>           
                
                    {{-- 
                    @php                
                        foreach ($fechas as $clave => $valor) {
                            echo "<tr><td>fechas[" . $clave . "] = " . $valor . "</td></tr>";
                        }
                    @endphp
                    
                    @foreach($fechas as $fecha)                
                    <tr><td>{{$fecha}}</td></tr>
                    @endforeach
                
                    array fechas
                    compras
                    ventas
                    --}}  

                @foreach($fechas as $fecha)     
                    @foreach($compras as $compra)
                        @if($compra->created_at==$fecha)
                        {{--<tr><td>{{$fecha}}</td></tr>--}}
                                                                            
                        <tr class="tod">
                            <td class="first">{{$compra->Id_Com}}</td>
                            <td></td>
                            <td>{{$compra->created_at->format('d/m/y H:i')}}</td>
                            <td>
                                @foreach($egresos as $egreso)
                                    @if($egreso->Id_Com==$compra->Id_Com)
                                        {{$egreso->Com_Fac}}
                                    @endif
                                @endforeach 
                            </td>
                            <td>{{$compra->Id_Pag}}</td>        
                            <td></td>
                            <td>{{$compra->Pag_Prov}}</td> 
                            <td></td>
                            <td></td>
                            <td>
                                @foreach($egresos as $egreso)
                                    @if($egreso->Id_Com==$compra->Id_Com)
                                        {{$egreso->Id_PedProv}}
                                    @endif
                                @endforeach            
                            </td> 
                            <td></td>
                            <td>{{$compra->Pag_Eg}}</td>   
                            <td></td>
                            <td>{{$compra->Pag_RegUser}}</td>
                        </tr>                                 
                        @endif
                    @endforeach                         

                    @foreach($ventas as $venta)
                        @if($venta->created_at==$fecha)
                        {{--<tr><td>{{$fecha}}</td></tr>--}}
                        
                        <tr class="tod">
                            <td class="first"></td>
                            <td>{{$venta->Id_Ven}}</td>
                            <td>{{date('d/m/y', strtotime($venta->Ven_Fe)).' '.date('H:i', strtotime($venta->Ven_Ho))}}</td>     
                            <td>{{$venta->Ven_Fact}}</td>            
                            <td></td>
                            <td>{{$venta->Id_Cob}}</td> 
                            <td></td>
                            <td>
                                @foreach($clientes as $cli)
                                    @if($cli->Id_Cli==$venta->Id_Cli)        
                                        {{$cli->Cli_Nom.' '.$cli->Cli_Ape}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if($venta->Ven_CliDesc>0)
                                    {{$venta->Ven_CliDesc.'%'}}
                                @endif
                            </td>
                            <td></td>
                            <td>{{$venta->Id_PedCli}}</td>
                            <td></td>
                            <td>{{$venta->Ven_Tot}}</td>
                            <td>{{$venta->Ven_RegUser}}</td>
                        </tr>                                     
                        @endif
                    @endforeach
                @endforeach

                <tr><td>&nbsp;</td></tr>   
                <tr><td>&nbsp;</td></tr>                 
                
                <tr class="center">
                    <td colspan="10">&nbsp;</td>
                    <td><b>Compras:</b></td>
                    <td colspan="2"><b>Egreso:</b></td>    
                </tr>  

                <tr class="center">
                    <td colspan="10">&nbsp;</td>
                    <td>{{$compras->count()}}</td>  
                    <td colspan="2" style="/*text-align:right*/">{{$eg}} Gs.</td>            
                </tr>                                 

                <tr><td>&nbsp;</td></tr>              
                
                <tr class="center">
                    <td colspan="10">&nbsp;</td>
                    <td><b>Ventas:</b></td> 
                    <td colspan="2"><b>Ingreso:</b></td>            
                </tr>                                                                                                                                                                    

                <tr class="center">
                    <td colspan="10">&nbsp;</td>
                    <td>{{$ventas->count()}}</td>   
                    <td colspan="2" style="/*text-align:right*/">{{$ing}} Gs.</td>            
                </tr>                                                  
            </table>              
        @endif
    @endif
</body>
</html>