<div class="container mx-auto w-2/5">
    <h1 class="text-4xl mt-3 mb-2"><?= $pageName ?></h1>
    <div class="py-2">
        <nav>
            <div class="py-2 my-4 border-b-2 border-blue-400">
                <h2 class="text-2xl">Навигация</h2>
            </div>
            <ul class="py-2">
                <?php foreach ($navigation as $path) : ?>
                    <li><a class="hover:underline" href="<?= $path ?>"><?= $path ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <section>
            <div class="py-2 my-4 border-b-2 border-blue-400">
                <h2 class="text-2xl">История переходов</h2>
            </div>
            <ul class="py-2">
                <?php foreach ($history as [$path, $pageName]) : ?>
                    <li><a class="hover:underline" href="<?= $path ?>"><?= $pageName ?></a></li>
                <?php endforeach; ?>  
            </ul>
        </section>
    </div>
</div>