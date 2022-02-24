@section('navegacion_1') <!-- paginacion -->
    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>            

    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
    <button class="boton trans" id="pag">Página {{$proveedores->currentPage()}} de {{$lastPage}}</button>
    @endif

    @if($lastPage>1)
    <div id="pag_bot"><div class="records">                
        <a href="{{url('Proveedores?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>                
        {{$proveedores->links('vendor\pagination\simple-default')}}
        <a href="{{url('Proveedores?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
    </div></div>
    @endif
@endsection

@section('contenido')
    <style onload=" //recarga        
        window.cantidad= <?php echo $cant; ?>;
        window.pagina_actual=<?php echo $proveedores->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;

            // console.log('chequeados: '+window.proveedores_chequeados);
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('proveedores_sesion')));
        
        if(sessionStorage.getItem('proveedores_sesion')==null){
            window.proveedores_chequeados=[];
        }else{
            window.proveedores_chequeados=JSON.parse(sessionStorage.getItem('proveedores_sesion'));
        }

        $('input.check').each(function(){
            var id=$(this).attr('id');
            var check=document.getElementById(id);
            
            if(sessionStorage.getItem('proveedor_'+id)!=null){
                var chequeado=JSON.parse(sessionStorage.getItem('proveedor_'+id));
                check.checked=chequeado;
            }

            // sessionStorage.removeItem('proveedor_'+id); //borra
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
                    console.log(window.proveedores_chequeados.length);
                }else{
                    $('#siguiente').trigger('click');
                }
            }
        }        

        if(window.proveedores_chequeados.length==window.todos.length){
            $('#todo').prop('checked', true);
        }

        window.no=[]; //fk
    "></style>

    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Descripción</td>            
            <td>Estado</td>
            <td>Teléfono</td>
            <td>Dirección</td>
            <td id="opciones" colspan="4">Opciones</td>
        </tr>
        
        @if($proveedores)
        @foreach($proveedores as $proveedor)
        <tr class="registro">
            <td><input type="text" id="reg_id" size="4" value="{{$proveedor->Id_Prov}}" disabled></td>
            <td><input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled></td>
            <td><input type="text" size="8" value="{{$proveedor->Prov_Est}}" disabled></td>
            <td><input type="text" size="15" value="{{$proveedor->Prov_Tel}}" disabled></td>
            <td><input type="text" size="45" value="{{$proveedor->Prov_Dir}}" disabled>
        
                @php
                    $foreign='';
                
                    foreach($articulos as $articulo){
                        if($articulo->Id_Prov==$proveedor->Id_Prov){
                            $foreign='true';
                            break;
                        }
                    }

                    foreach($pedidos as $pedido){
                        if($pedido->Id_Prov==$proveedor->Id_Prov){
                            $foreign='true';
                            break;
                        }
                    }

                    foreach($compras as $compra){
                        if($compra->Id_Prov==$proveedor->Id_Prov){
                            $foreign='true';
                            break;
                        }
                    }
                @endphp
                <input type="hidden" class="foreign" value="{{$foreign}}" disabled></td>
            
            {{--<td class="check"><input class="check" type="checkbox" value="{{$proveedor->Id_Prov}}" id="{{$proveedor->Id_Prov}}" onclick="                                
                var art=$('.registro:hover').find($('.foreign')).val();   
            
                if(art==''){
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);
                    
                    sessionStorage.setItem('proveedor_'+id, check.checked);

                    if(sessionStorage.getItem('proveedor_'+id)=='true'){
                        window.proveedores_chequeados.push(id);
                    }else{
                        sessionStorage.removeItem('proveedor_'+id);

                        index=window.proveedores_chequeados.indexOf(id);
                        window.proveedores_chequeados.splice(index,1);
                    }                                
                    console.log('chequeados: '+window.proveedores_chequeados);

                    sessionStorage.setItem('proveedores_sesion', JSON.stringify(window.proveedores_chequeados));
                    console.log('sesion: '+JSON.parse(sessionStorage.getItem('proveedores_sesion')));
                }else{
                    var id=$(this).attr('id');

                    if($(this).is(':checked')){
                        window.no.push(id);                    
                    }else{
                        var i=window.no.indexOf(id);
                        window.no.splice(index,1);
                    }
                        console.log(window.no);    
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
                        if(window.proveedores_chequeados.length==window.todos.length){
                            $('#todo').prop('checked', true);
                        }
                    }else{
                        $('#todo').prop('checked',false);
                    }                    
            "></td>--}}            
            <td class="operacion td_ver"><a href="{{url('Proveedores/'.$proveedor->Id_Prov)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_editar"><a href="{{url('Proveedores/'.$proveedor->Id_Prov.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
            <td class="operacion td_eliminar">
                <!-- delete form -->
                <input type="submit" class="botones borrar" id="eliminar" value="Eliminar" onclick="
                    window.id=$('.registro:hover').find('#reg_id').val();
                    window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
                                    
                    var foreign=$('.registro:hover').find($('.foreign')).val();
                    if(foreign=='true'){
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
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="30" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="15" disabled></td>
                    <td><input type="text" size="45" disabled></td>
                    @if($cant==0)                                    
                    {{--<td class="operacion check"></td>--}}
                    
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
                    {{--<td class="check"></td>--}}
                    @endif
                </tr>
            @endfor
    </table>

    <!-- marcados -->    
    {{--
    <div id="marcar_todos">
        <button class="boton trans">Marcar todos:</button>

        <button class="boton trans">Página</button>
        <input id="todos" type="checkbox" onclick="        
            if($('#todos').is(':checked')){
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);

                    if(sessionStorage.getItem('proveedor_'+id)==null){
                        $(this).prop('checked', true);
                        sessionStorage.setItem('proveedor_'+id, check.checked);
                        window.proveedores_chequeados.push(id);
                    }else{
                        window.marcados.push(id);
                    }
                });
                $('#grupal').css('visibility','visible');
                
                if(window.proveedores_chequeados.length==window.todos.length){
                    $('#todo').prop('checked', true);
                }
            }
            else{
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    // if(window.marcados.indexOf(id)==-1){
                        $(this).prop('checked', false);
                        sessionStorage.removeItem('proveedor_'+id);

                        var index=window.proveedores_chequeados.indexOf(id);
                        window.proveedores_chequeados.splice(index,1);
                    // }
                });
                if(window.proveedores_chequeados.length==0){
                    $('#grupal').css('visibility','hidden');
                }

                $('#todo').prop('checked',false);

                // console.log(window.proveedores_chequeados.length);
            }
            // console.log('chequeados: '+window.proveedores_chequeados);

            sessionStorage.setItem('proveedores_sesion', JSON.stringify(window.proveedores_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('proveedores_sesion')));
        ">        
    </div>--}}
@endsection