@extends('Admin.lay.OrdenCompra')

<style>
    /* Titulo */
    #titulo{
        margin-bottom:6px;
    }

    /* auditoria */
    #aud{
        margin-top: 14px;
        margin-left:20px;
        font-family:Raleway;
        font-size:15px;
        color:black;
        text-shadow:0 0 0 #939393;
    }

    .por{
        vertical-align:top;
    }

    #aud input{
        font-family:arial;
        margin-left:6px;        
    }

    .separacion{
        padding-right:20px;
        padding-bottom:6px;
    }
</style>

@section('titulo')
    Orden de Compra
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('OrdenCompra/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo" disabled>Anterior</button>
        @endif

        {!! Form::open(['method'=>'DELETE', 'action'=>['OrdenCompraController@destroy', $orden->Id_OC]]) !!}
            {{csrf_field()}}
            <input class="boton eliminar" type="submit" id="eliminar" value="Eliminar">
        {!! Form::close() !!}
        
        @if($next)
        <a href="{{URL::to('OrdenCompra/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo" disabled>Siguiente</button>
        @endif

        <a href="{{url('OrdenCompra')}}" class="volver"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    <!-- Orden -->
    <div class="oc_titulo">
        <table id="oc_titulo">
            <tr><td>ORDEN DE COMPRA</td></tr>
        </table>
    </div>

    <div class="empresa_orden">
        <div class="empresa">
            <table id="empresa">
                <tr>
                    <td><input type="text" size="30" value="{{$orden->OC_EmpProv}}" disabled></td>
                </tr>
                <tr>
                    <td><input type="text" size="30" value="{{$orden->OC_EmpDir}}" disabled></td>
                </tr>
                <tr>
                    <td><input type="text" size="30" value="{{$orden->OC_EmpTel}}" disabled></td>
                </tr>
                <tr>
                    <td><input type="text" name="OC_EmpWeb" size="30" value="{{$orden->OC_EmpWeb}}" disabled></td>
                </tr>
            </table>
        </div>

        <div class="orden">
            <table id="orden">
                <tr>
                    <td>Fecha de orden:</td>
                    <td><input type="text" name="OC_Fecha" size="10" value="{{date('d/m/y', strtotime($orden->OC_Fecha))}}" disabled></td>
                </tr>
                <tr>
                    <td>Número de orden:</td>
                    <td><input type="text" size="10" value="{{$orden->OC_NumOrd}}" disabled></td>
                </tr>
                <tr>
                    <td>Cliente Nº:</td>
                    <td><input type="text" size="10" value="{{$orden->OC_CliNum}}" disabled></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="vendedor_enviar-a">
        <div class="vendedor">
            <table id="vendedor">
                <tr class="head">
                    <td colspan="2" class="td_tl td_tr">Vendedor</td>
                </tr>
                <tr>
                    <td>Empresa:</td>
                    <td><input type="text" size="30" value="{{$orden->OC_VenEmp}}" disabled></td>
                </tr>
                <tr>
                    <td>Departamento de:</td>
                    <td><input type="text" size="30" value="{{$orden->OC_VenDep}}" disabled></td>
                </tr>
                <tr>
                    <td>Dirección:</td>
                    <td><input type="text" size="30" value="{{$orden->OC_VenDir}}" disabled></td>
                </tr>
                <tr>
                    <td>Teléfono:</td>
                    <td><input type="text" size="30" value="{{$orden->OC_VenTel}}" disabled></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input type="text" size="30" value="{{$orden->OC_VenEmail}}" disabled></td>
                </tr>
            </table>
        </div>

        <div class="enviar-a">
            <p class="head td_tl td_tr" style="margin:0">Enviar a:</p>
            <table id="enviar-a">
                <tr>
                    <td><input type="text" size="30" value="{{$orden->OC_EnvEnc}}" disabled></td>
                </tr>
                <tr>
                    <td><input type="text" size="30" value="{{$orden->OC_EnvEmp}}" disabled></td>
                </tr>
                <tr>
                    <td><input type="text" size="30" value="{{$orden->Oc_EnvDir}}" disabled></td>
                </tr>
                <tr>
                    <td><input type="text" size="30" value="{{$orden->OC_EnvTel}}" disabled></td>
                </tr>
                <tr>
                    <td><input type="text" size="30" value="{{$orden->OC_EnvEmail}}" disabled></td>
                </tr>
        </table>
        </div>
    </div>

    <div class="envio">
        <table id="envio">
            <tr class="head">
                <td class="td_tl">Medio de Envío</td>
                <td>F.O.B.</td>
                <td>Condiciones de Envío</td>
                <td class="td_tr">Fecha de Entrega</td>
            </tr>
            <tr>
                <td><textarea class="tx_bl" rows="3" disabled>{{$orden->OC_MedEnv}}</textarea></td>
                <td><textarea rows="3" disabled>{{$orden->OC_FOB}}</textarea></td>
                <td><textarea rows="3" disabled>{{$orden->OC_CondEnv}}</textarea></td>
                <td><textarea class="tx_br" rows="3" disabled>{{$orden->OC_FechaEnt}}</textarea></td>
            </tr>
        </table>
    </div>

    <div class="detalle">
        <table id="detalle">
            <tr class="head">
                <td class="td_tl">Artículo #</td>
                <td>Descripción</td>
                <td>Cantidad</td>
                <td>Precio Unitario</td>
                <td class="td_tr">Total</td>
            </tr>
            
            @if($o_detalle)
            @foreach($o_detalle as $detalle)    
                <tr>
                    <td><input type="text" size="7" value="{{$detalle->OCD_ArtNum}}" disabled></td>
                    <td><input type="text" size="35" value="{{$detalle->OCD_ArtDes}}" disabled></td>
                    <td><input type="text" size="20" value="{{$detalle->OCD_ArtCant}}" disabled></td>
                    <td class="art_pre"><input type="text" size="7" value="{{$detalle->OCD_ArtPreUn}}" disabled></td>
                    <td><input type="text" size="7" value="{{$detalle->OCD_ArtTotal}}" disabled></td>
                </tr>
            @endforeach
            @endif
            
            @php
                $i=1;
            @endphp

            @for($i==1; $i<=12-$o_detalle->count(); $i++)
                <tr>
                    <td><input type="text" size="7" disabled></td>
                    <td><input type="text" size="35" disabled></td>
                    <td><input type="text" size="20" disabled></td>
                    <td><input type="text" size="7" disabled></td>
                    <td><input type="text" size="7" disabled></td>
                </tr>
            @endfor
            
            <tr>
                <td colspan="2" class="m_l">Condiciones o instrucciones especiales</td>
                <td colspan="2" class="m_l">Subtotal</td>
                <td><input type="text" name="OC_Subtotal" size="7" value="{{number_format($orden->OC_Subtotal,0,',','.')}}" disabled></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="4">
                    <textarea class="tx_bl" disabled>{{$orden->OC_CondEsp}}</textarea>
                </td>
                <td colspan="2" class="m_l">Iva</td>
                <td><input type="text" name="OC_Iva" size="7" value="{{number_format($orden->OC_Iva,0,',','.')}}" disabled></td>
            </tr>
            <tr>
                <td colspan="2" class="m_l">Envío</td>
                <td><input type="text" name="OC_Envio" size="7" value="{{number_format($orden->OC_Envio,0,',','.')}}" disabled></td>
            </tr>
            <tr>
                <td colspan="2" class="m_l">Otro</td>
                <td><input type="text" name="OC_Otro" size="7" value="{{number_format($orden->OC_Otro,0,',','.')}}" disabled></td>
            </tr>
            <tr>
                <td colspan="2" class="m_l">Total</td>
                <td><input type="text" name="OC_Total" style="border-bottom-right-radius:4px;" size="7" value="{{number_format($orden->OC_Total,0,',','.')}}" disabled></td>
            </tr>
        </table>
    </div>

    <!-- Auditoria -->
    <table id="aud">
        <tr>
            <td>Id:</td>
            <td class="separacion"><input type="text" value="{{$orden->Id_OC}}" size="4" disabled></td>
        </tr>
        <tr>
            <td>Registro:</td>
            <td class="separacion"><input type="text" value="{{$orden->created_at}}" size="15" disabled></td>
            <td>Por:</td>
            <td class="por">
            @foreach($users as $user)
                @if($user->Id_Usu==$orden->OC_RegPor)
                    <input type="text" id="regPor_id" size="4" value="Id: {{$user->Id_Usu}}" disabled>
                    <input type="text" id="regPor_name" size="15" value="{{$user->Usu_User}}" disabled>
                @endif
            @endforeach
            </td>
        </tr>    
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba">
        <a href="#"><button class="boton lista" id="arriba">Volver arriba</button></a>
    </div>
@endsection


