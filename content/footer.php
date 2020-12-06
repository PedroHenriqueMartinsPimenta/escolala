</div>
        </div>
    </div>

    
    </div>
    
<script>
    var show = false;
    function action(){
        if (!show) {
            $('#button').html("<b>X</b>");
            $('#model').fadeIn();
            show = true;
        }else{
            $('#button').html("Adicionar nova");
            $('#model').fadeOut('slow');
            show = false;
        }
    }
</script>

<script type="text/javascript" defer="defer" src="<?php echo $url?>page/imagesloaded.min.js.download"></script>
<script type="text/javascript" defer="defer" src="<?php echo $url?>page/masonry.min.js.download"></script>
<script type="text/javascript" defer="defer" src="<?php echo $url?>page/theme.bundle.min.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>page/theme-child.js.download"></script>
<script type="text/javascript" defer="defer" src="<?php echo $url?>page/wp-embed.min.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>page/jquery-3.3.1.js.download"></script>
<script>
    $(function(){
        
        $('.fa').click(function(){
            console.log("entrou")
                $('#offcanvas-wrapper').show(500);
            });
            $("#close").click(function(){
                $('#offcanvas-wrapper').hide(500);
            });
        $('.print').click(function(){
            window.print();
        });
        $('#close-modal').click(function(){
            $('.modal-info').fadeOut('fast');
        });
        $('.anime').click(function(){
            $('.modal-info').fadeIn('slow');
        });
    })
</script>

<script type="text/javascript">
     function fMasc(objeto,mascara) {
        obj=objeto
        masc = mascara
        setTimeout("fMascEx()",1)
    }
    function fMascEx() {
        obj.value=masc(obj.value)
    }
    function mTel(tel) {
        tel=tel.replace(/\D/g,"")
        tel=tel.replace(/^(\d)/,"($1")
        tel=tel.replace(/(.{3})(\d)/,"$1)$2")
        if(tel.length == 9) {
            tel=tel.replace(/(.{1})$/,"-$1")
        } else if (tel.length == 10) {
            tel=tel.replace(/(.{2})$/,"-$1")
        } else if (tel.length == 11) {
            tel=tel.replace(/(.{3})$/,"-$1")
        } else if (tel.length == 12) {
            tel=tel.replace(/(.{4})$/,"-$1")
        } else if (tel.length > 12) {
            tel=tel.replace(/(.{4})$/,"-$1")
        }
        return tel;
    }
    function mCNPJ(cnpj){
        cnpj=cnpj.replace(/\D/g,"")
        cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
        cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
        cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
        cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
        return cnpj
    }
    function mCPF(cpf){
        cpf=cpf.replace(/\D/g,"")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
        return cpf
    }
    function mCEP(cep){
        cep=cep.replace(/\D/g,"")
        cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
        cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
        return cep
    }
    function mNum(num){
        num=num.replace(/\D/g,"")
        return num
    }
</script>

<div id="offcanvas-wrapper" class="hide  offcanvas-right offcanvas col-12">
        <div class="offcanvas-top">
            <div class="logo-holder">
                <a class="text-logo" data-type="group" data-dynamic-mod="true"><span id="close" style="font-weight: 300;" class="btn btn-danger col-11"><b>X</b></span></a>            </div>
        </div>
        <div id="offcanvas-menu" class="menu-menu-do-topo-container"><ul id="offcanvas_menu" class="offcanvas_menu">
            				<?php nav_mobile($url)?>
			</ul></div>
</div></body></html>