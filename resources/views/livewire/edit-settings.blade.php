<div>
    {{-- Toggle between receiving emails for new comments or not --}}
    <div class="flex items-center py-2">
        <p class="text-white">Receive emails for new comments on your content</p>

        @if ($NewComment)
            <button class="bg-white font-bold text-black px-2 py-1 rounded ml-4"
                    wire:click="newComments(0)">{{ __('general.on') }}</button>
        @else
            <button class="bg-red-600 font-bold text-white px-2 py-1 rounded ml-4"
                    wire:click="newComments(1)">{{ __('general.off') }}</button>
            </button>
        @endif

    </div>
     
    {{-- Toggle between receiving emails for new replies or not --}}
    <div class="flex items-center py-2">
        <p class="text-white">Receive emails for new replies on your comment</p>

        @if ($NewReply)
            <button class="bg-white font-bold text-black px-2 py-1 rounded ml-4"
                    wire:click="newReplies(0)">{{ __('general.on') }}</button>
        @else
            <button class="bg-red-600 font-bold text-white px-2 py-1 rounded ml-4"
                    wire:click="newReplies(1)">{{ __('general.off') }}</button>
            </button>
        @endif

    </div>

    {{-- Toggle between receiving emails for new answers or not --}}
    <div class="flex items-center py-2">
    <p class="text-white">Receive emails for new answers on your post</p>

    @if ($NewAnswer)
        <button class="bg-white font-bold text-black px-2 py-1 rounded ml-4"
                wire:click="newAnswers(0)">{{ __('general.on') }}</button>
    @else
        <button class="bg-red-600 font-bold text-white px-2 py-1 rounded ml-4"
                wire:click="newAnswers(1)">{{ __('general.off') }}</button>
        </button>
    @endif

    </div>
</div>