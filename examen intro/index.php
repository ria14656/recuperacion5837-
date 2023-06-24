
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet" />
</head>
<body>
    <?php
     $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
       $conexion = new PDO('http://localhost/phpmyadmin/index.php?route=/database/export&db=recuperacion_ariatna_5837',"root",'',$pdo_options);

       if (isset($_POST["accion"])){
       // Echo "Quieres". $_´POST["accion"];
        if($_POST["accion"]=="Crear"){
            $insert = $conexion->prepare("INSERT INTO productos(Codigo,Nombre,Precio,Existencia)(:Codigo,:Nombre,:Precio,:Existencia");
            $insert->bindvalue('Codigo',$_POST['Codigo'] );
            $insert->bindvalue('Nombre',$_POST['Nombre'] );
            $insert->bindvalue('Precio',$_POST['Presio'] );
            $insert->bindvalue('Existencia',$_POST['Existencia'] );
            $insert->execute();
        }
       }


     $select = $conexion->query("SELECT Codigo, Nombre, Precio, Existencia FROM productos");

?>

<form method="POST">
    <imput type="text" name="Codigo" placehorder="ingresar el Codigo"/>
    <imput type="text" name="Nombre" placehorder="ingresar el Nombre"/>
    <imput type="text" name="Precio" placehorder="ingresar el Precio"/>
    <imput type="text" name="Existencia" placehorder="ingresar Existencia"/>
    <imput type="hidden"name="accion" value="crear"/>
    <button type="submit"> crear </button>
    
    <table class="table">
    <thead>
        <tr>
            <th> Codigo</th>
            <th> Nombre</th>
            <th> Precio </th>
            <th> Existencia</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach($select ->fetchAll() as $productos){?>
        <tr>
            <td> <?php echo $productos ["Codigo"]?> </td> 
            <td> <?php echo $productos ["Nombre"]?> </td> 
            <td> <?php echo $productos ["Precio"]?> </td> 
            <td> <?php echo $productos ["Existencia"]?> </td> 
            <td> <form method="POST" >
                <button type="submit" > Editar
                <input type="hidden" value="Editar"/>
                <input type="hidden"value="<?php echo $productos["Codigo"]?>"/>

                </form></td>
        </tr>
        <?php
        }?>
       </body>
</html>