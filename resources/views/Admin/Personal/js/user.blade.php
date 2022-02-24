<table id="auditoria">
    <tr id="registro">
        <td><label for="registrado">Registro:</label></td>
        <td> <!-- fecha -->
            <input type="text" id="reg" size="14" value="{{$personal->created_at->format('d/m/y H:i')}}" disabled>
        </td>

        <td class="hidden"><label for="reg_por">Por:</label></td>
        <td class="hidden"> <!-- user -->
            @foreach($users as $usu)
                @if($usu->Id_Usu==$personal->Per_RegPor) <!-- busca username de id -->
                    <input type="text" id="regPor_id" size="4" value="Id: {{$usu->Id_Usu}}" disabled> <!-- id -->
                    <input type="text" id="regPor_name" size="20" value="{{$usu->Usu_User}}" disabled> <!-- username -->
                    @php $no='false'; @endphp
                    @break
                @else
                    @php $no='true'; @endphp
                @endif
            @endforeach

            @if($no=='true')
                @if($personal->Per_RegPor!='')
                    <input type="text" id="regPor_id" size="4" value="Id: {{$personal->Per_RegPor}}" disabled> <!-- id -->
                    <input type="text" id="regPor_name" size="20" value="{{$personal->Per_RegUser}}" disabled> <!-- username -->

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
        </td>
    </tr>

    <tr id="modificado">
        <td><label for="modificado">Modificado:</label></td>
        <td> <!-- fecha -->
            @if($personal->created_at!=$personal->updated_at)
                <input type="text" id="mdf" size="14" value="{{$personal->updated_at->format('d/m/y H:i')}}" disabled>
            @endif
        </td>

        <td><label for="mdf_por">Por:</label></td>
        <td> <!-- user -->
            @if($personal->created_at!=$personal->updated_at)
                @foreach($users as $usu)
                    @if($usu->Id_Usu==$personal->Per_MdfPor)
                        <input type="text" id="mdfPor_id" size="4" value="Id: {{$usu->Id_Usu}}" disabled>
                        <input type="text" id="mdfPor_name" size="20" value="{{$usu->Usu_User}}" disabled>
                        @php $no='false'; @endphp
                        @break
                    @else
                        @php $no='true'; @endphp
                    @endif
                @endforeach

                @if($no=='true')
                    <input type="text" id="mdfPor_id" size="4" value="Id: {{$personal->Per_MdfPor}}" disabled> <!-- id -->
                    <input type="text" id="mdfPor_name" size="20" value="{{$personal->Per_MdfUser}}" disabled> <!-- username -->

                    <style>
                        #mdfPor_id,#mdfPor_name{
                            color:grey;
                        }
                    </style>
                @endif
            @endif                            
        </td>
    </tr>

    <tr id="sin_modif">
        <td colspan="2"><label for="modificado">Sin modificaciones</label></td>
        <td colspan="2"><input type="text" class="oculto"></td>

        @if($personal->created_at==$personal->updated_at)
            <style>
                #sin_modif{
                    display:table-row;
                }
            </style>
        @endif
    </tr>
</table>

<!-- no modificado -->
@if($personal->created_at==$personal->updated_at)
    <style>
        #modificado{
            display:none;
        }                
        #sin_modif{
            display:table-row !important;
        }            

        #reg{
        margin-left:111px !important;
        }
    </style>
@else <!-- modificado -->    
    <style>
        #reg,#mdf{ /* inputs */
            margin-left:90px !important; /* ubica ambos */
        }
    </style>
@endif