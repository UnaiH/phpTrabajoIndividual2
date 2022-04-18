<?php
$DB_SERVER="localhost"; #la dirección del servidor
$DB_USER="Xuhernandez008"; #el usuario para esa base de datos
$DB_PASS="*YzSn11YG"; #la clave para ese usuario
$DB_DATABASE="Xuhernandez008_usuarios";
# Se establece la conexión:
$con = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS, $DB_DATABASE);
#Comprobamos conexión
$usu = $_POST["usu"];
$contr = $_POST["contrasena"];
if (mysqli_connect_errno($con)) 
{
    $result[] = array('resultado' => false);
	echo 'Error de conexion: ' . mysqli_connect_error();
	exit();
}

# Ejecutar la sentencia SQL
$resultado = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario='$usu'");

# Comprobar si se ha ejecutado correctamente
if (!$resultado) 
{
	echo 'Ha ocurrido algún error: ' . mysqli_error($con);
    $result[] = array('resultado' => false);
}
$usuario = array();
if(mysqli_num_rows($resultado)==1){
    while($row = $resultado->fetch_assoc())
    {
        $claveVerif= $row['contrasena'];
    }
    if(password_verify($contr,$claveVerif)){
        $result[] = array('resultado' => true);
    }
    else{
        $result[] = array('resultado' => false);
    }
}
else{
    $result[] = array('resultado' => false);
}
#Devolver el resultado en formato JSON
mysqli_close($con);
echo json_encode($result);
?>