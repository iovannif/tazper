<style>
    #modificado{
        display:none;
    }
    
    #reg{
        margin-left:65px !important;
    }
</style>

<table id="auditoria">
    <tr id="registro">
        <td><label for="registrado">Registro:</label></td>
        <td> <!-- fecha -->
            <input type="text" id="reg" size="14" value="{{$cliente->created_at->format('d/m/y H:i')}}" disabled>
        </td>

        <td class="hidden"><label for="reg_por">Por:</label></td>
        <td class="hidden"> <!-- user -->
            @foreach($users as $usu)
                @if($usu->Id_Usu==$cliente->Cli_RegPor) <!-- busca username de id -->
                    <input type="text" id="regPor_id" size="4" value="Id: {{$usu->Id_Usu}}" disabled> <!-- id -->
                    <input type="text" id="regPor_name" size="20" value="{{$usu->Usu_User}}" disabled> <!-- username -->
                    @php $no='false'; @endphp
                    @break
                @else
                    @php $no='true'; @endphp
                @endif
            @endforeach

            @if($no=='true')
                @if($cliente->Cli_RegPor!='')
                    <input type="text" id="regPor_id" size="4" value="Id: {{$cliente->Cli_RegPor}}" disabled> <!-- id -->
                    <input type="text" id="regPor_name" size="20" value="{{$cliente->Cli_RegUser}}" disabled> <!-- username -->

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
</table>