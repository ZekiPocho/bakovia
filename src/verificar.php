<?php
    include "db.php";

    // Validación básica de entradas
    if (isset($_POST['email'], $_POST['codigo'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $codigo = htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8');

        // Uso de sentencias preparadas para prevenir inyección SQL
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? AND token = ?");
        $stmt->bind_param("ss", $email, $codigo);  // 'ss' indica que ambas variables son strings
        $stmt->execute();
        $res = $stmt->get_result();

        // Verificar si se encontró un resultado
        if ($res->num_rows > 0) {
            // Actualizar el estado de verificado
            $update_stmt = $conn->prepare("UPDATE usuarios SET verificado = 'si' WHERE correo = ?");
            $update_stmt->bind_param("s", $email);
            $update_stmt->execute();

            // Redirigir a la página de validación exitosa
            header('Location: ../valid.html');
        } else {
            echo "Código inválido";
        }

        // Cerrar las sentencias y la conexión
        $stmt->close();
        $update_stmt->close();
        $conn->close();
    } else {
        echo "Error: Datos incompletos.";
    }
?>
