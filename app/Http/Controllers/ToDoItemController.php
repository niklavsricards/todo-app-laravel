<?php

namespace App\Http\Controllers;

use App\Models\ToDoItem;
use Illuminate\Http\Request;

class ToDoItemController extends Controller
{
    public function index()
    {
        $todoitems = auth()->user()->todoitems()->get();
        return view('todoitems.index', compact('todoitems'));
    }

    public function create()
    {
        return view('todoitems.create');
    }

    public function store(Request $request)
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

    public function show(ToDoItem $todoitem)
    {
        return view('todoitems.show', compact('todoitem'));
    }

    public function edit(ToDoItem $todoitem)
    {
        return view('todoitems.edit', compact('todoitem'));
    }

    public function update(Request $request, ToDoItem $todoitem)
    {
        $request->validate([
            'title' => ['required', 'max:255']
        ]);

        $todoitem->update($request->all());

        return redirect()->route('todoitems.index');
    }

    public function destroy(ToDoItem $todoitem)
    {
        $todoitem->delete();
        return redirect()->route('todoitems.index');
    }
}
