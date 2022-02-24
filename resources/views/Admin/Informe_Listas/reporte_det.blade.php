<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tazper</title>
    <style>
        .titulo{
            text-align:center;           
            font-weight:bold;
            border-bottom:1px solid black;
            font-size:105%;
            margin-bottom:15px;
            padding-bottom:5px; 
        } 
        .sub{
            font-weight:normal;              
        }        

        /* detalle */
        table{
            font-size:95%;
            border-collapse:collapse;
        }
        .detalle{
            margin:10px 0 35px 0; 
        }
        td{
            /* padding:1px 0;   */
            /* border:1px solid grey; */
        }        
        .th td{
            border-bottom:1px solid lightgrey;
            text-align:right;
        }
        input{
            font-family: 'Times New Roman';
            padding:0; 
            margin:0;
            /* border:none; */
            border:1px solid transparent;
        }
        .cabecera input{
           padding-left:3px; 
        }           
        .num{
            text-align:right;
        }
        .d{
            text-align:center !important;
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

        <span class="sub">                
            {{"Informe Detalle"}}            
            <br>  
                    
                @php
                    $inicio=date('d/m/Y', strtotime($inicio));
                    $fin=date('d/m/Y', strtotime($fin));
                @endphp

            @if($inicio==$fin)
                {{$inicio}}
            @else
                {{$inicio.' a '.$fin}}
            @endif              
            <br>
            
            <!-- totales -->                                                    
            @if($ventas!='' && $compras=='') <!-- ventas -->                     
                    @php 
                        $sum=0;                                            
                        foreach($ventas as $venta){
                            $sum+=$venta->Ven_Tot;
                        }
                    @endphp            
            
                Cantidad: {{$ventas->count().'&nbsp;'}} Ingreso: {{number_format($sum,0,',','.').' Gs.'}}            
            
            @elseif($ventas=='' && $compras!='') <!-- compras -->
                    @php
                        $sum=0;
                        foreach($compras as $compra){
                            $sum+=$compra->Pag_Eg;
                        }
                    @endphp
            
                Cantidad: {{$compras->count().'&nbsp;'}} Egreso: {{number_format($sum,0,',','.').' Gs.'}}
            
            @elseif($ventas!='' && $compras!='') <!-- todo -->            
                    @php                        
                        $fechas=[];
                            $eg=0;
                            $ing=0;
                    
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
            
                Compras: {{$compras->count().'&nbsp;'}}
                Egreso: {{number_format($eg,0,',','.')}} Gs.
                <br>
                Ventas: {{$ventas->count().'&nbsp;'}}
                Ingreso: {{number_format($ing,0,',','.')}} Gs.     
            @endif
        </span>                 
    </div>

    <!-- Detalle -->
        
    <!-- venta -->
    @if($ventas!='' && $compras=='')        

        <style>
            body{
                margin:0 -21px;
            }
        </style> 

    @foreach($ventas as $venta)
    <table class="cabecera"> <!-- cabecera -->
        <tr>   
            <td>Id Venta:</td>
            <td><input type="text" value="{{$venta->Id_Ven}}" size="1"></td>

            @if($inicio==$fin)
                <td>Hora:</td>
                <td><input type="text" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" size="7"></td>
            @else
            <td>Fecha:</td>
                <td><input type="text" value="{{date('d/m/y', strtotime($venta->Ven_Fe)).' '.date('H:i', strtotime($venta->Ven_Ho))}}" size="7"></td>
            @endif

            <td>Factura:</td>
            <td><input type="text" value="{{$venta->Ven_Fact}}" size="3"></td>

            <td>Cliente:</td>
            <td colspan="3">                
                @foreach($clientes as $cli)
                    @if($cli->Id_Cli==$venta->Id_Cli)        
                        <input type="text" value="{{$cli->Cli_Nom.' '.$cli->Cli_Ape}}" size="16">
                    @endif
                @endforeach
            </td>

            <!-- <td>Descuento:</td>
            <td><input type="text" value="{{$venta->Ven_CliDesc.'%'}}" size="1"></td> -->
        </tr>
                        
        <tr>                                
            <td>Id Cobro:</td>
            <td><input type="text" value="{{$venta->Id_Cob}}" size="1"></td>

            <td>Id Pedido:</td>
            <td>
                @if($venta->Id_PedCli)
                <input type="text" value="{{$venta->Id_PedCli}}" size="1">
                @else
                <input type="text" value="&nbsp;" size="1">
                @endif
            </td>

            <td>Total:</td>
            <td><input type="text" value="{{number_format($venta->Ven_Tot,0,',','.').' Gs.'}}" size="6"></td>

            <td>Por:</td>
            <td><input type="text" value="{{$venta->Ven_RegUser}}" size="5"></td>            

            <td style="padding-left:-5px">Descuento:</td>
            <td><input type="text" value="{{$venta->Ven_DescDia}}" size="10"></td>            
        </tr>  
    </table>                  
    
    <table class="detalle">
        <tr class="th"> <!-- titulos -->                                
            <td style="text-align:left">Artículo</td>
            <td>Precio</td>
            <td>Cantidad</td>
            <td class="d">Descuento (cliente)</td>
            <td class="d">(mayorista)</td>
            <td class="d">(día)</td>
            <td>Importe</td>
        </tr>

        <!-- detalle -->                                
        @foreach($cobros as $cob)  
        @if($venta->Id_Ven==$cob->Id_Ven)
            
            @foreach($cobros_det as $cob_det)  
            @if($cob_det->Id_Cob==$cob->Id_Cob)
                <tr>
                    <td><input type="text" value="{{$cob_det->CD_Art}}" size="20"></td>
                    <td><input type="text" class="num" value="{{$cob_det->CD_ArtPre}}" size="3"></td>
                    <td><input type="text" class="num" value="{{$cob_det->CD_ArtCant}}" size="4"></td>
                    <td>
                        @if($venta->Ven_CliDesc>0)
                        <input type="text" class="d" value="{{$venta->Ven_CliDesc.'%'}}" size="10">
                        @else
                        <input type="text" class="d" value="&nbsp;" size="10">
                        @endif
                    </td>
                    <td>
                        @if($cob_det->CD_ArtCant>=15)
                        <input type="text" class="d" value="10%" size="4">
                        @else
                        <input type="text" class="d" value="&nbsp;" size="4">
                        @endif
                    </td>
                    <td>                        
                        @if($cob_det->CD_ArtDesc)
                        <input type="text" class="d" value="{{$cob_det->CD_ArtDesc.'%'}}" size="1">
                        @else
                        <input type="text" class="d" value="&nbsp;" size="1">
                        @endif                        
                    </td>                                                                
                    <td><input type="text" class="num" value="{{$cob_det->CD_ArtTot}}" size="3"></td>                 
                </tr>
            @endif  
            @endforeach
        @endif                
        @endforeach        
    </table>        
    @endforeach    
    @endif 

     
    <!-- compra -->
    @if($ventas=='' && $compras!='')          
    @foreach($compras as $compra)
    <table class="cabecera"> <!-- cabecera -->
        <tr>   
            <td>Id Compra:</td>
            <td><input type="text" value="{{$compra->Id_Com}}" size="1"></td>
    
            @if($inicio==$fin)
                <td>Hora:</td>
                <td><input type="text" value="{{$compra->created_at->format('H:i')}}" size="7"></td>
            @else
            <td>Fecha:</td>
                <td><input type="text" value="{{$compra->created_at->format('d/m/y')}} {{$compra->created_at->format('H:i')}}" size="7"></td>
            @endif

            <td>Factura:</td>
            <td><input type="text" value="{{$compra->Pag_Fac}}" size="3"></td>

            <td>Proveedor:</td>
            <td>
                @if($compra->Pag_Prov)
                <input type="text" value="{{$compra->Pag_Prov}}" size="16">
                @else
                <input type="text" value="&nbsp;" size="16">
                @endif
            </td>            
        </tr>
                        
        <tr>                                
            <td>Id Pago:</td>
            <td><input type="text" value="{{$compra->Id_Pag}}" size="1"></td>

            <td>Id Pedido:</td>
            <td>
                @foreach($egresos as $egreso)
                @if($egreso->Id_Com==$compra->Id_Com)
                    @if($egreso->Id_PedProv)
                    <input type="text" value="{{$egreso->Id_PedProv}}" size="1">
                    @else
                    <input type="text" value="&nbsp;" size="1">
                    @endif    
                @endif
                @endforeach                 
            </td>

            <td>Total:</td>
            <td><input type="text" value="{{number_format($compra->Pag_Eg,0,',','.').' Gs.'}}" size="6"></td>
            
            <td>Por:</td>
            <td><input type="text" value="{{$compra->Pag_RegUser}}" size="5"></td>            
        </tr>  
    </table>  

    <table class="detalle">
        <tr class="th"> <!-- titulos -->                                
            <td style="text-align:left">Artículo</td>
            <td>Precio</td>
            <td>Cantidad</td>            
            <td>Importe</td>
        </tr>

        <!-- detalle -->                                                         
        @foreach($c_det as $det)  
            @if($det->Id_Pag==$compra->Id_Pag)
            <tr>
                <td><input type="text" value="{{$det->PD_Art}}" size="15"></td>
                <td><input type="text" class="num" value="{{$det->PD_ArtPre}}" size="3"></td>
                <td><input type="text" class="num" value="{{$det->PD_ArtCant}}" size="4"></td>
                <td><input type="text" class="num" value="{{$det->PD_ArtTot}}" size="3"></td>                 
            </tr>                    
            @endif                
        @endforeach        
    </table>        
    @endforeach    
    @endif    


    <!-- todo -->    
    @if($ventas!='' && $compras!='')  

        <style>
            body{
                margin:0 -21px;
            }
        </style> 
        
    @foreach($fechas as $fecha)    
        @foreach($ventas as $venta) {{--venta--}} 
        @if($venta->created_at==$fecha)   
        <table class="cabecera"> <!-- cabecera -->
            <tr>   
                <td>Id <b>Venta</b>:</td>
                <td><input type="text" value="{{$venta->Id_Ven}}" size="1"></td>

                @if($inicio==$fin)
                    <td>Hora:</td>
                    <td><input type="text" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" size="7"></td>
                @else
                <td>Fecha:</td>
                    <td><input type="text" value="{{date('d/m/y', strtotime($venta->Ven_Fe)).' '.date('H:i', strtotime($venta->Ven_Ho))}}" size="7"></td>
                @endif

                <td>Factura:</td>
                <td><input type="text" value="{{$venta->Ven_Fact}}" size="3"></td>

                <td>Cliente:</td>
                <td colspan="3">                
                    @foreach($clientes as $cli)
                        @if($cli->Id_Cli==$venta->Id_Cli)        
                            <input type="text" value="{{$cli->Cli_Nom.' '.$cli->Cli_Ape}}" size="16">
                        @endif
                    @endforeach
                </td>

                <!-- <td>Descuento:</td>
                <td><input type="text" value="{{$venta->Ven_CliDesc.'%'}}" size="1"></td> -->
            </tr>
                            
            <tr>                                
                <td>Id Cobro:</td>
                <td><input type="text" value="{{$venta->Id_Cob}}" size="1"></td>

                <td>Id Pedido:</td>
                <td>
                    @if($venta->Id_PedCli)
                    <input type="text" value="{{$venta->Id_PedCli}}" size="1">
                    @else
                    <input type="text" value="&nbsp;" size="1">
                    @endif
                </td>

                <td>Total:</td>
                <td><input type="text" value="{{number_format($venta->Ven_Tot,0,',','.').' Gs.'}}" size="6"></td>

                <td>Por:</td>
                <td><input type="text" value="{{$venta->Ven_RegUser}}" size="5"></td>            

                <td style="padding-left:-5px">Descuento:</td>
            <td><input type="text" value="{{$venta->Ven_DescDia}}" size="10"></td>         
            </tr>  
        </table>  

        <table class="detalle">
            <tr class="th"> <!-- titulos -->                                
                <td style="text-align:left">Artículo</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td class="d">Descuento (cliente)</td>
                <td class="d">(mayorista)</td>
                <td class="d">(día)</td>
                <td>Importe</td>
            </tr>

            <!-- detalle -->                                
            @foreach($cobros as $cob)  
            @if($venta->Id_Ven==$cob->Id_Ven)
                
                @foreach($cobros_det as $cob_det)  
                @if($cob_det->Id_Cob==$cob->Id_Cob)
                    <tr>
                        <td><input type="text" value="{{$cob_det->CD_Art}}" size="20"></td>
                        <td><input type="text" class="num" value="{{$cob_det->CD_ArtPre}}" size="3"></td>
                        <td><input type="text" class="num" value="{{$cob_det->CD_ArtCant}}" size="4"></td>
                        <td>
                            @if($venta->Ven_CliDesc>0)
                            <input type="text" class="d" value="{{$venta->Ven_CliDesc.'%'}}" size="10">
                            @else
                            <input type="text" class="d" value="&nbsp;" size="10">
                            @endif
                        </td>
                        <td>
                            @if($cob_det->CD_ArtCant>=15)
                            <input type="text" class="d" value="10%" size="4">
                            @else
                            <input type="text" class="d" value="&nbsp;" size="4">
                            @endif
                        </td>
                        <td>                        
                            @if($cob_det->CD_ArtDesc)
                            <input type="text" class="d" value="{{$cob_det->CD_ArtDesc.'%'}}" size="1">
                            @else
                            <input type="text" class="d" value="&nbsp;" size="1">
                            @endif                        
                        </td>                                                                
                        <td><input type="text" class="num" value="{{$cob_det->CD_ArtTot}}" size="3"></td>                 
                    </tr>
                @endif  
                @endforeach
            @endif                
            @endforeach        
        </table>
        @endif
        @endforeach         
        
        @foreach($compras as $compra) {{--compra--}} 
        @if($compra->created_at==$fecha)          
        <table class="cabecera"> <!-- cabecera -->
            <tr>   
                <td>Id <b>Compra</b>:</td>
                <td><input type="text" value="{{$compra->Id_Com}}" size="1"></td>
        
                @if($inicio==$fin)
                    <td>Hora:</td>
                    <td><input type="text" value="{{$compra->created_at->format('H:i')}}" size="7"></td>
                @else
                <td>Fecha:</td>
                    <td><input type="text" value="{{$compra->created_at->format('d/m/y')}} {{$compra->created_at->format('H:i')}}" size="7"></td>
                @endif

                <td>Factura:</td>
                <td><input type="text" value="{{$compra->Pag_Fac}}" size="3"></td>

                <td>Proveedor:</td>
                <td>
                    @if($compra->Pag_Prov)
                    <input type="text" value="{{$compra->Pag_Prov}}" size="16">
                    @else
                    <input type="text" value="&nbsp;" size="16">
                    @endif
                </td>            
            </tr>
                            
            <tr>                                
                <td>Id Pago:</td>
                <td><input type="text" value="{{$compra->Id_Pag}}" size="1"></td>

                <td>Id Pedido:</td>
                <td>
                    @foreach($egresos as $egreso)
                    @if($egreso->Id_Com==$compra->Id_Com)
                        @if($egreso->Id_PedProv)
                        <input type="text" value="{{$egreso->Id_PedProv}}" size="1">
                        @else
                        <input type="text" value="&nbsp;" size="1">
                        @endif    
                    @endif
                    @endforeach                 
                </td>

                <td>Total:</td>
                <td><input type="text" value="{{number_format($compra->Pag_Eg,0,',','.').' Gs.'}}" size="6"></td>
                
                <td>Por:</td>
                <td><input type="text" value="{{$compra->Pag_RegUser}}" size="5"></td>            
            </tr>  
        </table>  

        <table class="detalle">
            <tr class="th"> <!-- titulos -->                                
                <td style="text-align:left">Artículo</td>
                <td>Precio</td>
                <td>Cantidad</td>            
                <td>Importe</td>
            </tr>

            <!-- detalle -->                                                         
            @foreach($c_det as $det)  
                @if($det->Id_Pag==$compra->Id_Pag)
                <tr>
                    <td><input type="text" value="{{$det->PD_Art}}" size="20"></td>
                    <td><input type="text" class="num" value="{{$det->PD_ArtPre}}" size="3"></td>
                    <td><input type="text" class="num" value="{{$det->PD_ArtCant}}" size="4"></td>
                    <td><input type="text" class="num" value="{{$det->PD_ArtTot}}" size="3"></td>                 
                </tr>                    
                @endif                
            @endforeach        
        </table>                
        @endif
        @endforeach         
    @endforeach         
    @endif
</body>
</html>