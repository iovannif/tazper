@if($proveedores->count()>0)
    <ul class="lista_js busca" id="proveedores">
        @foreach($proveedores as $proveedor)
            <li class="item_js" id="descripcion" onclick="
                $('#id_prov').attr('value',$(this).find('#id').text());
                $(this).find('#id').remove();
                $('#busca_prov').val($.trim($(this).text()));
                $('#busca_prov').prop('disabled','true');
                $('.prov .cambiar').css('display','inline-block');">
                    {{$proveedor->Prov_Des}}
                    <span id="id">{{$proveedor->Id_Prov}}</span>
            </li>
        @endforeach
    </ul>
@endif