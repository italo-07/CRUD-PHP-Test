<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastro de Produtos</title>
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
        <link href="./web/css/bootstrap.min.css" rel="stylesheet">
        <link href="./web/css/style1.css" rel="stylesheet">
    </head>
    <body>
        <?php require_once 'process.php'; ?>

        <div class="container-fluid">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><i class="fa fa-book"></i> Sistema CRUD</a>
                </div>
            </div>
        </nav>



            <div id="main" class="container-fluid">

            <div class="row">
              <div class="form-group col-md-3"></div>
              <div class="form-group col-md-3">
                <h3>Cadastrar Produto</h3>
              </div>
              <div class="form-group col-md-3"></div>
              <div class="form-group col-md-3"></div>
            </div> 




            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <div class="row">
                    <div class="form-group col-md-3"></div>
                    <div class="form-group col-md-2">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>" placeholder="Digite o seu nome">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Preço</label>
                        <input type="text" class="form-control" name="preco" value="<?php echo $preco; ?>" placeholder="Digite o preco do produto">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Descrição</label>
                        <input type="text" class="form-control" name="descricao" value="<?php echo $descricao; ?>" placeholder="Digite a descricao do produto">
                    </div>
                    <div class="form-group col-md-3"></div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-3"></div>
                    <div class="form-group col-md-2">
                        <label>Imagem</label>
                        <input type="text" class="form-control" name="imagem" value="<?php echo $imagem; ?>" placeholder="Digite a url da imagem">
                    </div>
                    <div class="form-group col-md-3"></div>
                  </div>

                  

              <div class="row">
                    <div class="form-group col-md-3"></div>
                    <div class="col-md-3">

                    <?php
                        if($update == true):
                    ?>
                        <button type="submit" class="btn btn-info" name="update">Atualizar</button>
                    <?php else: ?>
                        

                        <button type="submit" class="btn btn-primary" name="save">Salvar</button>
                        <button type="button" class="btn btn-default" name="cancelar">Cancelar</button>

                    <?php endif; ?>
                    </div>
                    <div class="form-group col-md-3"></div>
              </div>

            </form>

        <?php

        if (isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">

            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
            
        </div>
        <?php endif ?>

        <?php 
            $mysqli = new mysqli('localhost', 'root', '', 'crudteste') or die(mysqli_error($mysqli));

            $result = $mysqli->query("SELECT * FROM produtos") or die ($mysqli->error);
            
            

        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="form-group col-md-3"></div>
                <div class="form-group col-md-6"> 
                    
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Descrição</th>
                                    <th>Imagem</th>
                                    <th colspan="2">Ação</th>
                                </tr>
                            </thead>

                            <?php 
                                while($row = $result->fetch_assoc()):    ?>

                                <tr>
                                    <td><?php echo $row['nome']; ?></td>
                                    <td><?php echo $row['preco']; ?></td>
                                    <td><?php echo $row['descricao']; ?></td>
                                    <td><img src="<?php echo $row['imagem']; ?>" width="50" height="60"></td>
                                    <td>
                                        <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Editar</a>
                                        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>

                        </table>
                   
                </div>
                <div class="form-group col-md-3"></div>
            </div>
        </div>

        <?php

            function pre_r( $array ){
                echo '<prep>';
                print_r($array);
                echo '</prep>';
            }

        ?>
        </div>

    </body>

        <div id="rodape">
        <span>© 2020 Italo - Todos os Direitos Reservados. </span>
    </div>

    <script src='./web/js/jquery.min.js'></script>
    <script src="./web/js/bootstrap.min.js"></script>

</body>
</html>