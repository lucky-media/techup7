<div class="lg:col-12">
    <div class="py-8 px-8 shadow-lg rounded-lg my-20 bg-gray-100">
        <div class="flex float-right -mt-16">
            <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" alt="{{ asset($answer->user->name) }}"
                src="{{ asset($answer->user->profile->profileImage()) }}">
        </div>
        <div>
            <p class="mt-2 text-gray-600">
                {{ $answer->body }}
            </p>
        </div>
        <div class="flex justify-between items-center mt-4">
            <div class="flex items-end mt-4">                        
                <a href="{{ route('profiles.show', $answer->user->id) }}" class="ml-4 text-xl font-medium text-indigo-500">
                    {{ $answer->user->name }}
                </a>
                <p class="ml-8 text-gray-600">{{ $answer->created_at->diffForHumans() }}</p>
            </div>
            <div class="flex justify-between items-center mt-4">
                <div class="float-right mt-4">
                    {{-- Edit a answer --}}
                    @can('update', $answer)
                        <form action="{{ route('comments.edit', $answer) }}"
                            enctype="multipart/form-data" method="get">
                            <button type="submit"
                                class="bg-transparent hover:bg-blue-500 text-gray-600 text-xs hover:text-white rounded">
                                {{ __('general.edit') }}</button>
                        </form>
                    @endcan
                    {{-- Delete a answer --}}
                    @can('delete', $answer)
                        <button wire:click="deleteAnswer"
                            onclick="confirm('{{ __('general.are_you_sure') }}') || event.stopImmediatePropagation()"
                            class="bg-transparent hover:bg-blue-500 text-gray-600 text-xs hover:text-white rounded">
                            {{ __('general.delete') }}</button>
                    @endcan
                    {{-- answers can be flagged as inappropriate by students or instructors. Admin manages flagged answers. --}}
                    @can('flagInappropriate', $answer)
                        <button wire:click="flagInappropriate"
                            onclick="confirm('{{ __('general.are_you_sure') }}') || event.stopImmediatePropagation()"
                            class="bg-transparent hover:bg-blue-500 text-orange-500 text-xs hover:text-white rounded">
                            {{ __('general.inappropriate') }}</button>
                    @endcan
                    @can('flagged', $answer)
                        <p class="text-gray-500 text-xs underline">
                            {{ __('general.flagged') }}
                        </p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>