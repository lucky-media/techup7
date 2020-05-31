<div>
    <input type="text" class="rounded bg-gray-100 border-2 border-orange-500" wire:model="searchTerm" />
        <p>This supports livewire. Needs redesign</p>
    <div class="container my-20">
        <div class="row">
            <div class="col-7 text-justify">
                <img src="{{ asset($course->image) }}" class="rounded-circle" alt="course cover">
                <p class="py-6">{!! $course->body !!}</p>
            </div>
            <div class="col-5">
                <h2 class="text-white font-bold text-2xl bg-blue-500 px-8 py-5">{{ $course->title }} &nbsp;
                    <span class="text-sm font-normal"> ( {{ $course->lesson->count() }} lessons ) </span>
                </h2>
                <div class="row">
                    @forelse($lessons->sortBy('position') as $lesson)
                        <div class="col-11">
                                <a href="{{ route('lessons.show', $lesson->slug) }}">
                                    <h2 class="text-black bg-gray-100 px-8 py-6 border-b-2 border-white">{{ $lesson->title }}</h2>
                                </a>
                        </div>
                        @can('create', $course)
                            <div class="col-1">                                
                                    @if($lesson->position > 1)
                                        <a href="{{ route('courses.arrangeUp', ['course'=>$course, 'position'=>$lesson->position]) }}"
                                        class="bg-blue-500 font-bold text-white px-2 py-1 rounded">&uarr;</a>
                                    @endif
                                    @if($lesson->position < $course->lesson->count())
                                        <a href="{{ route('courses.arrangeDown', ['course'=>$course, 'position'=>$lesson->position]) }}"
                                        class="bg-orange-500 font-bold text-white px-2 py-1 rounded">&darr;</a><br>
                                    @endif
                            </div>
                        @endcan
                    @empty
                        <p>{{ __('general.there_are_no_lessons_yet') }}</p>
                    @endforelse
                </div>
                <br>
                @can('create', $course)
                    <div>
                        <form action="{{ route('lessons.create', $course) }}" enctype="multipart/form-data" method="get">
                            <button type="submit"
                            class="transition duration-200 ease-in-out bg-blue-500 font-bold text-white py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                            {{ __('general.add_new_lesson') }}</button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>