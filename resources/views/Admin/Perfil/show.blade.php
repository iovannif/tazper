@extends('Admin.lay.Show')
<!-- css -->
<style>
    #auditoria{
        display:none;
    }    
    .detalle{
        cursor:default !important;
    }    
    #priv{
        text-shadow:0 0 0 #ECECEC;
        height:279px;
        width:751px;
        vertical-align:top;
        border-radius: 3px !important;
        border: 1px solid #D2D2D2;        
    }
    .fetch{
        padding:0;
    }    

    /* sin auditoria */
</style>

<!-- html -->
@section('titulo')
    Perfiles
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Perfil/'.$previous)}} primer" class="anterior"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif
        
        @if($next)
        <a href="{{URL::to('Perfil/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo" disabled>Siguiente</button>
        @endif

        <a href="{{url('/Perfil')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
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
@endsection

@section('detalle')
        <h3 id="detalle">Detalle</h3>

        <tr>                
            <td>
                <table class="detalle">                    
                    <tr class="head">
                        <td>Privilegios</td>
                    </tr>
                    @foreach($perfil_detalle as $detalle)
                        @if($detalle->Id_Prf==$perfil->Id_Prf)
                            <tr class="body">
                                <td id="priv" style="white-space: pre-line !important; text-align:justify !important;">{{$detalle->Prf_Priv}}</td>
                            </tr>
                        @endif
                    @endforeach                    
                </table>
            </td>
        </tr>
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection

<!-- scripts -->
<script src="{{asset('js/vistas/paginacion_show/perfil.js')}}"></script>