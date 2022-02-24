<table id="principal">
    <tr>
        <td><label for="cod_art">Id de perfil:</label></td>
        <td><input type="text" size="4" value="{{$perfil->Id_Prf}}" disabled></td>
    </tr>

    <tr>
        <td><label for="tipo">Descripción:</label></td>
        <td><input type="text" size="20" value="{{$perfil->Prf_Des}}" disabled></td>
    </tr>

    <tr>
        <td><label for="des_lar">Nivel de acceso:</label></td>
        <td><input type="text" size="40" value="{{$perfil->Prf_NivAcc}}" disabled></td>
    </tr>

    <tr>
        <td><label for="des_cor">Estado:</label></td>
        <td><input type="text" size="8" value="{{$perfil->Prf_Est}}" disabled></td>
    </tr>
</table>

<h3 id="detalle">Detalle</h3>    
<table>
    <tr>                
        <td colspan="2" class="fetch">
            <table class="detalle">                    
                <tr class="head">
                    <td>Privilegios</td>
                </tr>
                @foreach($perfil_detalle as $detalle)
                    @if($detalle->Id_Prf==$perfil->Id_Prf)
                        <tr class="body">
                            <td id="priv" style="white-space: pre-wrap; text-align:justify !important;">{{$detalle->Prf_Priv}}</td>                            
                        </tr>
                    @endif
                @endforeach                    
            </table>
        </td>
    </tr>
</table>