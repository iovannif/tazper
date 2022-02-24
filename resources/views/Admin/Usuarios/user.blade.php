<!-- Registro -->
@section('reg') <!-- fecha -->
    <input type="text" id="reg" size="14" value="{{$user->created_at->format('d/m/y H:i')}}" disabled>
@endsection

@section('reg_por') <!-- user -->
    @foreach($users as $usu)
        @if($usu->Id_Usu==$user->Usu_RegPor) <!-- busca username de id -->
            <input type="text" id="regPor_id" size="4" value="Id: {{$usu->Id_Usu}}" disabled> <!-- id -->
            <input type="text" id="regPor_name" size="20" value="{{$usu->Usu_User}}" disabled> <!-- username -->        
            @php $no='false'; @endphp
            @break            
        @else
            @php $no='true'; @endphp
        @endif
    @endforeach

    @if($no=='true')
        <input type="text" id="regPor_id" size="4" value="Id: {{$user->Usu_RegPor}}" disabled> <!-- id -->
        <input type="text" id="regPor_name" size="20" value="{{$user->Usu_RegUser}}" disabled> <!-- username -->

        <style>
            #regPor_id,#regPor_name{
                color:grey;
            }
        </style>
    @endif

    @if($user->Id_Prf==2 && $user->Usu_RegPor=='') <!-- admin 1 -->
        <style>
            .hidden{
                display:none;
            }
        </style>
    @endif
@endsection

<!-- Modificado -->
@section('mdf') <!-- fecha -->
    @if($user->created_at!=$user->updated_at)
        <input type="text" id="mdf" size="14" value="{{$user->updated_at->format('d/m/y H:i')}}" disabled>
    @endif
@endsection

@section('mdf_por') <!-- user -->
    @if($user->created_at!=$user->updated_at)
        @foreach($users as $usu)
            @if($usu->Id_Usu==$user->Usu_MdfPor)
                <input type="text" id="mdfPor_id" size="4" value="Id: {{$usu->Id_Usu}}" disabled>
                <input type="text" id="mdfPor_name" size="20" value="{{$usu->Usu_User}}" disabled>
                @php $no='false'; @endphp
                @break
            @else
                @php $no='true'; @endphp
            @endif
        @endforeach

        @if($no=='true')
            <input type="text" id="mdfPor_id" size="4" value="Id: {{$user->Usu_MdfPor}}" disabled> <!-- id -->
            <input type="text" id="mdfPor_name" size="20" value="{{$user->Usu_MdfUser}}" disabled> <!-- username -->

            <style>
                #mdfPor_id,#mdfPor_name{
                    color:grey;
                }
            </style>
        @endif
    @endif
@endsection

<!-- no modificado -->
@if($user->created_at==$user->updated_at)
    <style>
        #modificado{
            display:none;
        }
        #reg{
            margin-left:61px !important; /* reubica reg */
        }

        #sin_modif{
            display:table-row;
        }
    </style>
@else <!-- modificado -->
    <style>
        #reg,#mdf{ /* inputs */
            margin-left:40px !important; /* ubica ambos */
        }
    </style>
@endif

<!-- alreves de css donde pones los estilos y aplicas las clases en html
aca pones las clases html y luego de las los estilos -->