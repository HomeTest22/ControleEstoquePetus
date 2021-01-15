<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="painel.php">
            <i class="fas fa-fw fa-university"></i>
            <span>Painel Principal</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="lista_fornecedores.php">
            <i class="fas fa-fw fa-industry"></i>
            <span>Fornecedores</span>
        </a>
    <!--</li>-->
    <!--<li class="nav-item dropdown">-->
    <!--    <a class="nav-link dropdown-toggle" href="lista_fornecedores.php" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
    <!--        <i class="fas fa-fw fa-industry"></i>-->
    <!--        <span>Fornecedores</span>-->
    <!--    </a>-->
        <!--<div class="dropdown-menu" aria-labelledby="pagesDropdown">-->
        <!--    <h6 class="dropdown-header">Opções:</h6>-->
        <!--    <a class="dropdown-item" style="cursor:pointer;" data-toggle="modal" data-target="#modal_cadastrar_fornecedor"> <i class="fa fa-user-plus" aria-hidden="true"></i> Cadastro</a>-->
        <!--    <a class="dropdown-item" href="lista_fornecedores.php"> <i class="fa fa-list" aria-hidden="true"></i> Lista </a>-->
        <!--    <div class="dropdown-divider"></div>-->
            <!-- <h6 class="dropdown-header">Configurações:</h6> -->
            <!--<a class="dropdown-item" href="alterar_fornecedor.php">Alterar Cadastro</a>-->
        <!--</div>-->
    <!--</li>-->
    <li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="lista_produtos.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Produtos</span>
        </a>
        <?php// require "modais/modal_cadastrar_produto.php";?>
        <!--<div class="dropdown-menu" aria-labelledby="pagesDropdown">-->
        <!--    <h6 class="dropdown-header">Opções:</h6>-->
        <!--    <a class="dropdown-item" style="cursor:pointer;" data-toggle="modal" data-target="#modal_cadastrar_produto"> <i class="fa fa-cart-plus" aria-hidden="true"></i> Cadastro</a>-->
        <!--    <a class="dropdown-item" href="lista_produtos.php">  <i class="fa fa-list" aria-hidden="true"></i> Lista</a>-->
        <!--    <div class="dropdown-divider"></div>-->
            <!-- <h6 class="dropdown-header">Configurações:</h6> -->
        <!--    <a class="dropdown-item" href="alterar_produto.php">Alterar Cadastro</a>-->
        <!--</div>-->
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="lista_estoque.php">
            <i class="fas fa-fw fa-archive"></i>
            <span>Estoque</span>
        </a>
        <!--<div class="dropdown-menu" aria-labelledby="pagesDropdown">-->
        <!--    <h6 class="dropdown-header">Opções:</h6>-->
        <!--    <a class="dropdown-item" style="cursor:pointer;" data-toggle="modal" data-target="#modal_entrada">Entrada</a>-->
        <!--    <a class="dropdown-item" style="cursor:pointer;" data-toggle="modal" data-target="#modal_saida">Saída</a>-->
        <!--    <a class="dropdown-item" href="lista_estoque.php"> <i class="fa fa-list-ol" aria-hidden="true"></i> Estoque atual</a>-->
        <!--    <div class="dropdown-divider"></div>-->
            <!-- <h6 class="dropdown-header">Configurações:</h6> -->
        <!--    <a class="dropdown-item" style="cursor:pointer;" data-toggle="modal" data-target="#modal_devolucao">Devoluções</a>-->
        <!--</div>-->
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-book"></i>
            <span>Relatórios</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Opções:</h6>
            <a class="dropdown-item" href="relatorio_produtos.php">Produtos.</a>
            <a class="dropdown-item" href="relatorio_fornecedores.php">Fornecedores.</a>
            <div class="dropdown-divider"></div>
        </div>
    </li>
    <li class="nav-item">
        <?php include "modais/modal_suporte.php"; ?>
        <a style="cursor:pointer;" class="nav-link" data-toggle="modal" data-target="#modal_suporte">
            <i class="fas fa-fw fa-headset"></i>
            <span>Suporte Online</span></a>
    </li>
</ul>