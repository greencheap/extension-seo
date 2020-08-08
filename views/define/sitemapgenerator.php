<?php foreach ($items as $item) : ?>
    <?php if ($depth == 0) : ?>
        <url>
        <?php endif ?>
        <?php foreach ($item as $tag) : ?>
            <?php if (isset($tag['items']) && $tag['items']) : ?>

            <?php elseif (isset($tag['value']) && !isset($tag['items'])) : ?>
                <<?= $tag['tag'] ?>><?= $tag['value'] ?></<?= $tag['tag'] ?>>
            <?php endif ?>
        <?php endforeach ?>
        <?php if ($depth == 0) : ?>
        </url>
    <?php endif ?>
<?php endforeach ?>
