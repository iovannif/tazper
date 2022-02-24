window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador lp
        $(document).on('click','.show', function(e){
            e.preventDefault();            
            var id=$(this).attr('href').split('ListaPrecio/')[1];  // console.log(id);

            fetch(`/Tazper/public/show_lp_fetch_1?id=`+id, {method:'get'})
            .then(response=>response.text())
            .then(html=>{document.getElementById("navegacion_1").innerHTML=html});

            fetch(`/Tazper/public/show_lp_fetch_2?id=`+id, {method:'get'})
                .then(response=>response.text())
                .then(html=>{document.getElementById("contenido").innerHTML=html});
        });
    });
    
    //paginador lp detalle
    $(document).on('click','#lp_det a', function(e){
        e.preventDefault();
        var lp=window.lp;
        var page=$(this).attr('href').split('page=')[1];

        fetch('/Tazper/public/ListaPrecio/'+lp+'/detalle?page='+page, {method:'get'})
        .then(response=>response.text())
        .then(html=>{document.getElementById("lp_det").innerHTML=html});            
    });
});