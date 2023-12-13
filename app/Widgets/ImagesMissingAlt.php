<?php

namespace App\Widgets;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Statamic\Facades\Asset;
use Statamic\Facades\AssetContainer;
use Statamic\Widgets\Widget;

class ImagesMissingAlt extends Widget
{
    /**
     * The HTML that should be shown in the widget.
     *
     * This has been taken from Studio 1902's Peak starter kit
     *
     * @return string|View
     */
    public function html()
    {
        $expiration = Carbon::now()->addMinutes($this->config('expiry', 0));

        $assets = Cache::remember('widgets::ImagesMissingAlt', $expiration, function () {
            return Asset::query()
                ->where('container', $this->config('container', 'assets'))
                ->whereNull('alt')
                ->whereIn('extension',
                    $this->config('filetypes', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif', 'bmp', 'tiff', 'svg']))
                ->orderBy('last_modified', 'desc')
                ->limit(100)
                ->get()
                ->toAugmentedArray();
        });

        $assets = collect($assets);

        $container = AssetContainer::findByHandle($this->config('container', 'assets'));

        return view('widgets.images-missing-alt', [
            'assets' => $assets->slice(0, $this->config('limit', 5)),
            'count' => count($assets),
            'container' => $container,
        ]);
    }
}
