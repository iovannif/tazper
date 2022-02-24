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
    <style onload=" //recarga        
        window.cantidad= <?php echo $cant; ?>;
        window.pagina_actual=<?php echo $productos->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;

        if(sessionStorage.getItem('productos_sesion')==null){
            window.productos_chequeados=[];
        }else{
            window.productos_chequeados=JSON.parse(sessionStorage.getItem('productos_sesion'));
        }

        $('input.check').each(function(){
            var id=$(this).attr('id');
            var check=document.getElementById(id);
            
            if(sessionStorage.getItem('producto_'+id)!=null){
                var chequeado=JSON.parse(sessionStorage.getItem('producto_'+id));
                check.checked=chequeado;
            }

            // sessionStorage.removeItem('producto_'+id); //borra
        });

        // pagina
        // window.pagina='';
        $('input.check').each(function(){
            if($(this).is(':checked')){
                window.pagina='true';
            }else{
                window.pagina='false';
                return false;
            }
        });
        if(window.pagina=='true'){
            $('#todos').prop('checked', true);
        }else{
            $('#todos').prop('checked', false);
        } 

        // total
        if(typeof window.borrar!='undefined'){
            if(window.borrar.length!=0){
                window.borrar.forEach(
                    element => window.todos.splice(window.borrar.indexOf(element),1)
                );
                console.log(window.todos);
                window.borrar=[];
            }
        }
        
        // todo
        if(typeof window.marcando_todo!='undefined'){
            if(window.marcando_todo!='fin'){
                $('#todos').trigger('click');
                
                if(window.pagina_actual==window.ultima_pagina){
                    // location.reload();
                    window.marcando_todo='fin';
                    $('#todo').prop('disabled',true);
                    // $('#todo').attr('disabled','disabled');
                    console.log(window.productos_chequeados.length);
                }else{
                    $('#siguiente').trigger('click');
                }
            }
        }

        // if(typeof window.desmarcando_todo!='undefined'){
        //     if(window.desmarcando_todo!='fin'){
        //         $('#todos').trigger('click');
                
        //         if(window.pagina_actual==window.ultima_pagina){
        //             window.desmarcando_todo='fin';
        //             $('#inicio').trigger('click');
        //         }else{
        //             $('#siguiente').trigger('click');
        //         }
        //     }
        // }

        if(window.productos_chequeados.length==window.todos.length){
            $('#todo').prop('checked', true);
        }
    "></style>

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
                if(window.todos.length==0){ 
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);
                    
                    sessionStorage.setItem('producto_'+id, check.checked);

                    if(sessionStorage.getItem('producto_'+id)=='true'){
                        window.productos_chequeados.push(id);
                    }else{
                        sessionStorage.removeItem('producto_'+id);

                        index=window.productos_chequeados.indexOf(id);
                        window.productos_chequeados.splice(index,1);
                    }                                
                    console.log('chequeados: '+window.productos_chequeados);

                    sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
                    console.log('sesion: '+JSON.parse(sessionStorage.getItem('productos_sesion')));
                }else{
                    var id=$(this).attr('id');

                    if($(this).is(':checked')){
                        window.no.push(id);                    
                    }else{
                        var i=window.no.indexOf(id);
                        window.no.splice(index,1);
                    }
                        console.log(window.no.length);    
                }

                    $('input.check').each(function(){
                        if($(this).is(':checked')){
                            $('#grupal').css('visibility','visible');
                            return false;
                        }else{
                            $('#grupal').css('visibility','hidden');
                        }
                    });

                    $('input.check').each(function(){
                        if($(this).is(':checked')){
                            window.pagina='true';
                        }else{
                            window.pagina='false';
                            return false;
                        }
                    });
                    if(window.pagina=='true'){
                        $('#todos').prop('checked', true);
                    }else{
                        $('#todos').prop('checked', false);
                    }

                    if($(this).is(':checked')){
                        if(window.productos_chequeados.length==window.todos.length){
                            $('#todo').prop('checked', true);
                        }
                    }else{
                        $('#todo').prop('checked',false);
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

    <!-- marcados -->
    <div id="marcar_todos">
        <button class="boton trans">Marcar todos:</button>

        <button class="boton trans">Página</button>
        <input id="todos" type="checkbox" onclick="        
            if($('#todos').is(':checked')){
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
                $('#grupal').css('visibility','visible');
                
                if(window.productos_chequeados.length==window.todos.length){
                    $('#todo').prop('checked', true);
                }
            }
            else{
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    // if(window.marcados.indexOf(id)==-1){
                        $(this).prop('checked', false);
                        sessionStorage.removeItem('producto_'+id);

                        var index=window.productos_chequeados.indexOf(id);
                        window.productos_chequeados.splice(index,1);
                    // }
                });
                if(window.productos_chequeados.length==0){
                    $('#grupal').css('visibility','hidden');
                }

                $('#todo').prop('checked',false);

                console.log(window.productos_chequeados.length);
            }
            // console.log('chequeados: '+window.productos_chequeados);

            sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('productos_sesion')));
        ">        
    </div>
@endsection