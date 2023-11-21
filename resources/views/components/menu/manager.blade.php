@if(auth()->user()->getRole() == 'manager')
    @switch(auth()->user()->getStorehouseId())
        @case(1)
        @include('components.menu.'.auth()->user()->getRole().'.tashkent')
        @break
        @case(2)
        @include('components.menu.'.auth()->user()->getRole().'.khudjand')
        @break
        @case(3)
        @include('components.menu.'.auth()->user()->getRole().'.dushanbe')
        @break
    @endswitch
@endif
