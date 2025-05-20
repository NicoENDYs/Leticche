<?php
//Clase para conectar a la base de datos MySQL
class MySQL
{

    //Datos de conexión
    private $ipServidor = "localhost";
    private $usuario = "root";
    private $contraseña = "";
    private $baseDatos = "lettiche";

    private $conexion;

    //Metodo para conectar la base de datos
    public function conectar()
    {

        //Crear la conexión
        $this->conexion = mysqli_connect($this->ipServidor, $this->usuario, $this->contraseña, $this->baseDatos);

        //Verificar si hay errores en la conexión
        if (!$this->conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }

        //Establecer el conjunto de caracteres a utf8
        mysqli_set_charset($this->conexion, "utf8");
    }


    //Metodo para cerrar la conexión
    public function desconectar()
    {
        if ($this->conexion) {
            mysqli_close($this->conexion);
        }
    }

    //Metodo para ejecutar una consulta
    public function efectuarConsulta($consulta)
    {
        //verificar la codificacion sea utf8
        mysqli_query($this->conexion, "SET NAMES 'utf8'");
        mysqli_query($this->conexion, "SET CHARACTER SET 'utf8'");

        $resultado = mysqli_query($this->conexion, $consulta);

        if (!$resultado) {
            echo "Error en la consulta: " . mysqli_error($this->conexion);
        }

        return $resultado;
    }

    public function traerUltimoId($consulta)
    {
        //verificar la codificacion sea utf8
        mysqli_query($this->conexion, "SET NAMES 'utf8'");
        mysqli_query($this->conexion, "SET CHARACTER SET 'utf8'");

        $resultado = mysqli_query($this->conexion, $consulta);

        if (!$resultado) {
            echo "Error en la consulta: " . mysqli_error($this->conexion);
        }

        return $resultado;
    }
}
?>