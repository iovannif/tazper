@extends('Admin.lay.Index')

<style>
    body{
        height:100.1%;
    }

    #navegacion_1{
        display:none;
    }

    #tit{
        font-family: Raleway;
        color: #C90000;
        font-size: 20px;
        font-weight: bold;
        text-shadow: 1px 1px 1px lightgrey;
        margin-top:10px;
        margin-bottom: 10px;
    }

    #contenido div{
        text-align:center;
        cursor: default;
    }

    p,#parm{
        text-shadow: 0px 0px 0px #999;
    }
    
    input[name=de]{        
        margin-left: 15px;            
    }

    /* 
    input[type=radio]{
        vertical-align: top;
    }     
    dentro de table da igual
    */

    input{
        cursor:hand;
    }

    input[name=tipo]{        
        margin-left: 10px;            
        margin-right: 25px;            
    }

    .genera{
        margin-top: 35px;
    }

    #parm{
        margin:auto;
        margin-top: 15px;
        margin-bottom: 17px;
    }
    #parm td{
        border:none;
        padding-bottom: 15px;
    } 

    input[type=date]{
        border-radius: 4px;
        border: 1px solid #999999;
        box-shadow: 0px 0px 1px 1px inset #E6E6E6;
        margin-left: 10px;
        margin-right: 10px;
        margin-top:5px;
        margin-bottom:15px;
        padding: 0 0 0 6px;
        font-size: 15px;
        height:30px;
        text-shadow: 0px 0px 0px #999;
    }  

    button{
        margin-bottom:15px !important;
        background: #007bff;
        border: 1px solid #007bff;
        box-shadow: 1px 1px 2px 0px #000;
        text-shadow: 1px 1px 1px #000;
        color: white;
        border-radius: 2px !important;
        padding: 3px 6px;        
    } 
    button:hover{
        background: #005CBD;        
    }    
</style>

@section('titulo')
    Informes
@endsection

@section('contenido')    
    <div>    
        {!! Form::open(['url'=>'lista_informe']) !!}

        <p id="tit">Seleccionar tipo</p>
        <p>Tipo de transacciones</p>
        
        <p class="genera">Generar informe de:</p>
        <table id="parm">            
            <tr>
                <td>Lista de Ventas realizadas</td>
                <td><input type="radio" name="de" value="venta" checked></td>
            </tr>
            <tr>
                <td>Lista de Compras realizadas</td>
                <td><input type="radio" name="de" value="compra"></td>
            </tr>
            <tr>
                <td>Todo</td>
                <td><input type="radio" name="de" value="todo"></td>
            </tr>
        </table>

        <p>Tipo de informe:</p>
        <table id="parm">            
            <tr>
                <td>Simple</td>
                <td><input type="radio" name="tipo" value="simple" checked></td>
            
                <td>Detalle</td>
                <td><input type="radio" name="tipo" value="detallado"></td>
            </tr>
        </table>
        
        <p id="tit">Rango de fechas:</p>
        <p>
            De <input type="date" name="inicio" required> a <input type="date" name="fin" required>
        </p>     
              
        <a href="Inicio"><button>Generar</button></a>    

        {!! Form::close() !!}
    </div>

        {{--@if($ventas[0]->Ven_Fe=='2021-03-14')
        $ventas
        @endif--}}    
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection