<?php

namespace App\Jarboe\Fields;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage as IlluminateStorage;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Yaro\Jarboe\Table\Fields\Image as JarboeImage;

final class Image extends JarboeImage
{
    private array $thumbnailSizes = [];

    public function thumbnail($width, $height): Image
    {
        $this->thumbnailSizes = [$width, $height];

        return $this;
    }

    public function shouldCreateThumbnail(): bool
    {
        return !empty($this->thumbnailSizes);
    }

    private function getThumbnailWidth(): int
    {
        return Arr::first($this->thumbnailSizes, null, 0);
    }

    private function getThumbnailHeight(): int
    {
        return Arr::last($this->thumbnailSizes, null, 0);
    }

    protected function storeFile($filepath, $filename, $width = null, $height = null, $x = null, $y = null, $rotate = null, $rotateBackgroundColor = null)
    {
        $image = InterventionImage::make($filepath);
//        $rotateBackgroundColor = $rotateBackgroundColor ?: 'rgba(255, 255, 255, 0)';

        if ($rotate) {
            // because js plugin and php library rotating in different directions.
            $angle = $rotate * -1;
            $image->rotate($angle, $rotateBackgroundColor);
        }
        $hasCropProperties = !is_null($width) && !is_null($height) && !is_null($x) && !is_null($y);
        if ($this->isCrop() && $hasCropProperties) {
            $image->crop(round($width), round($height), round($x), round($y));
            if($this->shouldCreateThumbnail()) {
                $image->resize($this->getThumbnailWidth(), $this->getThumbnailHeight());
            }
        }

        if ($this->isEncode()) {
            return (string) $image->encode('data-url', $this->getQuality());
        }

        $format = '';
//        if ($this->isTransparentColor($rotateBackgroundColor)) {
//            $format = 'png';
//        }
        $path = trim($this->getPath() .'/'. $filename, '/');
        IlluminateStorage::disk($this->getDisk())->put(
            $path,
            (string) $image->encode($format, $this->getQuality())
        );

        return $path;
    }

    private function isTransparentColor(string $rgbaColor)
    {
        if (!$rgbaColor) {
            return false;
        }

        $segmentsString = preg_replace('~rgba\(|\)~', '', $rgbaColor);
        $segments = explode(',', $segmentsString);

        $opacity = $segments[3] ?? 0;

        return $opacity < 1;
    }
}
