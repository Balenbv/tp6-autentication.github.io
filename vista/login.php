<?php

?>

<html>
    <header>
        
    </header>

    <body>
        <form action="../control/validarLogin.php" method="POST">
            <label for="usNombre">Nombre de Usuario</label>
            <input type="text" name="usNombre" id="usNombre" required>
            <label for="usPass">Contraseña</label>
            <input type="password" name="usPass" id="usPass" required>
            <input type="submit" value="Ingresar">
        </form>

        <!--un script Vista/login.php que invoque al script accion/verificarLogin.php el cual redirecciona al 
        script Vista/paginaSegura.php si los datos ingresados se corresponden con un usuario/pass 
        registrados. Caso contrario se redirecciona nuevamente al script Vista/login.php-->
        <a href="./index.php"><button>Volver</button></a>
        
    </body>
</html>