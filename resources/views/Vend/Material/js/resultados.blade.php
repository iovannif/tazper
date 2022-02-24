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
                left: 503px !important;
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
            });            
            
            // marcando            
            if(window.materiales_chequeados.length!=0){                
                $('#grupal').css('visibility','visible');
            }
            if(typeof window.marcando_filtrados!='undefined'){
                if(window.marcando_filtrados!='fin'){
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
                    console.log(window.materiales_chequeados);
                    sessionStorage.setItem('materiales_sesion', JSON.stringify(window.materiales_chequeados));
                    
                    $('#filtrados').prop('disabled', true);                                     
                                        
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
            right: 439px;
            text-shadow:none;
        }

        #mf{
            left: 38%;
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
                
        @if($todos>0)
        <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($count, 2, " ", STR_PAD_LEFT))}}</button>
        <button class="boton trans" id="pag">Página {{$resultados->currentPage()}} de {{$lastPage}}</button>
        @endif
               
        @if($lastPage>1)                
        <div id="pag_bot"><div class="resultados">
            <a href=" {{url('Materiales_buscador?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$resultados->links('vendor\pagination\simple-default')}}
            <a href="{{url('Materiales_buscador?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div></div>  
        @endif                  
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

        @foreach($resultados as $material)
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
            
                // if(productos==0){
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
            <td class="operacion"><a href="{{url('Materiales/'.$material->Id_Mat)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion"><a href="{{url('Materiales/'.$material->Id_Mat.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
            <td class="operacion"><input type="submit" class="botones" id="eliminar" value="Eliminar" onclick="
                //si esta marcado
                window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
                window.id=window.el_check.val();

                    window.id=$('.registro:hover').find($('#reg_id')).val();
                
                //si el regsitro está referenciado
                // var foreign=$('.registro:hover').find($('.prod')).val();            
                // if(foreign>0){            
                // if(window.todos.length>0){            
                    // alert('si');                
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
            "></td>  
        </tr>              
        @endforeach
        <script src="{{asset('js/vistas/operacion.js')}}"></script>

            @php
                $linea=1;
                $relleno=20-$count;
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
                    
                    {{--<td class="check"></td>--}}
                    <td class="operacion"></td>
                    <td class="operacion"></td>
                    <td class="operacion"></td>
                </tr>
            @endfor    
    </table>

    <!-- marcar filtrados -->
    {{--<div id="mf">
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

                        if(sessionStorage.getItem('material_'+id)==null){
                            $(this).prop('checked', true);
                            sessionStorage.setItem('material_'+id, check.checked);
                            window.materiales_chequeados.push(id);
                        }else{
                            window.marcados.push(id);
                        }
                    });
                    console.log(window.materiales_chequeados);
                    sessionStorage.setItem('materiales_sesion', JSON.stringify(window.materiales_chequeados));
                    
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