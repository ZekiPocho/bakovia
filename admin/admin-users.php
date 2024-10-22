px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Administrar Usuarios</h1>
    <table>
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <th>Publicaciones</th>
            <th>Comentarios</th>
            <th>Acciones</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $user['id_usuario']; ?></td>
            <td><?php echo $user['nombre_usuario']; ?></td>
            <td>
                <?php
                // Obtener las publicaciones del usuario
                $user_id = $user['id_usuario'];
                $post_query = "SELECT * FROM publicaciones WHERE id_usuario = $user_id";
                $post_result = mysqli_query($conn, $post_query);
                while ($post = mysqli_fetch_assoc($post_result)): ?>
                    <div>
                        <strong><?php echo $post['titulo']; ?></strong>
                        <a href="admin-users.php?delete_post=<?php echo $post['id_publicacion']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">Eliminar</a>
                    </div>
                <?php endwhile; ?>
            </td>
            <td>
                <?php
                // Obtener los comentarios del usuario
                $comment_query = "SELECT * FROM comentarios WHERE id_usuario = $user_id";
                $comment_result = mysqli_query($conn, $comment_query);
                while ($comment = mysqli_fetch_assoc($comment_result)): ?>
                    <div class="comment">
                        <strong>Comentario:</strong> <?php echo $comment['comentario']; ?>
                        <a href="admin-users.php?delete_comment=<?php echo $comment['id_comentario']; ?>" onclick="return confirm('¿Estás seguro de eliminar este comentario?')">Eliminar</a>
                    </div>
                <?php endwhile; ?>
            </td>
            <td>
                <a href="admin-users.php?delete_user=<?php echo $user['id_usuario']; ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario y sus publicaciones y comentarios?')">Eliminar Usuario</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>