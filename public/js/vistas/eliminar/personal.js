window.addEventListener("load", function(){
    $(document).ready(function(){
        // Borrar
        $('.borrar').click(function(){
            event.preventDefault();            
            var usu=$('.registro:hover').find($('.user')).val();            
            window.id=$('.registro:hover').find($('.id')).val();
                        
            if(usu==''){
                console.log('borra');
                $('#confirm').css('display','block');
            }else{
                console.log('no borra');
                $("#rechazo").show().delay(1500).fadeOut(0);    
            }                                                            
        
            //si esta marcado        
            window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
        });

        // Confirmar
        $('.confirmar').click(function(){                        
            $("#confirm").css("display","none");                
            var id=window.id;
            
            $.ajax({
                type:"DELETE",
                async:false, 
                url:"http://localhost/Tazper/public/Personal/"+id,
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
                sessionStorage.removeItem('personal_'+id);
                
                var el_id=window.personal_chequeados.indexOf(id);
                window.personal_chequeados.splice(el_id,1);
                
                sessionStorage.setItem('personal_sesion', JSON.stringify(window.personal_chequeados));
            }
            
            $("#eliminado").show().delay(1500).fadeOut(0);                
            
            setTimeout(function(){
                var route="http://localhost/Tazper/public/Personal";
                    
                $.ajax({
                    url: route,
                    data: {'route': route},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#nav').html(data.nav);
                        $('#personal').html(data.contenido);                        
                    }
                });                
            }, 500);            
        });
    });
});