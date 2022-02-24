<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tazper</title>
    <style>
        .titulo{
            text-align:center;
            font-weight:bold;
            font-size:120%;
            margin-bottom:10px;
        }
        .head{
            border-bottom:1px solid black;            
        }
        .cabecera{
            /* width:fit-content; */
        }
        .cabecera td{
            /* border:1px solid black; */
            width:fit-content;
        }
        input{
            font-family: 'Times New Roman', Times, serif;
            border:none;
            font-size:16px;            
            /* color:inherit; */            
        }
        input::-webkit-input-placeholder { color: inherit; }
        .cabecera input{
            /* margin-right:15px; */
        }
        .det_head{
            font-weight:600;
        }
        .det{
            margin-top:5px;
        }
        .det .head{
            text-align:center;
        }
        .num{
            text-align:right;
        }
    </style>
</head>

<body>
    <div class="head titulo">Informe de Pago</div>
    <!-- <span class="head">Informe de Pago</span> -->

    {{--$pago--}}
    <!-- pago arqueo compra factura
    proveedor sucursal ptoexp
    condicion medio caja
    registro por egreso -->    
    <table class="cabecera">
        <tr>
            <td>Id Pago: </td>
            <td><input type="text" size="3" value="{{$pago->Id_Pag}}"></td>

            <td>Proveedor: </td>
            <td><input type="text" size="20" value="{{$pago->Pag_Prov}}"></td>
        </tr>
    
        <tr>
            <td>Arqueo: </td>
            <td><input type="text" size="3" value="{{$pago->Id_Arq}}"></td>            

            <td>Sucursal: </td>
            <td><input type="text" size="3" value="{{$pago->Id_Suc}}"></td>
        </tr>
    
        <tr>
            <td>Id Compra: </td>
            <td><input type="text" size="3" value="{{$pago->Id_Com}}"></td>

            <td>Pto. Expedición: </td>
            <td><input type="text" size="3" value="{{$pago->Id_PtoExp}}"></td>            
        </tr>
    
        <tr>    
            <td>Factura: </td>
            <td><input type="text" size="10" value="{{$pago->Pag_Fac}}"></td>
            
        </tr>   

        <tr>    
        <td>&nbsp;</td>
        </tr>  
        
        <tr> 
            <td>Condición de pago: </td>
            <td><input type="text" size="6" value="{{$pago->Pag_ConPag}}"></td>   

            <td>Registro: </td>
            <td><input type="text" size="10" value="{{$pago->created_at->format('d/m/Y H:i')}}">
        </tr>   
            
        <tr>    
            <td>Medio de pago: </td>
            <td><input type="text" size="6" value="{{$medio}}"></td>

            <td>Por: </td>
            <td><input type="text" size="10" value="{{$pago->Pag_RegUser}}"></td> 
        </tr>   
            
        <tr>            
            <td>Caja: </td>
            <td><input type="text" size="3" value="{{$pago->Id_Caj}}"></td>  

            <td>Egreso: </td>
            <td><input type="text" size="10" value="{{number_format($pago->Pag_Eg,0,',','.')}} Gs."></td>
        </tr>        

        <tr><td>&nbsp;</td></tr>        
    </table>        

    <span class="det_head">Detalle del pago</span>
    <table class="det">
        <tr> 
            <td class="head">Artículo</td>
            <td class="head">Precio</td>
            <td class="head">Cantidad</td>
            <td class="head">Importe</td>
        </tr>

        @foreach($detalle as $pag_det)
        <tr>
            <td><input type="text" size="30" value="{{$pag_det->PD_Art}}"></td>
            <td><input type="text" class="num" size="7" value="{{$pag_det->PD_ArtPre}}"></td>
            <td><input type="text" class="num" size="7" value="{{$pag_det->PD_ArtCant}}"></td>
            <td><input type="text" class="num" size="7" value="{{$pag_det->PD_ArtTot}}"></td>                                                
        </tr>
        @endforeach
    </table>
</body>
</html>