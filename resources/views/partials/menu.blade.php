<div class="h-8 bg-blue-500"></div>

<div class="container">
    <div class="row justify-between py-8 text-base text-black">
        <div class="col-3 items-left">
            <a href="{{ route('index') }}">
                <img src="{{ asset('/svg/techup.svg') }}" style="max-height: 50px;">
            </a>
        </div>
        <div class="col-5 hidden md:flex flex-row items-center justify-end">
            <a class="{{ Request::path() === '/' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out mr-6 hover:text-purple-500"
                href="{{ route('index') }}">Home</a>
            <a class="{{ Request::path() === 'courses' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out mr-6 hover:text-purple-500"
                href="{{ route('courses') }}">All Courses</a>
            <a class="{{ Request::path() === 'instructors' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out mr-6 hover:text-purple-500"
                href="{{ route('instructors') }}">Instructors</a>
            <a class="{{ Request::path() === 'blog' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out mr-6 hover:text-purple-500"
                href="{{ route('blog') }}">Blog</a>
            <a class="{{ Request::path() === 'contact' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out hover:text-purple-500"
                href="{{ route('contact') }}">Contact</a>
        </div>
        <div class="col-4 hidden md:flex flex-row items-center justify-end">
            <!-- Authentication Links -->
            @guest
            <a class="transition duration-200 ease-in-out bg-blue-500 text-white ml-2 py-2 px-6 rounded hover:bg-gray-600"
                href="{{ route('login') }}">{{ __('Login') }}</a>
            @else
            <div
                class="transition duration-200 bg-gray-200 ease-in-out font-medium mr-2 px-4 py-2 hover:text-purple-500">
                {{ Auth::user()->username }} 
            </div>
            @if (Auth::user()->role == 'admin')
            <div
                class="transition duration-200 bg-gray-200 ease-in-out font-medium mr-2 px-4 py-2 hover:text-purple-500">
                <a href="/admin">
                    Dashboard
                </a>
            </div>
            @endif
            @if (Auth::user()->role == 'instructor')
            <div
                class="transition duration-200 bg-gray-200 ease-in-out font-medium mr-4 px-4 py-2 hover:text-purple-500">
                <a href="/profile/{{ Auth::user()->id }}">
                    Profile
                </a>
            </div>
            @endif
            <div class="transition duration-200 bg-gray-200 ease-in-out font-medium px-4 py-2 hover:text-purple-500">
                <form action="{{ route('logout') }}" method="POST">
                    <button type="submit">
                        {{ __('Logout') }}
                    </button>
                    @csrf
                </form>
            </div>
            @endguest
        </div>
    </div>
</div>
