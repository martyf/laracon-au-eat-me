<?php

namespace App\Fieldtypes;

use Illuminate\Routing\Route;
use Statamic\Fields\Fieldtype;

class LaravelRoute extends Fieldtype
{
    protected $icon = 'select';

    protected $categories = ['special'];

    /**
     * The blank/default value.
     *
     * @return array
     */
    public function defaultValue()
    {
        return null;
    }

    /**
     * Pre-process the data before it gets sent to the publish page.
     *
     * @param  mixed  $data
     * @return array|mixed
     */
    public function preProcess($data)
    {
        return $data;
    }

    /**
     * Process the data before it gets saved.
     *
     * @param  mixed  $data
     * @return array|mixed
     */
    public function process($data)
    {
        return $data;
    }

    public function preload(): array
    {
        $router = app('router');

        return [
            'routes' => collect($router->getRoutes())
                ->filter(fn (Route $route) => in_array('GET', $route->methods()) && $route->getName() && ! starts_with($route->getName(), ['statamic', 'sanctum', 'livewire', 'ignition']) && ! str_contains($route->uri(), '{'))
                ->mapWithKeys(fn (Route $route) => [
                    $route->getName() => $route->uri(),
                ]),
        ];
    }

    public function prepareData($data): array
    {
        return $data;
        dd('a');
    }
}
