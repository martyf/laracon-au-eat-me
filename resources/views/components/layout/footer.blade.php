<footer class="mt-10 bg-gray-800 text-gray-500 text-sm">
    <div class="md:flex md:justify-between max-w-7xl mx-auto px-4 py-2.5 sm:px-6 lg:px-8">
        <div class="md:flex md:justify-start md:space-x-6 md:mr-6 ">

            <div class="flex justify-center md:justify-start space-x-4">
            @foreach(Statamic::tag('nav:footer') as $navItem)
                <a href="{{ $navItem['url'] }}"
                class="transition-colors hover:text-white">{{ $navItem['title'] }}</a>
            @endforeach
            </div>

            <div class="text-center opacity-80 ">{{ \Statamic\Facades\GlobalSet::findByHandle('settings')->inCurrentSite()['copyright'] }}</div>
        </div>

        <div class="mt-2 text-center md:text-right md:mt-0">
            <a href="https://www.mity.com.au" class="group inline-flex items-center" target="_blank">
                <span class="hidden sm:inline sm:whitespace-nowrap transition-all opacity-80 group-hover:opacity-100">Developed by</span>
                <x-marks.mity-digital
                    class="ml-2 h-4 transition-all opacity-80 group-hover:opacity-100"></x-marks.mity-digital>
            </a>
        </div>
    </div>
</footer>
