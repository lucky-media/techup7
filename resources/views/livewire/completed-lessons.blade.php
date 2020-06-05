<div>
    @auth
        @if (auth()->user()->role === 'student')
            <button type="submit" wire:click="markCompleted"
                class="bg-white hover:bg-blue-500 text-gray-600 text-xs hover:text-white py-2 px-2
                    border border-orange-500 hover:border-transparent rounded">
                    @if($completed === 0)
                        {{ __('general.uncompleted_lesson') }}
                    @else
                        {{ __('general.completed_lesson') }}
                    @endif
            </button>
        @endif
    @endauth
</div>
