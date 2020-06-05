<div>
    {{-- All answers --}}
    <div class="container">
        <div class="row justify-center">
            <div class="lg:col-10 mt-8">
                @foreach($post->answers as $answer)
                    <livewire:display-answer :answer="$answer" :key="rand()*$answer->id">
                @endforeach
            </div>
        </div>
    </div>

    {{-- Add a new answer --}}
    <div class="container my-10">
        <div class="row justify-center">
            <div class="lg:col-10">
                <form wire:submit.prevent="addAnswer">
                    <div class="row">
                        <div class="col-6">
                            <textarea type="text" wire:model.lazy="body"
                            class="rounded border-2 border-indigo-900 bg-gray-100 w-full py-2 px-2"></textarea>
                            <div>@error('body') <span class="error">{{ $message }}</span> @enderror</div>
                        </div>
                        <div class="col-3">
                            @auth
                                <button type="submit" class="bg-white hover:bg-blue-500 text-gray-600 text-xs hover:text-white py-2 px-2
                                border border-orange-500 hover:border-transparent rounded">{{ __('general.add_new_answer') }}</button>
                            @endauth
                            @guest
                                <a class="bg-white hover:bg-blue-500 text-gray-600 text-xs hover:text-white py-2 px-2
                                            border border-orange-500 hover:border-transparent rounded"
                                    href="{{ route('login') }}">{{ __('general.login') }}</a>
                            @endguest
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>