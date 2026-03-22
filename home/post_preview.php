<article class="post">
    <header class="post__header">
        <div class="post__user">
            <img src="<?= $post['avatar'] ?>" alt="<?= $post['username'] ?>" class="post__avatar">
            <span class="post__username"><?= $post['username'] ?></span>
        </div>
        <?php if ($post['has_edit']): ?>
            <img src="assets/edit.png" alt="Редактировать" class="post__edit-icon">
        <?php endif; ?>
    </header>

    <a href="post.php?postId=<?= $post['id'] ?>" class="post__link" title="<?= $post['username'] ?>">
        <div class="post__content">
            <img src="<?= $post['image'] ?>" 
                 alt="Пост пользователя <?= $post['username'] ?>" 
                 class="post__image <?= $post['img_modifier'] ?>">
        </div>
    </a>

    <footer class="post__footer">
        <div class="post__likes">
            <img src="assets/heart.png" alt="Лайк" class="post__like-icon">
            <span><?= $post['likes'] ?></span>
        </div>

        <p class="post__text">
            <?= $post['text'] ?>
            <span class="post__button post__button_type_more">ещё</span>
        </p>

        <p class="post__date"><?= $post['date'] ?></p>
    </footer>
</article>