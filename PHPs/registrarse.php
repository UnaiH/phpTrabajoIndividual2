<?php
$DB_SERVER="localhost"; #la dirección del servidor
$DB_USER="Xuhernandez008"; #el usuario para esa base de datos
$DB_PASS="*YzSn11YG"; #la clave para ese usuario
$DB_DATABASE="Xuhernandez008_usuarios";
$con = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS, $DB_DATABASE);

$usu = $_POST["usu"];
$pass = $_POST["contrasena"];
if(!is_null($usu)){
    if (mysqli_connect_errno($con)) 
    {
        $result[] = array('resultado' => false);
        echo 'Error de conexion: ' . mysqli_connect_error();
        exit();
    }
    $contrase=password_hash($pass, PASSWORD_DEFAULT);
    $resultado=mysqli_query($con,"SELECT * FROM usuarios WHERE usuario='$usu'");
    if (mysqli_num_rows ($resultado)==0){
        mysqli_query($con,"INSERT INTO usuarios (usuario,contrasena) VALUES ('$usu','$contrase')");
    }
    else{
        mysqli_query($con,"UPDATE usuarios SET usuario='$usu',contrasena='$contrase' WHERE usuario='$usu'");
    }
    $result[] = array('resultado' => true);
}
else{
    $result[] = array('resultado' => false);
}
mysqli_close($con);
echo json_encode($result);
?>