<div class="container my-10 ml-10">
    <div class="row no-gutters">
        <div class="px-0">
            {{-- Display profile image for instructors, or display no_image for students --}}
            <img src="{{ asset($comment->user->profile->profileImage())}}"
                alt="profile image" class="rounded-full w-12 h-12">
        </div>
        <div class="col-10">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-auto" style="max-width: 60%;">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('profiles.show', $comment->user->id) }}">
                                        <span class="font-bold underline"> {{ $comment->user->name }} </span> &nbsp;
                                        <span class="text-xs"> ({{ $comment->created_at->diffForHumans() }})</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-justify">
                                    {{ $comment->body }}
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-2">
                                            {{-- Edit a comment --}}
                                            @can('update', $comment)
                                            <form action="{{ route('comments.edit', $comment) }}"
                                                enctype="multipart/form-data" method="get">
                                                <button type="submit"
                                                    class="bg-white hover:bg-blue-500 text-gray-600 text-xs hover:text-white rounded">
                                                    {{ __('general.edit') }}</button>
                                            </form>
                                            @endcan
                                        </div>
                                        {{-- Delete a comment --}}
                                        <div class="col-2">
                                            @can('delete', $comment)
                                            <button wire:click="deleteComment"
                                                onclick="confirm('{{ __('general.are_you_sure') }}') || event.stopImmediatePropagation()"
                                                class="bg-white hover:bg-blue-500 text-gray-600 text-xs hover:text-white rounded">
                                                {{ __('general.delete') }}</button>
                                            @endcan
                                        </div>
                                        {{-- Comments can be flagged as inappropriate by students or instructors. Admin manages flagged comments. --}}
                                        <div class="col-2">
                                            @can('flagInappropriate', $comment)
                                            <button wire:click="flagInappropriate"
                                                onclick="confirm('{{ __('general.are_you_sure') }}') || event.stopImmediatePropagation()"
                                                class="bg-white hover:bg-blue-500 text-orange-500 text-xs hover:text-white rounded">
                                                {{ __('general.inappropriate') }}</button>
                                            @endcan
                                            @can('flagged', $comment)
                                            <p class="text-gray-500 text-xs underline">
                                                {{ __('general.flagged') }}
                                            </p>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Add a reply --}}
                    <div class="col">
                        <form wire:submit.prevent="replyComment">
                            <div class="container">
                                <div class="row">
                                    <div class="col-auto">
                                        <textarea type="text" wire:model.lazy="bodyReply"
                                            class="rounded bg-gray-100 w-46 py-2 px-2 @error('bodyReply') is-invalid @enderror"></textarea>
                                        <div>
                                            @error('bodyReply') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        @auth
                                            <button type="submit"
                                                    class="bg-white hover:bg-blue-500 text-gray-600 text-xs hover:text-white py-2 px-2
                                                    border border-orange-500 hover:border-transparent rounded">{{ __('general.reply') }}</button>
                                        @endauth
                                        @guest
                                            <a class="bg-white hover:bg-blue-500 text-gray-600 text-xs hover:text-white py-2 px-2
                                                        border border-orange-500 hover:border-transparent rounded"
                                                href="{{ route('login') }}">{{ __('general.login') }}</a>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- By calling this view again, we can add a new reply. --}}
    <div class="row">
        <div class="col-12">
            @foreach($comment->replies as $reply)
                <livewire:comment-replies :comment="$reply" :key="rand()*$reply->id">
            @endforeach
        </div>
    </div>
</div>
