<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<div class="pagging text-center">
    <nav aria-label="<?= lang('Pager.pageNavigation') ?>">
        <ul class="pagination justify-content-center">
            <?php if ($pager->hasPrevious()) : ?>
                <li class="page-item">
                    <span class="page-link">
                        <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                            <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                        </a>
                    </span>
                </li>
                <li class="page-item">
                    <span class="page-link">
                        <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                            <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                        </a>
                    </span>
                </li>
            <?php endif ?>
    
            <?php foreach ($pager->links() as $link) : ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                    <span class="page-link">
                        <a href="<?= $link['uri'] ?>">
                            <?= $link['title'] ?>
                        </a>
                    </span>
                </li>
            <?php endforeach ?>
    
            <?php if ($pager->hasNext()) : ?>
                <li class="page-item">
                    <span class="page-link">
                        <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                            <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                        </a>
                    </span>
                </li>
                <li class="page-item">
                    <span class="page-link">
                        <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                            <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                        </a>
                    </span>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</div>
