<?php 
    $dimensiones = array_map('trim', explode(',', $producto['producto_dimension']));
    ob_start(); 
?>
<main>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/2">
                <img class="w-full rounded-lg border" 
                    src="/Public/assets/Productos/<?= htmlspecialchars($producto['img_producto_url']) ?>" 
                    alt="<?= htmlspecialchars($producto['producto_nombre']) ?>"
                >
            </div>

            <!-- Información del producto -->
            <div class="md:w-1/2 flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        <?= htmlspecialchars($producto['producto_nombre']) ?>
                    </h1>

                    <span class="inline-block bg-gray-200 text-gray-800 text-sm font-medium px-3 py-1 rounded mb-2">
                        <?= htmlspecialchars($producto['producto_categoria']) ?>
                    </span>

                    <p class="text-gray-700 text-base mb-4">
                        <?= htmlspecialchars($producto['producto_descripcion']) ?>
                    </p>

                    <p class="text-sm text-gray-500 mb-6">
                        Stock disponible: <span class="font-semibold"><?= htmlspecialchars($producto['producto_stock']) ?></span>
                    </p>
                </div>

                <!-- Formulario -->
                <div>
                    <span class="text-2xl font-bold text-green-600">$<?= htmlspecialchars($producto['producto_precio']) ?></span>

                    <form method="POST" action="/aggCarrito" class="mt-6 space-y-4">
                        <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto['producto_id']) ?>">
                        <input type="hidden" name="producto_nombre" value="<?= htmlspecialchars($producto['producto_nombre']) ?>">
                        <input type="hidden" name="producto_precio" value="<?= htmlspecialchars($producto['producto_precio']) ?>">

                        <!-- Select de dimensión -->
                        <div>
                            <label for="dimension" class="block text-sm font-medium text-gray-700 mb-1">Tamaño / Talle:</label>
                            <select name="dimension" id="dimension" required class="w-full border-gray-300 rounded px-3 py-2">
                                <?php
                                $dimensiones = explode(',', $producto['producto_dimension']);
                                foreach ($dimensiones as $d) {
                                    echo '<option value="' . htmlspecialchars(trim($d)) . '">' . htmlspecialchars(trim($d)) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-1">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" min="1" max="<?= htmlspecialchars($producto['producto_stock']) ?>" 
                                value="1" required class="w-full border-gray-300 rounded px-3 py-2">
                        </div>
                        <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">
                            Añadir al carrito
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); require __DIR__.'/../layout.php'; ?>
