<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="../css/all.css">

    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/conteudo-main-logado.css">
    <?php  if($_SESSION["user"]['tabela'] == "professor") {?>
        <link rel="stylesheet" href="../css/leftnavbarprofessor.css">
        <link rel="stylesheet" href="../css/topbarprofessor.css">
    <?php } else if($_SESSION["user"]['tabela'] == "aluno") {?>
        <link rel="stylesheet" href="../css/leftnavbar.css">
        <link rel="stylesheet" href="../css/topbar.css">
    <?php } ?>
    <link rel="stylesheet" href="../css/editar-perfil.css">

    <script src="../js/perfil.js" defer></script>
    <script type = "module" src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <title>Editar Perfil - High Ecology</title>
</head>
<body>
    <div class = "container-p">
        <div class = "navegacao">
        <ul>
        <li>
                    <a href = "#">
                        <span class = "icone">
                            <img src="" alt="">
                        </span>
                        <span class = "titulo">HIGH ECOLOGY</span>
                    </a>
                </li>

                <?php 
                if($_SESSION["user"]['tabela'] == "aluno"){
                    if($_SESSION['dados_user']['matriculado'] == false)
                    {?>
                    <li>
                        <a href = "renovarAssinatura.php">
                            <span class = "icone">
                                <ion-icon name="repeat-outline"></ion-icon>
                            </span>
                            <span class = "titulo">Renovar Assinatura</span>
                        </a>
                    </li>
                <?php } }?>

                <?php 
                if($_SESSION["user"]['tabela'] == "aluno")
                {?>

                <li>
                    <a href = "perfil.php">
                        <span class = "icone">
                            <ion-icon name = "home-outline"></ion-icon>
                        </span>
                        <span class = "titulo">Home</span>
                    </a>
                </li>
                <?php } ?>

                <?php 
                if($_SESSION["user"]['tabela'] == "professor")
                {?>
                    <li>
                    <a href = "gerenciar-cursos.php">
                        <span class = "icone">
                            <ion-icon name="pencil-outline"></ion-icon>
                        </span>
                        <span class = "titulo">Gerenciar Cursos</span>
                    </a>
                    </li>
                <?php } ?>

                <?php
                if($_SESSION["user"]['tabela'] == "aluno"){
                    if($_SESSION['dados_user']['matriculado'] == true)
                    {?>
                    <li>
                        <a href = "cursos.php">
                            <span class = "icone">
                                <ion-icon name="library-outline"></ion-icon>
                            </span>
                            <span class = "titulo">Cursos</span>
                        </a>
                    </li>
                <?php }}
                elseif($_SESSION["user"]['tabela'] == "professor")
                {?>
                <li>
                    <a href = "cursos.php">
                        <span class = "icone">
                            <ion-icon name="library-outline"></ion-icon>
                        </span>
                        <span class = "titulo">Cursos</span>
                    </a>
                </li>
                <?php } ?>

                <?php 
                if($_SESSION["user"]['tabela'] == "aluno")
                {?>
                <li>
                    <a href = "certificados.php">
                        <span class = "icone">
                            <ion-icon name="trophy-outline"></ion-icon>
                        </span>
                        <span class = "titulo">Certificados</span>
                    </a>
                </li>
                <?php } ?>

                <li>
                    <a href = "editar-perfil.php">
                        <span class = "icone">
                            <ion-icon name = "settings-outline"></ion-icon>
                        </span>
                        <span class = "titulo">Editar Perfil</span>
                    </a>
                </li>

                <li>
                    <a href = "../php/logout.php">
                        <span class = "icone">
                            <ion-icon name = "log-out-outline"></ion-icon>
                        </span>
                        <span class = "titulo">Sair</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class = "main-p">
            <div class = "topbar">
                <div class = "toggle">
                    <ion-icon name = "menu-outline"></ion-icon>
                </div>

                <div class = "user">
                    <a href="editar-perfil.php">
                        <img src="<?php if($_SESSION["user"]['tabela'] == "aluno") { echo $_SESSION['dados_user']['img']; } elseif($_SESSION["user"]['tabela'] == "professor") { echo "../img/icon.png";} ?>" alt="foto de perfil">
                    </a>
                </div>
            </div>
            
            <div class="container-editar-perfil">
                <form action="#" method="POST">
                    <div class="Row">
                        <h1>Editar Perfil</h1>
                    </div>
                    <div class="row">
                        <div class="col" id="perfil-imagem">
                            
                            <div class="imagem">
                                <img src="<?php if($_SESSION["user"]['tabela'] == "aluno") { echo $_SESSION['dados_user']['img']; } elseif($_SESSION["user"]['tabela'] == "professor") { echo "../img/icon.png";} ?>" alt="foto de perfil">
                            </div>

                        </div>

                        <div class="col">
                            <div class="inputBox-editar-perfil">
                                <span>Alterar Nome:</span>
                                <input type="text" id="name" name="name" placeholder="Nome" required value="<?php echo $_SESSION['dados_user']['nome'];?>">
                            </div>
                            <div class="inputBox-editar-perfil">
                                <span>
                                    <?php if($_SESSION["user"]['tabela'] == "professor") { ?>
                                    Email:
                                    <?php } else {?>
                                    Alterar Email:
                                    <?php } ?>
                                </span>
                                <input type="email" id="email" name="email" placeholder="Email" required value="<?php echo $_SESSION['dados_user']['email'];?>" <?php if($_SESSION["user"]['tabela'] == "professor") echo "readonly style='background-color:#5a8854; color:#f2f2f2;'"; ?>>
                            </div>
                            <?php
                            if($_SESSION["user"]['tabela'] == "aluno")
                            {?>
                            <div class="inputBox-editar-perfil">
                                <span>Alterar CPF:</span>
                                <input type="text" id="cpf" name="cpf" placeholder="CPF" required value="<?php echo $_SESSION['dados_user']['cpf'];?>">
                            </div>
                            <?php } ?>
                            <div class="inputBox-editar-perfil">
                                <span>Alterar senha:</span>
                                <input type="password" name="password"placeholder="Senha" required value="<?php echo $_SESSION['dados_user']['senha'];?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button-editar-perfil" name="btn_editar_perfil">Salvar</button>
                    <?php 

                        include_once '../php/metodos_principais.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_editar_perfil'])) {
                            // Cria uma instância da classe de métodos principais
                            $metodos_principais = new metodos_principais();

                            // Recupera os dados do formulário
                            $nome = $_POST['name'];
                            $email = $_POST['email'];
                            $senha = $_POST['password'];
                            $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;


                            // Atualiza os dados do usuário
                            $resultado = $metodos_principais->editarPerfil($_SESSION["user"]['id'], $nome, $email, $cpf, $senha);
                            
                            // Caso a atualização seja bem-sucedida, atualiza os dados na sessão
                            if ($resultado) {
                                if ($_SESSION["user"]['tabela'] == "aluno"){
                                    $_SESSION['dados_user']= $metodos_principais->getAlunoPorId($_SESSION["user"]['id']);  // ou getProfessorPorId(), dependendo do tipo de usuário
                                }
                                else if ($_SESSION["user"]['tabela'] == "professor"){
                                    $_SESSION['dados_user']= $metodos_principais->getProfessorPorId($_SESSION["user"]['id']);  // ou getProfessorPorId(), dependendo do tipo de usuário
                                }
                                
                                echo "<p style='text-align: center; color: white; padding-top: 20px;'>Perfil atualizado com sucesso!</p>";
                            } else {
                                echo "<p>Erro ao atualizar perfil. Tente novamente.</p>";
                            }
                        }
                    ?>
                </form>
            </div>
        </div>
</body>
</html>