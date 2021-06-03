<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>

	<body>

		<div class="container">  

			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

      		<div class="row">
      			<div class="col-md-12">
  				
					<div class="card-body font-weight-bold">
					<?php 
					session_start();
					if(isset($_GET['status']) && $_GET['status'] == 'success'){ ?>
						<h1 class="text-success">Email enviado com sucesso! </h1>
                        <p class="text-success">Obrigado por usar nosso aplicativo</p>
						<a href="index.php" class="btn btn-outline-success btn-lg">Voltar</a>
					<? } if (isset($_GET['status']) && $_GET['status'] == 'error') { ?>
						<h1 class="text-danger">Ops!</h1>
                        <p class="text-danger">Infelizmente seu email não pode ser enviado.<br>Detalhes do erro: <?php echo $_SESSION['info_erro'] ?></p>
						<a href="index.php" class="btn btn-outline-danger btn-lg">Voltar</a>
					<? } ?>
					</div>
				</div>
      		</div>
      	</div>

	</body>
</html>