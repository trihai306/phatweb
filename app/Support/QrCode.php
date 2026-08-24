<?php

namespace App\Support;

use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Cache;

class QrCode
{
    /**
     * Render a QR code as inline SVG markup (no XML prolog), ready to embed in Blade.
     */
    public static function svg(string $text, int $size = 160, string $color = '#19592F'): string
    {
        $cacheKey = 'qr:'.md5($text.'|'.$size.'|'.$color);

        return Cache::rememberForever($cacheKey, function () use ($text, $size, $color) {
            [$r, $g, $b] = self::hexToRgb($color);

            $style = new RendererStyle(
                size: $size,
                margin: 1,
                fill: Fill::uniformColor(new Rgb(255, 255, 255), new Rgb($r, $g, $b)),
            );

            $svg = (new Writer(new ImageRenderer($style, new SvgImageBackEnd())))->writeString($text);

            // Strip the XML prolog so the SVG can be inlined directly into HTML.
            return preg_replace('/^<\?xml.*?\?>\s*/s', '', $svg);
        });
    }

    /**
     * @return array{0:int,1:int,2:int}
     */
    private static function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }

        return [
            (int) hexdec(substr($hex, 0, 2)),
            (int) hexdec(substr($hex, 2, 2)),
            (int) hexdec(substr($hex, 4, 2)),
        ];
    }
}
