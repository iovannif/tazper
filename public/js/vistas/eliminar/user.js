window.addEventListener("load", function(){
    $(document).ready(function(){
        //si esta marcado
        $('.eliminar').click(function(){
            window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
                
                window.id=$('.registro:hover').find('input').val(); 
        });

        // Confirmar
        $('.confirmar').click(function(){
            event.preventDefault();
            var id=window.id;
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

                if(window.el_check.is(':checked')){
                    sessionStorage.removeItem('user_'+id);
                    
                    var el_id=window.users_chequeados.indexOf(id);
                    window.users_chequeados.splice(el_id,1);
                    
                    sessionStorage.setItem('users_sesion', JSON.stringify(window.users_chequeados));
                }

                $("#eliminado").show().delay(1500).fadeOut(0);                
                
                if(id==window.current_user){
                    window.location.replace("http:localhost/Tazper/public/login");
                }else{
                    setTimeout(function(){
                        fetch(`http://localhost/Tazper/public/usuarios_fetch`, { method:"get" })
                        .then(response=>response.text())
                        .then(html=>{document.getElementById("contenido").innerHTML=html});
                                        
                        window.total=window.total.toString();
                        if(window.total.length==1){
                            $("#total_reg").text("Total: "+String.fromCharCode(160)+String.fromCharCode(160)+window.total);
                        }else{
                            $("#total_reg").text("Total: "+window.total);
                        }
                    }, 500);                
                }
            }else{
                if(window.registros>1){
                    $("#rechazo").show().delay(1500).fadeOut(0);
                }else{
                    $.ajax({
                        type:"DELETE",
                        url:"http://localhost/Tazper/public/Usuarios/"+id,
                        headers: {
                            "X-CSRF-TOKEN":$("input[name=_token]").val()
                        },
                        data:{"id":id,
                            // '_token': '{{csrf_token()}}',
                            "_method": "DELETE"},
                        success:function(data){
                            console.log(id+" success");
                        }
                    });

                    window.location.replace("http:localhost/Tazper/public/register");
                }
            }
        });
    });
});