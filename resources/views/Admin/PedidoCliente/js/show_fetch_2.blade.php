 <table id="principal">
    <tr>
        <td><label for="id_pedcli">Id de pedido:</label></td>
        <td><input type="text" size="4" value="{{$pedido->Id_PedCli}}" disabled></td>
    </tr>        

    <tr>
        <td><label for="sucursal">Sucursal:</label></td>
        <td><input type="text" size="15" value="Sucursal {{$sucursal->Id_Suc}}" disabled></td>
    </tr>

    <tr>
        <td><label for="pto_exp">Registrado en:</label></td>
        <td><input type="text" size="10" value="{{$punto->PtoExp_Des}}" disabled></td>
    </tr>        

    <tr>
        <td><label for="fe_ho">Fecha Hora:</label></td>
        <td><input type="text" size="15" value="{{date('d/m/y H:i', strtotime($pedido->PedCli_FeHo))}}" disabled></td>
        <!-- sale mal al traer un campo que no le corresponde, le aplica a algo que no existe -->
    </tr>   

    <tr>
        <td><label for="cli">Cliente:</label></td>
        <td>
            <input type="text" class="id_cli" size="4" value="Id: {{$pedido->PedCli_RegPor}}" disabled>
            <input type="text" size="35" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled>
        </td>
    </tr>   

    <tr>
        <td><label for="cli_cat">Categoría:</label></td>
        <td>
            {{--
            @foreach($listas as $lp)
                @if($lp->Id_Lp==$cliente->Id_Lp)
                <input type="text" size="15" value="{{$lp->Lp_Cat}}" disabled>
                @endif
            @endforeach
            --}}
            <input type="text" size="15" value="{{$pedido->PedCli_CliLp}}" disabled>
        </td>
    </tr>   

    <tr>
        <td><label for="desc_cat">Descuento:</label></td>
        <td>
            {{--
            @foreach($listas as $lp)
                @if($lp->Id_Lp==$cliente->Id_Lp)
                <input type="text" size="3" value="{{$lp->Lp_Desc}}%" disabled>
                @endif
            @endforeach
            --}}
            <input type="text" size="3" value="{{$pedido->PedCli_CliDesc}}%" disabled>
        </td>
    </tr>      

    <tr>
        <td><label for="ped_tip">Tipo:</label></td>
        <td><input type="text" size="9" value="{{$pedido->PedCli_Tip}}" disabled></td>
    </tr>   

    <tr>
        <td><label for="fe_entrega">Fecha de entrega:</label></td>
        <td><input type="text" size="8" value="{{date('d/m/y', strtotime($pedido->PedCli_FeEnt))}}" disabled></td>
    </tr>   

    <tr>
        <td><label for="condicion">Condición:</label></td>
        <td><input type="text" size="7" value="{{$pedido->PedCli_CondCob}}" disabled></td>
    </tr>   

    <tr>
        <td><label for="med_cob">Medio de cobro:</label></td>            
        <td>
        @foreach($medios_pag as $med_pag)          
            @if($med_pag->Id_MedPag==$pedido->Id_MedPag)
            <input type="text" class="bottom" size="15" value="{{$med_pag->MedPag_Des}}" disabled>
            @endif
        @endforeach
        </td> 
    </tr>                                        

    <tr>
        <td><label for="est">Estado:</label></td>
        <td><input type="text" size="10" value="{{$pedido->PedCli_Est}}" disabled></td>
    </tr>

    @if($pedido->PedCli_Est=='Entregado' && $venta!='')
        <tr>
            <td><label for="est">Venta:</label></td>
            <td><input type="text" size="4" value="Id: {{$venta}}" disabled></td>
        </tr>
    @endif

    <tr>
        <td class="obs"><label for="observacion">Observación:</label></td>
        <td><textarea id="obs" cols="50" rows="4" disabled>{{$pedido->PedCli_Obs}}</textarea></td>
    </tr>
    
    <tr>
        <td>&nbsp;</td>
    </tr>  
    @include('Admin.PedidoCliente.js.user')
</table>

    <div id="cancela">
        <table>
            <tr><td class="center" colspan="2">Está a punto de cancelar el pedido, desea continuar?</td></tr>            
            <tr>                    
                <td class="right">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PedidosClientesController@destroy', $pedido->Id_PedCli]]) !!}            
                    <input class="botones borrar" type="submit" value="Confirmar">
                    {!! Form::close() !!}
                </td>                    
                <td class="left"><button class="botones cancelar" onclick="$('#cancela').hide();">Cancelar</button></td>
            </tr>
        </table>
    </div>

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el pedido, desea continuar?</td></tr>            
            <tr>                    
                <td class="right">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PedidosClientesController@destroy', $pedido->Id_PedCli]]) !!}            
                    <input class="botones borrar" type="submit" value="Confirmar">
                    {!! Form::close() !!}
                </td>                                                                
                <td class="left"><button class="botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>

<h3 id="detalle">Detalle</h3>

<table class="detalle">                                        
    <tr class="head">
        <td>Id Art</td>
        <td>Producto</td>					
        <td>Precio</td>		
        <td>Cantidad</td>	
        <td>Desc. (cliente)</td>		
        <td>(mayorista)</td>	
        <td>Importe</td>								
    </tr>

    @php
        $i=0;

        $total=0;
    @endphp

    @foreach($detalles as $detalle)                        
        <tr class="body">
            @foreach($articulos as $articulo)                        
            @if($articulo->Id_Art==$det_art[$i]->Id_Art)
            <td><input type="text" size="4" value="{{$det_art[$i]->Id_Art}}" disabled></td>
            <td><input type="text" size="35" value="{{$articulo->Art_DesLar}}" disabled></td>
            <td><input type="text"  size="7" value="{{$articulo->Art_PreVen}}" disabled></td>
            <td><input type="text"  size="4" value="{{$detalle->PCD_ArtCant}}" disabled></td>   
                @if($pedido->PedCli_CliDesc>0)
                <td><input type="text" size="3" value="{{$pedido->PedCli_CliDesc}}%" disabled></td>   
                @else
                <td><input type="text" size="3" value="" disabled></td>   
                @endif
            
                @if($detalle->PCD_ArtCant>=15)
                <td><input type="text" size="3" value="10%" disabled></td>   
                @else
                <td><input type="text" size="3" value="" disabled></td>   
                @endif                    

                {{--
                @if($detalle->PCD_ArtCant>=15 || $detalle->Id_Desc==1)
                    @php                        
                        //pk desc mayorista
                                                    
                        $descontado=$articulo->Art_PreVen*10; $mayorista
                        $descontado=$descontado/100;
                        $descontado=$articulo->Art_PreVen-$descontado;                                                        
                    @endphp
                <td><input type="text" size="7" value="{{$importe=$detalle->PCD_ArtCant*$descontado}}" disabled></td>
                @else
                <td>
                    <input type="text" size="7" value="{{$importe=$detalle->PCD_ArtCant*$articulo->Art_PreVen}}" disabled>
                </td>    
                @endif            
                --}}

                @php
                    $saldo=$articulo->Art_PreVen;
                    $desc=0;

                        /*
                        if($pedido->PedCli_CliDesc>0){
                            $desc_lp=$saldo*$pedido->PedCli_CliDesc;
                            $desc_lp=$saldo/100;                           

                            $desc+=$desc_lp;                            
                        }
                        $desc=pedido->PedCli_CliDesc;

                        if($detalle->PCD_ArtCant>=15){                            
                            $may=$saldo*10;
                            $may=$saldo/100;                            

                            $desc+=$may;                                                        
                        }
                        */

                    if($pedido->PedCli_CliDesc>0){                            
                        $desc+=$pedido->PedCli_CliDesc;    
                    }                                                
                    if($detalle->PCD_ArtCant>=15){                            
                        $desc+=10;                                                      
                    }

                    $desc=$saldo*$desc/100;

                    $saldo=$saldo-$desc;
                @endphp
                
                <td><input type="text" size="7"  value="{{$importe=$detalle->PCD_ArtCant*$saldo}}" disabled></td>
            @endif            
            @endforeach
        </tr>                     
        
        @php                 
            $i++;

            $total+=$importe;                             
        @endphp
    @endforeach                                                                                                    

        @php
            $linea=1;
            $relleno=8-$detalles->count();
        @endphp      

        @for($linea==1;$linea<=$relleno;$linea++)
        <tr class="body">
            <td><input type="text" size="4" disabled></td>
            <td><input type="text" size="35" disabled></td>
            <td><input type="text" size="7" disabled></td>   
            <td><input type="text" size="4" disabled></td>
            <td><input type="text" size="3" disabled></td>
            <td><input type="text" size="3" disabled></td>
            <td><input type="text" size="7" disabled></td>    
        </tr>       
        @endfor

    <tr class="blank">
        <td colspan="5"></td>
        <td colspan="2">Total: <input type="text" id="total" size="7" value="{{$total}}" style="text-align:right !important" disabled> Gs.</td>				
    </tr>	
</table>     