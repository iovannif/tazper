window.addEventListener("load", function(){
    //blanco
    function busca(){
        fetch(`/Tazper/public/Productos/{id}/edit/busca_categoria_2`, { method:'get' })
        .then(response=>response.text())
        .then(html=>{document.getElementById("categoria").innerHTML=html});
    }

    //busqueda
    document.getElementById("busca_cat").addEventListener("keyup", () =>{
        if(document.getElementById("busca_cat").value.length>=1){
            fetch(`/Tazper/public/Productos/{id}/edit/busca_categoria_1?busca_cat=${document.getElementById("busca_cat").value}`, { method:'get' })            
                .then(response=>response.text())
                .then(html=>{document.getElementById("categoria").innerHTML=html});
                // .then(html=>{console.log(html)});                         
        }else{
            busca();
        }
    });

    //focus
    $("#busca_cat").click(function(){ //focus
        busca();
    });
    
    //salir
    $(document).click(function(){
        if(this!=$("#busca_cat")){
            $("#categorias").css('display','none');
        }
    });
    //blur

    //cambiar
    $('.cat .cambiar').click(function(){
        event.preventDefault();
        $('#busca_cat').removeAttr('disabled');
        $('#busca_cat').val('');
        $('#busca_cat').trigger('click');
        $('#busca_cat').focus();
        $(this).css('display','none');
        $('#id_cat').val('');
    });
});