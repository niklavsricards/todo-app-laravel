@extends('layouts.app')

@section('content')
    <div class="ml-20 mt-5">
        <a href="{{ route('todoitems.create') }}" class="bg-blue-500 hover:bg-blue-700
        text-white font-bold py-2 px-4 rounded">Create New Task</a>
    </div>

    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="border-b border-gray-200 shadow">
                    <table class="divide-y divide-gray-300 ">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-gray-500">Task</th>
                            <th class="px-6 py-2 text-xs text-gray-500">Edit</th>
                            <th class="px-6 py-2 text-xs text-gray-500">Completed</th>
                            <th class="px-6 py-2 text-xs text-gray-500">Delete</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            @foreach($todoitems as $todoitem)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            @if ($todoitem->completed_at)<s>{{ $todoitem->title }}</s>
                                            @else {{ $todoitem->title }} @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('todoitems.edit', $todoitem) }}"
                                           class="px-4 py-1 text-sm text-black-600 bg-green-200 rounded-full">Edit</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form method="post" action="{{ route('todoitems.complete', $todoitem) }}">
                                            @csrf
                                            <input type="checkbox" onchange="this.form.submit()"
                                            @if ($todoitem->completed_at)
                                                checked
                                                @endif>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('todoitems.destroy', $todoitem) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                            class="px-4 py-1 text-sm text-black-400 bg-red-200 rounded-full">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $todoitems->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
