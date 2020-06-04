<div class="row">
    @foreach ($course->lesson->sortBy('position') as $lessons)
        <div class="col-11">
            <a href="{{ route('lessons.show', $lessons) }}">
                <h2 class="px-8 py-5 border-b-2 border-white
                {{-- Different color for current lesson --}}        
                        @if ($lessons->id == $lesson->id)
                            bg-gray-500 text-white
                        @else
                            bg-gray-100 text-black
                        @endif
                ">
                    {{-- Checks if this lesson is completed --}}
                    @if (in_array($lessons->id, $this->completedLessons))
                        &#10004;
                    @endif

                    {{ $lessons->title }}</h2>    
            </a>
        </div>
        @can('create', $course)
            <div class="col-1">                                
                    @if($lessons->position > 1)
                        <button class="bg-blue-500 font-bold text-white px-2 py-1 rounded"
                                wire:click="arrangeUp({{ $course->id }}, '{{ $lessons->position }}')">&uarr;</button><br>
                    @endif
                    @if($lessons->position < $course->lesson->count())
                        <button class="bg-orange-500 font-bold text-white px-2 py-1 rounded"
                                wire:click="arrangeDown({{ $course->id }}, '{{ $lessons->position }}')">&darr;</button>
                    @endif
            </div>
        @endcan
    @endforeach
</div>
