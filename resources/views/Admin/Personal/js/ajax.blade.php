@section('navegacion_1')    
    <a href="{{url('Personal/create')}}" class="agregar"><button class="boton" id="agregar">Agregar</button></a>        
    <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>    
@endsection 

@section('contenido')
    <style onload="
        // Cargar Pagina
        //sesion, chequeados
        if(sessionStorage.getItem('personal_sesion')==null){ //si no hay sesion
            window.personal_chequeados=[];
        }else{
            window.personal_chequeados=JSON.parse(sessionStorage.getItem('personal_sesion')); //guarda los id
        }

        //set
        $('input.check').each(function(){
            var id=$(this).attr('id');
            var check=document.getElementById(id);

            if(sessionStorage.getItem('personal_'+id)!=null){ //si tiene item
                var chequeado=sessionStorage.getItem('personal_'+id); //true
                check.checked=chequeado; //marca
            }

            // sessionStorage.removeItem('personal_'+id); //borra
            // sessionStorage.removeItem('personal_sesion');            
        });

        //mostrar grupal
        // $('input.check').each(function(){
            if(window.personal_chequeados.length!=0){ //si hay chequeados
                $('#grupal').css('visibility','visible');
                console.log(window.personal_chequeados);
            }else{
                $('#grupal').css('visibility','hidden');
            }
        // });

        window.no=[];

        $('input.check').each(function(){
            if($(this).is(':checked')){
                window.todos='true';
            }else{
                window.todos='false';
                return false;
            }
            if(window.todos=='true'){
                $('#todos').prop('checked', true);
            }else{
                $('#todos').prop('checked', false);
            }  
        });
    "></style>

    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Apellidos, Nombres</td>            
            <td>Estado</td>
            <td>Cargo</td>
            <td>Username</td>
            <td>Registro</td>
            <td id="opciones" colspan="4">Opciones</td>
        </tr>            
        
        @if($personal)
        @foreach($personal as $empleado)
        <tr class="registro">
            <td><input type="text" class="id" size="4" value="{{$empleado->Id_Per}}" disabled></td>
            <td><input type="text" size="35" value="{{$empleado->Per_Ape.', '.$empleado->Per_Nom}}" disabled></td>
            <td><input type="text" size="8" value="{{$empleado->Per_Est}}" disabled></td>
            <td><input type="text" size="20" value="{{$empleado->Per_Car}}" disabled></td>
            <td>                
                @foreach($users as $user)
                    @if($user->Id_Usu==$empleado->Id_Usu)
                        <input type="text" class="user" size="20" value="{{$user->Usu_User}}" disabled>
                        @php $no='false'; @endphp
                        @break
                    @else
                        @php $no='true'; @endphp
                    @endif
                @endforeach

                @if($no=='true')
                    <input type="text" id="{{$empleado->Id_Per}}" class="user" size="20" disabled>
                @endif            
            </td>
            <td><input type="text" size="10" value="{{$empleado->created_at->format('d/m/Y')}}" disabled></td>

            {{--<td class="check"><input class="check" type="checkbox" value="{{$empleado->Id_Per}}" id="{{$empleado->Id_Per}}" onclick="
                // var usu=$('.registro:hover').find($('.user')).val();            

                // if(usu==''){
                    var id=$(this).attr('id');
                    // var check=document.getElementById(id);

                    // sessionStorage.setItem('personal_'+id, check.checked); //crea item, check true
                    if($('input.check:hover').is(':checked')){
                        sessionStorage.setItem('personal_'+id, 'true')
                    }else{
                        sessionStorage.setItem('personal_'+id, 'false')
                    }  

                    if(sessionStorage.getItem('personal_'+id)=='true'){ //si tiene item
                        window.personal_chequeados.push(id); //agrega a chequeados
                    }else{
                        sessionStorage.removeItem('personal_'+id); //borra item

                        var index=window.personal_chequeados.indexOf(id); //busca
                        window.personal_chequeados.splice(index,1); //quita de chequeados
                    }
                    console.log('chequeados: '+window.personal_chequeados); //vemos chequeados

                    // array a string
                    sessionStorage.setItem('personal_sesion', JSON.stringify(window.personal_chequeados)); //tiene los id
                    console.log('sesion: '+JSON.parse(sessionStorage.getItem('personal_sesion'))); //muestra la sesion
                    //string a array

                    // chequeados a chequeados, usa sesion para mantener, carga con pagina
                // }else{
                    // var id=$(this).attr('id');

                    // if($(this).is(':checked')){
                    if($('input.check:hover').is(':checked')){
                        window.no.push(id);                    
                    }else{
                        var i=window.no.indexOf(id);
                        window.no.splice(i,1);
                    }
                    console.log(window.no);    
                // }

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
                        window.todos='true';
                    }else{
                        window.todos='false';
                        return false;
                    }
                });
                if(window.todos=='true'){
                    $('#todos').prop('checked', true);
                }else{
                    $('#todos').prop('checked', false);
                }            
            "></td>--}}
            <td class="operacion td_ver"><a href="{{url('/Personal/'.$empleado->Id_Per)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_editar"><a href="{{url('/Personal/'.$empleado->Id_Per).'/edit'}}"><button class="botones" id="editar">Editar</button></a></td>
            <td class="operacion td_eliminar"><input type="submit" class="botones borrar" id="eliminar" value="Eliminar" onclick="
                event.preventDefault();            
                var usu=$('.registro:hover').find($('.user')).val();            
                window.id=$('.registro:hover').find($('.id')).val();
                            
                if(usu==''){
                    console.log('borra');
                    $('#confirm').css('display','block');
                }else{
                    console.log('no borra');
                    $('#rechazo').show().delay(1500).fadeOut(0);
                }   
                
                //si esta marcado
                window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
            "></td>
        </tr>
        @endforeach
        @endif
        <script src="{{asset('js/vistas/operacion.js')}}"></script>

        <div id="grupal">
            <button class="boton trans">Marcar todos</button> <!-- Marcar Todos -->
            <input id="todos" type="checkbox" onclick="
                if($('#todos').is(':checked')){
                    $('input.check').attr('checked','checked');
                }else{
                    $('input.check').removeAttr('checked');
                }
            ">
            
            <button class="boton trans">Marcados:</button> <!-- Marcados -->
            <button type="submit" class="boton" id="eliminar_grupo" onclick="
                var borrar=window.personal_chequeados.length;

                $('input.check').each(function(){
                    if($(this).is(':checked')){
                        window.user='si';
                        
                        return false;
                    }else{                        
                        window.user='no';
                    }
                });                

                if(borrar==0){
                    if(window.user=='no'){
                        $('#vacio').show().delay(1500).fadeOut(0);                                
                    }else{
                        $('#rechazo').show().delay(1500).fadeOut(0);                                
                    }                                        
                }else{
                    if(borrar==1){
                        $('#confirm_grupal #cant').html('Está a punto de eliminar el personal, no lo podrá recuperar');
                    }else{
                        $('#confirm_grupal #cant').html('Está a punto de eliminar los empleados, no los podrá recuperar');
                    }
                    $('#confirm_grupal').show();
                }
            ">Eliminar</button>
            <button type="submit" class="boton" id="cancelar_grupo" onclick="
                window.personal_chequeados.forEach(
                    element => sessionStorage.removeItem('personal_'+element) //borra items                    
                );
                sessionStorage.removeItem('personal_sesion'); //borra sesion, chequeados=[]                
                $('#grupal').css('visibility','hidden'); //oculta grupal

                $('input.check').each(function(){ //recorre
                    if(sessionStorage.getItem('personal_'+$(this).attr('id'))==null){ //si no hay item
                        $(this).prop('checked', false); //desmarca
                    }
                });
            ">Cancelar</button>
        </div>

            @php
                $linea=1;
                $relleno=20-$personal->count();
            @endphp

            @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="35" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="20" disabled></td>
                    <td><input type="text" size="20" disabled></td>
                    <td><input type="text" size="10" disabled></td>
                    @if($cant==0)
                        {{--<td class="operacion check"></td>--}}
                        <td class="operacion td_ver"></td>
                        <td class="operacion td_editar"></td>
                        <td class="operacion td_eliminar"></td>
                    @else
                        {{--<td class="check"></td>--}}
                    @endif
                </tr>
            @endfor
    </table>

        @php
                $id='';
            $total=$cant-1;
        @endphp    
@endsection