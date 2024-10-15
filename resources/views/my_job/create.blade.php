<x-layout>
    {{ Breadcrumbs::render('create-job') }}

    <x-card class="mb-8">
        <form action="{{ route('my-jobs.store') }}" method="POST">
            @csrf

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">
                        Job title
                    </x-label>
                    <x-text-input name="title"/>
                </div>
                <div>
                    <x-label for="location" :required="true">
                        Location
                    </x-label>
                    <x-text-input name="location"/>
                </div>
                <div class="col-span-2">
                    <x-label for="salary" :required="true">
                        Salary
                    </x-label>
                    <x-text-input type="number" name="salary"/>
                </div>
                <div class="col-span-2">
                    <x-label for="description" :required="true">
                        Description
                    </x-label>
                    <x-text-input type="textarea" name="description"/>
                </div>

                <div>
                    <x-label for="experience" :required="true">Experience</x-label>
                    <x-radio-group name="experience" :value="old('experience')" :options="\App\Models\Job::$experience" :allOption="false" />
                </div>

                <div>
                    <x-label for="category" :required="true">Category</x-label>
                    <x-radio-group name="category" :value="old('category')" :options="\App\Models\Job::$category" :allOption="false" />
                </div>

                <div class="col-span-2">
                    <x-button class="w-full">Create Job</x-button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>