@extends('Admin.lay.Transaccion')
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

    #content{
        margin-bottom: 12px !important;
    }
    #cabecera{
        /* width: auto; */
        width: initial;
    }
    #cabecera input{
        margin-bottom:6px;
    }
    #ped{
        /* margin-right: 15px !important;
        margin-left: 24px !important; */

        margin-right: 57px !important;
        margin-left: 56px !important;
    }
    #prov_dir{
        margin-left: -12px !important;
    }
    #detalle{
        padding-top: 7px !important;
    }    
    .detalle{
        /* margin:auto; */
        width: -webkit-fill-available;
        margin-bottom: 10px;
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
        /* width:106px !important */
        width:121px !important;
        text-align:center;        
    }
    .ancho input{
        box-shadow:none !important;
    }
    .filler{
        width:6px !important;
    }
    .liq_iva input{
        border:none !important;
    }

    .precio,.exentas,.iva_5,.iva10{
        text-align:right !important;
        margin-right:5px !important;
    }
    .unimed{
        text-align:left !important;
        margin-left:5px !important;
    }
</style>

@section('titulo')
    Compra Realizada
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Compras/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif

        <a href="{{URL::to('Compras/'.$compra->Id_Com.'/informe')}}" class="informe"><button class="boton" name="reporte" id="informe">Informe</button></a>                        

        <button class="boton eliminar" id="eliminar" onclick="$('#confirm').show();">Eliminar</button>    

        <button class="boton anular" onclick="$('#anular').show();">Anular</button>   
        <!-- form o url 
        lo mismo tiene que estar definido en rutas -->

        @if($next)
        <a href="{{URL::to('Compras/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Compras')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('cabecera')            
    <table class="tabla_cabecera">    
        <tr>        
            <td>Compra:</td>
            <td><input type="text" size="4" value="Id: {{$compra->Id_Com}}" disabled></td> 
            
            <td class="col_sep">Sucursal:</td>
            <td><input type="text" size="4" value="{{$compra->Id_Suc}}" disabled></td>                

            <td class="col_sep">Punto Exp:</td>
            <td><input type="text" size="4" value="{{$compra->Id_PtoExp}}" disabled></td>                

            <td class="col_sep">Registro:</td>
            <td><input type="text" size="10" value="{{$compra->Com_RegUser}}" disabled></td>                             
        </tr>      
            
        <tr>
            <td>Fecha:</td>
            <td><input type="text" size="6" value="{{date('d/m/y', strtotime($compra->Com_Fe))}}" disabled></td>
            
            <td class="col_sep">Hora:</td>
            <td><input type="text" size="4" value="{{date('H:i', strtotime($compra->Com_Ho))}}" disabled></td>

            <td class="col_sep">Factura Nº:</td>
            <td><input type="text" size="10" value="{{$compra->Com_Fac}}" disabled></td>   
            
            <td colspan="2" class="col_sep">
                Pedido: <input type="text" id="ped" size="4" value="{{$compra->Id_PedProv}}" disabled>
                Orden<!-- de compra -->: <input type="text" size="4" value="{{$compra->Id_OC}}" disabled>                 
            </td>            
        </tr>                       

        <tr>
            @if($compra->Id_Prov!='')
                @foreach($proveedores as $proveedor)       
                @if($proveedor->Id_Prov==$compra->Id_Prov)
                <td>Proveedor:</td>
                <td><input type="text" size="25" value="{{$proveedor->Prov_Des}}" disabled></td>                

                <td class="col_sep">RUC:</td>
                <td><input type="text" size="10" value="{{$proveedor->Prov_Ruc}}" disabled></td>

                <td class="col_sep">Teléfono:</td>
                <td><input type="text" size="10" value="{{$proveedor->Prov_Tel}}" disabled></td>

                <td class="col_sep">Dirección:</td>
                <td><input type="text" id="prov_dir" size="42" value="{{$proveedor->Prov_Dir}}" disabled></td>
                @endif
                @endforeach
            @else
                <td>Proveedor:</td>
                <td><input type="text" size="25" disabled></td>                

                <td class="col_sep">RUC:</td>
                <td><input type="text" size="10" disabled></td>

                <td class="col_sep">Teléfono:</td>
                <td><input type="text" size="10" disabled></td>

                <td class="col_sep">Dirección:</td>
                <td><input type="text" id="prov_dir" size="42" disabled></td>
            @endif
        </tr>        
        
        <tr>
            <td>Arqueo:</td>
            <td><input type="text" class="bottom" size="4" value="{{$compra->Id_Arq}}" disabled></td>                

            <td class="col_sep">Pago:</td>
            <td><input type="text" class="bottom" size="4" value="Id: {{$compra->Id_Pag}}" disabled></td>                                       

            <td class="col_sep">Condición:</td>
            <td><input type="text" class="bottom" size="7" value="{{$compra->Com_ConPag}}" disabled></td>

            <td class="col_sep">Medio de pago:</td>            
            <td>
            @foreach($medios_pag as $med_pag)          
                @if($med_pag->Id_MedPag==$compra->Id_MedPag)
                <input type="text" class="bottom" size="7" value="{{$med_pag->MedPag_Des}}" disabled>
                @endif
            @endforeach
            </td>                                               
        </tr>     
    </table>
@endsection

@section('detalle')               
    <table class="detalle">            
        <tr class="head">
            <td>Id Art</td>				
            <td>Descripción</td>					
            <td>Precio</td>	
            <td>Cantidad</td>					
            <td>Exentas</td>					
            <td>5%</td>					
            <td>10%</td>												
        </tr>

        @php
            $i=0;
        @endphp

        @foreach($compra_det as $detalle)
            @foreach($articulos as $articulo)          
            @if($articulo->Id_Art==$det_art[$i]->Id_Art)
            <tr class="linea">
                <td><input type="text" size="4" value="{{$det_art[$i]->Id_Art}}" disabled></td>
                <td><input type="text" size="35" value="{{$articulo->Art_DesLar}}" disabled></td>
                <td><input type="text" class="precio" size="6" value="{{$articulo->Art_PreCom}}" disabled></td>
                <td>
                    <input type="text" size="4" value="{{$detalle->CD_ArtCant}}" style="text-align:right" disabled>
                    <input type="text" class="unimed" size="15" value="{{$articulo->Art_UniMed}}" disabled>
                </td>
                <td><input type="text" class="exentas" size="6" value="{{$detalle->CD_ArtExen}}" disabled></td>
                <td><input type="text" class="iva_5" size="6" value="{{$detalle->CD_ArtIva5}}" disabled></td>
                <td><input type="text" class="iva10" size="6" value="{{$detalle->CD_ArtIva10}}" disabled></td>            
            </tr>
            @endif  
            @endforeach

            @php
                $i++;
            @endphp
        @endforeach

            @php
                $linea=1;
                $relleno=8-$compra_det->count();
            @endphp      

            @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="linea">
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="35" disabled></td>
                <td><input type="text" size="7" disabled></td>
                <td>
                    <input type="text" size="4" disabled>
                    <input type="text" size="16" disabled>
                </td>
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
            <td class="ancho"><input type="text" size="7" value="{{$compra->Com_StExe}}" disabled></td>
            <td class="ancho"><input type="text" size="7" value="{{$compra->Com_St5}}" disabled></td>
            <td class="ancho"><input type="text" size="7" value="{{$compra->Com_St10}}" disabled></td>
            <td class="filler"></td>
        </tr>

        <?php $objeto=new NumeroALetras; $letras=$objeto->convertir($compra->Com_Total); ?>

        <tr>
            <td class="tot_let" colspan="2">Total: guaraníes <input type="text" size="60" value="{{$letras}}" style="text-align:left" disabled></td>                
            <td class="tot">Total</td>
            <td class="ancho"><input type="text" size="7" value="{{$compra->Com_Total}}" disabled></td>
            <td class="filler"></td>
        </tr>

        <tr>
            <td colspan="4" class="liq_iva">Liquidación del IVA:
            (5%) <input type="text" value="{{$compra->Com_Liq5}}" disabled>
            (10%) <input type="text" value="{{$compra->Com_Liq10}}" disabled> 
            Total IVA <input type="text" name="Com_TotIva" value="{{$compra->Com_TotIva}}" disabled>
            </td>
        </tr>
    </table>   

        <div id="confirm">
            <table>
                <tr><td class="center" colspan="2">Está a punto de eliminar la compra, no la podrá recuperar</td></tr>
                <tr><td class="center" colspan="2">Desea continuar?</td></tr>
                <tr>                    
                    <td class="right">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['ComprasController@destroy', $compra->Id_Com]]) !!}            
                        <button class="botones confirmar" type="submit">Confirmar</button>
                        {!! Form::close() !!}
                    </td>                                                                
                    <td class="left"><button class="botones cancelar" id="cancelar" onclick="$('#confirm').hide();">Cancelar</button></td>
                </tr>
            </table>
        </div>

        <div id="anular">
            <table>
                <tr><td class="center" colspan="2">La compra será anulada y eliminada</td></tr>
                <tr><td class="center" colspan="2">Desea continuar?</td></tr>
                <tr>                    
                    <td class="right">
                        {{-- {!! Form::open(['method'=>'get', 'action'=>['ComprasController@anular', $compra->Id_Com]]) !!} --}}            
                        <!-- <button class="botones confirmar" type="submit">Confirmar</button> -->
                        {{-- {!! Form::close() !!} --}}
                        <a href="{{URL::to('Compras/'.$compra->Id_Com.'/anular')}}"><button class="botones confirmar" type="submit">Confirmar</button></a>
                    </td>                                                                
                    <td class="left"><button class="botones cancelar" id="cancelar" onclick="$('#anular').hide();">Cancelar</button></td>
                </tr>
            </table>
        </div>
@endsection

<script src="{{asset('js/vistas/paginacion_show/compra.js')}}"></script>