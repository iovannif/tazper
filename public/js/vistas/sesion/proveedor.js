window.addEventListener("load", function(){
    $(document).ready(function(){
        // Cargar Pagina
        //sesion, chequeados
        if(sessionStorage.getItem('proveedores_sesion')==null){ //si no hay sesion
            window.proveedores_chequeados=[];
        }else{
            window.proveedores_chequeados=JSON.parse(sessionStorage.getItem('proveedores_sesion')); //guarda los id
        }

        //set
        $('input.check').each(function(){
            var id=$(this).attr('id');
            var check=document.getElementById(id);

            if(sessionStorage.getItem('proveedor_'+id)!=null){ //si tiene item
                var chequeado=sessionStorage.getItem('proveedor_'+id); //true
                check.checked=chequeado; //marca
            }

            // sessionStorage.removeItem('proveedor_'+id); //borra
            // sessionStorage.removeItem('proveedor_sesion');
        });

        // Click
        //get
        window.no=[];
        $('input.check').click(function(){
            var art=$('.registro:hover').find($('.foreign')).val();   
            
            if(art==''){
                var id=$(this).attr('id');
                var check=document.getElementById(id);
                
                sessionStorage.setItem('proveedor_'+id, check.checked); //crea item, check true

                console.log(sessionStorage.getItem('proveedor_'+id));

                if(sessionStorage.getItem('proveedor_'+id)=='true'){ //si tiene item
                    window.proveedores_chequeados.push(id); //agrega a chequeados
                }else{
                    sessionStorage.removeItem('proveedor_'+id); //borra item

                    var index=window.proveedores_chequeados.indexOf(id); //busca
                    window.proveedores_chequeados.splice(index,1); //quita de chequeados
                }
                console.log('chequeados: '+window.proveedores_chequeados); //vemos chequeados

                // array a string
                sessionStorage.setItem('proveedores_sesion', JSON.stringify(window.proveedores_chequeados)); //tiene los id
                console.log('sesion: '+JSON.parse(sessionStorage.getItem('proveedores_sesion'))); //muestra la sesion
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

                    $('.foreign').each(function(){
                        if($(this).attr('id')==id){
                            if($(this).val()==''){
                                // var check=document.getElementById(id);
                                var check=$("input.check");

                                if(sessionStorage.getItem('proveedor_'+id)==null){
                                    $(this).prop('checked', true);
                                    sessionStorage.setItem('proveedor_'+id, true);
                                    window.proveedores_chequeados.push(id);
                                }else{
                                    window.marcados.push(id);
                                }                                
                            }else{
                                window.no.push(id);
                            }
                        }
                    });                    
                });
                $('#grupal').css('visibility','visible');
            }else{                
                $("input.check").each(function(){
                    var id=$(this).attr('id');

                    $('.foreign').each(function(){
                        if($(this).val()==''){
                            if(window.marcados.indexOf(id)==-1){
                                $(this).prop('checked', false);
                                sessionStorage.removeItem('proveedor_'+id);

                                var index=window.proveedores_chequeados.indexOf(id);
                                window.proveedores_chequeados.splice(index,1);
                            }
                        } 
                    });
                });
                if(window.proveedores_chequeados.length==0){
                    $('#grupal').css('visibility','hidden');
                }
            }
            // console.log('chequeados: '+window.proveedores_chequeados);

            sessionStorage.setItem('proveedores_sesion', JSON.stringify(window.proveedores_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('proveedores_sesion')));
        });

            //mostrar grupal //solo al cargar la pagina
            $("input.check").each(function(){            
                if(window.proveedores_chequeados.length!=0){ //si hay chequeados
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
            if(window.proveedores_chequeados.length==window.todos.length){
                $('#todo').prop('checked', true);
            }

            // Desmarcar Todo
            $('#cancelar_grupo').click(function(){
                window.proveedores_chequeados.forEach(
                    element => sessionStorage.removeItem('proveedor_'+element) //borra items
                );
                sessionStorage.removeItem('proveedores_sesion'); //borra sesion, chequeados=[]
                window.proveedores_chequeados=[];
                $('#grupal').css('visibility','hidden'); //oculta grupal
                
                $("input.check").each(function(){ //recorre
                    if(sessionStorage.getItem('proveedor_'+$(this).attr('id'))==null){ //si no hay item
                        $(this).prop('checked', false); //desmarca
                    }
                });

                $('#todos').prop('checked', false);
                $('#todo').prop('disabled',false);
                $('#todo').prop('checked', false);              
                $('#filtrados').prop('checked', false);
                //window.filtrados
            });
    });
});