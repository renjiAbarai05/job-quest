@unless ($breadcrumbs->isEmpty())
    <nav class="container mx-auto">
        <ol class="py-4 rounded flex flex-wrap text-sm text-gray-800">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}" class="text-slate-800 hover:text-slate-950 hover:underline focus:text-blue-900 focus:underline">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li class="text-slate-500">
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless($loop->last)
                    <li class="text-gray-500 px-2">
                        {{-- → --}}
                        /
                    </li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
