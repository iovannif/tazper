@extends('Admin.lay.Show')

<style>
    #content{
		margin-bottom: 166px !important;
	}

    /* Contenido */
	#contenido{
		padding-top:34px !important;
		padding-bottom:30px !important;
	}
	td{
        padding:3px 0 3px 10px !important;
    }	    
    #auditoria{
        display:none;
    }        
    
    /* sin detalle */
    /* sin auditoria */
</style>

@section('titulo')
    Punto de Expedición
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('PtoExpedicion/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif
        
        @if($next)
        <a href="{{URL::to('PtoExpedicion/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('PtoExpedicion')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    <table id="principal">
        <tr>
            <td><label for="id_pto">Id:</label></td>
            <td><input type="text" size="4" value="{{$punto->Id_PtoExp}}" disabled></td>
        </tr>

        <tr>
            <td><label for="descripcion">Descripción:</label></td>
            <td><input type="text" size="20" value="{{$punto->PtoExp_Des}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="codigo">Código de punto:</label></td>
            <td><input type="text" size="7" value="Exp-{{$punto->PtoExp_Cod}}" disabled></td>
        </tr>        

        <tr>
			<td><label for="suc">Sucursal:</label></td>
			<td>
				@foreach($sucursales as $sucursal)
					@if($sucursal->Id_Suc==$punto->Id_Suc)
					<input type="text" size="7" value="Suc-{{$sucursal->Suc_Cod}}" disabled>
					@endif
				@endforeach						
			</td>			
		</tr>

        <tr>
            <td><label for="estado">Estado:</label></td>
            <td><input type="text" size="8" value="{{$punto->PtoExp_Est}}" disabled></td>
        </tr>        
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection