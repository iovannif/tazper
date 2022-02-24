@extends('Admin.lay.Show')

<style>
    /* sin auditoria */
    #auditoria{
        display:none;
    }    
    
    /* sin detalle */
</style>

@section('titulo')
    Sucursal
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Sucursal/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif
        
        <a href="{{url('Sucursal/'.$sucursal->Id_Suc.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>
        
        @if($next)
        <a href="{{url('Sucursal/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Sucursal')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    @include('Admin.Sucursal.session_div.show')
    <table id="principal">
        <tr>
            <td><label for="id_suc">Id de sucursal:</label></td>
            <td><input type="text" size="4" value="{{$sucursal->Id_Suc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="nombre_fantasia">Nombre fantasía:</label></td>
            <td><input type="text" size="30" value="{{$sucursal->Suc_NomFan}}" disabled></td>
        </tr>                

        <tr>
            <td><label for="descripcion">Descripción:</label></td>
            <td><input type="text" size="30" value="{{$sucursal->Suc_Des}}" disabled></td>
        </tr>

        <tr>
            <td><label for="codigo">Código de sucursal:</label></td>
            <td><input type="text" size="7" value="Suc-{{$sucursal->Suc_Cod}}" disabled></td>
        </tr>

        <tr>
            <td><label for="telefono">Teléfono:</label></td>
            <td><input type="text" size="15" value="{{$sucursal->Suc_Tel}}" disabled></td>
        </tr>

        <tr>
            <td><label for="direccion">Dirección:</label></td>
            <td><input type="text" size="50" value="{{$sucursal->Suc_Dir}}" disabled></td>
        </tr>

        <tr>
            <td><label for="ciudad">Ciudad:</label></td>
            <td><input type="text" size="30" value="{{$sucursal->Suc_Ciu}}" disabled></td>
        </tr>

        <tr>
            <td><label for="barrio">Barrio:</label></td>
            <td><input type="text" size="30" value="{{$sucursal->Suc_Bar}}" disabled></td>
        </tr>        

        <tr>
            <td><label for="red_1">Red 1:</label></td>
            <td><input type="text" size="30" value="{{$sucursal->Suc_Red1}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="red_2">Red 2:</label></td>
            <td><input type="text" size="30" value="{{$sucursal->Suc_Red2}}" disabled></td>
        </tr>   

        <tr>
            <td><label for="email">E-mail:</label></td>
            <td><input type="text" size="30" value="{{$sucursal->Suc_Email}}" disabled></td>
        </tr>        

        <tr>
            <td><label for="ruc">RUC:</label></td>
            <td><input type="text" size="20" value="{{$sucursal->Suc_Ruc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="raz_soc">Razón social:</label></td>
            <td><input type="text" size="40" value="{{$sucursal->Suc_RazSoc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="enc">Encargado:</label></td>
            <td><input type="text" size="40" value="{{$sucursal->Suc_Enc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="estado">Estado:</label></td>
            <td><input type="text" size="8" value="{{$sucursal->Suc_Est}}" disabled></td>
        </tr>

        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
			<td><textarea cols="50" rows="4" id="obs" disabled>{{$sucursal->Suc_Obs}}</textarea></td>
        </tr>                
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection