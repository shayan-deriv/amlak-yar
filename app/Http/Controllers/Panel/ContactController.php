<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if($request->name){
            $query->where('name','like',"%$request->name%");
        }

        if($request->phones){
            $query->where('phones','like',"%$request->phones%");
        }

        $model = $query->orderByDesc('created_at')->paginate(50);
        $model->appends($request->except('page'));
        return view('panel.admin.contacts.index', compact('model'));
    }

    public function create()
    {
        return view('panel.admin.contacts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phones' => 'required',
        ]);
        
        Contact::create($request->all());

        return redirect()->route('contacts.index');
    }

    public function edit($contact)
    {
        $model = Contact::findOrFail($contact);
        return view('panel.admin.contacts.edit', compact('model'));
    }

    public function update(Request $request, $contact){
        $this->validate($request, [
            'name' => 'required',
            'phones' => 'required',
        ]);
        
        Contact::where('id',$contact)->update($request->except(['_token','_method']));

        return redirect()->route('contacts.index');
    }

    public function delete(Request $request){
        
        Contact::where('id',$request->id)->delete();

        return redirect()->route('contacts.index');
    }
}
