@if($personal->count()>0)
    <ul class="lista_js busca" id="empleados">
        @foreach($personal as $empleado)
            <li class="item_js" id="nombre" onclick="
                $('#id_per').attr('value',$(this).find('#id').text());
                $(this).find('#id').remove();
                $('#busca_per').val($.trim($(this).text()));
                $('#busca_per').prop('disabled','true');
                $('#cambiar').css('display','inline-block');">
                    {{$empleado->Per_Nom.', '.$empleado->Per_Ape}}
                    <span id="id">{{$empleado->Id_Per}}</span>
            </li>
        @endforeach
    </ul>
@endif