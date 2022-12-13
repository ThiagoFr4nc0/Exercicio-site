<?php
session_start();
if( (isset($_SESSION['logado'])) && ($_SESSION['logado']==TRUE) ){
    header("Location: tarefas.php");
    exit();
} else {
    if(!isset($_SESSION['erro_verificacao'])){
        if(isset($_POST['nome'])){
            require "conecta.php";

            $stmt=$conn->prepare("SELECT nome FROM usuarios 
            WHERE usuario=:USUARIO OR email=:EMAIL;");
            $stmt->bindValue(':USUARIO',$_POST['usuario']);
            $stmt->bindValue(':EMAIL',$_POST['email']);
            $stmt->execute();
            if($stmt->rowCount()>0){
                echo 'Usuário ou e-mail já cadastrado. <a href
                ="cria_usuario.php">Tentar novamente</a>';
                exit();
            } else {
                $verificador = rand(0,10000);
                $stmt2=$conn->prepare("INSERT INTO usuarios
                (nome,email,usuario,senha,verificador,verificado)
                VALUES (:NOME,:EMAIL,:USUARIO,:SENHA,:VERIFICADOR,
                :VERIFICADO);");
                $stmt2->bindValue(':NOME',$_POST['nome']);
                $stmt2->bindValue(':EMAIL',$_POST['email']);
                $stmt2->bindValue(':USUARIO',$_POST['usuario']);
                $stmt2->bindValue(':SENHA',sha1($_POST['senha']));
                $stmt2->bindValue(':VERIFICADOR',$verificador);
                $stmt2->bindValue(':VERIFICADO',0);
                if($stmt2->execute()){
                    $iduser = $conn->lastInsertId();
                    $_SESSION['verificador']=$verificador;
                    $_SESSION['id']=$iduser;

                    //Dispara o e-mail
                    require "class/class.phpmailer.php";
                    $mail = new PHPMAILER();
                    $mail->IsSMTP();
                    $mail->Host="smtp.hostinger.com.br";
                    $mail->SMTPAuth = true;
                    $mail->Username="ifsp@jhonatangalante.com.br";
                    $mail->Password="if-856@M2";
                    $mail->From="ifsp@jhonatangalante.com.br";
                    $mail->AddAddress($_POST['email']);
                    $mail->IsHTML(true);
                    $mail->FromName="Sistema de Tarefas";
                    $mail->CharSet='UTF-8';
                    $mail->Subject='Codigo de Verificacao';
                    $mail->Body="Olá ".$_POST['nome'].",<br /><br />
                    Seu código de verificação é ".$verificador;

                    if(!$mail->Send()){
                        $stmt3=$conn->prepare("DELETE FROM usuarios 
                        WHERE codigo=:CODIGO LIMIT 1;");
                        $stmt3=bindValue(':CODIGO',$iduser);
                        $stmt3->execute();
                        echo "Houve um erro no cadastro. Por favor, tente novamente.";
                        exit();
                    } else {
                    }
                } else {
                    echo "Houve um erro no cadastro. Por favor, tente novamente.";
                    exit();
                }
            }
        } else {
            header("Location: logout.php");
            exit();
        }
    } else {
        unset($_SESSION['erro_verificacao']);
    }
}
?>
<h3>Verificação Pendente</h3>
<form method="POST" action="cria_usuario3.php">
    Digite o código de verificação enviado por e-mail:
        <input type="text" name="verificador">
        <input type="submit" value="Confirmar">
</form>