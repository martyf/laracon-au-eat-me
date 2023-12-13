/**
 * When extending the control panel, be sure to uncomment the necessary code for your build process:
 * https://statamic.dev/extending/control-panel
 */


import ExampleFieldtype from './components/fieldtypes/ExampleFieldtype.vue';
import LaravelRouteFieldtype from './components/fieldtypes/LaravelRouteFieldtype.vue';


Statamic.booting(() => {
    Statamic.$components.register('example-fieldtype', ExampleFieldtype);
    Statamic.$components.register('laravel_route-fieldtype', LaravelRouteFieldtype);
});


