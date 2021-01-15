<?php
ob_start();
session_start();
require "../dao/conexao.php";
if (isset($_POST['enviar'])) {

    $mensagem = ($_POST['mensagem']);
    //inserir no banco.
    $sql = "INSERT INTO suporte (mensagem) VALUES ('$mensagem')";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    //email
    
    $body = "Você possui uma nova mensagem de suporte : $mensagem ";



    //Definir para quem vai o formulário:
    $dest = "tuliovst@gmail.com";

    //Inicio Enviar e-mail
    require '../PHPMailer/PHPMailerAutoload.php';

    $Mailer = new PHPMailer();

    //Define que será usado SMTP
    $Mailer->IsSMTP();

    //Enviar e-mail em HTML
    $Mailer->isHTML(true);

    //Aceitar carasteres especiais
    $Mailer->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

    //Configurações
    $Mailer->SMTPAuth = true;
    $Mailer->SMTPSecure = 'ssl';

    //nome do servidor
    $Mailer->Host = 'email-ssl.com.br';

    //Porta de saida de e-mail 
    $Mailer->Port = 465;

    //Dados do e-mail de saida - autenticação
    $Mailer->Username = 'tulio.vasconcelos@balasantarita.com.br';
    $Mailer->Password = 'BSR@Nata#@1';

    //E-mail remetente (deve ser o mesmo de quem fez a autenticação)
    $Mailer->From = 'tulio.vasconcelos@balasantarita.com.br';

    //Nome do Remetente
    $Mailer->FromName = 'Controle Estoque - Petus';

    //Assunto da mensagem
    $Mailer->Subject = 'Nova mensagem de suporte';

    //Corpo da Mensagem
    $Mailer->Body = $body;

    //Destinatario 
    $Mailer->AddAddress($dest);

    if ($Mailer->Send()) {
    $_SESSION['mensagem_enviada']=true;
        ?>
        <script>
            location.href = "../view/painel.php";
        </script>
    <?php
    }
    else {
    $_SESSION['mensagem_nao_enviada']=true;
    ?>
        <script>
            location.href = "../view/painel.php";
        </script>
    <?php
    }
        
}   


