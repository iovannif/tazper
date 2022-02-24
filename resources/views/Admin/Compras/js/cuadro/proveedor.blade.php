@if($proveedores->count()>0)
    <ul class="lista_js busca" id="proveedores">
        @foreach($proveedores as $proveedor)
            <li class="item_js arial" id="descripcion" onclick="
                // $('#id_prov').attr('value',$(this).find('#id').text());

                // $('input[name=Id_Prov]').val($.trim($('#id').text()));
                $('input[name=Id_Prov]').val($.trim($(this).find('#id').text()));

                $(this).find('#id').remove();
                $('#busca_prov').val($.trim($(this).text()));
                    // $('#prov_ruc').val($('.prov_ruc').val());
                    // $('#prov_tel').val($('.prov_tel').val());
                    // $('#prov_dir').val($('.prov_dir').val());
                                        
                    $('#prov_ruc').val($(this).find('.prov_ruc').val());
                    $('#prov_tel').val($(this).find('.prov_tel').val());
                    $('#prov_dir').val($(this).find('.prov_dir').val());
                $('.prov .cambiar').css('display','inline-block');">
                    {{$proveedor->Prov_Des}}
                    <span id="id">{{$proveedor->Id_Prov}}</span>
                    <input type="hidden" class="prov_ruc" value="{{$proveedor->Prov_Ruc}}">
                    <input type="hidden" class="prov_tel" value="{{$proveedor->Prov_Tel}}">
                    <input type="hidden" class="prov_dir" value="{{$proveedor->Prov_Dir}}">
            </li>
        @endforeach
    </ul>
@endif

<style>
    #descripcion:hover{
        background:lightblue;
    }    

    .arial{
        font-family:arial;
    }
</style>