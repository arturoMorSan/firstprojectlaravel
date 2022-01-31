<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Constancia</title>
		<style>
			@page {
				margin: 0;
				padding: 0;
				size: landscape;
			}
			@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
			body {
				font-family: 'Lato', sans-serif;
				margin: 0;
				padding: 0;
			}
			.contenedor-diploma {
				display: block;
				width: 29.7cm;
				margin: 0;
				padding: 0;
				position: relative;
				height: 21.0cm;
			}
			.img-diploma {
				/*display: block;*/
				height: 100%;
				left: 0;
				position: absolute;
				top: 0;
				width: 100%;
				z-index: 1;
				margin:0;
			}
			.contenedor__diploma-nombre {
				position: absolute;
			    z-index: 100;
			    text-align: center;
			    top: 8.9cm;
			    font-size: 40px;
			    margin-left: 3.7cm;
			    margin-right: 3.7cm;
			    color: #000000;
			    font-weight: bold;
			    width: 100%;
			}

		</style>	
    </head>
    <body>
    	@foreach($attendees as $attende)<div class="contenedor-diploma">
    		<img class="img-diploma" src="{{ url('img/diploma/constancia.jpg') }}" alt="">
	        <div class="contenedor__diploma-nombre">
	           {{ $attende->full_name }}
	        </div><div></div></div>@endforeach</body></html>