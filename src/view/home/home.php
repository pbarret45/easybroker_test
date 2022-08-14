<!DOCTYPE html>
<html lang="es" >
<head>
	<meta charset="UTF-8">
	<title>EasyBroker</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="src\view\shared\favicon.ico" rel="icon">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link href="vendor\twbs\bootstrap\dist\css\bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container-xxl p-0" id="app">

		<nav class="navbar navbar-expand-lg bg-white sticky-top">
			<a href="#" class="navbar-brand d-flex p-2">
				<img class="img-fluid" src="src\view\shared\logo.svg" alt="EasyBroker" style="height: 1.76rem;">
			</a>
		</nav>
		<div class="container-fluid p-0">
			<div class="row g-0 align-items-center flex-column-reverse flex-md-row">
				<div class="col-md-6 p-5 mt-lg-3">
					<h2 class="mb-4">Ten <b>tu propio espacio</b> para mostrar tus propiedades</h2> 
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="src\view\home\img\casa.jpg" alt="">
				</div>
			</div>
		</div>
		<div class="container py-5">
			<property-list :properties="propertyList"></property-list>
		</div>
		<div class="d-flex align-items-center justify-content-center pb-5" id="loading">
			<div>
				<strong>Cargando...</strong>
				<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
			</div>
		</div>
		<div class="pb-5"></div>
		<div class="container-fluid bg-dark text-white-50 footer py-3 mt-5">
			<div class="container">
				<div class="row justify-content-center ">
					<div class="col-md-6 mb-3 mb-md-0">
						<a class="border-bottom" href="mailto:pbarret45@gmail.com">pbarret45@gmail.com</a>, Prueba del api de EasyBroker. 
					</div>
				</div>
			</div>
		</div>
		<a href="#" type="button" class="btn btn-primary btn-lg ml-auto rounded-circle position-fixed bottom-0 end-0 m-4" style="width: 50px;height: 50px;"><i class="fas fa-arrow-up"></i></a>
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="vendor\twbs\bootstrap\dist\js\bootstrap.min.js"></script>
	<script src="/src/view/home/js/easybroker.js"></script>
</body>
</html>