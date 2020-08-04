<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\Contact\ContactUpdateFormRequest;
use App\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:creator','permission:create contacts'])->except('index', 'allContact');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $religions = Religion::latest('updated_at')->get();
        return view('contacts.create', [
            'religions' => $religions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:contacts',
            'phone' => 'required',
            'email' => 'required|email|unique:contacts',
            'religion' => 'required',
        ]);
        $religion = Religion::find($request->religion);
        // $religion_name =$religion->name; //errors in create()
        // $data = [];
        // array_push($data, $request->name);
        // array_push($data, $request->email);
        // array_push($data, $request->phone);
        // array_push($data, $religion_name);
        // // return response([
        // //     $data
        // // ]);

        if($validator->passes())
        {
            // $check = count(Contact::where('name', $request->name)->orWhere('email', $request->email)->get());
            // if($check)
            // {
                // return response([
                //     "Model Errors" => "Name or Email is already existed!"
                // ]);
            // }
            // else
            // {
                Contact::create(['name'=>$request->name, 'email'=> $request->email, 'phone'=> $request->phone, 'religion'=> $religion->name]);
                return response([
                    'url' => url('/contacts'),
                    // 'sucess' => 'The religion was updated successfully!'
                ])->cookie('success', 'The contact was created successfully', 1);
            // }
        }
        else 
        {
            return response([
                'errors' => $validator->errors()->messages()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', [
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:contacts,name,'.$contact->id,
            'phone' => 'required',
            'email' => 'required|email|unique:contacts,email,'.$contact->id,
            'religion' => 'required',
        ]);

        if($validator->passes()){
            $contact->update($request->all());
            return response([
                'url' => url('/contacts'),
                'sucess' => 'The contact was updated successfully!'
            ])->cookie('success', 'The contact was edited successfully', 1);
            // return redirect()->action('contacts.index');
        }
        else 
        {
            // session()->flash('success_message', 'Quantity was updated successfully!');
            return response([
                'errors' => $validator->errors()->messages()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $name = $contact->name;
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'This ' . $name . ' was deleted successfully!');
    }

    public function allContact()
    {
        // return 'hello';
        $contact = Contact::all();
        // return 'Hello';
        return response([
            'contact' => $contact
        ]);
    }
}
