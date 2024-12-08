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
    <?php } else{?>
        <link rel="stylesheet" href="../css/leftnavbar.css">
        <link rel="stylesheet" href="../css/topbar.css">
    <?php } ?>
    <link rel="stylesheet" href="../css/editar-perfil.css">
    <link rel="stylesheet" href="../css/conteudo.css">

    <script src="../js/perfil.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/gerenciar-cursos.css">

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

                

            <header>
                <h1>Gerenciamento de Conteúdos</h1>
            </header>

            <div class="container my-5">
            <?php
                    include_once '../php/metodos_principais.php';
                    $metodos_principais = new metodos_principais();
                    $result = $metodos_principais->verificarConteudo($_SESSION['id_do_modulo']);
                    
                    if($result == false){ ?>
                    <a href="gerenciar-conteudo-create.php" class="btn btn-success add-course mb-4">Criar Conteúdo</a>
            <?php }?>
                

                <form class="row" action="#" method="POST">
                    <?php foreach ($conteudos as $conteudo): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="../img/uploads/<?php echo htmlspecialchars($conteudo['imagem1']); ?>" class="card-img-top" alt="Imagem do Módulo">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($conteudo['titulo_principal']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($conteudo['descricao']); ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="gerenciar-conteudo-edit.php?id=<?php echo $conteudo['id']; ?>" class="btn btn-primary">Editar</a>
                                <a href="../php/delete-conteudo.php?id=<?php echo $conteudo['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este conteúdo?')">Deletar</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                  <input type="hidden" name="txt_nome_do_conteudo" class="txt_nome_do_conteudo" value="">
                  </form>
                </div>
            </div>


            </div>
            <script>
                // Seleciona todos os botões de módulo
                let btn_conteudos = document.querySelectorAll(".btn_conteudo");
                let input_hidden_nome_modulo = document.querySelector('.txt_nome_do_modulo');

                // Itera sobre cada botão e adiciona um evento de clique
                btn_conteudos.forEach((btn) => {
                    btn.addEventListener('click', () => {
                        // Localiza o título do curso no mesmo cartão do botão clicado
                        let nome_modulo = btn.closest('.card').querySelector('.card-title').textContent;
                        
                        // Define o valor do curso no input oculto
                        input_hidden_nome_modulo.value = nome_modulo;
                        
                        // Envia o formulário
                        btn.closest('form').submit();
                    });
                });
            </script>
        </div>
    </div>
</body>
</html>

        <!--ADICIONAAAAAAAAAAAAR AQUII VINICIUUUSSSSSSSSS-->


   