<?php
    require_once 'crud.php';
    # inicia a sessão no arquivo

        if($_SERVER['REQUEST_METHOD'] === "POST") {

        $prod = filter_input(INPUT_POST, "prod", FILTER_SANITIZE_STRING);
        

        if(buscar($prod)) {
            // cria a sessão e define valor a ela
            $_SESSION['prod'] = buscar($prod);
            $_SESSION['msg'] = true;
            header("location:consulta.php");
            exit;
        } else {
            $_SESSION['msg'] = false;
        }
        #$_SESSION['msg'] = salvar($nome, $numero) ? 'Salvo com sucesso' : 'Erro ao gravar';
        
        # função responsavel por redirecionar a página
        header("location:consulta.php");
        exit;
    }