<div class="container">
    <div class="row justify-center">
        <div class="lg:col-10 mt-8">
            <div class="py-4 px-8 shadow-lg rounded-lg mt-20
            {{ ($post->best_answer) ? 'bg-orange-500' : 'bg-white' }}
            ">
                <div class="flex float-right -mt-16">
                    <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" alt="{{ asset($post->user->name) }}"
                        src="{{ asset($post->user->profile->profileImage()) }}">
                </div>
                <div>
                    <h2 class="text-gray-800 text-3xl font-semibold">
                            {{ $post->title }}
                    </h2>
                    <p class="mt-2 text-gray-600">
                        {!! $post->body !!}
                    </p>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div class="flex items-end">                        
                        <a href="{{ route('profiles.show', $post->user->id) }}" class="ml-4 text-xl font-medium text-indigo-900">
                            {{ $post->user->name }}
                        </a>
                        <p class="ml-8 text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                        <p class="ml-8 text-gray-600">{{ __('general.total_answers') }}: {{ $post->children_count }}</p>
                        <p class="ml-8 text-gray-600">{{ __('general.status') }}:
                            <strong>{{ ($post->best_answer) ? __('general.solved') : __('general.unsolved') }}</strong></p>
                    </div>                    
                    <div class="float-right">
                        <img class="w-10 h-10 object-cover rounded-full border-2 border-indigo-900" alt="{{ $post->lang }}"
                            src="{{ asset('/storage/'.$post->lang.'.png') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
