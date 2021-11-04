@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex items-center h-screen w-full bg-teal-lighter">
        <div class="w-full bg-white rounded shadow-lg p-8 m-4">
            <h1 class="block w-full text-center text-grey-darkest mb-6">Edit task</h1>
            <form class="mb-4" action="{{ route('todoitems.update', $todoitem) }}" method="post">
                @csrf
                @method('PUT')
                <div class="flex flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="title">Task</label>
                    <input class="border py-2 px-3 text-grey-darkest" value="{{ $todoitem->title }}"
                           type="text" name="title" id="title">
                </div>
                <button class="border-2 bg-green-500" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
