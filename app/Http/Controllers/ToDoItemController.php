<?php

namespace App\Http\Controllers;

use App\Models\ToDoItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ToDoItemController extends Controller
{
    public function index(): View
    {
        $todoitems = auth()->user()->todoitems()->paginate(5);
        return view('todoitems.index', compact('todoitems'));
    }

    public function create(): View
    {
        return view('todoitems.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'max:255']
        ]);

        $todoitem = (new ToDoItem([
            'title' => $request->get('title'),
        ]));

        $todoitem->user()->associate(auth()->user());
        $todoitem->save();

        return redirect()->route('todoitems.index');
    }

    public function show(ToDoItem $todoitem): View
    {
        return view('todoitems.show', compact('todoitem'));
    }

    public function edit(ToDoItem $todoitem): View
    {
        return view('todoitems.edit', compact('todoitem'));
    }

    public function update(Request $request, ToDoItem $todoitem): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'max:255']
        ]);

        $todoitem->update($request->all());

        return redirect()->route('todoitems.index');
    }

    public function destroy(ToDoItem $todoitem): RedirectResponse
    {
        $todoitem->delete();
        return redirect()->route('todoitems.index');
    }

    public function complete(ToDoItem $todoitem): RedirectResponse
    {
        $todoitem->toggleComplete();
        $todoitem->save();
        return redirect()->back();
    }
}
