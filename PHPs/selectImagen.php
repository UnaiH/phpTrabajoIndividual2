<?php
$DB_SERVER="localhost"; #la dirección del servidor
$DB_USER="Xuhernandez008"; #el usuario para esa base de datos
$DB_PASS="*YzSn11YG"; #la clave para ese usuario
$DB_DATABASE="Xuhernandez008_imagenes";
# Se establece la conexión:
$con = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS, $DB_DATABASE);
#Comprobamos conexión
$usu = $_POST["usuario"];
$tit = $_POST["titulo"];
if (mysqli_connect_errno($con)) 
{
    $result[] = array('resultado' => false);
	echo 'Error de conexion: ' . mysqli_connect_error();
	exit();
}

# Ejecutar la sentencia SQL
$resultado = mysqli_query($con, "SELECT * FROM fotos WHERE usuario='$usu' AND titulo='$tit'");

# Comprobar si se ha ejecutado correctamente
if (!$resultado) 
{
    $result[] = array('resultado' => false);
	echo 'Ha ocurrido algún error: ' . mysqli_error($con);
}
$usuario = array();
if(mysqli_num_rows($resultado)==1){
    while($row = $resultado->fetch_assoc())
    {
        $imagenes= $row['imagen'];
    }
    $result[] = array('resultado' => $imagenes);
}
else{
    $result[] = array('resultado' => false);
}
#Devolver el resultado en formato JSON
mysqli_close($con);
echo json_encode($result);
?>