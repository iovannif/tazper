@extends('Admin.lay.Show')

<style>
	#content{
		margin-bottom: 72px !important;
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
    Caja
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Caja/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif

        @if($next)
        <a href="{{URL::to('Caja/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Caja')}}" class="volver"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    <table id="principal">
		<tr>
            <td><label for="id_caj">Id de caja:</label></td>
            <td><input type="text" size="4" value="{{$caja->Id_Caj}}" disabled></td>
        </tr>

		<tr>
			<td><label for="descripcion">Descripción:</label></td>
			<td><input type="text" size="20" value="{{$caja->Caj_Des}}" disabled></td>
		</tr>

		<tr>
			<td><label for="cod_caj">Código de caja:</label></td>
			<td><input type="text" size="10" value="{{$caja->Caj_Cod}}" disabled></td>
		</tr>

		<tr>
			<td><label for="suc">Sucursal:</label></td>
			<td>
				@foreach($sucursales as $sucursal)
					@if($sucursal->Id_Suc==$caja->Id_Suc)
					<input type="text" size="7" value="Suc-{{$sucursal->Suc_Cod}}" disabled>
					@endif
				@endforeach						
			</td>			
		</tr>

		<tr>
			<td><label for="pto_exp">Punto de expedición:</label></td>
			<td>
				@foreach($puntos as $punto)
					@if($punto->Id_PtoExp==$caja->Id_PtoExp)
					<input type="text" size="7" value="Exp-{{$punto->PtoExp_Cod}}" disabled>
					@endif
				@endforeach
			</td>			
		</tr>

		<tr>
			<td><label for="estado">Estado:</label></td>
			<td><input type="text" size="10" value="{{$caja->Caj_Est}}" disabled></td>
		</tr>

		<tr>
			<td><label for="fondo">Fondo:</label></td>
			<td><input type="text" size="7" value="{{number_format($caja->Caj_Fon,0,',','.')}}" disabled></td>			
		</tr>
	</table>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection