<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= $this->Url->build(['_name' => 'home'], ['fullBase' => true]) ?></loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'posts'], ['fullBase' => true]) ?></loc>
        <priority>0.8</priority>
    </url>

    <?php foreach($pages as $page): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'page_view', 'slug' => h($page->slug)], ['fullBase' => true]) ?></loc>
    </url>
    <?php endforeach; ?>

    <?php foreach($posts as $post): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'post_view', 'slug' => h($post->slug)], ['fullBase' => true]) ?></loc>
    </url>
    <?php endforeach; ?>
</urlset>
