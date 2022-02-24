@extends('Admin.lay.Show')

@section('titulo')
    Lista de Precios
@endsection

<style>
    #contenido{
        width:fit-content !important;
        padding-right:30px !important;
    }
    #content{
        width:fit-content;
        margin-left:auto !important;
        margin-right:auto !important;
    }

    /* #content{
        margin:4px 120px 10px 120px !important;
    } */

    /* detalle */
    #detalle,#contenido .paginacion,.paginacion_det{
        display:inline;
    }
    #contenido .paginacion,.paginacion_det{
        float:right;        
    }
    #contenido .paginacion,.paginacion_det{
        margin-bottom:4px;
    }
    #contenido #siguiente,#contenido #siguiente_inactivo{
        margin-left: -15px;
        margin-right: 0px;
    }

    /* sin auditoria */
    #auditoria{
        display:none;
    }

    .body .der{
        text-align: right !important;
    }
</style>

{{--
@if($cant==0 || $cant==1)
<style>
    #content{
        margin-bottom: 128px !important; /**/
    }
</style>
@elseif($cant==2)
<style>
    #content{
        margin-bottom: 91px !important;
    }
</style>
@elseif($cant==3)
<style>
    #content{
        margin-bottom: 54px !important;
    }
</style>
@elseif($cant==4)
<style>
    #content{
        margin-bottom: 17px !important;
    }
</style>
@endif
--}}

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('ListaPrecio/'.$previous)}}" class="anterior show primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif        
            
        @if($next)
        <a href="{{URL::to('ListaPrecio/'.$next)}}" class="siguiente show"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('ListaPrecio')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    <table id="principal">
        <tr>
            <td><label for="cod_lp">Id de Lista:</label></td>
            <td><input type="text" id="id" size="4" value="{{$lista->Id_Lp}}" disabled></td>
        </tr>
        <tr>
            <td><label for="descripcion">Categoría de Cliente:</label></td>
            <td><input type="text" size="15" value="{{$lista->Lp_Cat}}" disabled></td>
        </tr>
        <tr>
            <td><label for="desc">Descuento:</label></td>
            <td><input type="text" size="3" value="{{$lista->Lp_Desc.'%'}}" disabled></td>
        </tr>
        <tr>
            <td><label for="desc">Clientes:</label></td>
            <td><input type="text" size="3" value="{{$clientes}}" disabled></td>
        </tr>
        <tr>
            <td><label for="estado">Estado:</label></td>
            <td><input type="text" size="8" value="{{$lista->Lp_Est}}" disabled></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>    
@endsection

@section('detalle')
    <div id="lp_det">
        <h3 id="detalle">Detalle</h3>
        {{$productos->links('vendor\pagination\simple-default')}}
        <table class="detalle">
            <tr class="head">
                <td>Id Art</td>                        
                <td>Id Prod</td>                                
                <td>Productos</td>                                    
                <td>Precio Original</td>
                <td>Descuento gs.</td>
                <td>Precio por Categoría</td>
                <td>Compra</td>
                <td>Ganancia</td>      
            </tr>

                @php
                    switch($lista->Lp_Desc){
                        case '0%':
                            $desc="0";
                            break;
                        case '10%':
                            $desc="10";
                            break;
                        case '20%':
                            $desc="20";
                            break;
                    }
                @endphp

            @if($cant!=0) 
            @foreach($detalles as $detalle)
                @foreach($productos as $producto)    
                    <tr class="body">                                                  
                        <td><input type="text" size="4" value="{{$producto->Id_Art}}" disabled></td>
                        <td><input type="text" size="4" value="{{$producto->Id_Prod}}" disabled></td>
                        <td><input type="text" size="30" value="{{$producto->Art_DesLar}}" disabled></td>
                        <td><input type="text" class="der" size="7" value="{{number_format($producto->Art_PreVen,0,',','.')}}" disabled></td>
                        <td><input type="text" class="der" size="7" value="{{number_format($desc_art=$desc*$producto->Art_PreVen/100,0,',','.')}}" disabled></td>
                        <td><input type="text" class="der" size="7" value="{{number_format($pre_cat=$producto->Art_PreVen-$desc_art,0,',','.')}}" disabled></td>
                        <td><input type="text" class="der" size="7" value="{{number_format($producto->Art_PreCom,0,',','.')}}" disabled></td>
                        <td><input type="text" class="der" size="7" value="{{number_format($pre_cat-$producto->Art_PreCom,0,',','.')}}" disabled></td>                                                                        
                    </tr> 
                @endforeach                            
            @endforeach

                @php
                    $linea=1;
                    $relleno=20-$productos->count();
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="body">
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="30" disabled></td>
                        <td><input type="text" size="7" disabled></td>                
                        <td><input type="text" size="7" disabled></td>
                        <td><input type="text" size="7" disabled></td>
                        <td><input type="text" size="7" disabled></td>
                        <td><input type="text" size="7" disabled></td>       
                    </tr>
                @endfor
            @else
                <tr class="body">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="30" value="No hay productos" disabled></td>
                    <td><input type="text" size="7" disabled></td>                
                    <td><input type="text" size="7" disabled></td>
                    <td><input type="text" size="7" disabled></td>
                    <td><input type="text" size="7" disabled></td>
                    <td><input type="text" size="7" disabled></td>
                </tr>             
            @endif
        </table>
    </div>
@endsection

@section('navegacion_2')    
    <div class="arriba_no">      
@endsection

<script>
    window.addEventListener("load", function(){
        window.lp=$('#id').val();
        // console.log(window.lp);
    });
</script>
<script src="{{asset('js/vistas/paginacion_show/lp.js')}}"></script>