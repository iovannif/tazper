@if($arqueo->Arq_Est=='Abierto') 
<style>    
    .i_horz{
        margin-left: 24px !important;
    }
</style>
@else
<style>
    .i_horz{
        margin-left: 36px !important;
    }
</style>
@endif

<table id="principal">
    <tr>
        <td><label for="id_arq">Id del arqueo:</label></td>
        <td><input type="text" size="4" value="{{$arqueo->Id_Arq}}" disabled></td>
    </tr>

    <tr>
        <td><label for="caja">Caja:</label></td>
        <td><input type="text" size="15" value="{{$caja->Caj_Des}}" disabled></td>
    </tr>

    <tr>
        <td><label for="caja">Estado:</label></td>
        <td><input type="text" size="7" value="{{$arqueo->Arq_Est}}" disabled></td>
    </tr>

    <tr>
        <td><label for="caj_ape">Apertura:</label></td>
        <td><input type="text" id="apertura" size="14" value="{{date('d/m/y H:i', strtotime($arqueo->Arq_Ape))}}" disabled></td>
        
        <td><label for="ape_por">Por:</label></td>
        @foreach($users as $user)
            @if($user->Id_Usu==$arqueo->Arq_ApePor)
                <td><input type="text" id="apePor_id" size="4" value="{{'Id: '.$user->Id_Usu}}" disabled></td>
                <td><input type="text" id="apePor_name" size="15" value="{{$user->Usu_User}}" disabled></td>            
                @php $no='false'; @endphp
                @break            
            @else
                @php $no='true'; @endphp
            @endif
        @endforeach                         

        @if($no=='true')
            <td><input type="text" id="apePor_id" size="4" value="Id: {{$arqueo->Arq_ApePor}}" disabled></td>
            <td><input type="text" id="apePor_name" size="15" value="{{$arqueo->Arq_ApeUser}}" disabled></td>

            <style>
                #apePor_id,#apePor_name{
                    color:grey;
                }
            </style>
        @endif
    </tr>

    @if($arqueo->Arq_Est=='Cerrado')
    <tr>
        <td><label for="caj_cie">Cierre:</label></td>
        <td><input type="text" id="cierre" size="14" value="{{date('d/m/y H:i', strtotime($arqueo->Arq_Cie))}}" disabled></td>
        
        <td><label for="cie_por">Por:</label></td>
        @foreach($users as $user)
            @if($user->Id_Usu==$arqueo->Arq_CiePor)
                <td><input type="text" id="ciePor_id" size="4" value="{{'Id: '.$user->Id_Usu}}" disabled></td>
                <td><input type="text" id="ciePor_name" size="15" value="{{$user->Usu_User}}" disabled></td>
                @php $no='false'; @endphp
                @break            
            @else
                @php $no='true'; @endphp
            @endif
        @endforeach                         

        @if($no=='true')
            <input type="text" id="ciePor_id" size="4" value="Id: {{$arqueo->Arq_CiePor}}" disabled>
            <input type="text" id="ciePor_name" size="20" value="{{$arqueo->Arq_CieUser}}" disabled>

            <style>
                #ciePor_id,#ciePor_name{
                    color:grey;
                }
            </style>
        @endif
    </tr>
    @endif

    <tr>
        <td><label for="fon_ini">Fondo incial:</label></td>
        <td><input type="text" size="10" value="{{number_format($arqueo->Arq_FonIni,0,',','.')}}" disabled></td>        
    </tr>

    @if($arqueo->Arq_Est=='Abierto')
    <tr>
        <td><label for="fon_act">Fondo actual:</label></td>
        <td>
            {{--<input type="text" size="10" value="{{number_format($arqueo->Arq_FonIni+$cobros->sum('Cob_In')-$pagos->sum('Pag_Eg'),0,',','.')}}" disabled>--}}
            <input type="text" size="10" value="{{number_format($caja->Caj_Fon,0,',','.')}}" disabled>
        </td>
    </tr>
    @endif
            
    @if($arqueo->Arq_Est=='Cerrado')
    <tr>
        <td><label for="fon_fin">Fondo final:</label></td>            
        <td><input type="text" size="10" value="{{number_format($arqueo->Arq_FonFin,0,',','.')}}" disabled></td>            
    </tr>

    {{--
    <tr>
        <td><label for="sal_tot">Saldo fondo:</label></td>            
        <td>
            @php                    
                $saldo_fon=$arqueo->Arq_FonFin-$arqueo->Arq_FonIni;
            @endphp                 
            
            <input type="text" size="10" value="{{$saldo_fon}}" disabled>
        </td>            
    </tr>
    --}}
    @endif

    <tr>
        <td>&nbsp;</td>
    </tr>
</table>

<table>
    @if($arqueo->Arq_Est=='Abierto')        
    <tr>
        <td><label for="fon_ini">Ingreso actual:</label></td>
        <td>
            {{--<input type="text" class="horz i_horz" size="10" value="{{number_format($cobros->sum('Cob_In'),0,',','.')}}" disabled>--}}

                @php
                    $ingreso=0;

                    if($ventas->count()>0){
                        foreach($ventas as $ven){
                            $ingreso+=$ven->Ven_Tot;
                        }                                                            
                    }                                                    
                @endphp

            <input type="text" class="horz i_horz" size="10" value="{{number_format($ingreso,0,',','.')}}" disabled>
        </td>
    
        <td><label for="fon_act">Egreso actual:</label></td>
        <td>
            {{--<input type="text" class="horz i_horz" size="10" value="{{number_format($pagos->sum('Pag_Eg'),0,',','.')}}" disabled>--}}

                @php
                    $egreso=0;

                    if($pagos->count()>0){
                        foreach($pagos as $pag){
                            $egreso+=$pag->Pag_Eg;
                        }                                                            
                    }                                                    
                @endphp

            <input type="text" class="horz i_horz" size="10" value="{{number_format($egreso,0,',','.')}}" disabled>
        </td>
    
        <td><label for="fon_fin">Saldo actual:</label></td>
        <td>
            {{--<input type="text" class="horz i_horz" size="10" value="{{number_format($cobros->sum('Cob_In')-$pagos->sum('Pag_Eg'),0,',','.')}}" disabled>--}}

            <input type="text" class="horz i_horz" size="10" value="{{number_format($ingreso-$egreso,0,',','.')}}" disabled>
        </td>
    </tr>        
    @endif
    
    @if($arqueo->Arq_Est=='Cerrado')        
    <tr>
        <td><label for="fon_ini">Ingreso final:</label></td>
        <td>
            {{--<input type="text" class="horz i_horz" size="10" value="{{number_format($cobros->sum('Cob_In'),0,',','.')}}" disabled>--}}

                @php
                    $ingreso=0;

                    if($ventas->count()>0){
                        foreach($ventas as $ven){
                            $ingreso+=$ven->Ven_Tot;
                        }                                                            
                    }                                                    
                @endphp                    

            <input type="text" class="horz i_horz" size="10" value="{{number_format($ingreso,0,',','.')}}" disabled>
        </td>
    
        <td><label for="fon_act">Egreso final:</label></td>
        <td>
            {{--<input type="text" class="horz i_horz" size="10" value="{{number_format($pagos->sum('Pag_Eg'),0,',','.')}}" disabled>--}}

                @php
                    $egreso=0;

                    if($pagos->count()>0){
                        foreach($pagos as $pag){
                            $egreso+=$pag->Pag_Eg;
                        }                                                            
                    }                                                    
                @endphp

                <input type="text" class="horz i_horz" size="10" value="{{number_format($egreso,0,',','.')}}" disabled>
        </td>
    
        <td><label for="fon_fin">Saldo final:</label></td>
        <td>
            {{--<input type="text" class="horz i_horz" size="10" value="{{number_format($cobros->sum('Cob_In')-$pagos->sum('Pag_Eg'),0,',','.')}}" disabled>--}}

            <input type="text" class="horz i_horz" size="10" value="{{number_format($ingreso-$egreso,0,',','.')}}" disabled>
        </td>            
    </tr>                           
    @endif
</table>     

<h3 id="detalle">Detalle</h3>
<table class="detalle">                    
    <tr class="head">
        <td>Entrada ({{$ventas->count()}} ventas)</td>
        <td>Salida ({{$pagos->count()}} compras)</td>                        
    </tr>        

    <tr class="body">
        @php
            $limit=50;
            $relleno_1=$limit-$ventas->count();
            $linea=1;
        @endphp
        <td>          
            @foreach($ventas as $venta)
                <span class="asiento_left">                                                                                                                                                                                           
                    <table>
                        <tr>
                            <td>Id Venta:</td>
                            <td><input type="text" size="4" value="{{$venta->Id_Ven}}" disabled></td>

                            <td>Hora:</td>
                            <td><input type="text" size="5" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" disabled></td>

                        </tr>

                        <tr>
                            <td>Cliente:</td>                                
                            <td colspan="5">
                                @foreach($cli as $cliente)
                                @if($cliente->Id_Cli==$venta->Id_Cli)
                                <input type="text" size="30" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled>
                                @endif
                                @endforeach
                            </td>                          
                        </tr>

                        <tr>
                            <td>Sucursal:</td>
                            <td>
                                @foreach($suc as $sucursal)
                                @if($sucursal->Id_Suc==$venta->Id_Suc)
                                <input type="text" size="3" value="{{$sucursal->Suc_Cod}}" disabled>
                                @endif
                                @endforeach
                            </td>

                            <td>Pto Exp:</td>                                
                            <td>                                    
                                @foreach($punto as $pto)
                                @if($pto->Id_PtoExp==$venta->Id_PtoExp)
                                <input type="text" size="3" value="{{$pto->PtoExp_Cod}}" disabled>
                                @endif
                                @endforeach
                            </td>

                            <td>Factura: </td>
                            <td><input type="text" size="7" value="{{$venta->Ven_Fact}}" disabled></td>
                        </tr>

                        <tr>
                            <td>Id Cobro: </td>
                            <td><input type="text" size="4" value="{{$venta->Id_Cob}}" disabled></td>

                            <td>Condición: </td>
                            <td><input type="text" size="4" value="{{$venta->Ven_CondCob}}" disabled></td>

                            <td>Medio: </td>
                            <td>
                                @foreach($med as $medio)
                                @if($medio->Id_MedPag==$venta->Id_MedPag)
                                <input type="text" size="9" value="{{$medio->MedPag_Des}}" disabled>
                                @endif
                                @endforeach
                            </td>
                        </tr>       

                        <tr>
                            <td>Ingreso: </td>
                            <td><input type="text" size="7" value="{{number_format($venta->Ven_Tot,0,',','.')}}" disabled></td>

                            <td>Registro: </td>
                            <td colspan="3"><input type="text" size="20" value="{{$venta->Ven_RegUser}}" disabled></td>
                        </tr>                                            
                    </table>
                </span>
            @endforeach                    

                @for($linea==1;$linea<=$relleno_1;$linea++)
                    <!-- <span class="asiento_left">&nbsp;</span>                         -->

                    <span class="asiento_left blank">                                                                                                                                                                                           
                        <table>
                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>

                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>

                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>

                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>     

                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>                                         
                        </table>
                    </span>
                @endfor
        </td>  
        
        @php
            $relleno_2=$limit-$pagos->count();
            $linea=1;
        @endphp          
        <td>
            @foreach($pagos as $pago)                   
            <span class="asiento_right">                                                                                                                                                                                           
                <table>
                    <tr>
                        <td colspan="2">Id Compra:
                        <input type="text" size="4" value="{{$pago->Id_Com}}" disabled></td>

                        <td>Hora:</td>
                        <td><input type="text" size="5" value="{{$pago->created_at->format('H:i')}}" disabled></td>                            
                    </tr>

                    <tr>
                        <td colspan="6">Proveedor:                                
                        <!-- </td>                                 -->
                        <!-- <td colspan="5"> -->
                            <input type="text" size="30" value="{{' '.$pago->Pag_Prov}}" disabled>                                
                        </td>                          
                    </tr>

                    <tr>
                        <td>Sucursal:</td>
                        <td>
                            @foreach($suc as $sucursal)
                            @if($sucursal->Id_Suc==$pago->Id_Suc)
                            <input type="text" size="3" value="{{$sucursal->Suc_Cod}}" disabled>
                            @endif
                            @endforeach
                        </td>

                        <td>Pto Exp:</td>                                
                        <td>                                    
                            @foreach($punto as $pto)
                            @if($pto->Id_PtoExp==$pago->Id_PtoExp)
                            <input type="text" size="3" value="{{$pto->PtoExp_Cod}}" disabled>
                            @endif
                            @endforeach
                        </td>

                        <td>Factura: </td>
                        <td>
                            @foreach($compras as $com)
                            @if($com->Id_Pag==$pago->Id_Pag)
                            <input type="text" size="7" value="{{$com->Com_Fac}}" disabled>
                            @endif
                            @endforeach                                
                        </td>
                    </tr>

                    <tr>
                        <td>Id Pago: </td>
                        <td><input type="text" size="4" value="{{$pago->Id_Pag}}" disabled></td>

                        <td>Condición: </td>
                        <td><input type="text" size="4" value="{{$pago->Pag_ConPag}}" disabled></td>

                        <td>Medio: </td>
                        <td>
                            @foreach($med as $medio)
                            @if($medio->Id_MedPag==$pago->Id_MedPag)
                            <input type="text" size="9" value="{{$medio->MedPag_Des}}" disabled>
                            @endif
                            @endforeach
                        </td>
                    </tr>       

                    <tr>
                        <td>Costo: </td>
                        <td><input type="text" size="7" value="{{number_format($pago->Pag_Eg,0,',','.')}}" disabled></td>

                        <td>Registro: </td>
                        <td colspan="3"><input type="text" size="20" value="{{$pago->Pag_RegUser}}" disabled></td>
                    </tr>                                            
                </table>
            </span>
            @endforeach

                @for($linea==1;$linea<=$relleno_2;$linea++)
                    <!-- <span class="asiento_left">&nbsp;</span>                         -->

                    <span class="asiento_right blank">                                                                                                                                                                                           
                        <table>
                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>

                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>

                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>

                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>     

                            <tr>                                    
                                <td><input type="text" value="" disabled></td>                                    
                            </tr>                                         
                        </table>
                    </span>
                @endfor                
        </td>
    </tr>            
</table>