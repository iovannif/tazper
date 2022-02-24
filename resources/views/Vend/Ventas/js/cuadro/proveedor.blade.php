@if($clientes->count()>0)
    <ul class="lista_js busca" id="proveedores">
        @foreach($clientes as $cliente)
            @foreach($listas as $lp)
                @if($lp->Id_Lp==$cliente->Id_Lp)
                    @php
                        $cat=$lp->Lp_Cat;
                        $desc=$lp->Lp_Desc;
                    @endphp
                @endif
            @endforeach
                
            <li class="item_js arial" id="descripcion" onclick="                  
                $('input[name=cli_ruc]').val($(this).find('.cli_ruc').val());
                $('input[name=cli_cat]').val($(this).find('.cli_cat').val());
                $('input[name=cli_lp]').val($(this).find('.cli_lp').val());
                $('input[name=cli_desc]').val($(this).find('.cli_desc').val()+'%');
                $('input[name=Id_Cli]').val($.trim($(this).find('.id').text()));
                $(this).find('.id').remove();
                $('#busca_prov').val($.trim($(this).text()));
                window.clie=$(this).find('.cli_desc').val();
                $('#busqueda').prop('disabled',false).focus();
                $('.detalle input').val('');
                
                    if($('input[name=desc_des]').val()!=''){
                        // cli desc dia
                        $('.desc_cli').each(function(){
                            if($('input[name=Id_Cli]').val()==$(this).val()){
                                window.cli='si';
                                return false;                                                
                            }else{
                                window.cli='no';                        
                            }                    
                        });     

                        // if(window.cli=='si'){
                        //     $('input[name=descuento]').val($('input[name=desc_des]').val());            
                        // }

                        // lp desc dia
                        $('.desc_lp').each(function(){
                            if($('input[name=cli_lp]').val()==$(this).val()){
                                window.lp='si';
                                return false;                                                
                            }else{
                                window.lp='no';                        
                            }                    
                        });     

                        // if(window.lp=='si'){
                        //     $('input[name=descuento]').val($('input[name=desc_des]').val());            
                        // }    
                    }            
                ">
                    {{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}
                    <span class="id">{{$cliente->Id_Cli}}</span>
                    <input type="hidden" class="cli_ruc" value="{{$cliente->Cli_Ruc}}">   
                    <input type="hidden" class="cli_lp" value="{{$cliente->Id_Lp}}">                 
                    <input type="hidden" class="cli_cat" value="{{$cat}}">
                    <input type="hidden" class="cli_desc" value="{{$desc}}">
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