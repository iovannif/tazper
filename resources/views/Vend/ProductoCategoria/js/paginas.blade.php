@section('navegacion_1')
    @if($cant==0)
    <style> /* por tener create ajax en index */
        #paginacion{
            left: 627px !important;
        }
    </style>
    @elseif($cant>0 && $cant<=20)
    <style>    
        #paginacion{
            left: 516px !important;
        }
    </style>
    @endif
    @if($cant>20)
    <style>
        /* Navegacion */
        #paginacion{
            left: 420px !important;
        }
        #pag{
            margin-right: 16px;
        }
    </style>
    @endif
    <style onload="
        window.cant='<?php echo $cant; ?>';        
        
        if(window.cant%20==0){
            window.ult_pag=<?php echo $lastPage+1; ?>;
        }else{
            window.ult_pag=<?php echo $lastPage; ?>;
        }

        // ----------
        window.cantidad= <?php echo $cant; ?>;
        window.pagina_actual=<?php echo $categorias->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;

            // console.log('chequeados: '+window.categorias_chequeados);
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('categorias_sesion')));
        
        if(sessionStorage.getItem('categorias_sesion')==null){
            window.categorias_chequeados=[];
        }else{
            window.categorias_chequeados=JSON.parse(sessionStorage.getItem('categorias_sesion'));
        }

        $('input.check').each(function(){
            var id=$(this).attr('id');
            var check=document.getElementById(id);
            
            if(sessionStorage.getItem('categoria_'+id)!=null){
                var chequeado=JSON.parse(sessionStorage.getItem('categoria_'+id));
                check.checked=chequeado;
            }

            // sessionStorage.removeItem('categoria_'+id); //borra
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
                    console.log(window.categorias_chequeados.length);
                }else{
                    $('#siguiente').trigger('click');
                }
            }
        }        

        if(window.categorias_chequeados.length==window.todos.length){
            $('#todo').prop('checked', true);
        }

        window.no=[]; //relacionados por fk
    ;">
    </style>           

    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button> <!-- total -->                        
    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button> <!-- mostrados -->
    <button class="boton trans" id="pag">Página {{$categorias->currentPage()}} de {{$lastPage}}</button> <!-- pagina -->
    @endif
    
    @if($lastPage>1)
    <div id="pag_bot"><div class="records">
        <a href="{{url('Productos_Categoria?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a> <!-- primera -->
        {{$categorias->links('vendor\pagination\simple-default')}} <!-- anterior siguiente -->
        <a href="{{url('Productos_Categoria?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a> <!-- utima -->
    </div></div>       
    @endif
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Descripción</td>
            <td>Estado</td>
            <td>Registro</td>
            <td>Productos</td>
            <td id="opciones" colspan="4">Opciones</td>
        </tr>
        
        @foreach($categorias as $categoria)
        <tr class="registro">
            <td><input type="text" id="reg_id" size="4" value="{{$categoria->Id_Cat}}" disabled></td>
            <td><input type="text" size="20" value="{{$categoria->Cat_Des}}" disabled></td>
            <td><input type="text" size="8" value="{{$categoria->Cat_Est}}" disabled></td>
            <td><input type="text" size="8" value="{{$categoria->created_at->format('d/m/y')}}" disabled></td>
            <td>                    
                @php
                    $contador=0;
                    
                    foreach($productos as $producto){
                        if($producto->Id_Cat==$categoria->Id_Cat){
                            $contador++;
                        }
                    }
                @endphp
                <input type="text" class="prod" size="3" value="{{$contador}}" disabled>
            </td>
            
            {{--<td class="check"><input class="check" type="checkbox" value="{{$categoria->Id_Cat}}" id="{{$categoria->Id_Cat}}" onclick="
                var productos=$('.registro:hover').find($('.prod')).val();   
            
                if(productos==0){
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);
                    
                    sessionStorage.setItem('categoria_'+id, check.checked);

                    if(sessionStorage.getItem('categoria_'+id)=='true'){
                        window.categorias_chequeados.push(id);
                    }else{
                        sessionStorage.removeItem('categoria_'+id);

                        index=window.categorias_chequeados.indexOf(id);
                        window.categorias_chequeados.splice(index,1);
                    }                                
                    console.log('chequeados: '+window.categorias_chequeados);

                    sessionStorage.setItem('categorias_sesion', JSON.stringify(window.categorias_chequeados));
                    console.log('sesion: '+JSON.parse(sessionStorage.getItem('categorias_sesion')));
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
                        if(window.categorias_chequeados.length==window.todos.length){
                            $('#todo').prop('checked', true);
                        }
                    }else{
                        $('#todo').prop('checked',false);
                    }     
            ">--}}
            <td class="operacion td_ver"><a href="{{url('Productos_Categoria/'.$categoria->Id_Cat)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_editar"><a href="{{url('Productos_Categoria/'.$categoria->Id_Cat.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
            <td class="operacion td_eliminar"><input type="submit" class="botones borrar" id="eliminar" value="Eliminar" onclick="
                //si esta marcado
                window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
                window.id=window.el_check.val();
                
                //si el regsitro está referenciado
                var foreign=$('.registro:hover').find($('.prod')).val();            
                if(foreign>0){            
                    // alert('si');                
                    $('#rechazo').show().delay(1500).fadeOut(0);
                }else{
                    $('#confirm').css('display','block');
                }
            "></td>
        </tr>
        @endforeach
        <script src="{{asset('js/vistas/operacion.js')}}"></script>

            @php
                $linea=1;
                $relleno=20-$mostrados;
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="20" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="3" disabled></td>
                    @if($cant==0)
                    {{--<td class="operacion check"></td>--}}
                    <td class="operacion td_ver"></td>
                    <td class="operacion td_editar"></td>
                    <td class="operacion td_eliminar"></td>
                        <style>
                            #nav2,#pag,#most,#marcar_todos,.marcar_todos{
                                display:none;
                            }                            
                        </style>
                    @else
                    {{--<td class="check"></td>--}}
                    @endif
                </tr>
            @endfor
    </table>

    <!-- marcados -->{{--
    <div id="marcar_todos">
        <button class="boton trans">Marcar todos:</button>

        <button class="boton trans">Página</button>
        <input id="todos" type="checkbox" onclick="        
            if($('#todos').is(':checked')){
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);

                    if(sessionStorage.getItem('categoria_'+id)==null){
                        $(this).prop('checked', true);
                        sessionStorage.setItem('categoria_'+id, check.checked);
                        window.categorias_chequeados.push(id);
                    }else{
                        window.marcados.push(id);
                    }
                });
                $('#grupal').css('visibility','visible');
                
                if(window.categorias_chequeados.length==window.todos.length){
                    $('#todo').prop('checked', true);
                }
            }
            else{
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    // if(window.marcados.indexOf(id)==-1){
                        $(this).prop('checked', false);
                        sessionStorage.removeItem('categoria_'+id);

                        var index=window.categorias_chequeados.indexOf(id);
                        window.categorias_chequeados.splice(index,1);
                    // }
                });
                if(window.categorias_chequeados.length==0){
                    $('#grupal').css('visibility','hidden');
                }

                $('#todo').prop('checked',false);

                // console.log(window.categorias_chequeados.length);
            }
            // console.log('chequeados: '+window.categorias_chequeados);

            sessionStorage.setItem('categorias_sesion', JSON.stringify(window.categorias_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('categorias_sesion')));
        ">        
    </div>--}}
@endsection