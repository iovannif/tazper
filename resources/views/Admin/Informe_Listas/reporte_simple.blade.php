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
        body{
            /* border:1px solid red; */                  
        }

        /* Detalle */
        table{
            font-size:95%;
            /* border:1px solid red; */
            border-collapse:collapse;            
        }
        .th{
            font-weight:bold;   
            text-align:center;                           
        }
        .th td{
            padding-bottom:5px !important;                
        }
        .v{
            background:lightgreen;
        }
        .c{
            background:#FF8383;
        }
        .i{
            background:#FFBB83;            
        }
        td{
            /* border:1px solid red; */
            text-align:center;            
            padding:1px 0;                       
        }
        input{
            font-family: 'Times New Roman';
            padding:0 0;                       
            /* border:none; */
            border:1px solid transparent;
        }
        .id{
            text-align:left;
        }
        .com{
            margin-left:10px !important;
        }    
        .tod td{
            border-bottom:1px solid lightgrey;
        }
        .venta td,.venta input{
            background:#F3F3F3;            
        } 
        .compra td,.compra input{
            background:#FAFAFA;
        }    
        .mont{
            text-align:right;
        }
        .impt{
            padding-right:10px;
        }
    </style>
</head>

<body >
    <!-------- Cabecera -------->
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
            {{"Informe Simple"}}            
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

                            {{--$fechas=collect($fechas);
                                $fechas=$fechas->sortBy('created_at');--}}                                                                                                                                
                    @endphp
            
                Compras: {{$compras->count().'&nbsp;'}}
                Egreso: {{number_format($eg,0,',','.').' Gs.'}}
                <br>
                Ventas: {{$ventas->count().'&nbsp;'}}
                Ingreso: {{number_format($ing,0,',','.').' Gs.'}}
                
                    {{--
                    {{ print_r($array, true) }}
                    {!! dd($array) !!}

                    @php            
                        var_dump($fechas);
                    @endphp
                
                    @php
                        $transacciones=$compras;   

                            $transacciones=collect($transacciones);
                        $transacciones->push($ventas); no son los mismos campos
                    @endphp                     
                        
                    @foreach($ventas as $venta)                    
                    $transacciones->push($venta);
                    @endforeach

                    {{$transacciones}}   
                    --}}                  

            @endif
        </span>                 
    </div>

    <!-------- Detalle -------->    

    <!-- Ventas -->   
    @if($ventas!='' && $compras=='')                        
        @if($inicio==$fin)            
        <style>
            body{
                margin:0 10px;
            }
        </style>         
        @endif 

    <table>        
        <tr class="th"> <!-- titulos -->                                                                                                                                            
            <td>Id Venta</td>            
            @if($inicio==$fin)
                <td>Hora</td>            
            @else
                <td>Fecha</td>       
                <td>Hora</td>            
            @endif             
            <td>Factura</td>                    
            <td>Id Cobro</td>
            <td>Cliente</td>
            <!-- <td>Descuento</td> -->
            <td>Id Pedido</td>
            <td class="mont impt">Total</td>
            <td>Por</td>
        </tr>            
                
        @if($ventas->count()>0)
        @foreach($ventas as $venta) <!-- detalle -->
        <tr>
            <td><input type="text" class="id" value="{{$venta->Id_Ven}}" size="1"></td>            
            @if($inicio==$fin)
                <td><input type="text" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" size="3"></td>        
            @else
                <td><input type="text" value="{{date('d/m/y', strtotime($venta->Ven_Fe))}}" size="3"></td>
                <td><input type="text" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" size="1"></td>                                                    
            @endif            
            <td><input type="text" value="{{$venta->Ven_Fact}}" size="3"></td>                    
            <td><input type="text" class="id" value="{{$venta->Id_Cob}}" size="1"></td>                    
            <td>
                @foreach($clientes as $cli)
                @if($cli->Id_Cli==$venta->Id_Cli)                                                                    
                    <input type="text" value="{{$cli->Cli_Nom.' '.$cli->Cli_Ape}}" size="16">                    
                @endif
                @endforeach
            </td>
            <!-- <td>
                <input type="text" value="{{$venta->Ven_CliDesc.'%'}}" size="5">    
            </td> -->
            <td>
                @if($venta->Id_PedCli)
                <input type="text" class="id" value="{{$venta->Id_PedCli}}" size="1">
                @else
                <input type="text" value="&nbsp;" size="1">
                @endif
            </td>
            <td><input type="text" class="mont" value="{{number_format($venta->Ven_Tot,0,',','.')}}" size="4"></td>    
            <td><input type="text" value="{{$venta->Ven_RegUser}}" size="6"></td>
        </tr>                                                        
        @endforeach                                 
        @endif
    </table>                                        
    @endif


    <!-- Compras -->   
    @if($ventas=='' && $compras!='')                                                                                                                                                                                  
    <table style="width:100%">        
        <tr class="th"> <!-- titulos -->                                                                                                                                           
            <td>Id Compra</td>                            
            @if($inicio==$fin)
                <td>Hora</td>    
            @else
                <td>Fecha</td>  
                <td>Hora</td>
            @endif
            <td>Factura</td>                    
            <td>Id Pago</td>
            <td>Proveedor</td>                        
            <td>Id Pedido</td>
            <td class="mont impt">Total</td>                        
        </tr>            
        
        @if($compras->count()>0)
        @foreach($compras as $compra) <!-- detalle -->
        <tr> 
            <td><input type="text" class="com id" value="{{$compra->Id_Com}}" size="4"></td>
            @if($inicio==$fin)
                <td><input type="text" class="com" value="{{$compra->created_at->format('H:i')}}" size="1"></td> 
            @else
                <td><input type="text" class="com" value="{{$compra->created_at->format('d/m/y')}}" size="3"></td>
                <td><input type="text" class="com" value="{{$compra->created_at->format('H:i')}}" size="1"></td>
            @endif                                            
            <td><input type="text" class="com" value="{{$compra->Pag_Fac}}" size="3"></td>                                
            <td><input type="text" class="com id" value="{{$compra->Id_Pag}}" size="2"></td>             
            <td>                
                @if($compra->Pag_Prov)
                <input type="text" class="com" value="{{$compra->Pag_Prov}}">
                @else
                <input type="text" class="com" value="&nbsp;">
                @endif                            
            </td>
            <td>                
                @foreach($egresos as $egreso)
                @if($egreso->Id_Com==$compra->Id_Com)
                    @if($egreso->Id_PedProv)
                    <input type="text" class="com id" value="{{$egreso->Id_PedProv}}" size="3">                        
                    @else
                    <input type="text" class="com id" value="&nbsp;" size="3">                        
                    @endif
                @endif
                @endforeach                                  
            </td>                                     
            <td><input type="text" class="com mont" value="{{number_format($compra->Pag_Eg,0,',','.')}}" size="3"></td>                                 
        </tr>                    
        @endforeach    
        @endif                               
    </table>                                    
    @endif

        
    <!-- Todo -->
    @if($ventas!='' && $compras!='')  
        <style>
            .titulo{
                margin-bottom:5px;
            }
        </style>                                               
        @if($inicio!=$fin)            
        <style>
            body{
                margin:0 -32px;
            }
        </style>         
        @endif 

    @if($ventas->count()>0 || $compras->count()>0)
    <table>        
        <!-- titulos -->
        <tr class="th"> 
            <td class="c">Id Com</td>
            <td class="v">Id Ven</td>            
            @if($inicio==$fin)
                <td class="i">Hora</td>    
            @else
                <td class="i">Fecha</td>  
                <td class="i">Hora</td>
            @endif
            <td class="i">Factura</td>                    
            <td class="c">Id Pag</td>
            <td class="v">Id Cob</td>
            <td class="c">Proveedor</td>                        
            <td class="v">Cliente</td>
            <!-- <td class="v">Descuento</td> -->
            <td class="c">Id Ped Prov</td>
            <td class="v">Id Ped Cli</td>
            <td class="c">Egreso</td>
            <td class="v">Ingreso</td>
            <td class="i">Por</td>     
        </tr>               

        <!-- detalle -->                  
        @foreach($fechas as $fecha)    
            @foreach($ventas as $venta) 
                @if($venta->created_at==$fecha)                                         
                <tr class="tod venta">
                    <td><input type="text" class="id" value="&nbsp;" size="2"></td> {{--c--}}                    
                    <td><input type="text" class="id" value="{{$venta->Id_Ven}}" size="1"></td>
                    @if($inicio==$fin)                    
                        <td><input type="text" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" size="1"></td> 
                    @else                        
                        <td><input type="text" value="{{$venta->created_at->format('d/m/y')}}" size="3"></td>
                        <td><input type="text" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" size="1"></td> 
                    @endif                    
                    <td><input type="text" value="{{$venta->Ven_Fact}}" size="3"></td>
                    <td><input type="text" class="id" value="&nbsp;" size="1"></td> {{--c--}}                                        
                    <td><input type="text" class="id" value="{{$venta->Id_Cob}}" size="1"></td>                    
                    <td><input type="text" value="&nbsp;" size="14"></td> {{--c--}}                    
                    <td>
                        @foreach($clientes as $cli)
                            @if($cli->Id_Cli==$venta->Id_Cli)        
                            <input type="text" value="{{$cli->Cli_Nom.' '.$cli->Cli_Ape}}" size="16">
                            @endif
                        @endforeach
                    </td>
                    <!-- <td><input type="text" value="{{$venta->Ven_CliDesc.'%'}}" size="3"></td>                                                                      -->
                    <td><input type="text" class="id" value="&nbsp;" size="4"></td> {{--c--}}                                                                                                    
                    <td>
                        @if($venta->Id_PedCli)
                        <input type="text" class="id" value="{{$venta->Id_PedCli}}" size="3">                     
                        @else
                        <input type="text" class="id" value="&nbsp;" size="3">                        
                        @endif                                                                                        
                    </td>  
                    <td><input type="text" value="&nbsp;" size="3"></td> {{--c--}}                                        
                    <td><input type="text" class="mont" value="{{number_format($venta->Ven_Tot,0,',','.')}}" size="3"></td>                    
                    <td><input type="text" value="{{$venta->Ven_RegUser}}" size="4"></td> 
                </tr> 
                @endif
            @endforeach

            @foreach($compras as $compra) 
                @if($compra->created_at==$fecha)                                      
                <tr class="tod compra">
                    <td><input type="text" class="id" value="{{$compra->Id_Com}}" size="2"></td>
                    <td><input type="text" class="id" value="&nbsp;" size="1"></td> {{--v--}}
                    @if($inicio==$fin)
                        <td><input type="text" value="{{$compra->created_at->format('H:i')}}" size="1"></td> 
                    @else
                        <td><input type="text" value="{{$compra->created_at->format('d/m/y')}}" size="3"></td>
                        <td><input type="text" value="{{$compra->created_at->format('H:i')}}" size="1"></td>
                    @endif    
                    <td><input type="text" value="{{$compra->Pag_Fac}}" size="3"></td>         
                    <td><input type="text" class="id" value="{{$compra->Id_Pag}}" size="1"></td> 
                    <td><input type="text" class="id" value="&nbsp;" size="1"></td> {{--v--}}
                    <td>                
                        @if($compra->Pag_Prov)
                        <input type="text" value="{{$compra->Pag_Prov}}" size="14">
                        @else
                        <input type="text" value="&nbsp;" size="14">
                        @endif                            
                    </td>                    
                    <td><input type="text" value="&nbsp;" size="16"></td> {{--v--}}
                    <!-- <td><input type="text" value="&nbsp;" size="3"></td> {{--v--}} -->
                    <td>                
                        @foreach($egresos as $egreso)
                        @if($egreso->Id_Com==$compra->Id_Com)
                            @if($egreso->Id_PedProv)
                            <input type="text" class="id" value="{{$egreso->Id_PedProv}}" size="4">                        
                            @else
                            <input type="text" class="id" value="&nbsp;" size="4">                        
                            @endif
                        @endif
                        @endforeach                                  
                    </td>   
                    <td><input type="text" class="id" value="&nbsp;" size="3"></td> {{--v--}}
                    <td><input type="text" class="mont" value="{{number_format($compra->Pag_Eg,0,',','.')}}" size="3"></td>               
                    <td><input type="text" value="&nbsp;" size="3"></td> {{--v--}}
                    <td><input type="text" value="{{$compra->Pag_RegUser}}" size="4"></td>
                </tr> 
                @endif
            @endforeach
        @endforeach    
    </table>
    @endif    
    @endif
</body>
</html>