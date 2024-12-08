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
    <link rel="stylesheet" href="../css/conteudo-main-logado.css">
    <?php  if($_SESSION["user"]['tabela'] == "professor") {?>
        <link rel="stylesheet" href="../css/leftnavbarprofessor.css">
        <link rel="stylesheet" href="../css/topbarprofessor.css">
    <?php } else if($_SESSION["user"]['tabela'] == "aluno") {?>
        <link rel="stylesheet" href="../css/leftnavbar.css">
        <link rel="stylesheet" href="../css/topbar.css">
    <?php } ?>
    <link rel="stylesheet" href="../css/especializacoes.css">
    <link rel="stylesheet" href="../css/conteudoCurso.css">

    <script src="../js/perfil.js" defer></script>
    <script type = "module" src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Editar Perfil - High Ecology</title>
</head>
<body>
    <div class = "container-p">
        <div class = "navegacao">
            <ul style="padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
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

            <?php
            include('../php/config.php');

            $stmt = $pdo->query('SELECT * FROM conteudos');
            $modulos = $stmt->fetchAll();
            ?>
            
            <?php
            include('../php/config.php');

            // Pegando o id do curso
            $stmt = $pdo->query('SELECT * FROM modulos WHERE titulo_mod LIKE "' . $_SESSION['nome_do_modulo'] . '"');
            $id_do_modulo = $stmt->fetch(PDO::FETCH_ASSOC); // Usando fetch() para obter uma única linha e colocando na variavel $id_do_modulo
            
            $_SESSION['id_do_modulo'] = $id_do_modulo['id_mod']; // Criei um varaivel de sessão

            // Armazene o ID do curso na variável de sessão
            $stmt = $pdo->query('SELECT * FROM conteudos WHERE id_modulo = ' . $_SESSION['id_do_modulo']);
            $conteudos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            
            <?php foreach ($conteudos as $conteudo): ?>
            <div class="container-titles">
                <div class="titles">
                    <h1><?php echo htmlspecialchars($conteudo['titulo_principal']); ?></h1>
                    
                </div>
            </div>
            
            <section class="conteudo-curso">
                <h1><?php echo htmlspecialchars($conteudo['titulo1']); ?></h1>
                <div class="conteudo">

                <div class="conteudo-left">
                <img src="../img/uploads/<?php echo htmlspecialchars($conteudo['imagem1']); ?>" alt="imagem" class="card__img">
                </div>
                <div class="conteudo-right">
                    <div class="content-textos">
                    <p>
                    <?php echo htmlspecialchars($conteudo['texto1']); ?>
                    </p>
                    </div>
                </div>
                </div>
            </section>

            <section class="conteudo-curso-dois">
                <h1><?php echo htmlspecialchars($conteudo['titulo2']); ?></h1>
                <div class="conteudo-dois">

                <div class="conteudo-left-dois">
                    <div class="content-textos-dois">
                    <?php echo htmlspecialchars($conteudo['texto2']); ?>
                    </div>
                </div>
                <div class="conteudo-right-dois">
                    <img src="../img/uploads/<?php echo htmlspecialchars($conteudo['imagem2']); ?>" alt="ecologia">
                </div>
                </div>
            </section>

            <section class="conteudo-curso">
                <h1><?php echo htmlspecialchars($conteudo['titulo3']); ?></h1>
                <div class="conteudo">

                <div class="conteudo-left">
                    <img src="../img/uploads/<?php echo htmlspecialchars($conteudo['imagem3']); ?>" alt="ecologia">
                </div>
                <div class="conteudo-right">
                    <div class="content-textos">
                    <?php echo htmlspecialchars($conteudo['texto3']); ?>
                    </div>
                </div>
                </div>
            </section>

            <div class="rodape">
                <div class="rodape-text">
                <h1><?php echo htmlspecialchars($conteudo['titulo_principal']); ?></h1>
                <p>(COMPLETO)</p>
                </div>
                <div class="rodape-button">
                    <a href="../html/cursos.php">
                    <button>
                        Finalizar Módulo
                    </button>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>

</body>
</html>