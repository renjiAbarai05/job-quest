<x-layout>
    {{ Breadcrumbs::render('jobs') }}

    <x-card class="mb-4 text-sm" x-data>
        <form x-ref="filters" action="{{ route('jobs.index') }}" method="GET">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input form-ref="filters" name="search" value="{{ request('search') }}" placeholder="Search for any text"/>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input form-ref="filters" name="min_salary" value="{{ request('min_salary') }}" placeholder="From"/>
                        <x-text-input form-ref="filters" name="max_salary" value="{{ request('max_salary') }}" placeholder="To"/>
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>

                    <x-radio-group name="experience" :options="\App\Models\Job::$experience" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>

                    <x-radio-group name="category" :options="\App\Models\Job::$category" />
                </div>
            </div>

            <x-button class="w-full">
                Filter
            </x-button>
        </form>
    </x-card>

    @foreach($jobs as $job)
        <x-job-card class="mb-4" :$job>
            <div>
                <x-link-button :href="route('jobs.show', $job)">
                    Show
                </x-link-button>
            </div>
        </x-job-card>
    @endforeach

    <div class="mb-4">
        {{ $jobs->links() }}
    </div>
</x-layout>