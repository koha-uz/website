<?php
namespace Meta\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use \Meta\Model\Entity\MetaTag;
use Cake\Core\Configure;

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
    public $helpers = ['Html', 'Text', 'Image', 'Url'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
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
        ],
        'twitter' => [
            'card' => 'summary',
            'site' => null,
            'creator' => null
        ]
    ];

    private $entity;

    public function init(MetaTag $meta_tag, array $options = null)
    {
        $this->setConfig('title', $meta_tag->title);
        $this->setConfig('description', $meta_tag->description);
        $this->setConfig('og.title', $meta_tag->og_title);
        $this->setConfig('og.description', $meta_tag->og_description);
        $this->setConfig('og.locale', Configure::read('App.defaultLocale'));
        $this->setConfig('og.url',
            $this->Url->build(
                $this->getView()->getRequest()->getAttribute('here'), ['fullBase' => true]
            )
        );

        $og_image_url = $this->Url->build('/img/logo1200x630.png', ['fullBase' => true]);
        if ($meta_tag->has('image')) {
            $og_image_url = $this->Url->build($this->Image->imageUrl($meta_tag->image, null), ['fullBase' => true]);
            $this->setConfig('twitter.card', 'summary_large_image');
        }
        $this->setConfig('og.image.url', $og_image_url);

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
        $tags .= $this->twitterMetaTagsRender();

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

    private function twitterMetaTagsRender()
    {
        $tags = '';
        foreach ($this->getConfig('twitter') as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $tags .= $this->Html->meta(['name' => "twitter:{$key}", 'content' => $value]);
        }

        return $tags;
    }
}
