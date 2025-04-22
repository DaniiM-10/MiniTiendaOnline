<?php 
    ob_start(); 
?>
<main class="container mx-auto mt-10 mb-10 columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
    <?php 
        if (is_string($productos)) :
    ?>
        <div class="text-center mt-5">
            <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($productos) ?></h1>
        </div>
    <?php
        else :
            foreach ($productos as $p): 
    ?>
        <div class="break-inside-avoid max-w-full bg-white border border-gray-200 rounded-lg shadow hover:shadow-md transition-shadow duration-300 mb-4">
            <img class="rounded-t-lg" 
                src="../../../Public/assets/Productos/<?php echo htmlspecialchars($p['img_producto_url']); ?>" 
                alt="<?php echo htmlspecialchars($p['producto_nombre']) ?>"
            />
            <div class="p-5">
                <a href="/producto/<?= htmlspecialchars($p['producto_id']) ?>">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 hover:underline transition-all duration-200">
                        <?= htmlspecialchars($p['producto_nombre']) ?>
                    </h5>
                </a>
                <span class="inline-block bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-3 py-1 rounded-full mb-3">
                    <?= htmlspecialchars($p['producto_categoria']) ?>
                </span>
                <p class="text-xl font-semibold text-gray-900 mb-4">
                    $<?= htmlspecialchars($p['producto_precio']) ?>
                </p>
                <button class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors duration-200">
                    Añadir al carrito <!-- Todavia no funciona -->
                </button>
            </div>
        </div>
    <?php 
          endforeach;
        endif;
    ?>
</main>
<?php $content = ob_get_clean(); require __DIR__.'/../layout.php'; ?>
