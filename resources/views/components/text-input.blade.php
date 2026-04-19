@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm', 'style' => 'background-color: #ffffff !important; color: #4b5563 !important; -webkit-appearance: none; -moz-appearance: none; appearance: none;']) }}>
