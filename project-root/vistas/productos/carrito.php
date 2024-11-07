<?php
// carrito.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inicializar el carrito si no existe
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

// Funcionalidad para eliminar un producto del carrito
if (isset($_POST['remove_id'])) {
    $removeId = $_POST['remove_id'];
    foreach ($cart as $key => $item) {
        if ($item['id'] == $removeId) {
            unset($cart[$key]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($cart);
    header("Location: carrito.php");
    exit();
}

// Funcionalidad para editar la cantidad de un producto
if (isset($_POST['edit_id'], $_POST['new_quantity'])) {
    $editId = $_POST['edit_id'];
    $newQuantity = max(1, (int)$_POST['new_quantity']);
    foreach ($cart as &$item) {
        if ($item['id'] == $editId) {
            $item['cantidad'] = $newQuantity;
            break;
        }
    }
    $_SESSION['cart'] = $cart;
    header("Location: carrito.php");
    exit();
}

// Agrupar productos del carrito y calcular el total
$groupedCart = [];
$total = 0;
foreach ($cart as $item) {
    $item['cantidad'] = $item['cantidad'] ?? 1;
    if (isset($groupedCart[$item['id']])) {
        $groupedCart[$item['id']]['cantidad'] += $item['cantidad'];
    } else {
        $groupedCart[$item['id']] = $item;
    }
    $total += $item['precio'] * $item['cantidad'];
}

// Variable para identificar si el usuario está autenticado
$isLoggedIn = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .content { padding-bottom: 70px; }

        /* Tarjetas de producto uniformes */
        .card {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Imagen con tamaño consistente */
        .card-img-top {
            height: 200px; /* Fija la altura de la imagen */
            object-fit: cover; /* Asegura que la imagen cubra el espacio sin distorsión */
        }

        /* Asegura que el contenido ocupe el espacio restante */
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px;
            flex-grow: 1;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-text {
            color: #6c757d;
        }

        .fixed-bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-top: 2px solid #dee2e6;
        }

        .btn-primary {
            background-color: #006D77;
            border: none;
        }

        .btn-danger {
            background-color: #E29578;
            border: none;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }

        .quantity-input {
            border: none;
            text-align: center;
            width: 60px;
            font-size: 1rem;
        }

        .quantity-btn {
            background-color: #83C5BE;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .quantity-btn:hover {
            background-color: #006D77;
        }

    </style>
</head>
<body>

<section>
    <div class="container mt-4 content">
        <h2 class="text-center text-dark">Carrito de Compras</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (empty($groupedCart)): ?>
                <p>No hay productos en el carrito.</p>
            <?php else: ?>
                <?php foreach ($groupedCart as $item): ?>
                    <div class="col mb-4">
                        <div class="card">
                            <?php $imagePath = '../../public/imagenes/' . htmlspecialchars($item['imagen']); ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo htmlspecialchars($item['nombre']); ?></h3>
                                <p class="card-text"><?php echo htmlspecialchars($item['descripcion']); ?></p>
                                <p class="card-text">Precio: $<?php echo htmlspecialchars($item['precio']); ?></p>
                                <form method="POST" action="" class="btn-action d-flex justify-content-around mt-2">
                                    <input type="hidden" name="edit_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                    <div class="quantity-control">
                                        <button type="submit" name="new_quantity" value="<?php echo max(1, $item['cantidad'] - 1); ?>" class="quantity-btn">-</button>
                                        <input type="text" name="quantity_display" value="<?php echo htmlspecialchars($item['cantidad']); ?>" class="quantity-input" readonly>
                                        <button type="submit" name="new_quantity" value="<?php echo $item['cantidad'] + 1; ?>" class="quantity-btn">+</button>
                                    </div>
                                </form>
                                <form method="POST" action="" class="mt-2">
                                    <input type="hidden" name="remove_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                    <button type="submit" class="btn btn-danger remove-btn">Eliminar Todo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="fixed-bottom-bar">
        <h4>Total: $<?php echo number_format($total, 2); ?></h4>
        <a href="../../public/productos.php" class="btn btn-secondary">Regresar a Productos</a>
        <a href="#" class="btn btn-primary" onclick="realizarPedido(<?php echo json_encode($isLoggedIn); ?>)">Hacer Pedido</a>
    </div>
</section>

<script>
function realizarPedido(isLoggedIn) {
    if (!isLoggedIn) {
        alert("Debes iniciar sesión para realizar un pedido.");
        window.location.href = "/project-root/vistas/usuarios/login.php"; // Redirige a la página de inicio de sesión
    } else {
        window.location.href = "/project-root/vistas/administracion/procesodecompra.php"; // Redirige al proceso de compra
    }
}
</script>

</body>
</html>
