@if($clientes->count()>0)
    <ul class="lista_js busca" id="clientes">
        @foreach($clientes as $cliente)
            <li class="item_js" id="descripcion" onclick="
                $('#id_cli').attr('value',$(this).find('.id').text());
                $(this).find('.id').remove();
                $('#busca_cli').val($.trim($(this).text()));
                $('#busca_cli').prop('disabled','true');
                $('.cli .cambiar').css('display','inline-block');
                              
                //
                if($(this).find('.lp').text()==1){
                    var lp='Ocasional';
                    var desc='0%';
                }else if($(this).find('.lp').text()==2){
                    var lp='Frecuente';
                    var desc='10%';
                }else if($(this).find('.lp').text()==3){
                    var lp='Fiel';
                    var desc='20%';                
                }         
                
                // alert($('.item_js:hover .id').text());
                
                $('#cli_cat').attr('value',lp);
                $('#cli_desc').val(desc);
                $('.cli_cat,.cli_desc').css('display','table-row');
                $('#busca_producto').prop('disabled',false);
                window.cli_desc=$('#cli_desc').val().slice(0, -1);                  
                ">
                    {{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}
                    <span class="id">{{$cliente->Id_Cli}}</span>                    
                    <span class="lp">{{$cliente->Id_Lp}}</span>
            </li>
        @endforeach
    </ul>
@endif

<style>
    #descripcion:hover{
        background:lightblue;
    }
</style>