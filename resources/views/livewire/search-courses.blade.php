<div>
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            <input type="text" class="rounded bg-gray-100 border-2 mr-4 border-orange-500" wire:model="searchTerm" />
            <p>search with livewire. Show only in:</p>
            <button class="bg-blue-500 font-bold text-white px-2 py-1 rounded ml-4"
                    wire:click="switchLanguage('sq')">{{ __('general.albanian') }}</button>
            <button class="bg-orange-500 font-bold text-white px-2 py-1 rounded ml-4"
                    wire:click="switchLanguage('mk')">{{ __('general.macedonian') }}</button>
            <button class="bg-gray-500 font-bold text-white px-2 py-1 rounded ml-4"
                    wire:click="switchLanguage()">{{ __('general.both') }}</button>
        </div>
    </div>

    {{-- We display all courses with a link, cover image, date created, owner and category --}}
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @foreach($courses as $course)
            <div class="my-4 px-4 col-4">
                <article class="overflow-hidden rounded-lg shadow-lg">
                    <a href="{{ route('courses.show', $course->slug) }}">
                        <img alt="course cover" class="block h-64 w-full" src="{{ asset($course->image) }}">
                    </a>

                    <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                        <h1 class="text-lg">
                            <a class="no-underline hover:underline text-black" href="{{ route('courses.show', $course->slug) }}">
                                {{ Str::limit($course->title, 30) }}
                            </a>
                        </h1>
                    </header>

                    <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                        <a class="flex items-center no-underline hover:underline text-black" href="{{ route('profiles.show', $course->user->id) }}">
                            <img alt="profile photo" class="block rounded-full w-12 h-12" src="{{ asset($course->user->profile->profileImage()) }}">
                            <p class="ml-2 text-sm">
                                {{ Str::limit($course->user->name, 20) }}
                            </p>
                        </a>
                        <div class="no-underline text-grey-darker text-right text-sm hover:text-red-dark">
                                {{ $course->created_at->formatLocalized('%b %Y') }}<br>
                            <a class="no-underline hover:underline text-black" href="{{ route('courses.index') }}">
                                {{ Str::limit($course->category->name, 10) }}
                            </a><br>
                            <img src="{{ asset('/storage/'.$course->lang.'.png') }}" style="max-height: 20px;">
                        </div>
                    </footer>

                </article>
            </div>
            @endforeach
        </div>
        <div class="row justify-center mt-4">
            <div class="col-6 justify-content-center">  
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
