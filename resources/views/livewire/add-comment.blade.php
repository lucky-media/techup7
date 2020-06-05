<div>
    <div class="container mt-10">
        <div class="row">
            <div class="col-12">
                <h2 class="text-black py-5 border-b-2 border-white">{{ __('general.comments') }} ({{ $this->commentsCount }})</h2>
            </div>
        </div>
    </div>
    <div class="container mt-10">
        <div class="row">
            <div class="col-12">
                <form wire:submit.prevent="addComment">
                    <div class="row">
                        <div class="col-6">
                            <textarea type="text" wire:model.lazy="body"
                            class="rounded bg-gray-100 w-full py-2 px-2"></textarea>
                            <div>@error('body') <span class="error">{{ $message }}</span> @enderror</div>
                        </div>
                        <div class="col-3">
                            @auth
                                <button type="submit" class="bg-transparent hover:bg-blue-500 text-gray-600 text-xs hover:text-white py-2 px-2
                                border border-orange-500 hover:border-transparent rounded">{{ __('general.add_new_comment') }}</button>
                            @endauth
                            @guest
                                <a class="bg-transparent hover:bg-blue-500 text-gray-600 text-xs hover:text-white py-2 px-2
                                            border border-orange-500 hover:border-transparent rounded"
                                    href="{{ route('login') }}">{{ __('general.login') }}</a>
                            @endguest
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Show comments, replies and add new replies from another view. --}}
    <div class="container my-10">
        <div class="row">
            @foreach($comments->reverse() as $comment)
                <livewire:comment-replies :comment="$comment" :key="rand()*$comment->id">
            @endforeach
        </div>
    </div>
</div>
