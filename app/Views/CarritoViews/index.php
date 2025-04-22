<?php 
    ob_start(); 
?>
<main class="max-w-5xl mx-auto mt-10 px-4">
    <h2 class="text-3xl font-bold text-center mb-8">Tu Carrito</h2>

    <div class="overflow-x-auto">
        <?php if (empty($carrito)): ?>
            <p class="text-center text-gray-500">Tu carrito está vacío.</p>
        <?php else: ?>
            <table class="min-w-full bg-white shadow-md rounded-xl overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Nombre</th>
                        <th class="px-4 py-3 text-left">Cantidad</th>
                        <th class="px-4 py-3 text-left">Dimensión</th>
                        <th class="px-4 py-3 text-left">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    $total = 0;
                    foreach ($carrito as $item):
                        $total += $item['precio'];
                    ?>
                    <tr>
                        <td class="px-4 py-3"><?= $item['id'] ?></td>
                        <td class="px-4 py-3"><?= $item['nombre'] ?></td>
                        <td class="px-4 py-3"><?= $item['cantidad'] ?></td>
                        <td class="px-4 py-3"><?= $item['dimension'] ?></td>
                        <td class="px-4 py-3">$<?= number_format($item['precio'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50 font-semibold">
                        <td colspan="4" class="px-4 py-3 text-right">Total:</td>
                        <td class="px-4 py-3">$<?= number_format($total, 2) ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </div>

    <form action="/carrito/comprar.php" method="post" class="text-center mt-8">
        <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow">
            Comprar
        </button>
    </form>
</main>
<?php $content = ob_get_clean(); require __DIR__.'/../layout.php'; ?>