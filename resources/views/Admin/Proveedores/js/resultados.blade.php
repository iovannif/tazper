@section('navegacion_1') <!-- paginacion -->
    @if($todos==0)
        <style>
            #paginacion{
                left: 610px !important;
            }
        </style>
    @elseif($todos>0 && $todos<=20)
        <style>
            #paginacion{
                left: 485px !important;
            }
        </style>
    @elseif($todos>20)    
        <style>
            #paginacion{
                left: 371px !important;
            }
        </style>
    @endif
    <style onload="
        $(document).ready(function(){
            // resultados
            window.result= <?php echo $todos; ?>; 
            window.pag_act=<?php echo $resultados->currentPage(); ?>;
            window.ult_pag=<?php echo $lastPage ?>;           
            
            if(window.result!=0){
                $('#mf').css('display','inline'); //marcar filtro
            }            

            var filtro=document.getElementById('buscar');
            if(filtro.disabled){
                $('#no_match').css('top','116px');
            }else{
                $('#no_match').css('top','157px');
            }            

            // set
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
            });            
            
            // marcando            
            if(window.proveedores_chequeados.length!=0){
                // $('#filtrados').prop('checked', true);
                $('#grupal').css('visibility','visible');
            }
            if(typeof window.marcando_filtrados!='undefined'){
                if(window.marcando_filtrados!='fin'){
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
                    console.log(window.proveedores_chequeados);
                    sessionStorage.setItem('proveedores_sesion', JSON.stringify(window.proveedores_chequeados));
                    
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

            window.no=[]; //fk
        });        
    ">        
        #no_match{
            position: relative;
            top: 116px;
            right: 527px;
            text-shadow:none;
        }

        #mf{
            left: 33%;
        }
        
        #inicio,#fin,#anterior,#anterior_inactivo,#siguiente_inactivo,#siguiente{
            background:#0075F3 !important;
            border-color:#006BDE !important;
        }
        #inicio:hover,#fin:hover,#anterior:hover,#siguiente:hover{
            background:#006BDE !important;
            border-color:#006BDE !important;
        }
    </style>

    @if($resultados->count()==0)
        <button class="boton trans" id="total_reg">Resultados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($todos, 2, " ", STR_PAD_LEFT))}}</button>        
        <button class="boton trans" id="no_match">{{'No hay coincidencias'}}</button>
    @else    
        <button class="boton trans" id="total_reg">Resultados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($todos, 2, " ", STR_PAD_LEFT))}}</button>        
        
        <!-- <div class="paginas"> -->
        @if($todos>0)
        <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($count, 2, " ", STR_PAD_LEFT))}}</button>
        <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($resultados->currentPage(), 2, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 2, " ", STR_PAD_LEFT))}}</button>
        @endif        

        @if($lastPage>1)
        <div class="resultados">
            <a href="{{url('Proveedores_buscador?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$resultados->links('vendor\pagination\simple-default')}}
            <a href="{{url('Proveedores_buscador?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div>            
        @endif
        <!-- </div>         -->
    @endif
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Descripción</td>            
            <td>Estado</td>
            <td>Teléfono</td>
            <td>Dirección</td>
            <td id="opciones" colspan="4">Opciones</td>
        </tr>

        @foreach($resultados as $proveedor)
        <tr class="registro" onmouseover="$(this).find('.operacion').css('visibility','visible');" onmouseout="$(this).find('.operacion').css('visibility','hidden');">
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
                    if($(this).is(':checked')){ //hay marcado
                        // if(window.result>20){                            
                        //     $('#grupal').css('top','185px');
                        // }

                        $('#grupal').css('visibility','visible'); //muestra
                        return false;                    
                    }else{ //no hay marcado
                        $('#grupal').css('visibility','hidden'); //oculta                        
                        $('#grupal').css('top','144px');
                    }
                });
                
                //pagina
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
            "></td>--}}
            <td class="operacion td_ver"><a href="{{url('Proveedores/'.$proveedor->Id_Prov)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_editar"><a href="{{url('Proveedores/'.$proveedor->Id_Prov.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
            <td class="operacion td_eliminar">
                <!-- delete form -->
                <input type="submit" class="botones eliminar" id="eliminar" value="Eliminar" onclick="
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

            @php
                $linea=1;
                $relleno=20-$count;
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="30" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="15" disabled></td>
                    <td><input type="text" size="45" disabled></td>
                    
                    {{--<td class="check"></td>--}}
                    <td class="operacion td_ver"></td>
                    <td class="operacion td_editar"></td>
                    <td class="operacion td_eliminar"></td>
                </tr>
            @endfor    
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

                        if(sessionStorage.getItem('proveedor_'+id)==null){
                            $(this).prop('checked', true);
                            sessionStorage.setItem('proveedor_'+id, check.checked);
                            window.proveedores_chequeados.push(id);
                        }else{
                            window.marcados.push(id);
                        }
                    });
                    console.log(window.proveedores_chequeados);
                    sessionStorage.setItem('proveedores_sesion', JSON.stringify(window.proveedores_chequeados));
                    
                    // if(window.result>20){                        
                    //     $('#grupal').css('top','185px');
                    // }
                }
                $('#filtrados').prop('disabled', true);
                $('#siguiente').trigger('click');
            }
        ">
    </div>--}}
@endsection