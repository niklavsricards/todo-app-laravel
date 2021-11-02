<?php

namespace App\Http\Controllers;

use App\Models\ToDoItem;
use Illuminate\Http\Request;

class ToDoItemController extends Controller
{
    public function index()
    {
        $todoitems = ToDoItem::all();
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

        ToDoItem::create($request->all());

        return redirect()->route('todoitems.index');
    }

    public function edit(ToDoItem $toDoItem)
    {
        return view('todoitems.edit', compact('toDoItem'));
    }

    public function update(Request $request, ToDoItem $toDoItem)
    {
        $request->validate([
            'title' => ['required', 'max:255']
        ]);

        $toDoItem->update($request->all());

        return redirect()->route('todoitems.index');
    }

    public function destroy(ToDoItem $toDoItem)
    {
        dd($toDoItem);
        $toDoItem->delete();
        return redirect()->route('todoitems.index');
    }
}
