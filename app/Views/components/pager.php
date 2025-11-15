<?php

/**
 * Pager Template - Tailwind CSS
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 * @var string $group (opsional, default 'default')
 */
$group = $group ?? 'default';
$pager->setSurroundCount(2);
?>

<nav aria-label="Page navigation" class="flex justify-center mt-4">
    <ul class="inline-flex items-center -space-x-px text-sm">

        <!-- Previous -->
        <?php if ($pager->hasPreviousPage($group)) : ?>
            <li>
                <a href="<?= $pager->getPreviousPage($group) ?>"
                    class="flex items-center justify-center px-3 h-9 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span class="ml-1 hidden sm:inline">Prev</span>
                </a>
            </li>
        <?php else : ?>
            <li><span class="flex items-center justify-center px-3 h-9 ml-0 leading-tight text-gray-400 bg-gray-50 border border-gray-300 rounded-l-lg cursor-not-allowed">Prev</span></li>
        <?php endif; ?>

        <!-- Links -->
        <?php foreach ($pager->links($group) as $link) : ?>
            <li>
                <a href="<?= $link['uri'] ?>"
                    class="flex items-center justify-center px-3 h-9 leading-tight border <?= $link['active'] ? 'text-blue-600 bg-blue-50 border-blue-300 font-semibold' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700' ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <!-- Next -->
        <?php if ($pager->hasNextPage($group)) : ?>
            <li>
                <a href="<?= $pager->getNextPage($group) ?>"
                    class="flex items-center justify-center px-3 h-9 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="mr-1 hidden sm:inline">Next</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </li>
        <?php else : ?>
            <li><span class="flex items-center justify-center px-3 h-9 leading-tight text-gray-400 bg-gray-50 border border-gray-300 rounded-r-lg cursor-not-allowed">Next</span></li>
        <?php endif; ?>

    </ul>
</nav>