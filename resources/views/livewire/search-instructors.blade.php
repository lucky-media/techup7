<div>
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            <input type="text" class="rounded bg-gray-100 border-2 mr-4 border-orange-500" wire:model="searchTerm" />
            <p>search with livewire</p>
        </div>
    </div>
    
    <div class="container my-20">
        <div class="row text-center">
            @forelse($users as $user)
            <div class="lg:col-4 my-10">
                <a class="hover:text-orange-500" href="{{ route('profiles.show', $user) }}">
                    <img class="rounded-full h-64 w-64 border-2 border-orange-500" src="{{ asset($user->profile->profileImage()) }}" alt="profile image">
                    <h2 class="font-semibold text-2xl transition duration-200 ease-in">{{ Str::limit($user->name, 25) }}</h2>
                </a>
            </div>
            @empty
            <div>
                {{ __('general.there_is_no_instructor') }}
            </div>
        @endforelse
        </div>
    <div class="row justify-center mt-4">
        <div class="col-6 justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
    </div>
</div>