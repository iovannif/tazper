<style>
    #modificado{
        display:none;
    }
    
    #reg{
        margin-left:88px !important;
    }
</style>

<!-- Registro -->
@section('reg') <!-- fecha -->
    <input type="text" id="reg" size="14" value="{{$pedido->created_at->format('d/m/y H:i')}}" disabled>
@endsection

@section('reg_por') <!-- user -->    
    <input type="text" id="regPor_id" size="4" value="Id: {{$user->Id_Usu}}" disabled> <!-- id -->
    <input type="text" id="regPor_name" size="20" value="{{$user->Usu_User}}" disabled> <!-- username -->                    
@endsection