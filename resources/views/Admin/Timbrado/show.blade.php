@extends('Admin.lay.Show')

<style>
    #contenido{
        padding-right:30px !important;
    }

    .detalle{
        width: -webkit-fill-available;
    }
    
    .blank:nth-last-of-type(odd){
        background-color: #EEEEEE;
    }
    .blank:nth-last-of-type(even){
        background-color: #fbfbfb;
    }
    .blank td{        
        border-right: 1px solid #EEEEEE;
    }
</style>

@section('titulo')
    Timbrado
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Timbrado/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif                
        
        <!-- <input class="boton eliminar" type="submit" id="eliminar" value="Anular">         -->
        
        @if($timbrado->Timb_Est=='Anulada')
        <a href="{{url('Timbrado/'.$timbrado->Id_Timb.'/desanular')}}" class="modificar"><button class="boton" id="actualizar">Desanular</button></a>
        @else
        <a href="{{url('Timbrado/'.$timbrado->Id_Timb.'/anular')}}" class="modificar"><button class="boton" id="actualizar">Anular</button></a>
        @endif
        
        @if($next)
        <a href="{{URL::to('Timbrado/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Timbrado')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    <table id="principal">                        
        <tr>
            <td><label for="codigo">Id de timbrado:</label></td>
            <td><input type="text" size="4" value="{{$timbrado->Id_Timb}}" disabled></td>
        </tr>

        <tr>
            <td><label for="timb">Número de timbrado:</label></td>
            <td><input type="text" size="8" value="{{$timbrado->Timb_Num}}" disabled></td>
        </tr>

        <tr>
            <td><label for="suc">Sucursal:</label></td>
            <td><input type="text" size="3" value="{{$sucursal->Suc_Cod}}" disabled></td>
        </tr>

        <tr>
            <td><label for="punto">Punto de expedición:</label></td>
            <td><input type="text" size="3" value="{{$punto->PtoExp_Cod}}" disabled></td>
        </tr>

        <tr>
            <td><label for="ini_vig">Inicio de vigencia:</label></td>
            <td><input type="text" size="10" value="{{date('d/m/Y', strtotime($timbrado->Timb_IniVig))}}" disabled></td>
        </tr>

        <tr>
            <td><label for="fin_vig">Fin de vigencia:</label></td>
            <td><input type="text" size="10" value="{{date('d/m/Y', strtotime($timbrado->Timb_FinVig))}}" disabled></td>
        </tr>

        <tr>
            <td><label for="rang_timb">Rango de facutación:</label></td>
            <td><input type="text" size="3" value="{{$timbrado->Timb_Rang}}" disabled></td>
        </tr>

        <tr>
            <td><label for="fact_ini">Inicio de facturación:</label></td>
            <td><input type="text" size="7" value="{{str_pad($timbrado->Timb_IniFact,7,'0',STR_PAD_LEFT)}}" disabled></td>
        </tr>

        <tr>
            <td><label for="fact_fin">Fin de facturación:</label></td>
            <td><input type="text" size="7" value="{{str_pad($timbrado->Timb_FinFact,7,'0',STR_PAD_LEFT)}}" disabled></td>
        </tr>

        <tr>
            <td><label for="fact_cant">Facturas emitidas:</label></td>
            <td><input type="text" size="3" value="{{$detalles->count()}}" disabled></td>
        </tr>

        <tr>
            <td><label for="fact_rest">Restantes:</label></td>
            <td><input type="text" size="3" value="{{$timbrado->Timb_Rang-$detalles->count()}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="est">Estado:</label></td>
            <td><input type="text" size="10" value="{{$timbrado->Timb_Est}}" disabled></td>
        </tr>

        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
            <td><textarea rows="4" cols="50" id="obs" disabled>{{$timbrado->Timb_Obs}}</textarea></td>
        <tr>

        <tr><td>&nbsp;</td></tr>
        @include('Admin.Timbrado.user')
    </table>

    @section('detalle')
        <h3 id="detalle">Facturas</h3>   

        <table class="detalle">            
            <tr class="head">
                <td>Id Fact</td>                    
                <td>Factura</td>                    
                <td>Id Venta</td>    
                <td>Fecha</td>     
                <td>Estado</td>                    
            </tr>

            @foreach($detalles as $det) 
            <tr class="body">
                <td><input type="text" size="4" value="{{$det->TD_NroFact}}" disabled></td>     
                <td><input type="text" size="7" value="{{str_pad($det->TD_FactCod,7,'0',STR_PAD_LEFT)}}" disabled></td>     
                <td><input type="text" size="4" value="{{$det->Id_Ven}}" disabled></td>     
                <td>
                    @foreach($ventas as $venta) 
                    @if($det->Id_Ven==$venta->Id_Ven)
                    <input type="text" size="14" value="{{date('d/m/y', strtotime($venta->Ven_Fe)).' '.date('H:i', strtotime($venta->Ven_Ho))}}" disabled>
                    @endif
                    @endforeach
                </td>
                <td><input type="text" size="7" value="{{$det->TD_FactEst}}" disabled></td>     
            </tr>                                                
            @endforeach

                @php
                    $linea=1;
                    $relleno=$timbrado->Timb_Rang-$detalles->count();
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" value="" disabled></td>     
                        <td><input type="text" size="7" value="" disabled></td>     
                        <td><input type="text" size="4" value="" disabled></td>     
                        <td><input type="text" size="14" value="" disabled></td>     
                        <td><input type="text" size="7" value="" disabled></td>     
                    </tr>
                @endfor
        </table>                
    @endsection
@endsection

@section('navegacion_2')
    <div class="arriba">
        <a href="#"><button class="boton lista" id="arriba">Volver arriba</button></a>
    </div>
@endsection