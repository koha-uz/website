User-agent: *
Allow: /
Disallow: /login
Disallow: /admin/
Sitemap: <?= $this->Url->build(['_name' => 'sitemap', '_ext' => 'xml'], true) ?>

Host: <?= $this->Url->build(['_name' => 'home'], true) ?>