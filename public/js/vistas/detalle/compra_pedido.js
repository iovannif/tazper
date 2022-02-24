window.addEventListener("load", function(){
    document.getElementById("ped").addEventListener("keyup", () =>{
        // if(document.getElementById("des_art_1").value==''){ //si no se ha puesto
        // if(document.getElementById("ped").value.length>=1){
            fetch(`/Tazper/public/Compras/Create/busca_pedido?busca_ped=${document.getElementById("ped").value}`, { method:'get' })            
                .then(response=>response.text())
                .then(html=>{document.getElementById("pedido").innerHTML=html});
            
            // $('#prov_ruc,#prov_tel,#prov_dir').val(''); el cuadro
        // }        
        // } 
    }); 
});