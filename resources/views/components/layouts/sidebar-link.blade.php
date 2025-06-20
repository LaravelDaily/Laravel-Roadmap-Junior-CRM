@props(['active' => false, 'href' => '#', 'icon' => null])
<li>
    <a href="{{ $href }}" @class([
        'flex items-center px-3 py-2 text-sm rounded-md transition-colors duration-200',
        'bg-sidebar-accent text-sidebar-accent-foreground font-medium' => $active,
        'hover:bg-sidebar-accent hover:text-sidebar-accent-foreground text-sidebar-foreground' => !$active,
    ])>
        @svg($icon, $active ? 'w-5 h-5 text-white' : 'w-5 h-5 text-gray-500')
        <span :class="{ 'hidden ml-0': !sidebarOpen, 'ml-3': sidebarOpen }"
            x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="transition-opacity duration-300">{{ $slot }}</span>
    </a>
</li>
