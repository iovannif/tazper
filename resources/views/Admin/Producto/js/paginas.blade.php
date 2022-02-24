@section('navegacion_1') <!-- paginacion -->
    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 3, " ", STR_PAD_LEFT))}}</button>
    
    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
    <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($productos->currentPage(), 2, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 2, " ", STR_PAD_LEFT))}}</button>
    @endif

    @if($lastPage>1)
    <div id="pag_bot"><div class="records">
        <a href="{{url('Productos?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
        {{$productos->links('vendor\pagination\simple-default')}}
        <a href="{{url('Productos?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
    </div></div>
    @endif
@endsection

@section('contenido')
    <style onload="
        window.cantidad= <?php echo $cant; ?>;
        window.pagina_actual=<?php echo $productos->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;  
        
            console.log(window.productos_chequeados);
            
            // if(window.productos_chequeados.length==0){            
            //     $('#grupal').css('visibility','hidden');                  
            // }
            if(window.productos_chequeados.length!=0){            
                $('#grupal').css('display','block');                  
                // console.log('a '+window.productos_chequeados);
            }            

        //cargar pagina Set
        if(sessionStorage.getItem('productos_sesion')==null){
            window.productos_chequeados=[];
        }else{
            window.productos_chequeados=JSON.parse(sessionStorage.getItem('productos_sesion'));        
            
            $('input.check').each(function(){
                var id=$(this).attr('id');        
                if(sessionStorage.getItem('producto_'+id)!=null){
                    var chequeado=sessionStorage.getItem('producto_'+id);
                }else{
                    var chequeado=false;
                }

                $(this).prop('checked', chequeado);
            });
        }        

        //marcado todo
        if(typeof window.marcando_todo!='undefined'){
            if(window.marcando_todo!='fin'){
                $('input.check').each(function(){
                    $(this).prop('checked', true);

                    var id=$(this).attr('id');                                                        
                    sessionStorage.setItem('producto_'+id,true);                                                     
                    window.productos_chequeados.push(id);                                                                                            
                });                
                //sesion productos
                sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
                console.log('sesion: '+JSON.parse(sessionStorage.getItem('productos_sesion')));  
                
                if(window.pagina_actual==window.ultima_pagina){                    
                    window.marcando_todo='fin';                                
                    // console.log(window.productos_chequeados.length);
                        $('#todo').css('cursor', 'default');
                        $('.marcar_todos').css('display','none');                        
                    $('#grupal').css('visibility','visible');
                    $('#grupal').css('display','block'); 
                }else{
                    $('#siguiente').trigger('click');
                }
            }
        }

        if(window.productos_chequeados.length==window.todos.length){
            $('#todo').prop('checked', true).prop('disabled', true);   
            $('#todo').css('cursor','default');
        }else{
            $('#todo').prop('checked',false).prop('disabled',false);

        }
        //Ajax            
        setTimeout(function(){ 
            $('.registro').css('pointer-events','auto');                     
        }, 50);   
    ">
        .registro{
            pointer-events:none;
        }        
    </style>

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
            <td id="opciones" colspan="4">Opciones</td>
        </tr>
        
        @if($productos)
        @foreach($productos as $producto)
        <tr class="registro">
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
                        $('#grupal').css('display','block'); 
                        return false;
                    }else{
                        $('#grupal').css('visibility','hidden');
                    }
                }); 
                
                if(window.productos_chequeados.length==window.todos.length){
                    $('#todo').prop('checked', true).prop('disabled', true);       
                    $('.marcar_todos').css('display','none'); 
                    $('#todo').css('cursor','default');            
                }else{
                    $('#todo').prop('checked',false).prop('disabled',false);
                    $('.marcar_todos').css('display','block');    
                }
            "></td>
            <td class="operacion td_ver"><a href="Productos/{{$producto->Id_Prod}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_editar"><a href="Productos/{{$producto->Id_Prod}}/edit"><button class="botones" id="editar">Editar</button></a></td>
            <td class="operacion td_eliminar">
                <!-- delete form -->
                <input type="submit" class="botones eliminar" id="eliminar" value="Eliminar" onclick="
                    window.id=$('.registro:hover').find('#reg_id').val();
                    window.el_check=$('.registro:hover').find($('input[type=checkbox]'));

                    // window.todos=0;
                    // if(window.todos>0){                               
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
                <!--  -->
            </td>
        </tr>
        @endforeach
        @endif
        <script src="{{asset('js/vistas/operacion.js')}}"></script>

        @php
            $linea=1;
            $relleno=20-$mostrados;
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
                
                @if($cant==0)
                    <td class="operacion check"></td>
                    
                    <td class="operacion td_ver"></td>
                    <td class="operacion td_editar"></td>
                    <td class="operacion td_eliminar"></td>
                        <style>
                            #nav2,#pag,#most,#marcar_todos,.marcar_todos{
                                display:none;
                            }
                            #paginacion{
                                left:627px !important;
                            }
                        </style>
                    @else
                    <td class="check"></td>                        
                @endif
            </tr>
        @endfor
    </table>
    <!-- <script src="{{asset('js/vistas/mdfmsv_chck_.js')}}"></script> 
    primera y ajax diferentes  -->
@endsection