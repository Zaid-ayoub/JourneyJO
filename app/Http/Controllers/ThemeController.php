<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\Output\Theme;
use Termwind\Components\Dd;
use App\Http\Requests\StoreContactRequest;
use App\Models\category;
use App\Models\Contact;

class ThemeController extends Controller
{
    public function about(){
        return view('theme.about');
    }
    public function services(){
        return view('theme.services');
    }
    public function contact(){
        //create in normal way
        // $contact = new Contact();
        // $contact->first_name = 'Zaid3';
        // $contact->last_name = 'Ayoub3';
        // $contact->email = 'zaid3@gmail.com';
        // $contact->message = 'This is Zaid\'s message';
        // $contact->save();


        //Create on fillable way
        // Contact::create([
        //     'first_name' => 'Zaid4',
        //     'last_name' => 'Ayoub4',
        //     'email' => 'zaid4@gmail.com',
        //     'message' => 'this Zaid4 message'
        // ]);


        //edit in normal way
        // $contact = Contact::find(4);
        // $contact->first_name = 'Husam1';
        // $contact->last_name = 'Ayoub1';
        // $contact->email = 'husam1@gmail.com';
        // $contact->message = 'this is husam\'s message';
        // $contact->save();

        //edit in fillable way
        // $contact = Contact::find(5);
        // $contact->update([
        //     'first_name' => 'Husam2',
        //     'last_name' => 'Ayoub2',
        //     'email' => 'husam2@gmail.com',
        //     'message' => 'this husam2 message'
        // ]);

        //delete record
        // $contact = Contact::find(6);
        // $contact->delete();
        
        // dd('deleted 2 successfully');

        $categories = Category::all();
        return view('theme.contact', compact('categories'));
        // $data = Contact::where('first_name','=','zaid')->get();
    }
    public function store(StoreContactRequest $request){
        $validatedData = $request->validated();

        // $validatedData = $request->validate([
        //     'fname'=>'required|string|min:5',
        //     'lname'=>'required|string|min:5',
        //     'email'=>'required|email|min:5',
        //     'message'=>'nullable'
        // ], [
        //     'fname.required' => 'please fill first name field',
        //     'lname.required' => 'please fill last name field',
        //     'email.required' => 'please fill email field',
        // ]);
        
        Contact::create($validatedData);

        return back()->with('status', 'Your massage has been sent successfully!');
    }
    public function display(){
        $data = Contact::paginate(4);
        return view('theme.display-contacts', compact('data'));
    }
}