window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador
        $(document).on('click','.anterior,.siguiente', function(e){
            e.preventDefault();
            var id=$(this).attr('href').split('Compras/')[1];  // console.log(id);

            fetch(`/Tazper/public/show_compra_fetch_1?id=`+id, {method:'get'})
            .then(response=>response.text())
            .then(html=>{document.getElementById("navegacion_1").innerHTML=html});

            fetch(`/Tazper/public/show_compra_fetch_c?id=`+id, {method:'get'})
                .then(response=>response.text())
                .then(html=>{document.getElementById("cabecera").innerHTML=html});
            
            fetch(`/Tazper/public/show_compra_fetch_d?id=`+id, {method:'get'})
            .then(response=>response.text())
            .then(html=>{document.getElementById("detalle").innerHTML=html});

            fetch(`/Tazper/public/show_compra_fetch_t?id=`+id, {method:'get'})
            .then(response=>response.text())
            .then(html=>{document.getElementById("total").innerHTML=html});
        });
    });
});     