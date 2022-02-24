window.addEventListener("load", function(){
    $(document).ready(function(){
        // Cargar Pagina
        //sesion, chequeados
        if(sessionStorage.getItem('productos_sesion')==null){ //si no hay sesion
            window.productos_chequeados=[];
        }else{
            window.productos_chequeados=JSON.parse(sessionStorage.getItem('productos_sesion')); //guarda los id
        }

        //set
        $('input.check').each(function(){
            var id=$(this).attr('id');
            var check=document.getElementById(id);

            if(sessionStorage.getItem('producto_'+id)!=null){ //si tiene item
                var chequeado=sessionStorage.getItem('producto_'+id); //true
                check.checked=chequeado; //marca
            }

            // sessionStorage.removeItem('producto_'+id); //borra
            // sessionStorage.removeItem('productos_sesion');
        });

        // Click
        //get
        window.no=[];
        $('input.check').click(function(){
            //referenciado
            if(window.todos.length==0){ 
                var id=$(this).attr('id');
                var check=document.getElementById(id);
                
                sessionStorage.setItem('producto_'+id, check.checked); //crea item, check true

                if(sessionStorage.getItem('producto_'+id)=='true'){ //si tiene item
                    window.productos_chequeados.push(id); //agrega a chequeados
                }else{
                    sessionStorage.removeItem('producto_'+id); //borra item

                    var index=window.productos_chequeados.indexOf(id); //busca
                    window.productos_chequeados.splice(index,1); //quita de chequeados
                }
                console.log('chequeados: '+window.productos_chequeados); //vemos chequeados

                // array a string
                sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados)); //tiene los id
                console.log('sesion: '+JSON.parse(sessionStorage.getItem('productos_sesion'))); //muestra la sesion
                //string a array

                // chequeados a chequeados, usa sesion para mantener, carga con pagina
            }else{
                var id=$(this).attr('id');

                if($(this).is(':checked')){
                    window.no.push(id);                    
                }else{
                    var i=window.no.indexOf(id);
                    window.no.splice(index,1);
                }
                    console.log(window.no.length);    
            }
        });

        //marcar todos (pagina)
        window.marcados=[];
        $('#todos').click(function(){
            if($('#todos').is(':checked')){
                $("input.check").each(function(){
                    var id=$(this).attr('id');
                    var check=document.getElementById(id);

                    if(sessionStorage.getItem('producto_'+id)==null){
                        $(this).prop('checked', true);
                        sessionStorage.setItem('producto_'+id, check.checked);
                        window.productos_chequeados.push(id);
                    }else{
                        window.marcados.push(id);
                    }
                });
                $('#grupal').css('visibility','visible');
            }
            else{
                $("input.check").each(function(){
                    var id=$(this).attr('id');
                    if(window.marcados.indexOf(id)==-1){
                        $(this).prop('checked', false);
                        sessionStorage.removeItem('producto_'+id);

                        var index=window.productos_chequeados.indexOf(id);
                        window.productos_chequeados.splice(index,1);
                    }
                });
                if(window.productos_chequeados.length==0){
                    $('#grupal').css('visibility','hidden');
                }
            }
            // console.log('chequeados: '+window.productos_chequeados);

            sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('productos_sesion')));
        });

            //mostrar grupal //solo al cargar la pagina
            $("input.check").each(function(){            
                if(window.productos_chequeados.length!=0){ //si hay chequeados
                    $('#grupal').css('visibility','visible');
                }
            });

            // pagina
            window.pagina='';
            $("input.check").each(function(){
                if($(this).is(':checked')){
                    window.pagina='true';
                }else{
                    window.pagina='false';
                    return false;
                }
            });
            if(window.pagina=='true'){
                $('#todos').prop('checked', true);
            }

            // todo
            if(window.productos_chequeados.length==window.todos.length){
                $('#todo').prop('checked', true);
            }

            // Desmarcar Todo
            $('#cancelar_grupo').click(function(){
                window.productos_chequeados.forEach(
                    element => sessionStorage.removeItem('producto_'+element) //borra items
                );
                window.productos_chequeados=[];
                    // console.log('ch '+window.productos_chequeados);
                sessionStorage.removeItem('productos_sesion'); //borra sesion, chequeados=[]
                    // console.log('ss '+sessionStorage.getItem('productos_sesion'));
                $('#grupal').css('visibility','hidden'); //oculta grupal

                
                $("input.check").each(function(){ //recorre
                    if(sessionStorage.getItem('producto_'+$(this).attr('id'))==null){ //si no hay item
                        $(this).prop('checked', false); //desmarca
                    }
                });

                $('#todos').prop('checked', false);
                $('#todo').prop('disabled',false);
                $('#todo').prop('checked', false);
                $('#filtrados').prop('checked', false);
                $('#nav3').css('display','none');
                //window.filtrados
            });
    });
});