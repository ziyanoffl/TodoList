<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class TodoListController extends Controller
{
    //
    public function index()
    {
        // return view('welcome', ['listItems' => ListItem::where('is_complete',0)->get()]);

        $listItems = ListItem::where('is_complete', 0)->get();

        return view('welcome', compact('listItems'));
    }


    public function saveItem(Request $request)
    {
        Log::info(json_encode($request->all()));

        $newListItem = new ListItem();
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = 0;
        $newListItem->save();

        // return view('welcome', ['listItems' => ListItem::all()]);

        return redirect('/');
    }

    public function markComplete($id)
    {
        Log::info(\json_encode($id));
        $listItem = ListItem::find($id);
        $listItem->is_complete = 1;
        $listItem->save();

        return redirect('/');
    }
}
