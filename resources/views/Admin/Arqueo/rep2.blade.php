<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tazper</title>      
    <style>
        .titulo{            
            font-size:120%;
            margin-bottom:10px;
        }
        .head{
            border-bottom:1px solid black;            
            text-align:center;
            font-weight:bold;
        }

        input{
            font-family: 'Times New Roman', Times, serif;                                
            border:none;            
        }

        /* cabecera */                
        #principal input{
            margin-right:45px;
            margin-top:5px;
        }         
        .last{
            margin-right:0 !important;
        }

        /* detalle */
        .detalle{
            width:100%;
            border-collapse:collapse;
            /* border:1px solid green; */
            /* border:none; */
        }        
        .ent,.sal{
            width:50%;
        }

        .asiento{            
            border:1px solid darkgrey;
            width:100%;
            font-size:15px;
        }
        .asiento td{            
            /* border:1px solid black; */
        }                                

        .td{
            border:none !important;
            padding:0;
        }
        .pl{
            padding-left:5px;
        }
        .pt{
            padding-top:5px;
        }
        .pb{
            padding-bottom:5px;
        }        

        @page { margin-bottom: 0px; }        
    </style>        
</head>

<body>
    <div class="head titulo">Reporte de Arqueo de Caja</div>

    <table id="principal">
        <tr>
            <td>Id de Arqueo:</td>
            <td><input type="text" size="2" value="{{$arqueo->Id_Arq}}" disabled></td>

            <td>Caja:</td>
            <td><input type="text" size="6" value="{{$caja->Caj_Cod}}" disabled></td>

            <td>Estado:</td>
            <td><input type="text" class="last" size="7" value="{{$arqueo->Arq_Est}}" disabled></td>            
        </tr>

        <tr>
            <td>Apertura</td>
            <td><input type="text" size="8" value="{{date('d/m/y H:i', strtotime($arqueo->Arq_Ape))}}" disabled></td>

            <td>Por:</td>                        
            <td><input type="text" size="15" value="{{$arqueo->Arq_ApeUser}}" disabled></td>            
        </tr>

        @if($arqueo->Arq_Est=='Cerrado')
        <tr>
            <td>Cierre</td>
            <td><input type="text" size="8" value="{{date('d/m/y H:i', strtotime($arqueo->Arq_Cie))}}" disabled></td>

            <td>Por:</td>                        
            <td><input type="text" size="15" value="{{$arqueo->Arq_CieUser}}" disabled></td>
        </tr>
        @endif

        <tr>
            <td>Fondo Incial:</td>
            <td><input type="text" size="10" value="{{$arqueo->Arq_FonIni}} Gs." disabled></td>

            @if($arqueo->Arq_Est=='Abierto')
            <td>Fondo actual:</td>
            <td><input type="text" size="10" value="{{$caja->Caj_Fon}} Gs." disabled></td>

            <td colspan="2">Saldo Actual de Fondo:</td>
            <td><input type="text" size="10" value="{{$caja->Caj_Fon-$arqueo->Arq_FonIni}} Gs." disabled></td>
                @else
            <td>Fondo Final:</td>            
            <td><input type="text" size="10" value="{{$arqueo->Arq_FonFin}} Gs." disabled></td>            

            <td colspan="2">Saldo Final de Fondo:</td>
            <td><input type="text" size="10" value="{{$arqueo->Arq_FonFin-$arqueo->Arq_FonIni}} Gs." disabled></td>
            @endif

            <tr><td>&nbsp;</td></tr>
        </tr>

        <tr>
            <td>Transacciones:</td>
            <td><input type="text" size="2" value="{{$ventas->count()+$pagos->count()}}" disabled></td>

            <td>Ventas:</td>
            <td><input type="text" size="2" value="{{$ventas->count()}}" disabled></td>

            <td>Compras:</td>
            <td><input type="text" size="2" value="{{$pagos->count()}}" disabled></td>
        </tr>

        @if($arqueo->Arq_Est=='Abierto')      
        <tr>
            <td>Ingreso Actual:</td>
            <td>
                @php
                    $ingreso=0;

                    if($ventas->count()>0){
                        foreach($ventas as $ven){
                            $ingreso+=$ven->Ven_Tot;
                        }                                                            
                    }                                                    
                @endphp
                <input type="text" size="10" value="{{$ingreso}} Gs." disabled>
            </td>

            <td>Egreso Actual:</td>
            <td>                
                @php
                    $egreso=0;

                    if($pagos->count()>0){
                        foreach($pagos as $pag){
                            $egreso+=$pag->Pag_Eg;
                        }                                                            
                    }                                                    
                @endphp
                <input type="text" size="10" value="{{$egreso}} Gs." disabled>
            </td>

            <td colspan="2">Saldo Actual de Arqueo:</td>
            <td>                
                <input type="text" size="10" value="{{$ingreso-$egreso}} Gs." disabled>
            </td>
        </tr>
            @else
        <tr>
            <td>Ingreso Final:</td>
            <td>
                @php
                    $ingreso=0;

                    if($ventas->count()>0){
                        foreach($ventas as $ven){
                            $ingreso+=$ven->Ven_Tot;
                        }                                                            
                    }                                                    
                @endphp 
                <input type="text" size="10" value="{{$ingreso}} Gs." disabled>
            </td>

            <td>Egreso Final:</td>
            <td>                
            @php
                $egreso=0;

                if($pagos->count()>0){
                    foreach($pagos as $pag){
                        $egreso+=$pag->Pag_Eg;
                    }                                                            
                }                                                    
                @endphp
                <input type="text" size="10" value="{{$egreso}} Gs." disabled>
            </td>

            <td colspan="2">Saldo Final de Arqueo:</td>
            <td>                
                <input type="text" size="10" value="{{$ingreso-$egreso}} Gs." disabled>
            </td>
        </tr>        
        @endif

        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
    </table>    

    <table class="detalle">    
        <tr>
            <td class="head ent">Entrada</td>
            <td class="head sal">Salida</td>
        </tr>
        
            {{--
            @php
                $multiplo_v=0;
                $multiplo_c=0;
            @endphp
            --}}
        
        <tr>
            <td class="td" style="vertical-align:top">
            @if($ventas->count()>0)
                {{--@php
                    $entrada=1;
                @endphp--}                

            @foreach($ventas as $venta)                                 
            <table class="asiento">
                <tr>    
                    <td class="pl pt">Id Venta:</td>
                    <td class="pt"><input type="text" size="2" value="{{$venta->Id_Ven}}" disabled></td>

                    <td class="pt">Hora:</td>
                    <td colspan="3" class="pt"><input type="text" size="2" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" disabled></td>                                                            

                    {{--<td>$entrada</td>--}}
                </tr>            

                <tr>
                    <td class="pl">Cliente:</td>                                
                    <td colspan="5">
                        @foreach($cli as $cliente)
                        @if($cliente->Id_Cli==$venta->Id_Cli)
                        <input type="text" size="15" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled>
                        @endif
                        @endforeach
                    </td>                          
                </tr>

                <tr>
                    <td class="pl">Sucursal:</td>
                    <td>
                        @foreach($suc as $sucursal)
                        @if($sucursal->Id_Suc==$venta->Id_Suc)
                        <input type="text" size="2" value="{{$sucursal->Suc_Cod}}" disabled>
                        @endif
                        @endforeach
                    </td>

                    <td>Pto Exp:</td>                                
                    <td>                                    
                        @foreach($punto as $pto)
                        @if($pto->Id_PtoExp==$venta->Id_PtoExp)
                        <input type="text" size="2" value="{{$pto->PtoExp_Cod}}" disabled>
                        @endif
                        @endforeach
                    </td>

                    <td>Factura: </td>
                    <td><input type="text" size="4" value="{{$venta->Ven_Fact}}" disabled></td>
                </tr>

                <tr>
                    <td class="pl">Id Cobro: </td>
                    <td><input type="text" size="2" value="{{$venta->Id_Cob}}" disabled></td>

                    <td>Condición: </td>
                    <td><input type="text" size="4" value="{{$venta->Ven_CondCob}}" disabled></td>

                    <td>Medio: </td>
                    <td>
                        @foreach($med as $medio)
                        @if($medio->Id_MedPag==$venta->Id_MedPag)
                        <input type="text" size="6" value="{{$medio->MedPag_Des}}" disabled>
                        @endif
                        @endforeach
                    </td>
                </tr>       

                <tr>
                    <td class="pl pb">Ingreso: </td>
                    <td class="pb"><input type="text" size="4" value="{{$venta->Ven_Tot}}" disabled></td>

                    <td class="pb">Registro: </td>
                    <td colspan="3" class="pb"><input type="text" size="10" value="{{$venta->Ven_RegUser}}" disabled></td>
                </tr>            
            </table>                   

                {{--
                @if($entrada==2)                                    
                    @if($entrada!=$ventas->count())
                        <div style="page-break-after:always;"></div>
                        <!-- salto de pagina -->                        
                    @endif
                @endif                
                
                
                @if($entrada>2)                                    
                    {{$multiplo_v}}
                @endif
                

                @php
                    $entrada++;
                @endphp                                
                --}}

            @endforeach
            @endif
                   
                {{--
                <!-- relleno entrada -->
                @if($ventas->count()<$pagos->count())                                                                                                    
                @for($relleno_e=1;$relleno_e<=$pagos->count();$relleno_e++)
                        <table class="asiento">
                            <tr><td class="pl pt"><input type="text" value="a"></td></tr>            
                            <tr><td class="pl"><input type="text" value="&nbsp;"></td></tr>
                            <tr><td class="pl"><input type="text" value="&nbsp;"></td></tr>
                            <tr><td class="pl"><input type="text" value="&nbsp;"></td></tr>       
                            <tr><td class="pl pb"><input type="text" value="&nbsp;"></td></tr>
                        </table>         
                    
                        
                        @if($ventas->count()+$relleno_e==2)                                                        
                        <div style="page-break-after:always;"></div> <!-- salto de pagina -->                                            
                        @endif
                       @endfor
                @endif                                                  
                --}}                     
            </td>

            <td class="td" style="vertical-align:top">
            @if($pagos->count()>0)                
                
                {{--@php
                    $salida=1;
                @endphp--}}           

            @foreach($pagos as $pago)                               
            <table class="asiento">
                <tr>    
                    <td class="pl pt">Id Compra:</td>
                    <td class="pt"><input type="text" size="2" value="{{$pago->Id_Com}}" disabled></td>

                    <td class="pt">Hora:</td>
                    <td colspan="3" class="pt"><input type="text" size="2" value="{{$pago->created_at->format('H:i')}}" disabled></td>
                    
                    {{--<td>$salida</td>--}}
                </tr>            

                <tr>
                    <td class="pl">Proveedor:</td>                                
                    <td colspan="5">
                        @if($pago->Pag_Prov!='')
                        <input type="text" size="12" value="{{' '.$pago->Pag_Prov}}" disabled>      
                        @else
                        <input type="text" size="12" value="&nbsp;" disabled>
                        @endif
                    </td>                          
                </tr>

                <tr>
                    <td class="pl">Sucursal:</td>
                    <td>
                        @foreach($suc as $sucursal)
                        @if($sucursal->Id_Suc==$pago->Id_Suc)
                        <input type="text" size="2" value="{{$sucursal->Suc_Cod}}" disabled>
                        @endif
                        @endforeach
                    </td>

                    <td>Pto Exp:</td>                                
                    <td>                                    
                        @foreach($punto as $pto)
                        @if($pto->Id_PtoExp==$pago->Id_PtoExp)
                        <input type="text" size="2" value="{{$pto->PtoExp_Cod}}" disabled>
                        @endif
                        @endforeach
                    </td>

                    <td>Factura: </td>
                    <td>
                        @foreach($compras as $com)
                        @if($com->Id_Pag==$pago->Id_Pag)
                        <input type="text" size="4" value="{{$com->Com_Fac}}" disabled>
                        @endif
                        @endforeach                                
                    </td>
                </tr>

                <tr>
                    <td class="pl">Id Pago: </td>
                    <td><input type="text" size="2" value="{{$pago->Id_Pag}}" disabled></td>

                    <td>Condición: </td>
                    <td><input type="text" size="4" value="{{$pago->Pag_ConPag}}" disabled></td>

                    <td>Medio: </td>
                    <td>
                        @foreach($med as $medio)
                        @if($medio->Id_MedPag==$pago->Id_MedPag)
                        <input type="text" size="6" value="{{$medio->MedPag_Des}}" disabled>
                        @endif
                        @endforeach
                    </td>
                </tr>       

                <tr>
                    <td class="pl pb">Costo: </td>
                    <td class="pb"><input type="text" size="4" value="{{$pago->Pag_Eg}}" disabled></td>

                    <td class="pb">Registro: </td>
                    <td colspan="3" class="pb"><input type="text" size="10" value="{{$pago->Pag_RegUser}}" disabled></td>
                </tr>
            </table>                
                
                {{--
                @if($salida==2)                                
                    <div style="page-break-after:always;"></div>
                    <!-- salto de pagina -->
                @endif                
                
                @php
                    $salida++;
                @endphp
                --}}
                
            @endforeach
            @endif          
            
                {{--
                <!-- relleno salida -->
                @if($pagos->count()<$ventas->count())                                                                                                    
                    @for($relleno_s=1;$relleno_s<=$ventas->count();$relleno_s++) mientras que/para
                    <table class="asiento">
                        <tr><td class="pl pt"><input type="text" value="&nbsp;"></td></tr>            
                        <tr><td class="pl"><input type="text" value="&nbsp;"></td></tr>
                        <tr><td class="pl"><input type="text" value="&nbsp;"></td></tr>
                        <tr><td class="pl"><input type="text" value="&nbsp;"></td></tr>       
                        <tr><td class="pl pb"><input type="text" value="&nbsp;"></td></tr>
                    </table>              
                    @endfor
                @endif  
                --}}
            </td>
        </tr>        
    </table>
</body>
</html>