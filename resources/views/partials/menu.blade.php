<div class="h-8 bg-blue-500"></div>

<div class="container">
    <div class="row justify-between py-8 text-base text-black">
        {{-- Techup logo for the menu --}}
        <div class="col-3 items-left">
            <a href="{{ route('index') }}">
                <img src="{{ asset('/svg/techup.svg') }}" style="max-height: 50px;">
            </a>
        </div>
        {{-- Menu link to other pages --}}
        <div class="col-5 hidden md:flex flex-row items-center justify-end">
            <a class="{{ Request::path() === '/' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out mr-6 hover:text-purple-500"
                href="{{ route('index') }}">Home</a>
            <a class="{{ Request::path() === 'courses' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out mr-6 hover:text-purple-500"
                href="{{ route('courses.index') }}">All Courses</a>
            <a class="{{ Request::path() === 'instructors' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out mr-6 hover:text-purple-500"
                href="{{ route('profiles.index') }}">Instructors</a>
            <a class="{{ Request::path() === 'blog' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out mr-6 hover:text-purple-500"
                href="{{ route('blog') }}">Blog</a>
            <a class="{{ Request::path() === 'contact' ? 'font-bold' : 'font-medium' }} transition duration-200 ease-in-out hover:text-purple-500"
                href="{{ route('contact') }}">Contact</a>
        </div>

        {{-- Here we display Login/Logout/Register for visitors. --}}
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

            {{-- The admin can view the dashboard for managing users, comments and categories --}}
            @if (Auth::user()->role == 'admin')
            <div
                class="transition duration-200 bg-gray-200 ease-in-out font-medium mr-2 px-4 py-2 hover:text-purple-500">
                <a href="{{ route('admin.index') }}">
                    Dashboard
                </a>
            </div>
            @endif

            {{-- Only the instructors can have a link to their profile page --}}
            @if (Auth::user()->role == 'instructor')
            <div
                class="transition duration-200 bg-gray-200 ease-in-out font-medium mr-4 px-4 py-2 hover:text-purple-500">
                <a href="{{ route('profiles.show', Auth::user()->id) }}">
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
