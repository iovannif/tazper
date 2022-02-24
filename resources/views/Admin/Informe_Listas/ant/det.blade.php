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
            font-size:120%;
            margin-bottom:15px;
            padding-bottom:5px;     
        }
        .head{
            border-bottom:1px solid black;
        }
        .fecha{            
            font-size:110%;
            font-weight:normal;                   
        }

        .hl{
            font-weight:bold; 
            
        }  
        .hl td{
            border:none !important;           
        }

        td{            
            padding-bottom:10px;
            font-size:16px;               
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
            /* border:1px solid black; */
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

        .informe{
            font-weight:normal;
        }
    </style>
</head>

<body>
    <div class="head titulo">
    {{--titulo--}}
        @if($ventas!='' && $compras=='')        
            {{"Lista de Ventas"}}
            
        @elseif($ventas=='' && $compras!='')
            {{"Lista de Compras"}}
            
        @elseif($ventas!='' && $compras!='')
            {{"Lista de Transacciones"}}
            
        @endif        
                
        <br><span class="fecha">    
        @if($v_det!='' || $c_det!='')   
            {{"Informe Detalle"}}
        @else
            {{"Informe Simple"}}
        @endif        
        </span><br>                                            

        <span class="fecha">
    {{--fechas--}}
        @if($inicio==$fin)
            {{date('d/m/Y', strtotime($inicio))}}
        @else
            {{date('d/m/Y', strtotime($inicio)).' a '.date('d/m/Y', strtotime($fin))}}
        @endif        
        </span>
    </div>

    {{--lista--}}
        @if($ventas!='' && $compras=='') {{--ventas--}}    
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
                                               
            @endif
        @endif
        

        @if($ventas=='' && $compras!='') {{--compras--}}    
            @if($c_det!='')
                {{-- detalle --}}    
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
            @else         
                                               
            @endif
        @endif


        @if($ventas!='' && $compras!='') {{--todo--}}         

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

            @if($v_det!='' || $c_det!='') {{--detalle--}}
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

            @else {{--simple--}}
                             
            @endif
        @endif
</body>
</html>