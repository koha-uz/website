<?php
namespace Meta\GenerateImage;

class Image {
    const WIDTH = 1200;
    const HEIGHT = 630;
    const PADDING_X = 70;
    const PADDING_Y = 70;
    const TEXT_AREA_PADDING_TOP = 290;
    const TEXT_AREA_PADDING_BOTTOM = 105;
    const FONT_SIZE_MAP = [
        ['size' => 72, 'line-height' => -10],
        ['size' => 60, 'line-height' => -5],
        ['size' => 48, 'line-height' => 0],
        ['size' => 36, 'line-height' => 5]
    ];
    const FONT_FAMILY = 'PTSans-Bold.ttf';

    const OVERLAY_BG_COLOR = '#000000';
    const OVERLAY_OPACITY = '0.54';

    const SHADOW_COLOR = '#000000';
    const SHADOW_OPACITY = '0.8';
    const SHADOW_SIGMA = '10';
    const SHADOW_X = '50';
    const SHADOW_Y = '10';

    const THEME_MAP = ['bg' => 2, 'color' => 1];

    const COLOR_THEME_BG_COLOR = '#f2f2f2';
    const COLOR_THEME_TEXT_COLOR = '#282828';

    const BG_THEME_TEXT_COLOR = '#ffffff';

    private $theme;
    private $bgPath;
    private $title;
    private $image;

    public function __construct($title, $bgPath = null)
    {
        $this->setTheme($bgPath);
        $this->setTitle($title);

        $this->generate();
    }

    private function generate()
    {
        $mainLayout = $this->getMainLayout();
        $logoLayout = $this->getLogoLayout();
        $titleLayout = $this->getTitleLayout();

        $mainLayout->compositeImage($logoLayout, \Imagick::COMPOSITE_OVER, self::PADDING_X, self::PADDING_Y);
        $mainLayout->compositeImage($titleLayout, \Imagick::COMPOSITE_OVER, self::PADDING_X, self::TEXT_AREA_PADDING_TOP);

        $this->image = $mainLayout;
    }

    public function save($filename)
    {
        return $this->image->writeImage($filename);
    }

    public function show()
    {
        header('Content-type: image/png');
        echo $this->image;
    }

    private function getMainLayout()
    {
        if ($this->theme('color')) {
            $image = new \Imagick();
            $image->newImage(self::WIDTH, self::HEIGHT, self::COLOR_THEME_BG_COLOR);
        } else {
            $image = $this->overlayLayout(new \Imagick($this->bgPath));
        }

        $image->setImageFormat('png');

        return $image;
    }

    private function getLogoLayout()
    {
        $imgPath = WWW_ROOT . 'img' . DS . 'logo-og.png';
        if ($this->theme('bg')) {
            $imgPath = WWW_ROOT . 'img' . DS . 'logo-og.png';
        }

        return new \Imagick($imgPath);
    }

    private function getTitleLayout()
    {
        $draw = new \ImagickDraw();
        $draw->setFont(WWW_ROOT . 'webfonts' . DS . self::FONT_FAMILY);

        $textColor = self::COLOR_THEME_TEXT_COLOR;
        if ($this->theme('bg')) {
            $textColor = self::BG_THEME_TEXT_COLOR;
        }
        $draw->setFillColor($textColor);
        $draw->setStrokeAntialias(true);
        $draw->setTextAntialias(true);

        $title = '';
        foreach(self::FONT_SIZE_MAP as $fontSize) {
            $draw->setFontSize($fontSize['size']);

            if ($title = $this->title($draw)) {
                break;
            }
        }

        $titleLayout = new \Imagick();
        $metrics = $titleLayout->queryFontMetrics($draw, $title);

        $draw->setTextInterlineSpacing($fontSize['line-height']);
        $draw->annotation(0, $metrics['ascender'], $title);
        $titleLayout->newImage(
            (self::WIDTH - self::PADDING_X * 2),
            (self::HEIGHT - self::TEXT_AREA_PADDING_TOP - self::TEXT_AREA_PADDING_BOTTOM),
            "none"
        );
        $titleLayout->drawImage($draw);

        if ($this->theme('bg')) {
            $titleLayout = $this->shadowLayout($titleLayout);
        }
        $titleLayout->trimImage(0);

        return $titleLayout;
    }

    private function title($draw)
    {
        $title = '';
        $prevWord = '';
        $titleLayout = new \Imagick();
        $words = explode(' ', $this->getTitle());
        foreach($words as $key => $word) {
            if (!empty($prevWord)) {
                $word = "{$prevWord} {$word}";
                $prevWord = '';
            }

            if (mb_strlen($word) == 1) {
                $prevWord = $word;
                continue;
            }

            $metrics = $titleLayout->queryFontMetrics($draw, "{$title} {$word}");
            if ($metrics["textWidth"] > (self::WIDTH - self::PADDING_X * 2)) {
                $word = "\n{$word}";
            } else {
                $word = "{$word}";
            }

            $title .= "{$word} ";
        }

        $metrics = $titleLayout->queryFontMetrics($draw, $title);
        if ($metrics["textHeight"] < (self::HEIGHT - self::TEXT_AREA_PADDING_TOP - self::TEXT_AREA_PADDING_BOTTOM)) {
            return $title;
        }

        return false;
    }

    private function shadowLayout($titleLayout)
    {
        $shadowLayout = clone $titleLayout;
        $shadowLayout->setImageBackgroundColor(new \ImagickPixel(self::SHADOW_COLOR));
        return $shadowLayout;


        $shadowLayout->shadowImage(self::SHADOW_OPACITY, self::SHADOW_SIGMA, self::SHADOW_X, self::SHADOW_Y);
        $shadowLayout->compositeImage($titleLayout, \Imagick::COMPOSITE_OVER, 5, 5);

        return $shadowLayout;
    }

    private function overlayLayout($layout)
    {
        $geometry = $layout->getImageGeometry();
        $overlay = new \Imagick();
        $overlay->newImage($geometry['width'], $geometry['height'], self::OVERLAY_BG_COLOR);
        $overlay->setImageOpacity(self::OVERLAY_OPACITY);

        $layout->compositeImage($overlay, \Imagick::COMPOSITE_DEFAULT, 0, 0);

        return $layout;
    }

    public function theme($type)
    {
        if (self::THEME_MAP[$type] === $this->getTheme()) {
            return true;
        }

        return false;
    }

    private function setTheme($bgPath)
    {
        $this->theme = (null === $bgPath) ? 1 : 2;
        $this->bgPath = $bgPath;
    }

    private function getTheme()
    {
        return $this->theme;
    }

    private function setTitle($title)
    {
        $this->title = $title;
    }

    private function getTitle()
    {
        return $this->title;
    }
}
