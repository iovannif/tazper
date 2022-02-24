@if($categorias->count()>0)
    <ul class="lista_js busca" id="categorias">
        @foreach($categorias as $categoria)
            <li class="item_js" id="descripcion" onclick="
                $('#id_cat').attr('value',$(this).find('#id').text());
                $(this).find('#id').remove();
                $('#busca_cat').val($.trim($(this).text()));
                $('#busca_cat').prop('disabled','true');
                $('.cat .cambiar').css('display','inline-block');">
                    {{$categoria->Cat_Des}}
                    <span id="id">{{$categoria->Id_Cat}}</span>
            </li>
        @endforeach
    </ul>
@endif