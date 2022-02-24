window.addEventListener("load", function(){
    document.getElementById("ped").addEventListener("keyup", () =>{        
        fetch(`/Tazper/public/Ventas/Create/busca_pedido?busca_ped=${document.getElementById("ped").value}`, { method:'get' })            
            .then(response=>response.text())
            .then(html=>{document.getElementById("pedido").innerHTML=html});                    
    }); 
});