@extends('Vend.lay.Transaccion')
@include('Admin.funcion_letras')

<link href="{{asset('css/vistas/Compra.css')}}" rel="stylesheet">
<style>
    #navegacion_2{
        display:none;
    }    
    
    #navegacion_1{
        background:#E1E1E1;
        margin-bottom: 2px;
    }    
    
    #cabecera{        
        width: initial;
    }
    #cabecera input{
        margin-bottom:6px;
    }
    #est{
        margin-right: 15px !important;        
    }
    .last{
        margin-left: -70px !important;
        /* -200px */
    }
    .col_sep{
        margin-right: 15px !important;    
    }
    
    #detalle{
        padding: 0 0.1px !important;    
    }
    .detalle{
        /* margin:auto; */
        width: -webkit-fill-available;        
        margin-top: 4px;
    }
    
    #total{
        margin-bottom: 10px !important;
    }
    .sub_tot{
        width: 1202px;
        /* width: 100%; */
    }
    .ancho{
        background: #FCFCFC;        
        width:96px !important;
        text-align:center;        
    }
    .ancho input{
        box-shadow:none !important;
    }
    
    .liq_iva input{
        border:none !important;
    }

    .der{
        text-align:right !important;
        margin-right:5px !important;
    } 
</style>

@section('titulo')
    Venta Realizada
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Ventas/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif

        <a href="{{URL::to('Ventas/'.$venta->Id_Ven.'/informe')}}" class="informe"><button class="boton" name="reporte" id="informe">Informe</button></a>                        
        
        @if($venta->Ven_Est=='Válida')
        <a href="{{URL::to('Ventas/'.$venta->Id_Ven.'/anular')}}"><button class="boton anular">Anular</button></a>      
        @else
        <a href="{{URL::to('Ventas/'.$venta->Id_Ven.'/desanular')}}"><button class="boton anular">Desanular</button></a>           
        @endif                      

        <a href="{{URL::to('Ventas/comprobante/'.$venta->Id_Ven)}}" class="informe"><button class="boton" id="informe">Factura</button></a>                        
        
        @if($next)
        <a href="{{URL::to('Ventas/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Ventas')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('cabecera')      
    <table class="tabla_cabecera">    
        <tr>        
            <td>Venta:</td>
            <td><input type="text" size="4" value="Id: {{$venta->Id_Ven}}" disabled></td> 

            <td class="col_sep">Fecha:</td>
            <td><input type="text" size="6" value="{{date('d/m/y', strtotime($venta->Ven_Fe))}}" disabled></td>
            
            <td class="col_sep">Hora:</td>
            <td><input type="text" size="4" value="{{date('H:i', strtotime($venta->Ven_Ho))}}" disabled></td>

            <td class="col_sep">Tipo:</td>
            <td><input type="text" size="9" value="{{$venta->Ven_Tip}}" disabled></td>   
            
            <td colspan="2" class="col_sep">
                Estado: <input type="text" id="est" size="7" value="{{$venta->Ven_Est}}" disabled>
                Pedido: <input type="text" size="4" value="{{$venta->Id_PedCli}}" disabled>
            </td>        
        </tr>      
            
        <tr>
            <td>Sucursal</td>
            <td><input type="text" size="3" value="{{$sucursal->Suc_Cod}}" disabled></td>                

            <td class="col_sep">Punto Exp:</td>
            <td><input type="text" size="3" value="{{$punto->PtoExp_Cod}}" disabled></td>

            <td class="col_sep">Factura Nº:</td>
            <td><input type="text" size="7" value="{{$venta->Ven_Fact}}" disabled></td>   

            <td class="col_sep">Timbrado:</td>
            <td><input type="text" size="8" value="{{$timb->Timb_Num}}" disabled></td>   

            <td class="col_sep">Arqueo:</td>
            <td><input type="text" class="last" size="3" value="{{$venta->Id_Arq}}" disabled></td>                             
        </tr>                                     
        
        <tr>                   
            <td>Cobro:</td>
            <td><input type="text" size="4" value="Id: {{$venta->Id_Ven}}" disabled></td>                                       

            <td class="col_sep">Condición:</td>
            <td><input type="text" size="7" value="{{$venta->Ven_CondCob}}" disabled></td>

            <td class="col_sep">Medio:</td>            
            <td><input type="text" size="9" value="{{$medio_pag->MedPag_Des}}" disabled></td>    
            
            <td class="col_sep">Caja:</td>            
            <td><input type="text" size="3" value="1" disabled></td>    

            <td class="col_sep">Registro:</td>
            <td><input type="text" class="last" size="15" value="{{$venta->Ven_RegUser}}" disabled></td>                              
        </tr>     

        <tr>        
            <td>Cliente:</td>
            <td colspan="3"><input type="text" class="bottom" size="35" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled></td>                

            <td class="col_sep">RUC:</td>
            <td><input type="text" class="bottom" size="10" value="{{$cliente->Cli_Ruc}}" disabled></td>

            <td class="col_sep">Categoría:</td>
            <td><input type="text" class="bottom" size="15" value="{{$venta->Ven_CliLp}}" disabled></td>

            <td class="col_sep">Descuento:</td>
            <!-- <td><input type="text" class="bottom last" size="3" value="{{$venta->Ven_CliDesc}}%" disabled></td>                -->
            <td><input type="text" class="bottom last" size="15" value="{{$venta->Ven_DescDia}}" disabled></td>             
        </tr>  
    </table>
@endsection

@section('detalle')               
    <table class="detalle">            
        <tr class="head">
            <td rowspan="2">Id Art</td>		
            <td rowspan="2">Cant.</td>				
            <td rowspan="2">Descripción</td>					
            <td rowspan="2">Precio</td>	
            <td colspan="4">Descuento</td>								
            <td rowspan="2">Exentas</td>					
            <td rowspan="2">5%</td>					
            <td rowspan="2">10%</td>												
        </tr>
        <tr class="head">
            <td>Cliente</td>				
            <td>Mayorista</td>		
            <td>Día</td>		
            <td>Saldo</td>														
        </tr>

            @php
                $i=0;
            @endphp

        @foreach($venta_det as $detalle)
            @foreach($articulos as $articulo)          
            @if($articulo->Id_Art==$det_art[$i]->Id_Art)            
            <tr class="linea">
                <td><input type="text" size="4" value="{{$det_art[$i]->Id_Art}}" disabled></td>
                <td><input type="text" class="der" size="3" value="{{$detalle->VD_ArtCant}}" disabled></td>
                <td><input type="text" size="35" value="{{$articulo->Art_DesLar}}" disabled></td>
                <td><input type="text" class="der" size="6" value="{{$detalle->VD_ArtPre}}" disabled></td>      
                                                                            
                <td>
                    @if($venta->Ven_CliDesc!='' && $detalle->Ven_CliDesc!=0)
                    <input type="text" size="3" value="{{$venta->Ven_CliDesc}}%" disabled>
                    @else
                    <input type="text" size="3" value="" disabled>
                    @endif
                </td>
                <td>
                    @if($detalle->VD_ArtCant>=15)
                    <input type="text" size="3" value="10%" disabled>
                        @php $may=10; @endphp
                    @else
                    <input type="text" size="3" value="" disabled>
                        @php $may=0; @endphp
                    @endif
                </td>
                <td>
                    @if($detalle->VD_ArtDesc!='')
                    <input type="text" size="3" value="{{$detalle->VD_ArtDesc}}%" disabled>
                    @else
                    <input type="text" size="3" value="" disabled>
                    @endif
                </td>

                    @php
                            if($detalle->VD_ArtDesc==''){
                                $detalle->VD_ArtDesc=0;
                            }

                        $saldo = $venta->Ven_CliDesc + $may +  $detalle->VD_ArtDesc;
                                                
                        if($saldo==0){
                            $saldo=$articulo->Art_PreVen;
                        }else{
                            $saldo = $articulo->Art_PreVen * $saldo;
                            $saldo = $saldo/100;

                            $saldo = $articulo->Art_PreVen - $saldo;
                        }                    
                    @endphp                                    
                
                <td><input type="text" class="der" size="6" value="{{$saldo}}" disabled></td>
                
                <td><input type="text" class="der" size="6" value="{{$detalle->VD_ArtExen}}" disabled></td>
                <td><input type="text" class="der" size="6" value="{{$detalle->VD_ArtIva5}}" disabled></td>
                <td><input type="text" class="der" size="6" value="{{$detalle->VD_ArtIva10}}" disabled></td>
            </tr>
            @endif  
            @endforeach

            @php
                $i++;
            @endphp
        @endforeach

            @php
                $linea=1;
                $relleno=8-$venta_det->count();
            @endphp      

            @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="linea">
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="35" disabled></td>
                <td><input type="text" size="7" disabled></td>

                <td><input type="text" size="3" disabled></td>
                <td><input type="text" size="3" disabled></td>
                <td><input type="text" size="3" disabled></td>     
                <td><input type="text" size="7" disabled></td>     
                
                <td><input type="text" size="7" disabled></td>
                <td><input type="text" size="7" disabled></td>
                <td><input type="text" size="7" disabled></td>  
            </tr>     
            @endfor
    </table>	                     
@endsection

@section('total')
    <table id="compra_total">
        <tr>
            <td class="sub_tot">Subtotales:</td>                
            <td class="ancho"><input type="text" size="7" value="{{$venta->Ven_StExe}}" disabled></td>
            <td class="ancho"><input type="text" size="7" value="{{$venta->Ven_St5}}" disabled></td>
            <td class="ancho"><input type="text" size="7" value="{{$venta->Ven_St10}}" disabled></td>            
        </tr>

            <?php $objeto=new NumeroALetras; $letras=$objeto->convertir($venta->Ven_Tot); ?>

        <tr>
            <td class="tot_let" colspan="2">Total: guaraníes <input type="text" size="60" value="{{$letras}}" style="text-align:left" disabled></td>                
            <td class="tot">Total</td>
            <td class="ancho"><input type="text" size="7" value="{{$venta->Ven_Tot}}" disabled></td>            
        </tr>

        <tr>
            <td colspan="4" class="liq_iva">Liquidación del IVA:
            (5%) <input type="text" value="{{$venta->Ven_Liq5}}" disabled>
            (10%) <input type="text" value="{{$venta->Ven_Liq10}}" disabled> 
            Total IVA <input type="text" name="Com_TotIva" value="{{$venta->Ven_TotIva}}" disabled>
            </td>
        </tr>
    </table>           
@endsection

<script src="{{asset('js/vistas/paginacion_show/venta.js')}}"></script>