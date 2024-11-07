<?php
// Iniciar la sesión
session_start();

// Verificar si el carrito está vacío
if (empty($_SESSION['cart'])) {
    // Redirigir a la página del carrito si está vacío
    header('Location: carrito.php');
    exit();
}

// Calcular el total de la compra
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    // Sumar el precio multiplicado por la cantidad de cada producto
    $total += $item['precio'] * $item['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceso de Compra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* El mismo estilo anterior */
        body {
            background-color: #EDF6F9;
            font-family: 'Roboto', sans-serif;
            overflow-x: hidden;
        }
        .container {
            background-color: #FFFFFF;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        h2 {
            color: #006D77;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
        }
        label {
            color: #006D77;
            font-weight: 500;
        }
        .btn-primary {
            background-color: #E29578;
            border: none;
            transition: background-color 0.3s, transform 0.3s;
            border-radius: 25px;
        }
        .btn-primary:hover {
            background-color: #FFDDD2;
            transform: translateY(-2px);
        }
        .form-section {
            margin-bottom: 30px;
            border: 1px solid #83C5BE;
            border-radius: 10px;
            padding: 20px;
            background-color: #FFFFFF;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .total {
            font-weight: bold;
            font-size: 1.5em;
            margin-top: 20px;
            text-align: center;
            color: #006D77;
        }
        .form-control {
            border-radius: 20px;
            border: 1px solid #83C5BE;
            transition: border 0.3s;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 109, 119, 0.5);
            border-color: #006D77;
        }
        #message {
            display: none;
            text-align: center;
            color: green;
            font-size: 1.5em;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Formulario de Proceso de Compra</h2>
    
    <form id="orderForm" method="POST">
        <div class="form-section">
            <h4>Información Personal</h4>
            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="tipo_identificacion">Tipo de Identificación:</label>
                <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" onchange="toggleIdField()" required>
                    <option value="">Seleccione...</option>
                    <option value="cedula">Cédula</option>
                    <option value="extranjeria">Extranjería</option>
                </select>
            </div>
            <div class="form-group" id="id_field" style="display:none;">
                <label for="numero_identificacion">Número de Identificación:</label>
                <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" required>
            </div>
            <div class="form-group">
                <label for="pais">País:</label>
                <input type="text" class="form-control" id="pais" name="pais" required>
            </div>
            <div class="form-group">
                <label for="codigo_postal">Código Postal:</label>
                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
            </div>
        </div>

        <div class="form-section">
            <h4>Método de Pago</h4>
            <div class="form-group">
                <label for="metodo_pago">Seleccione un método de pago:</label>
                <select class="form-control" id="metodo_pago" name="metodo_pago" required onchange="togglePaymentFields()">
                    <option value="">Seleccione...</option>
                    <option value="bancolombia">Bancolombia</option>
                    <option value="davivienda">Davivienda</option>
                </select>
            </div>

            <div id="tarjeta_fields" style="display:none;">
                <div class="form-group">
                    <label for="numero_tarjeta">Número de Tarjeta:</label>
                    <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                </div>
                <div class="form-group">
                    <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                    <input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="MM/AA" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" required>
                </div>
            </div>
        </div>

        <div class="total">
            <p>Total: $<span id="totalAmount">0</span></p>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Confirmar Pedido</button>
        </div>
    </form>

    <div id="message">¡Pedido exitoso! Serás redirigido a la página de inicio.</div>
</div>

<script>
    // Función para mostrar los campos de identificación según el tipo
    function toggleIdField() {
        var tipoId = document.getElementById('tipo_identificacion').value;
        var idField = document.getElementById('id_field');
        if (tipoId === 'extranjeria') {
            idField.style.display = 'none';
        } else {
            idField.style.display = 'block';
        }
    }

    // Función para mostrar los campos de tarjeta según el método de pago
    function togglePaymentFields() {
        var metodoPago = document.getElementById('metodo_pago').value;
        var tarjetaFields = document.getElementById('tarjeta_fields');
        if (metodoPago === 'bancolombia' || metodoPago === 'davivienda') {
            tarjetaFields.style.display = 'block';
        } else {
            tarjetaFields.style.display = 'none';
        }
    }

    // Prevenir el envío del formulario y mostrar el mensaje de éxito
    document.getElementById('orderForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevenir la acción por defecto del formulario
        
        // Mostrar el mensaje de éxito
        document.getElementById('message').style.display = 'block';
        
        // Redirigir a la página principal después de 3 segundos
        setTimeout(function() {
            window.location.href = '/project-root/public/index.php';
        }, 3000); // 3000 ms = 3 segundos
    });
</script>

</body>
</html>

