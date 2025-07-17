<?php
declare(strict_types=1);

namespace App\View\Helper;

use App\Model\Entity\MetaTag;
use Cake\Core\Configure;
use Cake\View\Helper;

/**
 * MetaRender helper
 */
class MetaRenderHelper extends Helper
{
    /**
     * Helpers used by this helper.
     *
     * @var array
     */
    public array $helpers = ['Html', 'Text', 'Image', 'Url'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected array $_defaultConfig = [
        'title' => null,
        'description' => null,
        'fb' => [
            'app_id' => null
        ],
        'og' => [
            'title' => null,
            'description' => null,
            'url' => null,
            'type' => 'website',
            'site_name' => null,
            'locale' => null,
            'image' => [
                'url' => null,
                'width' => 1200,
                'height' => 630,
                'type' => 'image/png'
            ]
        ]
    ];

    private $entity;

    public function init(MetaTag $metaTag, ?array $options = null)
    {
        $this->setConfig('title', $metaTag->title);
        $this->setConfig('description', $metaTag->description);
        $this->setConfig('og.title', $metaTag->og_title);
        $this->setConfig('og.description', $metaTag->og_description);

        $ogLocale = Configure::read('App.defaultLocale');
        if (
            (null !== $this->getView()->getRequest()->getParam('lang')) &&
            !empty($this->getView()->getRequest()->getParam('lang'))
        ) {
            $ogLocale = $this->getView()->getRequest()->getParam('lang');
        }
        $this->setConfig('og.locale', $ogLocale);

        $this->setConfig('og.url',
            $this->Url->build(
                $this->getView()->getRequest()->getAttribute('here'), ['fullBase' => true]
            )
        );

        $ogImageUrl = $this->Url->build('/img/og_image.png', ['fullBase' => true]);
        if (!empty($metaTag->og_image_url)) {
            $ogImageUrl = $this->Url->build($metaTag->og_image_url, ['fullBase' => true]);
        }
        $this->setConfig('og.image.url', $ogImageUrl);

        if (null !== $options) {
            $this->setConfig($options);
        }

        return $this;
    }

    /**
     * Render view block.
     *
     * @return string
     */
    public function render()
    {
        $tags = $this->baseMetaTagsRender();
        $tags .= $this->openGraphMetaTagsRender();
        $tags .= $this->Html->meta([
            'property' => "fb:app_id",
            'content' => $this->getConfig('fb.app_id')
        ]);

        return $tags;
    }

    private function baseMetaTagsRender()
    {
        $tags = $this->Html->meta([
            'link' => $this->Url->build(
                $this->getView()->getRequest()->getAttribute('here'), ['fullBase' => true]
            ),
            'rel' => 'canonical'
        ]);

        $tags .= $this->Html->tag('title', $this->getConfig('title'));
        $tags .= $this->Html->meta('description', $this->getConfig('description'));

        return $tags;
    }

    private function openGraphMetaTagsRender()
    {
        $data = [];
        $tags = '';
        foreach($this->getConfig('og') as $key => $value) {
            if (is_array($value)) {
                foreach($value as $k => $v) {
                    if (in_array($key, ['audio', 'image', 'video']) && $k == 'url') {
                        $data["og:{$key}"] = $v;
                        continue;
                    }
                    $data["og:{$key}:{$k}"] = $v;
                }
                continue;
            }

            $data["og:{$key}"] = $value;
        }

        foreach($data as $key => $value) {
            $tags .= $this->Html->meta(['property' => $key, 'content' => $value]);
        }

        return $tags;
    }
}