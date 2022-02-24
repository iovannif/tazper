@extends('Admin.lay.OrdenCompra')

@section('titulo')
    Registrar Orden
@endsection

@section('contenido')
    {!! Form::open(['url'=>'/OrdenCompra', 'method'=>'post']) !!}
	    {{csrf_field()}}
        <div class="oc_titulo">
            <table id="oc_titulo">
                <tr><td>ORDEN DE COMPRA</td></tr>
            </table>
        </div>

        <div class="empresa_orden">
            <div class="empresa">
                <table id="empresa">
                    <tr>
                        <td><input type="text" name="OC_EmpProv" placeholder="Empresa Proveedora" size="40" maxlength="30" required autofocus></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="OC_EmpDir" placeholder="Dirección" size="40" maxlength="30" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="OC_EmpTel" placeholder="Teléfono" size="40" maxlength="12" required></td>
                    </tr>
                    <tr>
                        <td><input type="url" name="OC_EmpWeb" placeholder="Sitio web" size="40" maxlength="40"></td>
                    </tr>
                </table>
            </div>

            <div class="orden">
                <table id="orden">
                    <tr>
                        <td>Fecha de orden:</td>
                        <td><input type="date" name="OC_Fecha" size="10" maxlength="8" required></td>
                    </tr>
                    <tr>
                        <td>Número de orden:</td>
                        <td><input type="text" name="OC_NumOrd" size="10" maxlength="10" required></td>
                    </tr>
                    <tr>
                        <td>Cliente Nº:</td>
                        <td><input type="text" name="OC_CliNum" size="10" maxlength="10" required></td>
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
                        <td><input type="text" name="OC_VenEmp" size="30" maxlength="30" required></td>
                    </tr>
                    <tr>
                        <td>Departamento de:</td>
                        <td><input type="text" name="OC_VenDep" size="30" maxlength="20" required></td>
                    </tr>
                    <tr>
                        <td>Dirección:</td>
                        <td><input type="text" name="OC_VenDir" size="30" maxlength="30" required></td>
                    </tr>
                    <tr>
                        <td>Teléfono:</td>
                        <td><input type="text" name="OC_VenTel" size="30" maxlength="12" required></td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td><input type="email" name="OC_VenEmail" size="30" maxlength="30"></td>
                    </tr>
                </table>
            </div>

            <div class="enviar-a">
                <p class="head td_tl td_tr" style="margin:0">Enviar a:</p>
                <table id="enviar-a">
                    <tr>
                        <td><input type="text" name="OC_EnvEnc" placeholder="Encargado" size="30" maxlength="30" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="OC_EnvEmp" placeholder="Empresa Cliente" size="30" maxlength="30" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="Oc_EnvDir" placeholder="Dirección" size="30" maxlength="30" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="OC_EnvTel" placeholder="Teléfono" size="30" maxlength="12" required></td>
                    </tr>
                    <tr>
                        <td><input type="email" name="OC_EnvEmail" placeholder="E-Mail" size="30" maxlength="30"></td>
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
                    <td><textarea class="tx_bl" rows="3" name="OC_MedEnv" maxlength="70"></textarea></td>
                    <td><textarea rows="3" name="OC_FOB" maxlength="70" required></textarea></td>
                    <td><textarea rows="3" name="OC_CondEnv" maxlength="70"></textarea></td>
                    <td><textarea class="tx_br" rows="3" name="OC_FechaEnt" maxlength="70" required></textarea></td>
                </tr>
            </table>
        </div>

        <div class="detalle">
            <table id="detalle">
                <tr class="head">
                    <td class="td_tl">Artículo #</td>
                    <td>Descripción</td>
                    <td>Cantidad</td>
                    <td class="art_pre">Precio Unitario</td>
                    <td class="td_tr">Total</td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_1" size="7" maxlength="7" required></td>
                    <td><input type="text" name="OCD_ArtDes_1" size="35" maxlength="35" required></td>
                    <td><input type="text" name="OCD_ArtCant_1" size="20" maxlength="20" required></td>
                    <td><input type="text" name="OCD_ArtPreUn_1" size="7" maxlength="7" required></td>
                    <td><input type="text" name="OCD_ArtTotal_1" size="7" maxlength="7" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_2" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_2" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_2" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_2" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_2" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_3" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_3" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_3" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_3" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_3" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_4" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_4" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_4" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_4" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_4" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_5" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_5" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_5" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_5" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_5" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_6" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_6" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_6" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_6" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_6" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_7" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_7" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_7" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_7" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_7" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_8" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_8" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_8" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_8" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_8" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_9" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_9" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_9" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_9" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_9" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_10" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_10" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_10" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_10" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_10" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_11" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_11" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_11" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_11" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_11" size="7" maxlength="7"></td>
                </tr>
                <tr>
                    <td><input type="text" name="OCD_ArtNum_12" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtDes_12" size="35" maxlength="35"></td>
                    <td><input type="text" name="OCD_ArtCant_12" size="20" maxlength="20"></td>
                    <td><input type="text" name="OCD_ArtPreUn_12" size="7" maxlength="7"></td>
                    <td><input type="text" name="OCD_ArtTotal_12" size="7" maxlength="7"></td>
                </tr>

                <tr>
                    <td colspan="2" class="m_l">Condiciones o instrucciones especiales</td>
                    <td colspan="2" class="m_l">Subtotal</td>
                    <td><input type="text" name="OC_Subtotal" size="7" required></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="4">
                        <textarea class="tx_bl" name="OC_CondEsp" maxlength="290"></textarea>
                    </td>
                    <td colspan="2" class="m_l">Iva</td>
                    <td><input type="text" name="OC_Iva" size="7" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="m_l">Envío</td>
                    <td><input type="text" name="OC_Envio" size="7" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="m_l">Otro</td>
                    <td><input type="text" name="OC_Otro"  size="7" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="m_l">Total</td>
                    <td><input type="text" style="border-bottom-right-radius:4px;" name="OC_Total" size="7" required></td>
                </tr>
            </table>
        </div>
@endsection

@section('navegacion_2')
        <div class="arriba">
            <input class="boton" type="submit" id="registrar" value="Registrar">
            <input class="boton" type="reset" id="limpiar" value="Limpiar">
    {!! Form::close() !!}
            <a href="/Tazper/public/OrdenCompra"><button class="boton lista" id="cancelar">Cancelar</button></a>
            <a href="/Tazper/public/OrdenCompra"><button class="boton lista" id="listado">Ver listado</button></a>
        </div>
@endsection

<style>
    #navegacion_1{
        display:none;
    }

    /*orden*/
    form input,form textarea{
        font-family:arial;
        font-size:15px;
    }

    input[name="OC_Fecha"],
    input[name="OC_NumOrd"],
    input[name="OC_CliNum"]
    {
        width:149px;
    }

    /* Navegacion 2 */
    .arriba .boton{
        margin-right:3px;
    }
</style>
