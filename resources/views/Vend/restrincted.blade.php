<style>
    #t_house{   
        width: fit-content;
        margin: 15% auto;        
    }

    #home{
        opacity: 0.4;
        width:220px;
    }
    span{
        display:block;
        text-align:center;
    }
</style>

<div id="t_house">
    <span>
        Acceso restringido<br>
        No eres administrador
    </span>
    <a href="{{url('/Inicio')}}"><img src="{{asset('images/tazper_house.jpg')}}" id="home"></a>
</div>