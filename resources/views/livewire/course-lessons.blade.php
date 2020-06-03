<div>
    @foreach ($course->lesson->sortBy('position') as $lessons)
        {{-- Different color for current lesson --}}
        @if ($lessons->id == $lesson->id)
                <h2 class="text-white bg-gray-600 px-8 py-5 border-b-2 border-white">
                    {{-- Checks if this lesson is completed --}}
                    @if (in_array($lessons->id, $this->completedLessons))
                        &#10004;
                    @endif
                    {{ $lessons->title }}</h2>  
        @else
            <a href="{{ route('lessons.show', $lessons) }}">
                <h2 class="text-black bg-gray-100 px-8 py-5 border-b-2 border-white">
                    {{-- Checks if this lesson is completed --}}
                    @if (in_array($lessons->id, $this->completedLessons))
                        &#10004;
                    @endif
                    {{ $lessons->title }}</h2>    
            </a>
        @endif
    @endforeach
</div>
