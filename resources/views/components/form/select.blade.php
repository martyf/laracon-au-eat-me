@props(['disabled' => false])
<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'pl-4 pr-10 py-2.5 border-gray-200 focus:border-sky-500 focus:ring-sky-500 rounded-xl shadow-sm']) !!}>
    {{ $slot }}
</select>
