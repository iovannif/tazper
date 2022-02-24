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
        .der{
            padding-left:20px;
        }
        .det .head{
            text-align:center;
        }
        .num{
            text-align:right;
        }
        .porc{
            text-align:center;
        }
    </style>
</head>

<body>
    <div class="head titulo">Informe de Cobro</div>
       
    <table class="cabecera">
        <tr>
            <td>Id Cobro: </td>
            <td><input type="text" size="3" value="{{$cob->Id_Cob}}"></td>{{--id--}}

            <td class="der">Cliente: </td>
            <td><input type="text" size="20" value="{{$cli->Cli_Nom.' '.$cli->Cli_Ape}}"></td>
        </tr>
    
        <tr>
            <td>Arqueo: </td>
            <td><input type="text" size="3" value="{{$ven->Id_Arq}}"></td>            

            <!-- <td class="der">Descuento (cliente): </td>
            <td><input type="text" size="3" value="{{$ven->Ven_CliDesc}}%"></td>             -->

            <td class="der">Descuento (Día): </td>
            <td><input type="text" size="15" value="{{$ven->Ven_DescDia}}"></td>            
        </tr>
    
        <tr>
            <td>Venta: </td>
            <td><input type="text" size="3" value="{{$cob->Id_Ven}}"></td>                        
        </tr>

        <tr>
            <td>Tipo: </td>
            <td><input type="text" size="9" value="{{$ven->Ven_Tip}}"></td>            
        </tr>
    
        <tr>    
            <td>Factura: </td>
            <td><input type="text" size="10" value="001-001-{{$ven->Ven_Fact}}"></td>            
        </tr>  

        <tr>    
            <td>Timbrado: </td>
            <td><input type="text" size="10" value="{{$timbrado}}"></td>            
        </tr>  
        
        <tr>    
            <td>Estado: </td>
            <td><input type="text" size="10" value="{{$cob->Cob_Est}}"></td>            
        </tr>

        <tr>    
        <td>&nbsp;</td>
        </tr>  
        
        <tr> 
            <td>Condición de cobro: </td>
            <td><input type="text" size="6" value="{{$ven->Ven_CondCob}}"></td>   

            <td class="der">Registro: </td>
            <td><input type="text" size="10" value="{{$cob->created_at->format('d/m/Y H:i')}}">
        </tr>   
            
        <tr>    
            <td>Medio de cobro: </td>
            <td><input type="text" size="6" value="{{$med}}"></td>

            <td class="der">Por: </td>
            <td><input type="text" size="10" value="{{$cob->Cob_RegUser}}"></td> 
        </tr>   
            
        <tr>            
            <td>Caja: </td>
            <td><input type="text" size="3" value="1"></td>  

            <td class="der">Ingreso: </td>
            <td><input type="text" size="10" value="{{number_format($ven->Ven_Tot,0,',','.')}} Gs."></td>
        </tr>        

        <tr><td>&nbsp;</td></tr>        
    </table>        

    <span class="det_head">Detalle del cobro</span>
    <table class="det">
        <tr> 
            <td class="head">Artículo</td>
            <td class="head">Precio</td>
            <td class="head">Cantidad</td>            
            
            <td class="head">Descuento (cliente)</td>
            <td class="head">(mayorista)</td>
            <td class="head">(día)</td>

            <td class="head">Importe</td>
        </tr>

        @foreach($det as $cob_det)
        <tr>
            <td><input type="text" size="20" value="{{$cob_det->CD_Art}}"></td>
            <td><input type="text" class="num" size="4" value="{{$cob_det->CD_ArtPre}}"></td>
            <td><input type="text" class="num" size="2" value="{{$cob_det->CD_ArtCant}}"></td>
            
            <td>
                @if($ven->Ven_CliDesc!=0)
                <input type="text" class="porc" size="4" value="{{$ven->Ven_CliDesc}}%">
                @else
                <input type="text" class="porc" size="4" value="">
                @endif
            </td>
            <td>
                @if($cob_det->CD_ArtCant>=15)
                <input type="text" class="porc" size="3" value="10%">
                @else
                <input type="text" class="porc" size="3" value="">
                @endif
            </td>
            <td>
                @if($cob_det->CD_ArtDesc!='')
                <input type="text" class="porc" size="2" value="{{$cob_det->CD_ArtDesc}}%">
                @else
                <input type="text" class="porc" size="2" value="">
                @endif
            </td>

            <td><input type="text" class="num" size="4" value="{{$cob_det->CD_ArtTot}}"></td>                                                
        </tr>
        @endforeach
    </table>
</body>
</html>