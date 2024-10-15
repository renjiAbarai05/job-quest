<x-layout>
    {{ Breadcrumbs::render('edit-job', $job) }}

    <x-card class="mb-8">
        <form action="{{ route('my-jobs.update', $job) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">
                        Job title
                    </x-label>
                    <x-text-input name="title" :value="old('title', $job->title)"/>
                </div>
                <div>
                    <x-label for="location" :required="true">
                        Location
                    </x-label>
                    <x-text-input name="location" :value="old('location', $job->location)"/>
                </div>
                <div class="col-span-2">
                    <x-label for="salary" :required="true">
                        Salary
                    </x-label>
                    <x-text-input type="number" name="salary" :value="old('salary', $job->salary)"/>
                </div>
                <div class="col-span-2">
                    <x-label for="description" :required="true">
                        Description
                    </x-label>
                    <x-text-input type="textarea" name="description" :value="old('description', $job->description)"/>
                </div>

                <div>
                    <x-label for="experience" :required="true">Experience</x-label>
                    <x-radio-group name="experience" :value="old('experience', $job->experience)" :options="\App\Models\Job::$experience" :allOption="false" />
                </div>

                <div>
                    <x-label for="category" :required="true">Category</x-label>
                    <x-radio-group name="category" :value="old('category', $job->category)" :options="\App\Models\Job::$category" :allOption="false" />
                </div>

                <div class="col-span-2">
                    <x-button class="w-full">Update Job</x-button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>