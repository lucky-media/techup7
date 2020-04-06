@extends('layouts.app')

@section('content')

<div class="container my-10">
    <div class="row justify-center">
        <div class="col-6">
            <div class="bg-blue-500 border rounded mb-10 lg:mb-0">
                <div class="m-10">
                    <h2 class="text-4xl font-bold text-white">Edit User Role</h2>

                    <form action="/admin/{{ $user->id }}" enctype="multipart/form-data" method="post">

                        @csrf
                        @method('PATCH')

                        <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight
                            focus:outline-none focus:bg-white focus:border-gray-500 @error('lang') border-2 border-red-600 @enderror"
                            id="role" name="role">
                            <option value="instructor" {{ ("instructor" == $user->role ? "selected":"") }}>Instructor</option>
                            <option value="student" {{ ("student" == $user->role ? "selected":"") }}>Student</option>
                        </select>


                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit"
                                class="mt-4 transition duration-200 ease-in-out bg-orange-500 font-bold text-white py-6 px-10 rounded hover:bg-gray-200 hover:text-gray-600">
                                {{ __('Save') }}
                                    </button>
                                </div>
                                <div class="col-auto text-right">
                                    <a href="{{ url()->previous() }}">
                                    <div
                                        class="mt-8 transition duration-200 ease-in-out bg-white font-bold text-orange-500 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                        {{ __('Cancel') }}
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
