<!-- Codigo 1 - Luis Rios  -->

<?php
$empleados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar'])) {
    
    for ($i = 1; $i <= 5; $i++) {
        $nombreEmpleado = $_POST["nombre$i"];
        $apellidoEmpleado = $_POST["apellido$i"];
        $sexoEmpleado = $_POST["sexo$i"];
        $edadEmpleado = $_POST["edad$i"];
        $estadoCivilEmpleado = $_POST["estadoCivil$i"];
        
        $sueldoKey = "sueldo$i";
        $sueldoEmpleado = isset($_POST[$sueldoKey]) ? $_POST[$sueldoKey] : 0;

        $empleados[] = [
            "Nombre" => $nombreEmpleado,
            "Apellido" => $apellidoEmpleado,
            "Sexo" => $sexoEmpleado,
            "Edad" => $edadEmpleado,
            "Estado Civil" => $estadoCivilEmpleado,
            "Sueldo" => $sueldoEmpleado
        ];
    }
}

if (!empty($empleados)) {
    echo "<h2>Datos Ingresados:</h2>";
    foreach ($empleados as $index => $empleado) {
        echo "<h3>Empleado " . ($index + 1) . ":</h3>";
        foreach ($empleado as $key => $value) {
            echo "<p><strong>$key:</strong> $value</p>";
        }
    }

    $totalMujeres = 0;
    $totalHombresCasados = 0;
    $totalMujeresViudas = 0;
    $sumaEdadHombres = 0;
    $countHombres = 0;

    foreach ($empleados as $empleado) {
        $sexo = $empleado['Sexo'];
        $estadoCivil = $empleado['Estado Civil'];
        $sueldo = $empleado['Sueldo'];

        if ($sexo == 'Femenino') {
            $totalMujeres++;
        }

        if ($sexo == 'Masculino' && $estadoCivil == 'Casado' && $sueldo > 2500) {
            $totalHombresCasados++;
        }

        if ($sexo == 'Femenino' && $estadoCivil == 'Viudo' && $sueldo > 1000) {
            $totalMujeresViudas++;
        }

        if ($sexo == 'Masculino') {
            $sumaEdadHombres += $empleado['Edad'];
            $countHombres++;
        }
    }

    $promedioEdadHombres = $countHombres > 0 ? $sumaEdadHombres / $countHombres : 0;

    echo "<h2>Estadísticas Calculadas:</h2>";
    echo "<p>Total de mujeres: $totalMujeres</p>";
    echo "<p>Total de hombres casados que ganan más de 2500: $totalHombresCasados</p>";
    echo "<p>Total de mujeres viudas que ganan más de 1000: $totalMujeresViudas</p>";
    echo "<p>Edad promedio de los hombres: $promedioEdadHombres</p>";
}
?>

<h2>Registro de Empleados</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <h3>Empleado <?php echo $i; ?></h3>
        <label for="nombre<?php echo $i; ?>">Nombre:</label>
        <input type="text" name="nombre<?php echo $i; ?>" required>
        <br>

        <label for="apellido<?php echo $i; ?>">Apellido:</label>
        <input type="text" name="apellido<?php echo $i; ?>" required>
        <br>

        <label for="sexo<?php echo $i; ?>">Sexo:</label>
        <select name="sexo<?php echo $i; ?>" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select>
        <br>

        <label for="edad<?php echo $i; ?>">Edad:</label>
        <input type="number" name="edad<?php echo $i; ?>" required>
        <br>

        <label for="estadoCivil<?php echo $i; ?>">Estado Civil:</label>
        <select name="estadoCivil<?php echo $i; ?>" required>
            <option value="Soltero">Soltero</option>
            <option value="Casado">Casado</option>
            <option value="Viudo">Viudo</option>
            <option value="Divorciado">Divorciado</option>
        </select>
        <br>

        <!-- Cambiamos el nombre del campo de sueldo -->
        <label for="sueldo<?php echo $i; ?>">Sueldo:</label>
        <input type="number" name="sueldo<?php echo $i; ?>" required>
        <br><br>
    <?php endfor; ?>

    <input type="submit" name="registrar" value="Registrar">
</form>

</body>
</html>
