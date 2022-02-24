<!-- Session -->
@if(Session::has('no_abierta')) <!-- No hay caja cerrada para abrir -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#arqueo .center').html('No hay caja abierta')
                $('#arqueo').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('caja_cerrada')) <!-- Caja cerrada -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#arqueo .center').html('Caja cerrada')
                $('#arqueo').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('no_cerrada')) <!-- No hay caja abierta para cerrar -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#arqueo .center').html('El arqueo anterior no fue cerrado')
                $('#arqueo').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('caja_abierta')) <!-- Caja abierta -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#arqueo .center').html('Caja abierta')
                $('#arqueo').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@elseif(Session::has('abrir_caja')) <!-- Para empezar a realizar transacciones -->
    <script>
        window.addEventListener("load", function(){
            $(document).ready(function(){
                $('#arqueo .center').html('Para realizar transacciones debe abrir caja')
                $('#arqueo').show().delay(1500).fadeOut(0);
                setTimeout(function(){ location.reload(); }, 1500);        
            });
        });
    </script>
@endif