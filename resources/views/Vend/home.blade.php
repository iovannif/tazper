@extends('layouts.Vend_app')
<style>
    #t_house{   
        width: fit-content;
        margin: 15% auto;        
    }

    #home{
        opacity: 0.1;
        width:220px;
    }
</style>

@section('content')
    <div id="t_house">
        <img src="images/tazper_house.jpg" id="home">
    </div>
@endsection