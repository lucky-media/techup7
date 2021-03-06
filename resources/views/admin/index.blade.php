@extends('layouts.app')

@section('content')

<div style="background:url({{ asset('/storage/title_img.png') }}); ">
    <div class="container">
        <div class="row items-center justify-between py-20">
            <div class="col-4">
                <h2 class="text-4xl">Dashboard</h2>
            </div>
        </div>
    </div>
</div>

<div class="container my-6">
    <div class="row">
        <div class="col-4"> 
            <form action="{{ route('comments.index') }}" enctype="multipart/form-data" method="get">
                    <button type="submit" 
                    class="transition duration-200 ease-in-out font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                    Manage Comments</button>
            </form>
        </div>
        <div class="col-4"> 
            <form action="{{ route('categories.index') }}" enctype="multipart/form-data" method="get">
                    <button type="submit" 
                    class="transition duration-200 ease-in-out font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                    Manage Categories</button>
            </form>
        </div>
    </div>
</div>

{{-- Listing all users --}}
<div class="container my-10">
    <div class="row justify-center">
        {{-- Instructors --}}
        <div class="col-6">
            <table class="table-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Change Role</th>
                    <th class="px-4 py-2">Delete User</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($instructors as $instructor)
                        <tr>
                            <td class="px-4 py-2"><a href="{{ route('profiles.show', $instructor) }}">{{ $instructor->name }}<a></td>
                            <td class="px-4 py-2">{{ $instructor->role }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('admin.edit', $instructor) }}" enctype="multipart/form-data" method="get">
                                    <button type="submit" 
                                    class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                    {{ __('Edit') }}</button>
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('admin.destroy', $instructor) }}" enctype="multipart/form-data" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                    class="transition duration-200 ease-in-out bg-blue-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                    {{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Students --}}
        <div class="col-6">
            <table class="table-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Change Role</th>
                    <th class="px-4 py-2">Delete User</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td class="px-4 py-2"><a href="{{ route('profiles.show', $student) }}">{{ $student->name }}<a></td>
                            <td class="px-4 py-2">{{ $student->role }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('admin.edit', $student) }}" enctype="multipart/form-data" method="get">
                                    <button type="submit" 
                                    class="transition duration-200 ease-in-out bg-orange-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                    {{ __('Edit') }}</button>
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('admin.destroy', $student) }}" enctype="multipart/form-data" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                    class="transition duration-200 ease-in-out bg-blue-500 font-bold text-gray-600 py-2 px-5 rounded hover:bg-gray-200 hover:text-gray-600">
                                    {{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-center mt-4">
        <div class="col-6 justify-content-center">
            {{ $instructors->links() }}
        </div>
        <div class="col-6 justify-content-center">
            {{ $students->links() }}
        </div>
    </div>
</div>

@endsection