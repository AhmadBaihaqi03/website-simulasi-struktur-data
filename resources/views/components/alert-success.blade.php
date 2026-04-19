@props(['message'])

<div x-data="{ show: true }"
     x-show="show"
     x-init="setTimeout(() => show = false, 3000)"
     x-transition:leave="transition ease-in duration-500"
     class="mb-6 p-4 bg-emerald-50 border-2 border-emerald-200 rounded-xl shadow-sm">

    <div class="flex items-center justify-between gap-4">
        <!-- Left Icon + Message -->
        <div class="flex items-start gap-3 flex-1">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>

            <p class="text-emerald-900 font-semibold text-sm leading-relaxed">{{ $message }}</p>
        </div>

        <!-- Close Button (Centered Vertically) -->
        <button @click="show = false"
                class="flex-shrink-0 text-emerald-600 hover:text-emerald-900 hover:bg-emerald-100 transition-colors p-2 rounded-lg">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
</div>
