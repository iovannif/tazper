<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tazper</title>
    <link href="{{asset('css/vistas/oc_pdf.css')}}" rel="stylesheet">
</head>

<body>
    <div class="oc_titulo">
        <table id="oc_titulo">
            <tr><td>ORDEN DE COMPRA</td></tr>
        </table>
    </div>

    <div class="empresa_orden">
        <div class="empresa">
            <table id="empresa">
            @foreach($sucursales as $sucursal)
            @if($sucursal->Id_Suc==$sucursal->Id_Suc)
                <tr>
                    <td><input type="text" size="32" value="{{$sucursal->Suc_NomFan}}" disabled></td>
                </tr>

                <tr>
                    <td><input type="text" size="32" value="{{$sucursal->Suc_Dir}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" size="32" value="{{$sucursal->Suc_Tel}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" class="last" size="32" value="{{'facebook: '.$sucursal->Suc_Red1.' · instagram: '.$sucursal->Suc_Red2}}" disabled></td>
                </tr>
            @endif
            @endforeach 
            </table>
        </div>

        <div class="orden">
            <table id="orden">
                <tr>
                    <td>Fecha de orden:</td>
                    <td><input type="text" size="8" value="{{date('d/m/y', strtotime($orden->OC_Fe))}}" disabled></td>
                </tr>

                <tr>
                    <td>Número de orden:</td>
                    <td><input type="text" size="8" value="{{$orden->Id_OC}}" disabled></td>
                </tr>
                
                <tr>
                    <td>Cliente Nº:</td>
                    <td>
                        @if($orden->OC_CliNum!='')
                        <input type="text" size="8" value="{{$orden->OC_CliNum}}" disabled>
                        @else
                        <input type="text" size="8" value="&nbsp;" disabled>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="vendedor_enviar-a">
        <div class="vendedor">
            <table id="vendedor">
                @foreach($proveedores as $proveedor)
                @if($proveedor->Id_Prov==$orden->Id_Prov)
                <tr class="head">
                    <td colspan="2" class="td_tl td_tr">Vendedor</td>
                </tr>

                <tr>
                    <td class="first">Empresa:</td>
                    <td><input type="text" size="29" value="{{$proveedor->Prov_Des}}" disabled></td>
                </tr>
                
                <tr>
                    <td></td>
                    <span class="dep">Departamento de:</span>
                    <td class="inp"><input type="text" size="24 class="der"" value="Ventas" disabled></td>
                </tr>
                
                <tr>
                    <td class="first">Dirección:</td>
                    <td><input type="text" size="29" value="{{$proveedor->Prov_Dir}}" disabled></td>
                </tr>
                
                <tr>
                    <td class="first">Teléfono:</td>
                    <td><input type="text" size="29" value="{{$proveedor->Prov_Tel}}" disabled></td>
                </tr>
                
                <tr>
                    <td class="first">E-mail:</td>
                    <td>
                        @if($proveedor->Prov_Email)
                        <input type="text" size="29" value="{{$proveedor->Prov_Email}}" disabled>
                        @else
                        <input type="text" size="29" value="&nbsp;" disabled>
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </table>
        </div>

        <div class="enviar-a">
            <p class="head td_tl td_tr" style="margin:0">Enviar a:</p>
            <table id="enviar-a">
                @foreach($sucursales as $sucursal)
                @if($sucursal->Id_Suc==$sucursal->Id_Suc)
                <tr>
                    <td><input type="text" size="28" value="{{$sucursal->Suc_Enc}}" disabled></td>
                </tr>

                <tr>
                    <td><input type="text" size="28" value="{{$sucursal->Suc_Des}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" size="28" value="{{$sucursal->Suc_Dir}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" size="28" value="{{$sucursal->Suc_Tel}}" disabled></td>
                </tr>
                
                <tr>
                    <td><input type="text" size="28" value="{{$sucursal->Suc_Email}}" disabled></td>
                </tr>
                @endif
                @endforeach
            </table>
        </div>
    </div>

    <div class="envio">
        <table id="envio">
            <tr class="head">
                <td class="td_tl" style="padding-left:1px;">Medio de Envío</td>
                <td>F.O.B.</td>
                <td>Condiciones de Envío</td>
                <td class="td_tr">Fecha de Entrega</td>
            </tr>
            
            <tr>
                {{--
                <td><textarea class="tx_bl" rows="3" disabled>{{$orden->OC_MedEnv}}</textarea></td>
                <td><textarea rows="3" disabled>{{$orden->OC_FOB}}</textarea></td>
                <td><textarea rows="3" disabled>{{$orden->OC_CondEnv}}</textarea></td>
                <td><textarea class="tx_br" rows="3" disabled>{{date('d/m/y', strtotime($orden->OC_FeEnt))}}</textarea></td>
                --}}
                <td><span style="margin-top:2px">{{$orden->OC_MedEnv}}</span></td>
                <td><span style="margin-top:2px">{{$orden->OC_FOB}}</span></td>
                <td><span style="margin-top:2px">{{$orden->OC_CondEnv}}</span></td>
                <td><span style="margin-top:2px">{{date('d/m/y', strtotime($orden->OC_FeEnt))}}</span></td>                
            </tr>
        </table>
    </div>

    <div class="detalle">
        <table id="detalle">
            <tr class="head">
                <td class="td_tl" style="width:70px">Artículo #</td>
                <td>Descripción</td>
                <td style="width:150px">Cantidad</td>
                <td>Precio Unitario</td>
                <td class="td_tr" style="width:100px">Total</td>
            </tr>

            @php
                $i=0;
            @endphp
            
            @if($o_detalle)
            @foreach($o_detalle as $detalle)   
                @foreach($articulos as $articulo)   
                @if($articulo->Id_Art==$ocd_a[$i]->Id_Art) 
                <tr>
                    <td><input type="text" size="4" value="{{$ocd_a[$i]->Id_Art}}" disabled></td>
                    <td><input type="text" size="30" value="{{$articulo->Art_DesLar}}" disabled></td>
                    <td>
                        @if($articulo->Art_UniMed!='Unidades' && $articulo->Art_UniMed!='unidades')
                        <input type="text" size="10" value="{{$detalle->OCD_ArtCant.' '.$articulo->Art_UniMed}}" disabled>
                        @else
                        <input type="text" size="10" value="{{$detalle->OCD_ArtCant}}" disabled>
                        @endif
                    </td>
                    <td class="art_pre"><input type="text" class="der" size="6" value="{{$articulo->Art_PreCom}}" disabled></td>
                    <td><input type="text" class="der" size="6" value="{{$detalle->OCD_ArtTot}}" disabled></td>
                </tr>
                @endif            
                @endforeach                

                @php                 
                    $i++;                    
                @endphp
            @endforeach
            @endif
            
                @php
                    $i=1;
                @endphp

                @for($i==1; $i<=12-$o_detalle->count(); $i++)
                    <tr>
                        <td><input type="text" size="4" value="&nbsp;" disabled></td>
                        <td><input type="text" size="20" value="&nbsp;" disabled></td>
                        <td><input type="text" size="10" value="&nbsp;" disabled></td>
                        <td><input type="text" size="6" value="&nbsp;" disabled></td>
                        <td><input type="text" size="6" value="&nbsp;" disabled></td>
                    </tr>
                @endfor
            
            <tr>
                <td colspan="2" class="m_l">Condiciones o instrucciones especiales</td>
                <td colspan="2" class="m_l">Subtotal</td>
                <td><input type="text" name="OC_SubTot" size="7" value="{{$orden->OC_SubTot}}" disabled></td>
            </tr>

            <tr>
                <td colspan="2" rowspan="4" style="vertical-align:top; padding-left:3px !important; padding-top:2px">
                    <span>{{$orden->OC_Obs}}</span>
                    {{--<textarea style="overflow:block;" class="tx_bl" disabled>{{$orden->OC_Obs}}</textarea>--}}
                    <!-- <p></p> -->
                </td>
                <td colspan="2" class="m_l">Iva</td>
                <td>
                    @if($orden->OC_Iva!='')
                    <input type="text" name="OC_Iva" size="7" value="{{$orden->OC_Iva}}" disabled>
                    @else
                    <input type="text" name="OC_Iva" size="7" value="&nbsp;" disabled>
                    @endif
                </td>
            </tr>
            
            <tr>
                <td colspan="2" class="m_l">Envío</td>
                <td>
                    @if($orden->OC_Env!='')
                    <input type="text" name="OC_Env" size="7" value="{{$orden->OC_Env}}" disabled>
                    @else
                    <input type="text" name="OC_Env" size="7" value="&nbsp;" disabled>
                    @endif
                </td>
            </tr>
            
            <tr>
                <td colspan="2" class="m_l">Otro</td>
                <td>
                    @if($orden->OC_Otr!='')
                    <input type="text" name="OC_Otr" size="7" value="{{$orden->OC_Otr}}" disabled>
                    @else
                    <input type="text" name="OC_Otr" size="7" value="&nbsp;" disabled>
                    @endif
                </td>
            </tr>
            
            <tr>
                <td colspan="2" class="m_l">Total</td>
                <td>
                    @if($orden->OC_Iva!='')
                    <input type="text" name="OC_Tot" style="border-bottom-right-radius:4px;" size="7" value="{{$orden->OC_Tot}}" disabled>
                    @else                                      
                    <input type="text" name="OC_Tot" style="border-bottom-right-radius:4px;" size="7" value="&nbsp;" disabled>
                    @endif
                </td>
            </tr>
        </table>
    </div>                   
</body>
</html>    