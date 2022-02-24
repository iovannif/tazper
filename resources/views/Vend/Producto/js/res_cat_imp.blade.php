@section('navegacion_1') <!-- paginacion -->
        
        @php 
            if(Session::get('art_cat')){
                if(empty($productos_cats)!=1){                    
                    //print_r($productos_cats);
                    
                    $i=0;                
                            
                    foreach($resultados as $key =>$pro){
                        foreach($productos_cats as $p_c){
                            if($pro->Id_Art==$p_c){
                                //echo $pro->Id_Art;                                
                                break;                            
                            }else{                            
                                $i++;
                                if($i==count($productos_cats)){
                                    //echo $pro->Id_Art;                                  
                                    unset($resultados[$key]); //controller =resultados                                                                
                                }                                                        
                            }                                                                         
                        }       
                        $i=0;     
                    } 

                    //echo $todos;
                    
                    $can_tot=count($productos_cats);                
                    
                        /*                                                                                                                    
                        if($todos<$can_tot){
                            $todo=$todos;
                        }elseif($can_tot<$todos){
                            $todo=$can_tot;
                            $count=$resultados->count();
                        }elseif($todos==$can_tot){
                            $todo=$todos;
                        } 
                        */
                        $count=$resultados->count();
                        
                        if($count<$can_tot){
                            $todo=$count;
                        }elseif($can_tot<$count){
                            $todo=$can_tot;
                            
                        }elseif($count==$can_tot){
                            $todo=$count;
                        } 

                    if($todo>20){
                        $lastPage=2;
                    }else{
                        $lastPage=1;
                    } 
                    
                                                        
                } 
                
                else{
                    $resultados = collect([]);      
                    $todo=0;    
                                     
                    $lastPage=0;                    
                } 
                
            }  

            //:/      
        @endphp
        
        @php 
            if(Session::get('art_imp')){        
                if(empty($productos_imp)!=1){
                    
                    //print_r($productos_imp);
                    
                    $i=0;                
                            
                    foreach($resultados as $key =>$pro){
                        foreach($productos_imp as $p_i){
                            if($pro->Id_Art==$p_i){
                                //echo $pro->Id_Art;                                
                                break;                            
                            }else{                            
                                $i++;
                                if($i==count($productos_imp)){
                                    //echo $pro->Id_Art;                                  
                                    unset($resultados[$key]);                                
                                }                                                        
                            }                                                                         
                        }       
                        $i=0;                         
                    }                                   
                    
                    
                        /*
                            //print_r($productos_imp);
                            //echo count($productos_imp);        

                        $todos=count($productos_imp);                
                        $count=$resultados->count();                                                                                                

                        if($todos>20){
                            $lastPage=2;
                        }else{
                            $lastPage=1;
                        } 
                        */                                                    

                    $can_tot=count($productos_imp);       
                    $count=$resultados->count();       

                    if($count<$can_tot){
                        $todo=$count;
                    }elseif($can_tot<$count){
                        $todo=$can_tot;
                        
                    }elseif($count==$can_tot){
                        $todo=$count;
                    } 

                    if($todo>20){
                        $lastPage=2;
                    }else{
                        $lastPage=1;
                    } 
                }   
                
                else{
                    $resultados = collect([]);      
                    $todo=0;    
                    
                    if($todo>20){
                        $lastPage=0;
                    }else{
                        $lastPage=0;
                    } 
                   
                } 
                
            }      
            
            //:/
        @endphp
        {{----}}

    @if($todo==0)
        <style>
            #paginacion{
                left: 610px !important;
            }
        </style>
    @elseif($todo>0 && $todo<=20)
        <style>
            #paginacion{
                left: 480px !important;
            }
        </style>
    @elseif($todo>20)    
        <style>
            #paginacion{
                left: 371px !important;
            }
        </style>
    @endif
    <style onload="
        window.result=<?php //echo $todos ?>;
        window.pag_act=<?php //echo $resultados->currentPage(); ?>;
        window.ult_pag=<?php echo $lastPage ?>;

        // if(window.result!=0){
        //     $('#mf').css('display','inline');
        // }

        //cargar pagina Set
        if(sessionStorage.getItem('productos_sesion')==null){
            window.productos_chequeados=[];
        }else{
            window.productos_chequeados=JSON.parse(sessionStorage.getItem('productos_sesion'));        
        }
        $('input.check').each(function(){
            var id=$(this).attr('id');        
            if(sessionStorage.getItem('producto_'+id)!=null){
                var chequeado=sessionStorage.getItem('producto_'+id);
            }else{
                var chequeado=false;
            }

            $(this).prop('checked', chequeado);
        });        

        //marcando filtrados
        if(typeof window.marcando_filtrados!='undefined'){
            if(window.marcando_filtrados!='fin'){
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);

                    if(sessionStorage.getItem('producto_'+id)==null){
                        $(this).prop('checked', true);
                        sessionStorage.setItem('producto_'+id, check.checked);
                        window.productos_chequeados.push(id);
                    }else{
                        window.marcados.push(id);
                    }
                });
                console.log(window.productos_chequeados);
                sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
                
                $('#filtrados').prop('disabled', true);                 
                // if(window.result>20){
                //     $('#nav3').css('display','block');
                //     $('#grupal').css('top','185px');
                // }
                                    
                if(window.pag_act==window.ult_pag){
                    window.marcando_filtrados='fin';
                }else{                        
                    $('#siguiente').trigger('click');
                }
            }
        }
        if($('#filtrados').is(':checked')){
            $('#filtrados').prop('disabled', true);
        }

        if(window.productos_chequeados.length==window.todos.length){
            $('#filtrados').prop('checked', true).prop('disabled', true);                
        }else{
            $('#filtrados').prop('checked',false).prop('disabled',false);
        }  
    ">
        #no_match{
            position: relative;
            top: 157px;
            right: 490px;
            text-shadow:none;
        }
        /* .paginas{
            display: block;
            position: relative;
            left: 95px;
            top: 7px;
        } */
        
        #inicio,#fin,#anterior,#anterior_inactivo,#siguiente_inactivo,#siguiente{
            background:#0075F3 !important;
            border-color:#006BDE !important;
        }
        #inicio:hover,#fin:hover,#anterior:hover,#siguiente:hover{
            background:#006BDE !important;
            border-color:#006BDE !important;
        }

        .botones{
            padding: 5px 28px !important;
        }
    </style>

    @if($resultados->count()==0)
        <button class="boton trans" id="total_reg">Resultados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($todo, 3, " ", STR_PAD_LEFT))}}</button>        
        <button class="boton trans" id="no_match">{{'No hay coincidencias'}}</button>
    @else    
        <button class="boton trans" id="total_reg">Resultados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($todo, 3, " ", STR_PAD_LEFT))}}</button>
                
        <!-- <div class="paginas"> -->
        @if($todo>0)
        <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($count, 2, " ", STR_PAD_LEFT))}}</button>
        <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($resultados->currentPage(), 2, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 2, " ", STR_PAD_LEFT))}}</button>
        @endif
        
        @if($lastPage>1)                
        <div id="pag_bot"><div class="resultados">
            <a href="{{url('Productos?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$resultados->links('vendor\pagination\simple-default')}}
            <a href="{{url('Productos?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div></div>
        @endif          
        <!-- </div>         -->
    @endif
@endsection

@section('contenido')
<table id="principal">
    <tr class="head">
        <td>Id Art</td>
        <td>Id Prod</td>
        <td>Descripción</td>
        <td>Categoría</td>
        <td>Estado</td>
        <td>Stock</td>
        <td>Compra</td>
        <td>Venta</td>
        <td>Impuesto</td>
        <td id="opciones" colspan="2">Opciones</td> {{--session('art_cat')--}} 
        {{--4--}}
    </tr>

    @foreach($resultados as $producto)
    <tr class="registro" onmouseover="$(this).find('.operacion').css('visibility','visible');" onmouseout="$(this).find('.operacion').css('visibility','hidden');">
        <td><input type="text" id="reg_id" size="4" value="{{$producto->Id_Art}}" disabled></td>
        <td><input type="text" size="4" value="{{$producto->Id_Prod}}" disabled></td>
        <td><input type="text" size="35" value="{{$producto->Art_DesLar}}" disabled></td>
        <td>
            @if($categorias->count()>0)                        
                @foreach($categorias as $categoria)
                    @if($categoria->Id_Cat==$producto->Id_Cat)
                        <input type="text" size="20" value="{{$categoria->Cat_Des}}" disabled>
                        @php $no='false'; @endphp
                        @break
                    @else
                        @php $no='true'; @endphp
                    @endif
                @endforeach

                @if($no=='true')
                    <input type="text" size="20" disabled>
                @endif
            @else
                <input type="text" size="20" disabled>
            @endif                        
        </td>
        <td><input type="text" size="8" value="{{$producto->Art_Est}}" disabled></td>
        <td><input type="text" size="4" value="{{$producto->Art_St}}" disabled></td>
        <td><input type="text" size="7" value="{{number_format($producto->Art_PreCom,0,',','.')}}" disabled></td>
        <td><input type="text" size="7" value="{{number_format($producto->Art_PreVen,0,',','.')}}" disabled></td>
        <td>
            @foreach($impuestos as $impuesto)
                @if($impuesto->Id_Imp==$producto->Id_Imp)
                    <input type="text" size="10" value="{{$impuesto->Imp_Des}}" disabled>
                @endif
            @endforeach
        </td>

            @php
                $foreign='';                         
                                    
                foreach($produccion as $pdc){
                    if($pdc->Id_Prod==$producto->Id_Art){
                        $foreign='true';
                        break;
                    }
                }                        
                foreach($ped_prov as $pedprov_det){
                    if($pedprov_det->Id_Art==$producto->Id_Art){
                        $foreign='true';
                        break;
                    }
                }                        
                foreach($compras as $com_det){
                    if($com_det->Id_Art==$producto->Id_Art){
                        $foreign='true';
                        break;
                    }
                }                        
                foreach($ped_cli as $pedcli_det){
                    if($pedcli_det->Id_Art==$producto->Id_Art){
                        $foreign='true';
                        break;
                    }
                }                        
                foreach($ventas as $ven_det){
                    if($ven_det->Id_Art==$producto->Id_Art){
                        $foreign='true';
                        break;
                    }
                }                                                                       
            @endphp
            <input type="hidden" id="{{$producto->Id_Art}}" class="foreign" value="{{$foreign}}" disabled></td> 
        
        {{--
        <td class="check"><input class="check" type="checkbox" value="{{$producto->Id_Art}}" id="{{$producto->Id_Art}}" onclick="                
            var id=$(this).attr('id');
            
            if($(this).is(':checked')){
                sessionStorage.setItem('producto_'+id,true);
            }else{
                sessionStorage.setItem('producto_'+id,false);
            }        

            if(sessionStorage.getItem('producto_'+id)=='true'){
                window.productos_chequeados.push(id);            
            }else{
                sessionStorage.removeItem('producto_'+id);

                var index=window.productos_chequeados.indexOf(id);
                window.productos_chequeados.splice(index,1);
            }
            console.log('chequeados: '+window.productos_chequeados);
            
            //sesion productos
            sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
            console.log('sesion: '+JSON.parse(sessionStorage.getItem('productos_sesion')));                        

            $('input.check').each(function(){
                if($(this).is(':checked')){
                    $('#grupal').css('visibility','visible');
                    return false;
                }else{
                    $('#grupal').css('visibility','hidden');
                }
            }); 
            
            if(window.productos_chequeados.length==window.todos.length){
                $('#filtrados').prop('checked', true).prop('disabled', true);                
            }else{
                $('#filtrados').prop('checked',false).prop('disabled',false);
            }                      
        "></td>--}}
        <td class="operacion td_ver"><button class="botones" id="ver"><a href="Productos/{{$producto->Id_Prod}}">Ver</a></button></td>
        <td class="operacion td_editar"><button class="botones" id="editar"><a href="Productos/{{$producto->Id_Prod}}/edit">Editar</a></button></td>
        {{--<td class="operacion td_eliminar">
            <input type="submit" class="botones eliminar" id="eliminar" value="Eliminar" onclick="
                    window.id=$('.registro:hover').find('#reg_id').val();
                window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
                
                // if(window.todos.length>0){                                
                //     $('#rechazo').show().delay(1500).fadeOut(0);
                // }else{
                //     $('#confirm').css('display','block');
                // }

                var foreign=$('.registro:hover').find($('.foreign')).val();                        
                if(foreign!=''){                                  
                    $('#rechazo').show().delay(1500).fadeOut(0);
                }else{
                    $('#confirm').css('display','block');
                }  
            ">
        </td>--}}
    </tr>
    @endforeach

    @php
        $linea=1;
        $relleno=20-$count;
    @endphp

    @for($linea==1;$linea<=$relleno;$linea++)
        <tr class="blank">
            <td><input type="text" size="4" value="" disabled></td>
            <td><input type="text" size="4" value="" disabled></td>
            <td><input type="text" size="35" value="" disabled></td>
            <td><input type="text" size="20" value="" disabled></td>
            <td><input type="text" size="8" value="" disabled></td>
            <td><input type="text" size="4" value="" disabled></td>
            <td><input type="text" size="7" value="" disabled></td>
            <td><input type="text" size="7" value="" disabled></td>
            <td><input type="text" size="10" value="" disabled></td>
            
            {{--<td class="check"></td>--}}
            @if($resultados->count()!=0)                            
                <td class="operacion td_ver"></td>
                <td class="operacion td_editar"></td>
            @endif
            {{--<td class="operacion td_eliminar"></td>--}}
        </tr>
    @endfor  
    
    @if($todo==0)
        @for($linea=1;$linea<=20;$linea++)
        <tr class="blank">
            <td><input type="text" size="4" value="" disabled></td>
            <td><input type="text" size="4" value="" disabled></td>
            <td><input type="text" size="35" value="" disabled></td>
            <td><input type="text" size="20" value="" disabled></td>
            <td><input type="text" size="8" value="" disabled></td>
            <td><input type="text" size="4" value="" disabled></td>
            <td><input type="text" size="7" value="" disabled></td>
            <td><input type="text" size="7" value="" disabled></td>
            <td><input type="text" size="10" value="" disabled></td>                        
        </tr>
        @endfor  
    @endif
</table>

<!-- marcar filtrados -->
{{--
<div id="mf">
    <button class="boton trans" id="marcar_filtrados">Marcar</button> <!-- marcar -->
    <input type="checkbox" id="filtrados" onclick="
        window.marcando_filtrados='';

        if(window.pag_act!=1){
            $('#inicio').trigger('click');
        }else{
            if($('#filtrados').is(':checked')){
                $('#grupal').css('visibility','visible');                    

                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);

                    if(sessionStorage.getItem('producto_'+id)==null){
                        $(this).prop('checked', true);
                        sessionStorage.setItem('producto_'+id, check.checked);
                        window.productos_chequeados.push(id);
                    }else{
                        window.marcados.push(id);
                    }
                });
                console.log(window.productos_chequeados);
                sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
                
                // if(window.result>20){
                //     $('#nav3').css('display','block');
                //     $('#grupal').css('top','185px');
                // }
            }
            $('#filtrados').prop('disabled', true);
            $('#siguiente').trigger('click');

            if(window.productos_chequeados.length==window.todos.length){
                $('#filtrados').prop('checked', true).prop('disabled', true);                
            }else{
                $('#filtrados').prop('checked',false).prop('disabled',false);
            }  
        }
    ">
</div>
--}}
@endsection