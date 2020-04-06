<?php
	$mensaje="";
	if(isset($_POST["envio"])){
			include("php/envioCorreo.php");
			$email = new email("iTPM Software","itpmalert@gmail.com","Itpm2050");
			$email->agregar($_POST["email"],$_POST["nombre"]);
						
			if ($email->enviar('Prueba envio de correos',$contenido_html)){
							
					$mensaje= 'Mensaje enviado';
							
			}else{
						   
			   $mensaje= 'El mensaje no se pudo enviar';
			   $email->ErrorInfo;
			}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" href="css/style.css"/>
</head>

<body>
    <header>
     <div id="logo"><img src="logo-php.png"/></div>
    </header>
    <div id="pagina">
    	<section>
        	<div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="application/x-www-form-urlencoded" name="envio">
                    <table>
                        <tr>
                            <td>
                            	<label for="email">Email</label>
                            </td>
                            <td>
                            	<input type="text" name="email" id="email" placeholder="ejemplo@dominio.com" autofocus maxlength="50" size="20">
                            </td>
                            <td>
                            	<label for="nombre">Nombre</label>
                            </td>
                            <td>
                            	<input type="text" name="nombre" id="nombre" placeholder="Tu nombre" autofocus maxlength="50" size="20">
                                <input name="envio" value="si" hidden="hidden">
                            </td>
                            <td>
                            	<button type="submit">Enviar</button>
                            </td>
                        </tr>
                    </table>
            	</form>
            </div>
            <?php
				echo $mensaje;
			?>
        </section>
        <aside>
        
        </aside>
    </div>
    <footer>
    
    </footer>
</body>
</html>