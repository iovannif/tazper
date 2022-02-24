<!-- Registro -->
@section('reg') <!-- fecha -->
    <input type="text" id="reg" size="14" value="{{$material->created_at->format('d/m/y H:i')}}" disabled>
@endsection

@section('reg_por') <!-- user -->
    @foreach($users as $usu)
        @if($usu->Id_Usu==$material->Art_RegPor) <!-- busca username de id -->
            <input type="text" id="regPor_id" size="4" value="Id: {{$usu->Id_Usu}}" disabled> <!-- id -->
            <input type="text" id="regPor_name" size="20" value="{{$usu->Usu_User}}" disabled> <!-- username -->        
            @php $no='false'; @endphp
            @break            
        @else
            @php $no='true'; @endphp
        @endif
    @endforeach

    @if($no=='true')
        @if($material->Art_RegPor!='')
            <input type="text" id="regPor_id" size="4" value="Id: {{$material->Art_RegPor}}" disabled> <!-- id -->
            <input type="text" id="regPor_name" size="20" value="{{$material->Art_RegUser}}" disabled> <!-- username -->

            <style>
                #regPor_id,#regPor_name{
                    color:grey;
                }
            </style>
        @else <!-- per 1 -->
            <style>
                .hidden{
                    display:none;
                }
            </style>
        @endif
    @endif
@endsection

<!-- Modificado -->
@section('mdf') <!-- fecha -->
    @if($material->created_at!=$material->updated_at)
        <input type="text" id="mdf" size="14" value="{{$material->updated_at->format('d/m/y H:i')}}" disabled>
    @endif
@endsection

@section('mdf_por') <!-- user -->
    @if($material->created_at!=$material->updated_at)
        @foreach($users as $usu)
            @if($usu->Id_Usu==$material->Art_MdfPor)
                <input type="text" id="mdfPor_id" size="4" value="Id: {{$usu->Id_Usu}}" disabled>
                <input type="text" id="mdfPor_name" size="20" value="{{$usu->Usu_User}}" disabled>
                @php $no='false'; @endphp
                @break
            @else
                @php $no='true'; @endphp
            @endif
        @endforeach

        @if($no=='true')
            <input type="text" id="mdfPor_id" size="4" value="Id: {{$material->Art_MdfPor}}" disabled> <!-- id -->
            <input type="text" id="mdfPor_name" size="20" value="{{$material->Art_MdfUser}}" disabled> <!-- username -->

            <style>
                #mdfPor_id,#mdfPor_name{
                    color:grey;
                }
            </style>
        @endif
    @endif
@endsection

<!-- no modificado -->
@if($material->created_at==$material->updated_at)
    <style>
        #modificado{
            display:none;
        }                
        #sin_modif{
            display:table-row !important;
        }            

        #reg{
        margin-left:67px !important;
        }
    </style>
@else <!-- modificado -->    
    <style>
        #reg,#mdf{ /* inputs */
            margin-left:46px !important; /* ubica ambos */
        }
    </style>
@endif