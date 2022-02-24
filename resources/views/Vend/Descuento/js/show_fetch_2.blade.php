<table id="principal">
    <tr>
        <td><label for="des_lar">Id de Descuento:</label></td>
        <td><input type="text" size="4" value="{{$descuento->Id_Desc}}" disabled></td>
    </tr>

    <tr>
        <td><label for="des_lar">Tipo:</label></td>
        <td><input type="text" size="15" value="{{$descuento->Desc_Tip}}" disabled></td>
    </tr>

    <tr>
        <td><label for="des_lar">Descripción:</label></td>
        <td><input type="text" size="20" value="{{$descuento->Desc_Des}}" disabled></td>
    </tr>

    <tr>
        <td><label for="estado">Estado:</label></td>
        <td><input type="text" size="8" value="{{$descuento->Desc_Est}}" disabled></td>
    </tr>

    <tr>
        <td class="obs"><label for="observacion">Observación:</label></td>
        <td><textarea rows="4" cols="50" id="obs" disabled>{{$descuento->Desc_Obs}}</textarea></td>
    <tr>

    <tr>
        <td>&nbsp;</td>
    </tr>

    @include('Admin.Descuento.js.user')
    
    <!-- detalle -->
    <h3 id="detalle">Detalle</h3>

    <div class="para">
        <span class="tit">Para:</span>        
            <!-- lp -->
            @php
                $count=0;
                foreach($detalle as $det){
                    if($det->Id_Lp!=''){                        
                        $count++;
                        break;
                    }
                }
            @endphp                                            

        @if($count>=1)            
        <table class="detalle para">                            
            <tr class="head">
                <td colspan="2">Categorías de Cliente</td>
            </tr>
            <tr class="head">
                <td class="sub">Id</td>            
                <td class="sub">Descripción</td>            
            </tr>
            
            @foreach($detalle as $det)
                @if($det->Id_Lp!='')
                    @foreach($listas as $lp)
                        @if($det->Id_Lp==$lp->Id_Lp)
                        <tr class="body">
                            <td><input type="text" size="4" value="{{$det->Id_Lp}}" disabled></td>                                                                                                        
                            <td><input type="text" size="20" value="{{$lp->Lp_Cat}}" disabled></td>                                                                                                      
                        </tr>      
                        @endif
                    @endforeach
                @endif
            @endforeach
        </table><br><br>            
        @endif
        
            <!-- cli -->
            @php
                $count=0;
                foreach($detalle as $det){
                    if($det->Id_Cli!=''){                        
                        $count++;
                        break;
                    }
                }
            @endphp 

        @if($count>=1)     
        <table class="detalle para">            
            <tr class="head">
                <td colspan="2">Clientes</td>                    
            </tr>
            <tr class="head">
                <td class="sub">Id</td>            
                <td class="sub">Nombre</td>            
            </tr>
            
            @foreach($detalle as $det)
                @if($det->Id_Cli!='')
                    @foreach($clientes as $cliente)
                        @if($det->Id_Cli==$cliente->Id_Cli)
                        <tr class="body">
                            <td><input type="text" size="4" value="{{$det->Id_Cli}}" disabled></td>                                                                             
                            <td><input type="text" size="40" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled></td>      
                        </tr>      
                        @endif
                    @endforeach
                @endif
            @endforeach
        </table>
        @endif
    </div>        

    <div class="sobre">            
        
            <!-- uno o varios porc -->
            @php
                $catprod=0;
                $porc=0;
            
                foreach($detalle as $det){
                    if($det->Id_Cat!='' || $det->Id_Art!=''){                        
                        $catprod++;
                    }

                    if($det->DD_Porc!=''){                            
                        $porc++;                          
                        $desc=$det->DD_Porc;
                    }    
                }                    
            @endphp            

            <!-- cat prod porc --> 
            @php                             
                $cat_cont=0;                    
                
                $porc_cont=0;                                         
                $cat_porc=[];                   
                $prod_porc=[];                   
                                
                foreach($detalle as $det){
                    if($det->Id_Cat!=''){                        
                        $cat_cont++;                                                        
                    }                        
                }

                foreach($detalle as $det){
                    if($det->DD_Porc!=''){      
                        $porc_cont++;

                        if($porc_cont<=$cat_cont){
                            array_push($cat_porc, $det->DD_Porc);
                        }else{
                            array_push($prod_porc, $det->DD_Porc);
                        }                            
                    }                        
                }
            @endphp   

                {{--$cat_porc[0]--}}
                <!-- no array, si collection, json -->
                <!-- offset, no existe posicion en array, no existe array -->


            <!-- cat -->
            @php
                $count=0;
                foreach($detalle as $det){
                    if($det->Id_Cat!=''){                        
                        $count++;
                        break;
                    }
                }
            @endphp 



        <!-- un porcentaje -->     
            @php                             
                $cat=0;
                $prod=0;                             
                                
                foreach($detalle as $det){
                    if($det->Id_Cat!=''){                        
                        $cat++;                                                        
                    }                        
                    if($det->Id_Prod!=''){                        
                        $prod++;                                                        
                    }                        
                }
            @endphp                        

        @if($porc==1)
            @if($cat==0 || $prod==0)
            <!-- <br><br> -->
            Porcentaje: <input type="text" class="porc_tod" size="2" value="{{$desc}}" disabled> %
            @endif    
        @endif

        <span class="tit">Sobre:</span>

        @if($count>=1)                 
        <table class="detalle sobre">            
            <tr class="head">
                <td colspan="3">Categorías de Producto</td>                    
            </tr>
            <tr class="head">
                <td class="sub">Id</td>            
                <td class="sub">Descripción</td> 
                
                @if($porc_cont>1)               
                    <td class="sub">Porcentaje</td> 
                @endif
            </tr>
            
            @foreach($detalle as $det)
                @if($det->Id_Cat!='')
                    @php
                    $i=0;
                    @endphp                        

                    @foreach($categorias as $cat)
                        @if($det->Id_Cat==$cat->Id_Cat)
                        <tr class="body">
                            <td><input type="text" size="4" value="{{$det->Id_Cat}}" disabled></td>                                                                                                  
                            <td><input type="text" size="20" value="{{$cat->Cat_Des}}" disabled></td>  
                            

                            @if($porc_cont>1)               
                                <td><input type="text" size="2" value="{{$cat_porc[$i]}}%" disabled></td>
                            @endif                          
                        </tr>                                    
                        @endif
                    @endforeach
                @endif
            @endforeach
        </table><br><br>   
        @endif      

            <!-- prod -->
            @php
                $count=0;
                foreach($detalle as $det){
                    if($det->Id_Art!=''){                        
                        $count++;
                        break;
                    }
                }
            @endphp 

        @if($count>=1)                            
        <table class="detalle sobre">                            
            <tr class="head">
                <td colspan="3">Productos</td>                    
            </tr>
            <tr class="head">
                <td class="sub">Id</td>            
                <td class="sub">Nombre</td>      

                {{--@if($catprod>1)--}} <!-- incluye prod, por algo entro aca -->      
                
                @if($porc_cont>1)        
                <td class="sub">Porcentaje</td>                         
                @endif                                      
            </tr>                
            
            @foreach($detalle as $det)
                @if($det->Id_Art!='')
                    @foreach($productos as $producto)
                        @if($det->Id_Art==$producto->Id_Art)
                            @php
                                $i=0;
                            @endphp

                        <tr class="body">
                            <td><input type="text" size="4" value="{{$det->Id_Art}}" disabled></td>                                                                  
                            <td><input type="text" size="30" value="{{$producto->Art_DesLar}}" disabled></td>  
                            

                            @if($porc_cont>1)        
                            <td><input type="text" size="2" value="{{$prod_porc[$i]}}%" disabled></td>                 
                            @endif                                     
                        </tr>      
                        @endif
                    @endforeach
                @endif
            @endforeach
        </table>  
        @endif             
                
    </div>   
</table>                    
