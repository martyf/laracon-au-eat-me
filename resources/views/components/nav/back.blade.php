<a class="inline-flex items-center
          text-sky-900 opacity-70 transition-all ease-in-out duration-150
          hover:text-purple-900 hover:opacity-100"
   href="{{ $href }}"
   wire:navigate>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
        <path fill-rule="evenodd"
              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
              clip-rule="evenodd"/>
    </svg>
    <span>{{ $slot }}</span>
</a>
