<aside :class="{ 'w-full md:w-64': sidebarOpen, 'w-0 md:w-16 hidden md:block': !sidebarOpen }"
    class="bg-sidebar text-sidebar-foreground border-r border-gray-200 dark:border-gray-700 sidebar-transition overflow-hidden">
    <!-- Sidebar Content -->
    <div class="h-full flex flex-col">
        <!-- Sidebar Menu -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
            <ul class="space-y-1 px-2">
                <!-- Dashboard -->
                <x-layouts.sidebar-link href="{{ route('dashboard') }}" icon='fas-house'
                    :active="request()->routeIs('dashboard*')">Dashboard</x-layouts.sidebar-link>
                @can('manage users')
                    <x-layouts.sidebar-link href="{{ route('users.index') }}" icon='fas-users'
                        :active="request()->routeIs('users*')">Users</x-layouts.sidebar-link>
                @endcan
                <x-layouts.sidebar-link href="{{ route('clients.index') }}" icon='fas-building'
                    :active="request()->routeIs('clients*')">Clients</x-layouts.sidebar-link>
                <x-layouts.sidebar-link href="{{ route('tasks.index') }}" icon='fas-tasks'
                    :active="request()->routeIs('tasks*')">Tasks</x-layouts.sidebar-link>
                <x-layouts.sidebar-link href="{{ route('projects.index') }}" icon='fas-briefcase'
                    :active="request()->routeIs('projects*')">Projects</x-layouts.sidebar-link>
            </ul>
        </nav>
    </div>
</aside>