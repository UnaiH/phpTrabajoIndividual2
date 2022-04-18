<?php
$DB_SERVER="localhost"; #la dirección del servidor
$DB_USER="Xuhernandez008"; #el usuario para esa base de datos
$DB_PASS="*YzSn11YG"; #la clave para ese usuario
$DB_DATABASE="Xuhernandez008_imagenes";
$con = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS, $DB_DATABASE);

$nick = $_POST["usu"];
$tit = $_POST["titulo"];
$ima = $_POST["imagen"];
if(!is_null($nick)){
    if (mysqli_connect_errno($con)) 
    {
        $result[] = array('resultado' => false);
        echo 'Error de conexion: ' . mysqli_connect_error();
        exit();
    }
    $resultado = mysqli_query($con,"SELECT * FROM fotos WHERE usuario='$nick'AND titulo='$tit'");
    if (mysqli_num_rows($resultado)==0){
        mysqli_query($con,"INSERT INTO fotos (usuario,titulo,imagen) VALUES ('$nick','$tit','$ima')");
        $result[] = array('resultado' => true);
    }
    else{
        mysqli_query($con,"UPDATE fotos SET usuario='$nick',titulo='$tit', imagen='$ima' WHERE usuario='$nick' AND titulo='$tit'");
        $result[] = array('resultado' => true);
    }
}
else{
    $result[] = array('resultado' => false);
}
mysqli_close($con);
echo json_encode($result);
?>