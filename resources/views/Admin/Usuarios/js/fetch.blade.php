@include('Admin.Usuarios.session_div.index')

<style onload="
    if(sessionStorage.getItem('users_sesion')==null){
        window.users_chequeados=[];
    }else{
        window.users_chequeados=JSON.parse(sessionStorage.getItem('users_sesion'));
    }

        if(sessionStorage.getItem('users_per_sesion')==null){
            window.users_per_chequeados=[];
        }else{
            window.users_per_chequeados=JSON.parse(sessionStorage.getItem('users_per_sesion'));
        }

    $('input.check').each(function(){
        var id=$(this).attr('id');
        var check=document.getElementById(id);

        if(sessionStorage.getItem('user_'+id)!=null){
            var chequeado=sessionStorage.getItem('user_'+id);
            check.checked=chequeado;
        }

        // sessionStorage.removeItem('user_'+id);
    });

        // $('input.check').each(function(){
            if(window.users_chequeados.length!=0){
                $('#grupal').css('visibility','visible');
                // alert(window.users_chequeados.length);
            }
        // });

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
        <td>Username</td>
        <td>Estado</td>
        <td>Perfil</td>
        <td>Personal</td>
        <td>Registro</td>
        <td id="opciones" colspan="4">Opciones</td>
    </tr>

    @foreach($users as $user)
    <tr class="registro" onmouseover="$(this).find('.operacion').css('visibility','visible');" onmouseout="$(this).find('.operacion').css('visibility','hidden');">
        <td><input type="text" id="id" size="4" value="{{$user->Id_Usu}}" disabled></td>
        <td><input type="text" size="20" value="{{$user->Usu_User}}" disabled></td>
        <td><input type="text" size="8" value="{{$user->Usu_Est}}" disabled></td>
        <td>
            @foreach($perfiles as $perfil)
                @if($perfil->Id_Prf==$user->Id_Prf)
                    <input type="text" size="20" value="{{$perfil->Prf_Des}}" disabled>
                @endif
            @endforeach
        </td>
        <td>
            @foreach($personal as $empleado)
                @if($empleado->Id_Per==$user->Id_Per)
                    <input type="text" size="35" value="{{$empleado->Per_Ape.', '.$empleado->Per_Nom}}" disabled>
                @endif
            @endforeach
            <input type="hidden" size="4" class="per" value="{{$user->Id_Per}}" disabled>
        </td>
        <td><input type="text" size="10" value="{{$user->created_at->format('d/m/Y')}}" disabled></td>

        {{--<td class="check"><input class="check" type="checkbox" value="{{$user->Id_Usu}}" id="{{$user->Id_Usu}}" onclick="
            var id=$(this).attr('id');
            // var check=document.getElementById(id);
            var check=$(this);
                var per=$('.registro:hover').find($('.per')).val();            
            
            // sessionStorage.setItem('user_'+id, check.checked);
            //     sessionStorage.setItem('user_per_'+id, per); // personal

            if(check.is(':checked')){
                sessionStorage.setItem('user_'+id, true);                      
            }else{
                sessionStorage.setItem('user_'+id, false);                      
            }

            if(sessionStorage.getItem('user_'+id)=='true'){
                window.users_chequeados.push(id);
                    window.users_per_chequeados.push(per);
            }else{
                sessionStorage.removeItem('user_'+id);
                    // sessionStorage.removeItem('user_per'+per);

                var index=window.users_chequeados.indexOf(id);
                window.users_chequeados.splice(index,1);

                    var index=window.users_per_chequeados.indexOf(per); //busca
                    window.users_per_chequeados.splice(index,1); //quita de chequeados
            }
            console.log('chequeados: '+window.users_chequeados);
                console.log('personal: '+window.users_per_chequeados);

            sessionStorage.setItem('users_sesion', JSON.stringify(window.users_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('users_sesion')));

                sessionStorage.setItem('users_per_sesion', JSON.stringify(window.users_per_chequeados));
            
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
        <td class="operacion td_ver"><a href="Usuarios/{{$user->Id_Usu}}"><button class="botones" id="ver">Ver</button></a></td>
        <td class="operacion td_editar"><a href="Usuarios/{{$user->Id_Usu}}/edit"><button class="botones" id="editar">Editar</button></a></td>
        <td class="operacion td_eliminar">
            <!-- delete form -->
            <button class="botones eliminar" id="eliminar" onclick="
                window.id=$('.registro:hover').find('#id').val();
                window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
                $('#confirm').css('display','block');
            ">Eliminar</button>
            <!--  -->
        </td>
    </tr>
    @endforeach        

    <div id="grupal">
        <button class="boton trans">Marcar todos</button>
        <input  id="todos" type="checkbox" onclick="
            if($('#todos').is(':checked')){
                $('input.check').attr('checked','checked')
            }else{
                $('input.check').removeAttr('checked');
            }

            if($('#todos').is(':checked')){
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    // var check=document.getElementById(id);                    

                    $('.per').each(function(){                           
                        if($(this).attr('id')==id){
                            var per=$(this).val();                                                
                            
                            if(sessionStorage.getItem('user_'+id)==null){                                
                                sessionStorage.setItem('user_'+id, true);
                                    sessionStorage.setItem('user_per_'+id, per);
        
                                window.users_chequeados.push(id);
                                    window.users_per_chequeados.push(per);                                                                
                            }else{
                                window.marcados.push(id);
                            }
                        }
                    }); 

                    // if(sessionStorage.getItem('user_'+id)==null){
                    //     // sessionStorage.setItem('user_'+id, check.checked);
                    //     sessionStorage.setItem('user_'+id, true);
                    //         sessionStorage.setItem('user_per_'+id, per);

                    //     window.users_chequeados.push(id);
                    //         window.users_per_chequeados.push(per);
                    // }else{
                    //     window.marcados.push(id);
                    // }
                });                
            }
            else{
                $('input.check').each(function(){
                    var id=$(this).attr('id');
                    if(window.marcados.indexOf(id)==-1){
                        sessionStorage.removeItem('user_'+id);
                            sessionStorage.removeItem('user_per'+per);  

                        var index=window.users_chequeados.indexOf(id);
                        window.users_chequeados.splice(index,1);    
                        
                            var index=window.users_per_chequeados.indexOf(per);
                            window.users_per_chequeados.splice(index,1);
                    }
                });
            }
            console.log('chequeados: '+window.users_chequeados);

            sessionStorage.setItem('users_sesion', JSON.stringify(window.users_chequeados));
            console.log('sesion: '+JSON.parse(sessionStorage.getItem('users_sesion')));
        ">

        <button class="boton trans">Marcados:</button>
        <button type="submit" class="boton" id="eliminar_grupo" onclick="
            var borrar=window.users_chequeados.length;            

            if(borrar!=0){
                if(borrar==1){
                    $('#confirm_grupal #cant').html('Está a punto de eliminar el usuario, no la podrá recuperar');
                }else{
                    $('#confirm_grupal #cant').html('Está a punto de eliminar los usuarios, no la podrá recuperar');
                }

                $('#confirm_grupal').show();
            }else{                
                $('#vacio').show().delay(1500).fadeOut(0);                
            }
        ">Eliminar</button>
        <button class="boton" id="cancelar_grupo" onclick="
            window.users_chequeados.forEach(
                element => sessionStorage.removeItem('user_'+element)
            );
            window.users_chequeados=[];
            sessionStorage.removeItem('users_sesion');
            $('#grupal').css('visibility','hidden');

                sessionStorage.removeItem('users_per_sesion'); //borra sesion, chequeados=[]                
            
            $('input.check').each(function(){
                if(sessionStorage.getItem('user_'+$(this).attr('id'))==null){
                    $(this).prop('checked', false);
                }
            });
        ">Cancelar</button>
    </div>

    @php
        $linea=1;
        $relleno=20-$users->count();
    @endphp

    @for($linea==1;$linea<=$relleno;$linea++)
        <tr class="blank">
            <td><input type="text" size="4" value="" disabled></td>
            <td><input type="text" size="20" value="" disabled></td>
            <td><input type="text" size="8" value="" disabled></td>
            <td><input type="text" size="20" value="" disabled></td>
            <td><input type="text" size="35" value="" disabled></td>
            <td><input type="text" size="10" value="" disabled></td>
            {{--<td class="check"></td>--}}
        </tr>
    @endfor
</table>

@php
        $id='';
    $total=$cant;
@endphp

<div id="confirm">
    <table>
        <tr><td class="center" colspan="2">Está a punto de eliminar el registro, no lo podrá recuperar</td></tr>
        <tr><td class="center" colspan="2">Desea continuar?</td></tr>
        <tr>
            <td class="right">
                <button class="c_botones confirmar" type="submit" onclick='
                    event.preventDefault();
                    var id=window.id;
                    var registros=<?php echo $cant; ?>;
                    $("#confirm").css("display","none");
                        console.log(id);

                    if(id!=1){
                        $.ajax({
                            type:"DELETE",
                            url:"http://localhost/Tazper/public/Usuarios/"+id,
                            headers: {
                                "X-CSRF-TOKEN":$("input[name=_token]").val()
                            },
                            data:{"id":id,
                                "_method": "DELETE"},
                            success:function(data){
                                console.log(id+" success");
                            }
                        });

                        if(window.el_check.is(":checked")){
                            sessionStorage.removeItem("user_"+id);
                            
                            var el_id=window.users_chequeados.indexOf(id);
                            window.users_chequeados.splice(el_id,1);
                            
                            sessionStorage.setItem("users_sesion", JSON.stringify(window.users_chequeados));
                        }

                        $("#eliminado").show().delay(1500).fadeOut(0);
                        var total=<?php echo $total; ?>;

                        if(id==window.current_user){
                            window.location.replace("http:localhost/Tazper/public/register");
                        }else{
                            setTimeout(function(){
                                fetch(`http://localhost/Tazper/public/usuarios_fetch`, { method:"get" })
                                .then(response=>response.text())
                                .then(html=>{document.getElementById("contenido").innerHTML=html});

                                total=total.toString();
                                if(total.length==1){
                                    $("#total_reg").text("Total: "+String.fromCharCode(160)+String.fromCharCode(160)+total);
                                }else{
                                    $("#total_reg").text("Total: "+total);
                                }
                            }, 500);
                        }
                    }else{
                        if(registros>1){
                            $("#rechazo").show().delay(1500).fadeOut(0);
                        }else{
                            $.ajax({
                                type:"DELETE",
                                url:"http://localhost/Tazper/public/Usuarios/"+id,
                                headers: {
                                    "X-CSRF-TOKEN":$("input[name=_token]").val()
                                },
                                data:{"id":id,
                                    "_method": "DELETE"},
                                success:function(data){
                                    console.log(id+" success");
                                }
                            });

                            // location.reload();
                            window.location.replace("http:localhost/Tazper/public/register");
                        }
                    }
                '>Confirmar</button>
            </td>
            <td class="left"><button class="c_botones cancelar" id="cancelar" onclick="$('#confirm').css('display','none');">Cancelar</button></td>
        </tr>
    </table>
</div>

<div id="confirm_grupal">
    <table>
        <tr><td class="center" id="cant" colspan="2">Está a punto de eliminar los usuarios, no los podrá recuperar</td></tr>
        <tr><td class="center" colspan="2">Desea continuar?</td></tr>
        <tr>
            <td class="right"><button class="c_botones g_confirmar" type="submit" onclick="
                $('#confirm_grupal').hide();
                var records=<?php echo $cant; ?>;
                var ids=[];
                var personal=[]; 
                    // var personal=window.users_per_chequeados;

                // $('input.check:checked').each(function(){
                //     if(records>1){
                //         if($(this).val()!=1){
                //             ids.push($(this).val());
                //         }else{
                //             window.admin=$(this).val();
                //             console.log('admin '+admin);
                //         }
                //     }else{
                //         ids.push($(this).val());
                //     }
                // });

                if(window.records>1){
                    if(window.users_chequeados.indexOf('1')>-1){
                        window.users_chequeados.splice(window.users_chequeados.indexOf('1'),1);
                        window.users_per_chequeados.splice(window.users_per_chequeados.indexOf('1'),1);

                        window.admin=1;
                    }                                   
                }
                console.log(window.users_chequeados);
                console.log(window.users_per_chequeados);

                ids=window.users_chequeados;                  
                personal=window.users_per_chequeados;  

                // ids.forEach(element=>console.log(element));

                var eliminar=ids.length;

                if(eliminar!=0){
                    var los_id=ids.join(',');
                        var empleados=personal.join(',');

                    $.ajax({
                        url: 'http://localhost/Tazper/public/usuarios_remove',
                        type: 'POST',                
                        // data: 'ids='+los_id,
                        data: {ids: los_id,
                            personal: empleados
                        },
                        success: function(data){
                            console.log(los_id+' success');
                        }
                    });

                    ids.forEach(
                        element => sessionStorage.removeItem('user_'+element)
                    );
                    sessionStorage.removeItem('users_sesion');

                        personal.forEach(
                            element => sessionStorage.removeItem('user_per_'+element)
                        );
                        sessionStorage.removeItem('users_per_sesion');

                    if(records!=1){
                            if(eliminar==1){
                                var eliminados='<span>'+eliminar+'</span> usuario eliminado';
                            }else{
                                var eliminados='<span>'+eliminar+'</span> usuarios eliminados';
                            }

                        if(window.admin){
                                console.log('hay un admin '+window.admin);                            
                            $('.admin_cant').html(eliminados).addClass('numero');
                            $('#admin_eliminados').show();
                        }else{
                                console.log('No admin');
                            $('.eliminados_cant').html(eliminados).addClass('numero');
                            $('#eliminados').show();
                        }

                        window.usuario_actual='';

                        if(ids.indexOf(window.current_users)!=-1){
                            window.usuario_actual='si';
                        }                        
                    
                        if(window.usuario_actual!='si'){                         
                            setTimeout(function(){
                                fetch(`http://localhost/Tazper/public/usuarios_fetch`, {method:'get'})
                                .then(response=>response.text())
                                .then(html=>{document.getElementById('contenido').innerHTML=html});
                            }, 1000);

                            var queda=records-eliminar;
                            queda=queda.toString();
                            
                            if(queda.length==1){
                                $('#total_reg').text('Total: '+String.fromCharCode(160)+String.fromCharCode(160)+queda);
                            }else{
                                $('#total_reg').text('Total: '+queda);
                            }
                        }else{
                            window.location.replace('http:localhost/Tazper/public/login');
                        }
                    }else{
                        // location.reload();
                        window.location.replace('http:localhost/Tazper/public/register');
                    }
                }else{                    
                    $('#rechazo').show().delay(1500).fadeOut(0);                    
                }
            ">Confirmar</button></td>
            <td class="left"><button class="c_botones g_cancelar" id="g_cancelar" onclick="
                $('#confirm_grupal').hide();
            ">Cancelar</button></td>
        </tr>
    </table>
</div>