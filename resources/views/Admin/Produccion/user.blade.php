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
    <input type="text" id="reg" size="14" value="{{$produccion->created_at->format('d/m/y H:i')}}" disabled>
@endsection

@section('reg_por') <!-- user -->
    @foreach($users as $usu)
        @if($usu->Id_Usu==$produccion->Pdc_RegPor) <!-- busca username de id -->
            <input type="text" id="regPor_id" size="4" value="Id: {{$usu->Id_Usu}}" disabled> <!-- id -->
            <input type="text" id="regPor_name" size="20" value="{{$usu->Usu_User}}" disabled> <!-- username -->        
            @php $no='false'; @endphp
            @break            
        @else
            @php $no='true'; @endphp
        @endif
    @endforeach

    @if($no=='true')
        @if($produccion->Pdc_RegPor!='')
            <input type="text" id="regPor_id" size="4" value="Id: {{$produccion->Pdc_RegPor}}" disabled> <!-- id -->
            <input type="text" id="regPor_name" size="20" value="{{$produccion->Pdc_RegUser}}" disabled> <!-- username -->

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