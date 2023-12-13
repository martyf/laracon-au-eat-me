<div class="card p-0 overflow-hidden h-full">
    <div class="flex justify-between items-center p-4">
        <h2>
            <a href="{{ $container->showUrl() }}" class="flex items-center">
                <div class="h-6 w-6 mr-1 text-gray-800">
                    @cp_svg('icons/light/assets')
                </div>
                <span>{{ __('widgets.images_missing_alt.title', ['container' => $container->title() ]) }}</span>
            </a>
        </h2>
        <a aria-label="{{ __('widgets.images_missing_alt.browse') }}"
           class="btn-primary"
           href="{{ $container->showUrl() }}">{{ __('widgets.images_missing_alt.browse') }}</a>
    </div>
    @if ($count > 0)
        <div class="content px-4 pb-2">
            <p class="text-xs">{{ __('widgets.images_missing_alt.explanation') }}</p>
            <p>{{ trans_choice('widgets.images_missing_alt.count', $count, ['count' => $count]) }}</p>
        </div>
    @else
        <div class="content flex px-4 pb-2">
            <div class="h-4 w-4 mr-2 text-green-600" style="flex-shrink: 0">
                @cp_svg('icons/light/check')
            </div>
            <p>{{ __('widgets.images_missing_alt.done') }}</p>
        </div>
    @endif

    @if ($assets)
        <table tabindex="0" class="data-table">
            <tbody tabindex="0">

            @foreach ($assets as $asset)
                <tr class="sortable-row outline-none" tabindex="0">
                    <td>
                        <div class="flex items-center">
                            <div class="little-dot mr-2 bg-red-500"></div>
                            <a href="{{ $asset['edit_url'] }}"
                               class="flex w-full group"
                               aria-label="{{ __('widgets.images_missing_alt.assets_edit') }}">
                                <span class="flex-grow">{{ $asset['basename'] }}</span>
                            </a>
                        </div>
                    </td>
                    <td class="actions-column w-0"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if ($count > $assets->count())
            <div class=" px-3 pt-1 pb-2">
                <p><a aria-label="{{ __('widgets.images_missing_alt.browse_label') }}"
                      href="{{  $container->showUrl() }}"
                      class="btn btn-xs">{{ __('widgets.images_missing_alt.browse_long') }}</a></p>
            </div>
        @endif
    @endif
</div>
