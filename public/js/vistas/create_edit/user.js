window.addEventListener("load", function(){
    //blanco
    function busca(){
        fetch(`/Tazper/public/Usuarios/{id}/edit/buscador2`, { method:'get' })
        .then(response=>response.text())
        .then(html=>{document.getElementById("personal").innerHTML=html});
    }

    //busqueda
    document.getElementById("busca_per").addEventListener("keyup", () =>{
        if(document.getElementById("busca_per").value.length>=1){
            fetch(`/Tazper/public/Usuarios/{id}/edit/buscador1?busca_per=${document.getElementById("busca_per").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("personal").innerHTML=html});
        }else{
            busca();
        }
    });

    //focus
    $("#busca_per").click(function(){ //focus
        busca();
    });
    
    //salir
    $(document).click(function(){
        if(this!=$("#busca_per")){
            $("#empleados").css('display','none');
        }
    });
    //blur

    //cambiar
    $('#cambiar').click(function(){
        event.preventDefault();
        $('#busca_per').removeAttr('disabled');
        $('#busca_per').val('');
        $('#busca_per').trigger('click');
        $('#busca_per').focus();
        $(this).css('display','none');
    });
});