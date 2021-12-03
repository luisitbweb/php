<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Assinatura de E-mail Padrão</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script> 
        <script type="text/javascript" src="../../js/html2canvas.js"></script> 

        <script type="text/javascript">
            $(document).ready(function () {
                var target = $('#div');
                html2canvas(target, {
                    onrendered: function (canvas) {
                        var img = canvas.toDataURL("image/jpeg");
                        window.open(img);
                    }
                });
            });
        </script>       

    </head>
    <body>
        <div style="width: 1350px; height: 340px; background-color:#fff" id="div">
            <table width="1350" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="420">
                        <?php if ($_POST["radio"] != 'c') { ?>
                            <div style="width:400px; height:150px; background:#FFF; background-image:url(<?php echo $_POST["radio"]; ?>2.jpg); background-repeat:no-repeat; color:#000;"></div>	
                        <?php } else { ?>	
                            <div style="width:400px; height:195px; background:#FFF; background-image:url(<?php echo $_POST["radio"]; ?>.jpg); background-repeat:no-repeat; color:#000;"></div>
                        <?php } ?>
                    </td>
                    <td width="930">
                        <div style="width:930px; padding:0px; margin:0px;">
                            <div style='font-size:30px; font-family:Verdana; font-color:000; font-style:italic; font-weight:bold; padding:0px; text-transform:uppercase;'><?php echo mb_strtoupper($_POST["nome"]); ?></div>
                            <div style='font-size:24px; font-family:Verdana; font-color:000; font-style:italic; padding-bottom:15px; text-transform:uppercase;'>
                                <?php echo strtoupper($_POST["cargo"]); ?>
                            </div>
                            <div style='font-size:22px; font-family:Verdana; font-color:000; padding:0px;'>
                                <div style="background-image:url(ico_telefone.png); background-repeat:no-repeat; width:24px; height:24px; float:left; display:block; padding-left:5px;"></div>
                                <div style="width:190px; float:left; display:block;">(<?php echo $_POST["ddd"]; ?>) <?php echo $_POST["tel1"]; ?></div>
                                <div style="background-image:url(ico_celular.png); background-repeat:no-repeat; width:24px; height:24px; float:left; display:block; padding-left:5px;"></div>
                                <div style="width:200px; float:left; display:block;">(<?php echo $_POST["ddd2"]; ?>) <?php echo $_POST["cel"]; ?></div>
                                <?php if (trim($_POST["skype"]) != '') { ?>
                                    <div style="background-image:url(ico_skype.png); background-repeat:no-repeat; width:24px; height:24px; float:left; display:block; padding-left:5px;"></div>
                                    <div style="width:450px; float:left; display:block; padding-bottom:2px;"><?php echo $_POST["skype"]; ?></div>
                                <?php } else { ?>
                                    <div style="width:450px; float:left; display:block; padding-bottom:2px;">.</div>
                                <?php } ?>
                            </div>
                            <div style="font-size:22px; font-family:Verdana; font-color:000;">
                                <div style="width:350px; float:left; display:block;"><strong>Site:</strong>
                                    <?php if ($_POST["radio"] == 'gb') { ?>
                                        <a href="http://www.goyazbritas.com.br">www.goyazbritas.com.br</a>
                                    <?php } else { ?>
                                        <a href="http://www.pneusvisa.com.br">www.pneusvisa.com.br</a>
                                    <?php } ?>
                                </div>
                                <div style="width:580px; float:left; display:block;"><strong>E-mail:</strong> <a href=<?php echo "mailto:" . $_POST["email"]; ?>><?php echo $_POST["email"]; ?></a></div>
                            </div>
                            <div style='font-size:22px; font-family:Verdana; font-color:000;'>
                                <div style="width:930px; float:left; display:block;">
                                    <strong>Endreço: </strong><?php echo $_POST["endereco"]; ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <td colspan="2">
                    <?php
                    if ($_POST["radio"] == 'gb') {
                        $texto = "<div style='font-size:21px; font-family:Times New Roman; text-align: justify; font-color:000'><br /> O conteúdo desta mensagem e de seus anexos é de uso restrito e confidencial, sendo o seu sigilo protegido por lei. Estas informações não podem ser divulgadas sem prévia autorização escrita. Se você não é o destinatário desta mensagem, ou o responsável pela sua entrega, apague-a imediatamente e avise ao remetente, respondendo a esta mensagem. Alertamos que esta transitou por rede pública de comunicação, estando, portanto, sujeita aos riscos inerentes a essa forma de comunicação. A <strong>PNEUS VISA LTDA</strong>, não se responsabiliza por conclusões, opiniões, ou outras informações nesta mensagem que não tenham sido emitidas por seus integrantes.</div>";
                    } elseif ($_POST["radio"] == 'ac') {
                        $texto = "<div style='font-size:21px; font-family:Times New Roman; text-align: justify; font-color:000'><br /> O conteúdo desta mensagem e de seus anexos é de uso restrito e confidencial, sendo o seu sigilo protegido por lei. Estas informações não podem ser divulgadas sem prévia autorização escrita. Se você não é o destinatário desta mensagem, ou o responsável pela sua entrega, apague-a imediatamente e avise ao remetente, respondendo a esta mensagem. Alertamos que esta transitou por rede pública de comunicação, estando, portanto, sujeita aos riscos inerentes a essa forma de comunicação. A <strong>GOYAZ BRITAS LTDA</strong>, não se responsabiliza por conclusões, opiniões, ou outras informações nesta mensagem que não tenham sido emitidas por seus integrantes.</div>";
                    } else {
                        $texto = "<div style='font-size:21px; font-family:Times New Roman; text-align: justify; font-color:000'><br /> O conteúdo desta mensagem e de seus anexos é de uso restrito e confidencial, sendo o seu sigilo protegido por lei. Estas informações não podem ser divulgadas sem prévia autorização escrita. Se você não é o destinatário desta mensagem, ou o responsável pela sua entrega, apague-a imediatamente e avise ao remetente, respondendo a esta mensagem. Alertamos que esta transitou por rede pública de comunicação, estando, portanto, sujeita aos riscos inerentes a essa forma de comunicação. A EMPRESA, não se responsabiliza por conclusões, opiniões, ou outras informações nesta mensagem que não tenham sido emitidas por seus integrantes.</div>";
                    }
                    echo $texto;
                    ?>
                </td>
                </tr>
            </table>
        </div>
    </body>
</html>