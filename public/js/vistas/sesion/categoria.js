window.addEventListener("load", function(){
    $(document).ready(function(){
        // Cargar Pagina
        //sesion, chequeados
        if(sessionStorage.getItem('categorias_sesion')==null){ //si no hay sesion
            window.categorias_chequeados=[];
        }else{
            window.categorias_chequeados=JSON.parse(sessionStorage.getItem('categorias_sesion')); //guarda los id
        }

        //set
        $('input.check').each(function(){
            var id=$(this).attr('id');
            var check=document.getElementById(id);

            if(sessionStorage.getItem('categoria_'+id)!=null){ //si tiene item
                var chequeado=sessionStorage.getItem('categoria_'+id); //true
                check.checked=chequeado; //marca
            }

            // sessionStorage.removeItem('categoria_'+id); //borra
            // sessionStorage.removeItem('categoria_sesion');
        });

        // Click
        //get
        window.no=[];
        $('input.check').click(function(){
            var productos=$('.registro:hover').find($('.prod')).val();   
            
            if(productos==0){
                var id=$(this).attr('id');
                var check=document.getElementById(id);
                
                sessionStorage.setItem('categoria_'+id, check.checked); //crea item, check true

                if(sessionStorage.getItem('categoria_'+id)=='true'){ //si tiene item
                    window.categorias_chequeados.push(id); //agrega a chequeados
                }else{
                    sessionStorage.removeItem('categoria_'+id); //borra item

                    var index=window.categorias_chequeados.indexOf(id); //busca
                    window.categorias_chequeados.splice(index,1); //quita de chequeados
                }
                console.log('chequeados: '+window.categorias_chequeados); //vemos chequeados

                // array a string
                sessionStorage.setItem('categorias_sesion', JSON.stringify(window.categorias_chequeados)); //tiene los id
                console.log('sesion: '+JSON.parse(sessionStorage.getItem('categorias_sesion'))); //muestra la sesion
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
                    console.log(window.no);    
            }
        });

        //marcar todos (pagina)
        window.marcados=[];
        $('#todos').click(function(){
            if($('#todos').is(':checked')){
                $("input.check").each(function(){
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
            }
            else{
                $("input.check").each(function(){
                    var id=$(this).attr('id');
                    if(window.marcados.indexOf(id)==-1){
                        $(this).prop('checked', false);
                        sessionStorage.removeItem('categoria_'+id);

                        var index=window.categorias_chequeados.indexOf(id);
                        window.categorias_chequeados.splice(index,1);
                    }
                });
                if(window.categorias_chequeados.length==0){
                    $('#grupal').css('visibility','hidden');
                }
            }
            // console.log('chequeados: '+window.categorias_chequeados);

            sessionStorage.setItem('categorias_sesion', JSON.stringify(window.categorias_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('categorias_sesion')));
        });

            //mostrar grupal //solo al cargar la pagina
            $("input.check").each(function(){            
                if(window.categorias_chequeados.length!=0){ //si hay chequeados
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
            if(window.categorias_chequeados.length==window.todos.length){
                $('#todo').prop('checked', true);
            }

            // Desmarcar Todo
            $('#cancelar_grupo').click(function(){
                window.categorias_chequeados.forEach(
                    element => sessionStorage.removeItem('categoria_'+element) //borra items
                );
                sessionStorage.removeItem('categorias_sesion'); //borra sesion, chequeados=[]
                window.categorias_chequeados=[];     
                $('#grupal').css('visibility','hidden'); //oculta grupal
                
                $("input.check").each(function(){ //recorre
                    if(sessionStorage.getItem('categoria_'+$(this).attr('id'))==null){ //si no hay item
                        $(this).prop('checked', false); //desmarca
                    }
                });

                $('#todos').prop('checked', false);
                $('#todo').prop('disabled',false);
                $('#todo').prop('checked', false);              
                $('#filtrados').prop('checked', false);                
            });
    });
});