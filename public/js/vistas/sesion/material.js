window.addEventListener("load", function(){
    $(document).ready(function(){
        // Cargar Pagina
        //sesion, chequeados
        if(sessionStorage.getItem('materiales_sesion')==null){ //si no hay sesion
            window.materiales_chequeados=[];
        }else{
            window.materiales_chequeados=JSON.parse(sessionStorage.getItem('materiales_sesion')); //guarda los id
        }

        //set
        $('input.check').each(function(){
            var id=$(this).attr('id');
            var check=document.getElementById(id);

            if(sessionStorage.getItem('material_'+id)!=null){ //si tiene item
                var chequeado=sessionStorage.getItem('material_'+id); //true
                check.checked=chequeado; //marca
            }

            // sessionStorage.removeItem('material_'+id); //borra
            // sessionStorage.removeItem('material_sesion');
        });

        // Click
        //get
        window.no=[];
        $('input.check').click(function(){
            // koi
            if(window.todos.length==0){ 
                var id=$(this).attr('id');
                var check=document.getElementById(id);
                
                sessionStorage.setItem('material_'+id, check.checked); //crea item, check true

                if(sessionStorage.getItem('material_'+id)=='true'){ //si tiene item
                    window.materiales_chequeados.push(id); //agrega a chequeados
                }else{
                    sessionStorage.removeItem('material_'+id); //borra item

                    var index=window.materiales_chequeados.indexOf(id); //busca
                    window.materiales_chequeados.splice(index,1); //quita de chequeados
                }
                console.log('chequeados: '+window.materiales_chequeados); //vemos chequeados

                // array a string
                sessionStorage.setItem('materiales_sesion', JSON.stringify(window.materiales_chequeados)); //tiene los id
                console.log('sesion: '+JSON.parse(sessionStorage.getItem('materiales_sesion'))); //muestra la sesion
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

                    if(sessionStorage.getItem('material_'+id)==null){
                        $(this).prop('checked', true);
                        sessionStorage.setItem('material_'+id, check.checked);
                        window.materiales_chequeados.push(id);
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
                        sessionStorage.removeItem('material_'+id);

                        var index=window.materiales_chequeados.indexOf(id);
                        window.materiales_chequeados.splice(index,1);
                    }
                });
                if(window.materiales_chequeados.length==0){
                    $('#grupal').css('visibility','hidden');
                }
            }
            // console.log('chequeados: '+window.materiales_chequeados);

            sessionStorage.setItem('materiales_sesion', JSON.stringify(window.materiales_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('materiales_sesion')));
        });

            //mostrar grupal //solo al cargar la pagina
            $("input.check").each(function(){            
                if(window.materiales_chequeados.length!=0){ //si hay chequeados
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
            if(window.materiales_chequeados.length==window.todos.length){
                $('#todo').prop('checked', true);
            }

            // Desmarcar Todo
            $('#cancelar_grupo').click(function(){
                window.materiales_chequeados.forEach(
                    element => sessionStorage.removeItem('material_'+element) //borra items
                );
                sessionStorage.removeItem('materiales_sesion'); //borra sesion, chequeados=[]
                window.materiales_chequeados=[];     
                $('#grupal').css('visibility','hidden'); //oculta grupal
                
                $("input.check").each(function(){ //recorre
                    if(sessionStorage.getItem('material_'+$(this).attr('id'))==null){ //si no hay item
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