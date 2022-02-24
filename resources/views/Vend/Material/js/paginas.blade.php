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
                        
        window.cantidad= <?php echo $cant; ?>;
        window.pagina_actual=<?php echo $materiales->currentPage() ?>;
        window.ultima_pagina=<?php echo $lastPage ?>;

            // console.log('chequeados: '+window.materiales_chequeados);
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('materiales_sesion')));
        
        if(sessionStorage.getItem('materiales_sesion')==null){
            window.materiales_chequeados=[];
        }else{
            window.materiales_chequeados=JSON.parse(sessionStorage.getItem('materiales_sesion'));
        }

        $('input.check').each(function(){
            var id=$(this).attr('id');
            var check=document.getElementById(id);
            
            if(sessionStorage.getItem('material_'+id)!=null){
                var chequeado=JSON.parse(sessionStorage.getItem('material_'+id));
                check.checked=chequeado;
            }

            // sessionStorage.removeItem('material_'+id); //borra
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
                    console.log(window.materiales_chequeados.length);
                }else{
                    $('#siguiente').trigger('click');
                }
            }
        }        

        if(window.materiales_chequeados.length==window.todos.length){
            $('#todo').prop('checked', true);
        }

        window.no=[]; //relacionados por fk
    ;">
    </style>           

    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button> <!-- total -->                        
    @if($cant>0)
    <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button> <!-- mostrados -->
    <button class="boton trans" id="pag">Página {{$materiales->currentPage()}} de {{$lastPage}}</button> <!-- pagina -->
    @endif
    
    @if($lastPage>1)
    <div id="pag_bot"><div class="records">
        <a href="{{url('Materiales?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a> <!-- primera -->
        {{$materiales->links('vendor\pagination\simple-default')}} <!-- anterior siguiente -->
        <a href="{{url('Materiales?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a> <!-- utima -->
    </div></div>       
    @endif
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Id Art</td>
            <td>Id Mat</td>
            <td>Descripción</td>
            <td>Estado</td>
            <td>Existencia</td>
            <td>Medición</td>
            <td>Proveedor</td>
            <td id="opciones" colspan="3" style="width:174px !important;">Opciones</td>
        </tr>
        
        @foreach($materiales as $material)
        <tr class="registro">
            <td><input type="text" id="reg_id" size="4" value="{{$material->Id_Art}}" disabled></td>
            <td><input type="text" size="4" value="{{$material->Id_Mat}}" disabled></td>
            <td><input type="text" size="35" value="{{$material->Art_DesLar}}" disabled></td>
            <td><input type="text" size="8" value="{{$material->Art_Est}}" disabled></td>
            <td><input type="text" size="5" value="{{$material->Art_St}}" disabled></td>            
            <td><input type="text" size="20" value="{{$material->Art_UniMed}}" disabled></td>         
            <td>
                @if($proveedores->count()>0)                        
                    @foreach($proveedores as $proveedor)
                        @if($proveedor->Id_Prov==$material->Id_Prov)
                            <input type="text" size="20" value="{{$proveedor->Prov_Des}}" disabled>
                            @php $no='false'; @endphp
                            @break
                        @else
                            @php $no='true'; @endphp
                        @endif
                    @endforeach

                    @if($no=='true')
                        <input type="text" size="30" disabled>
                    @endif
                @else
                    <input type="text" size="30" disabled>
                @endif                        
            </td> 

                @php
                    $foreign='';

                        //pivot art
                                        
                    foreach($produccion as $prod_det){
                        if($prod_det->Id_Art==$material->Id_Art){
                            $foreign='true';
                            break;
                        }
                    }

                    foreach($pedidos as $ped_det){
                        if($ped_det->Id_Art==$material->Id_Art){
                            $foreign='true';
                            break;
                        }
                    }

                    foreach($compras as $com_det){
                        if($com_det->Id_Art==$material->Id_Art){
                            $foreign='true';
                            break;
                        }
                    }
                @endphp
                <input type="hidden" id="{{$material->Id_Art}}" class="foreign" value="{{$foreign}}" disabled></td>      
            
            {{--<td class="check"><input class="check" type="checkbox" value="{{$material->Id_Art}}" id="{{$material->Id_Art}}" onclick="
                // var productos=$('.registro:hover').find($('.prod')).val();                   
            
                if(window.todos.length==0){                    
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);
                    
                    sessionStorage.setItem('material_'+id, check.checked);

                    if(sessionStorage.getItem('material_'+id)=='true'){
                        window.materiales_chequeados.push(id);
                    }else{
                        sessionStorage.removeItem('material_'+id);

                        index=window.materiales_chequeados.indexOf(id);
                        window.materiales_chequeados.splice(index,1);
                    }                                
                    console.log('chequeados: '+window.materiales_chequeados);

                    sessionStorage.setItem('materiales_sesion', JSON.stringify(window.materiales_chequeados));
                    console.log('sesion: '+JSON.parse(sessionStorage.getItem('materiales_sesion')));
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
                        if(window.materiales_chequeados.length==window.todos.length){
                            $('#todo').prop('checked', true);
                        }
                    }else{
                        $('#todo').prop('checked',false);
                    }     
            "></td>--}}            
            <td class="operacion"><a href="{{url('Materiales/'.$material->Id_Mat)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion"><a href="{{url('Materiales/'.$material->Id_Mat.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
            <td class="operacion"><input type="submit" class="botones borrar" id="eliminar" value="Eliminar" onclick="
                //si esta marcado
                window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
                window.id=window.el_check.val();

                    window.id=$('.registro:hover').find('#reg_id').val();                    
                
                //si el regsitro está referenciado
                // var foreign=$('.registro:hover').find($('.prod')).val();            
                var foreign=$('.registro:hover').find($('.foreign')).val();            
                // if(foreign>0){            
                // if(window.todos.length>0){                        
                if(foreign!=''){                  
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
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="35" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="5" disabled></td>
                    <td><input type="text" size="20" disabled></td>
                    <td><input type="text" size="30" disabled></td>
                    @if($cant==0)
                    {{--<td class="operacion check"></td>--}}
                    <td class="operacion"></td>
                    <td class="operacion"></td>
                    <td class="operacion"></td>
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

    <!-- marcados -->
    {{--<div id="marcar_todos">
        <button class="boton trans">Marcar todos:</button>

        <button class="boton trans">Página</button>
        <input id="todos" type="checkbox" onclick="        
            if($('#todos').is(':checked')){
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);

                    if(sessionStorage.getItem('material_'+id)==null){
                        $(this).prop('checked', true);
                        sessionStorage.setItem('material_'+id, check.checked);
                        window.materiales_chequeados.push(id);
                    }else{
                        window.marcados.push(id);
                    }
                });
                $('#grupal').css('visibility','visible');
                
                if(window.materiales_chequeados.length==window.todos.length){
                    $('#todo').prop('checked', true);
                }
            }
            else{
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    // if(window.marcados.indexOf(id)==-1){
                        $(this).prop('checked', false);
                        sessionStorage.removeItem('material_'+id);

                        var index=window.materiales_chequeados.indexOf(id);
                        window.materiales_chequeados.splice(index,1);
                    // }
                });
                if(window.materiales_chequeados.length==0){
                    $('#grupal').css('visibility','hidden');
                }

                $('#todo').prop('checked',false);

                // console.log(window.materiales_chequeados.length);
            }
            // console.log('chequeados: '+window.materiales_chequeados);

            sessionStorage.setItem('materiales_sesion', JSON.stringify(window.materiales_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('materiales_sesion')));
        ">        
    </div>--}}
@endsection