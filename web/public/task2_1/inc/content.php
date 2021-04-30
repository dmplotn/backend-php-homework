<div class="container mx-auto w-2/5">
    <h1 class="text-4xl mt-3 mb-8"><?= $pageName ?></h1>
    <div class="mb-4">
        <nav class="mb-4">
            <div class=" border-b-2 border-blue-400">
                <h2 class="text-2xl">Навигация</h2>
            </div>
            <ul class="">
                <?php foreach ($navigation as $path) : ?>
                    <li><a class="hover:underline" href="<?= $path ?>"><?= $path ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <section class="">
            <div class="border-b-2 border-blue-400">
                <h2 class="text-2xl">История переходов</h2>
            </div>
            <ul class="">
                <?php foreach ($historyData as [$path, $pageName]) : ?>
                    <li><a class="hover:underline" href="<?= $path ?>"><?= $pageName ?></a></li>
                <?php endforeach; ?>  
            </ul>
        </section>
    </div>
    <?php if ($pathToParentLevel !== null) : ?>
        <p><a class="hover:underline" href="<?= $pathToParentLevel ?>">На уровень выше</a></p>
    <?php endif; ?>
</div>
