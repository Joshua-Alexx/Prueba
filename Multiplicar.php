<?php
// Incluir conexión a la base de datos
include "conexion.php"; // Asegúrate de que la ruta sea correcta
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Tabla de Multiplicar</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Generador de Tabla de Multiplicar</h1>
    <form method="POST" action="Multiplicar.php" style="text-align: center;">
        <input type="number" name="numero" placeholder="Ingrese un número" required>
        <button type="submit">Generar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = intval($_POST["numero"]);

        // Validar conexión antes de usarla
        if (isset($conn) && $conn) {
            // Insertar resultados en la base de datos
            $stmt = $conn->prepare("INSERT INTO resultados (numero, multiplicador, resultado) VALUES (?, ?, ?)");
            
            echo "<table>";
            echo "<tr><th>Multiplicador</th><th>Resultado</th></tr>";

            // Generar y mostrar tabla, además de guardar en la base de datos
            for ($i = 1; $i <= 12; $i++) {
                $resultado = $numero * $i;

                // Insertar en la base de datos
                $stmt->bind_param("iii", $numero, $i, $resultado);
                $stmt->execute();

                // Mostrar en la tabla HTML
                echo "<tr><td>{$numero} x {$i}</td><td>{$resultado}</td></tr>";
            }

            echo "</table>";
            $stmt->close();
        } else {
            echo "<p style='color: red; text-align: center;'>Error: No se pudo conectar a la base de datos.</p>";
        }
    }

    // Cerrar conexión si existe
    if (isset($conn) && $conn) {
        $conn->close();
    }
    ?>
</body>
</html>
