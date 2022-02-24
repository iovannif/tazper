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
            });            
            
            // marcando            
            if(window.categorias_chequeados.length!=0){                
                $('#grupal').css('visibility','visible');
            }
            if(typeof window.marcando_filtrados!='undefined'){
                if(window.marcando_filtrados!='fin'){
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
                    console.log(window.categorias_chequeados);
                    sessionStorage.setItem('categorias_sesion', JSON.stringify(window.categorias_chequeados));
                    
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
        <button class="boton trans" id="pag">Página {{$resultados->currentPage()}} de {{$lastPage}}</button>
        @endif
               
        @if($lastPage>1)                
        <div id="pag_bot"><div class="resultados">
            <a href=" {{url('ProductosCategoria_buscador?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$resultados->links('vendor\pagination\simple-default')}}
            <a href="{{url('ProductosCategoria_buscador?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div></div>  
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
            <td>Registro</td>
            <td>Productos</td>
            <td id="opciones" colspan="4">Opciones</td>
        </tr>

        @foreach($resultados as $categoria)
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
            ">--}}
            <td class="operacion td_ver"><a href="{{url('Productos_Categoria/'.$categoria->Id_Cat)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_editar"><a href="{{url('Productos_Categoria/'.$categoria->Id_Cat.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
            <td class="operacion td_eliminar"><input type="submit" class="botones" id="eliminar" value="Eliminar" onclick="
                //si esta marcado
                window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
                window.id=window.el_check.val();

                    window.id=$('.registro:hover').find('input').val(); 
                
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
                $relleno=20-$count;
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="20" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="3" disabled></td>
                    
                    {{--<td class="check"></td>--}}
                    <td class="operacion td_ver"></td>
                    <td class="operacion td_editar"></td>
                    <td class="operacion td_eliminar"></td>
                </tr>
            @endfor    
    </table>

    <!-- marcar filtrados -->{{--
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

                        if(sessionStorage.getItem('categoria_'+id)==null){
                            $(this).prop('checked', true);
                            sessionStorage.setItem('categoria_'+id, check.checked);
                            window.categorias_chequeados.push(id);
                        }else{
                            window.marcados.push(id);
                        }
                    });
                    console.log(window.categorias_chequeados);
                    sessionStorage.setItem('categorias_sesion', JSON.stringify(window.categorias_chequeados));
                    
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