window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador
        $(document).on('click','.anterior,.siguiente', function(e){
            e.preventDefault();
            var id=$(this).attr('href').split('Productos/')[1];  // console.log(id);

            fetch(`/Tazper/public/show_producto_fetch_1?id=`+id, {method:'get'})
            .then(response=>response.text())
            .then(html=>{document.getElementById("navegacion_1").innerHTML=html});

            fetch(`/Tazper/public/show_producto_fetch_2?id=`+id, {method:'get'})
                .then(response=>response.text())
                .then(html=>{document.getElementById("contenido").innerHTML=html});
        });
    });
});     