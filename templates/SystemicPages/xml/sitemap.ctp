<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= $this->Url->build(['_name' => 'home'], true) ?></loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'banks'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'insurers'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'organizations'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'credits'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'deposits'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'news'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'news_timeline'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'posts'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'exchange_rates'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'exchange_rate_currency', 'currency_alpha_code' => 'usd'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'exchange_rate_currency', 'currency_alpha_code' => 'eur'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'exchange_rate_currency', 'currency_alpha_code' => 'gbp'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'exchange_rate_currency', 'currency_alpha_code' => 'chf'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'exchange_rate_currency', 'currency_alpha_code' => 'jpy'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'exchange_rate_currency', 'currency_alpha_code' => 'rub'], true) ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'exchange_rate_currency', 'currency_alpha_code' => 'kzt'], true) ?></loc>
        <priority>0.8</priority>
    </url>

    <?php foreach($pages as $page): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'page_view', 'slug' => h($page->slug)], true) ?></loc>
    </url>
    <?php endforeach; ?>

    <?php foreach($news as $news): ?>
    <url>
        <loc>
            <?php
            echo $this->Url->build(
                [
                    '_name' => 'news_view',
                    'year'  => $news->date_published->format('Y'),
                    'month' => $news->date_published->format('m'),
                    'day'   => $news->date_published->format('d'),
                    'slug' => h($news->slug)
                ],
                true
            );
            ?>
        </loc>
    </url>
    <?php endforeach; ?>

    <?php foreach($newsCategories as $category): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'news_category_view', 'slug' => h($category->slug)], true) ?></loc>
    </url>
    <?php endforeach; ?>

    <?php foreach($newsTags as $tag): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'news_by_tag', 'slug' => h($tag->slug)], true) ?></loc>
    </url>
    <?php endforeach; ?>

    <?php foreach($posts as $post): ?>
    <url>
        <loc>
            <?php
            echo $this->Url->build(
                [
                    '_name' => 'post_view',
                    'year'  => $post->date_published->format('Y'),
                    'month' => $post->date_published->format('m'),
                    'day'   => $post->date_published->format('d'),
                    'slug' => h($post->slug)
                ],
                true
            );
            ?>
        </loc>
    </url>
    <?php endforeach; ?>

    <?php foreach($postCategories as $category): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'post_category_view', 'slug' => h($category->slug)], true) ?></loc>
    </url>
    <?php endforeach; ?>

    <?php foreach($banks as $bank): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'bank_view', 'slug' => h($bank->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'news_by_model', 'model' => 'banks', 'slug_model' => h($bank->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'requisites_by_model', 'model' => 'banks', 'slug_model' => h($bank->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'bank_branches', 'slug_bank' => h($bank->slug)], true) ?></loc>
    </url>
    <?php foreach($bank->bank_branches as $branch): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'bank_branch_view', 'slug_bank' => h($bank->slug), 'slug_branch' => h($branch->slug)], true) ?></loc>
    </url>
    <?php endforeach; ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'bank_exchange_rates', 'slug_bank' => h($bank->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'bank_exchange_rate_currency', 'slug_bank' => h($bank->slug), 'currency_alpha_code' => 'usd'], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'bank_exchange_rate_currency', 'slug_bank' => h($bank->slug), 'currency_alpha_code' => 'eur'], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'bank_exchange_rate_currency', 'slug_bank' => h($bank->slug), 'currency_alpha_code' => 'gbp'], true) ?></loc>
    </url>
    <?php endforeach; ?>

    <?php foreach($organizations as $organization): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'organization_view', 'slug' => h($organization->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'news_by_model', 'model' => 'organizations', 'slug_model' => h($organization->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'requisites_by_model', 'model' => 'organizations', 'slug_model' => h($organization->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'branches', 'model' => 'organizations', 'slug_model' => h($organization->slug)], true) ?></loc>
    </url>
    <?php foreach($organization->branches as $branch): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'branch_view', 'model' => 'organizations', 'slug_model' => h($organization->slug), 'slug_branch' => h($branch->slug)], true) ?></loc>
    </url>
    <?php endforeach; ?>
    <?php endforeach; ?>

    <?php foreach($insurers as $insurer): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'insurer_view', 'slug' => h($insurer->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'news_by_model', 'model' => 'insurers', 'slug_model' => h($insurer->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'requisites_by_model', 'model' => 'insurers', 'slug_model' => h($insurer->slug)], true) ?></loc>
    </url>
    <url>
        <loc><?= $this->Url->build(['_name' => 'branches', 'model' => 'insurers', 'slug_model' => h($insurer->slug)], true) ?></loc>
    </url>
    <?php foreach($insurer->branches as $branch): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'branch_view', 'model' => 'insurers', 'slug_model' => h($insurer->slug), 'slug_branch' => h($branch->slug)], true) ?></loc>
    </url>
    <?php endforeach; ?>
    <?php endforeach; ?>

    <?php foreach($creditCategories as $creditCategory): ?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'credit_category_view', 'slug' => h($creditCategory->slug)], true) ?></loc>
    </url>
    <?php endforeach; ?>
</urlset>
