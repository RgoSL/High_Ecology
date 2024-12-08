<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_hidden = $_POST['txt_nome_do_modulo'];
    $_SESSION['nome_do_modulo'] = $input_hidden;
    header("Location: gerenciar-conteudo.php?id=" . $modulo['id_mod']);
    exit();
}

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

    <script src="../js/perfil.js" defer></script>
    <script type = "module" src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

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
            
            
                <!--ADICIONAAAAAAAAAAAAR AQUII VINICIUUUSSSSSSSSS-->
            <?php
            include('../php/config.php');

            $stmt = $pdo->query('SELECT * FROM modulos');
            $cursos = $stmt->fetchAll();
            ?>
            
            <?php
            include('../php/config.php');

            // Pegando o id do curso
            $stmt = $pdo->query('SELECT * FROM cursos WHERE title LIKE "' . $_SESSION['nome_do_curso'] . '"');
            $id_do_curso = $stmt->fetch(PDO::FETCH_ASSOC); // Usando fetch() para obter uma única linha e colocando na variavel $id_do_curso
            
            $_SESSION['id_do_curso'] = $id_do_curso['id']; // Criei um varaivel de sessão

            // Armazene o ID do curso na variável de sessão
            $stmt = $pdo->query('SELECT * FROM modulos WHERE id_curso = ' . $_SESSION['id_do_curso']);
            $modulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['$modulos'] = $modulos;
            ?>

            <header>
                <h1>Gerenciamento de Módulos</h1>
            </header>

            <div class="container my-5">
                <!--Botão tem que desaparecer após ser criado 3 módulos-->
                <?php
                    include_once '../php/metodos_principais.php';
                    $metodos_principais = new metodos_principais();
                    $result = $metodos_principais->verificarModulos($_SESSION['id_do_curso']);
                    
                    if($result == false){ ?>
                    <a href="gerenciar-modulos-create.php" class="btn btn-success add-course mb-4">Criar Novo Módulo</a>
                <?php }?>

                <form class="row" method="POST">
                    <?php foreach ($modulos as $modulo): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="../img/uploads/<?php echo htmlspecialchars($modulo['image_mod']); ?>" class="card-img-top" alt="Imagem do Módulo">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($modulo['titulo_mod']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($modulo['descricao_mod']); ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="gerenciar-modulos-edit.php?id_mod=<?php echo $modulo['id_mod']; ?>" class="btn btn-primary">Editar</a>
                                <button type="button" class="btn_modulo btn btn-warning">Conteúdo</button>
                                <a href="../php/delete_mod.php?id_mod=<?php echo $modulo['id_mod']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este módulo?')">Deletar</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                  <input type="hidden" name="txt_nome_do_modulo" class="txt_nome_do_modulo" value="">
                  </form>
                </div>
            </div>

                <!--ADICIONAAAAAAAAAAAAR AQUII VINICIUUUSSSSSSSSS-->


        </div>
        <script>
        // Seleciona todos os botões de módulo
        let btn_conteudos = document.querySelectorAll(".btn_modulo");
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
</body>
</html>