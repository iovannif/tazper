<style>
    #modificado{
        display:none;
    }
    
    #reg{
        margin-left:101px !important;
    }
</style>

<!-- Registro -->
@section('reg') <!-- fecha -->
    <input type="text" id="reg" size="14" value="{{$pedido->created_at->format('d/m/y H:i')}}" disabled>
@endsection

@section('reg_por') <!-- user -->
    @foreach($users as $usu)
        @if($usu->Id_Usu==$pedido->PedProv_RegPor) <!-- busca username de id -->
            <input type="text" id="regPor_id" size="4" value="Id: {{$usu->Id_Usu}}" disabled> <!-- id -->
            <input type="text" id="regPor_name" size="20" value="{{$usu->Usu_User}}" disabled> <!-- username -->        
            @php $no='false'; @endphp
            @break            
        @else
            @php $no='true'; @endphp
        @endif
    @endforeach

    @if($no=='true')
        @if($pedido->PedProv_RegPor!='')
            <input type="text" id="regPor_id" size="4" value="Id: {{$pedido->PedProv_RegPor}}" disabled> <!-- id -->
            <input type="text" id="regPor_name" size="20" value="{{$pedido->PedProv_RegUser}}" disabled> <!-- username -->

            <style>
                #regPor_id,#regPor_name{
                    color:grey;
                }
            </style>
        @else <!-- per admin 1 -->
            <style>
                .hidden{
                    display:none;
                }
            </style>
        @endif
    @endif
@endsection