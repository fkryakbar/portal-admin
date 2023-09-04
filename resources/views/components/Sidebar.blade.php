<div class="p-4 bg-white drop-shadow h-full fixed w-[300px] z-[100] transition-all overflow-y-auto" x-show="open"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="open = false" @keydown.escape="open = false">
    <x-SidebarMenu />
</div>
<div class="p-4 bg-white drop-shadow h-full lg:block hidden w-[300px] z-[100] transition-all overflow-y-auto">
    <x-SidebarMenu />
</div>
