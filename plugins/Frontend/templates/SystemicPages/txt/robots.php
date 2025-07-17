User-agent: *
Allow: /
Disallow: /ru/founder/login
Disallow: /uz/founder/login
Sitemap: <?= $this->Url->build(['_name' => 'sitemap', '_ext' => 'xml'], ['fullBase' => true]) ?>

Host: <?= $this->Url->build(['_name' => 'home'], ['fullBase' => true]) ?>