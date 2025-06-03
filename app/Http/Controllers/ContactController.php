<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleException;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use SimpleXMLElement;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->initDataTable();
        } else {
            return view('pages.contact.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        try {

            $data = [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
            ];

            Contact::create($data);
            return redirect()->route('contacts.index')->with('success', 'Contact create successfully');
        } catch (Exception $e) {
            throw new HandleException('Failed to create record.', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::find($id);
        return view('pages.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        try {
            // Get the validated input data
            $contactData = $request->only(['name', 'email', 'phone']);
            $contact->update($contactData);

            return redirect()->route('contacts.index')->with('success', 'Contact updated successfully');
        } catch (Exception $e) {
            throw new HandleException('Failed to update contact.', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try{
            // Delete the contact record
            $contact->delete();
            return response()->json(['status'=>'success', 'message' => 'Contact deleted successfully.']);
        }catch(Exception $e){
            return response()->json(['status'=>'failure', 'message'=>"Something went wrong"], 500);
        }
    }

    public function importFile(Request $request){

        try{
            $filePath = $request->file;
            
            $xmlContent = file_get_contents($filePath);
            $xml = new SimpleXMLElement($xmlContent);
            $contactData = [];
            foreach ($xml->contact as $record) {
               
                $contactData[] = [
                    "name" => (string) $record->name,
                    "phone" => $record->phone,
                    "created_at" => now()
                ];
            }
            
            Contact::insert($contactData);
            session()->flash('success', 'File data imported sucessfully');
            return response()->json(['status'=>true]);

        }catch(Exception $e){
            Log::info($e->getMessage());
            return response()->json(['status'=>'failure', 'message'=>"Something went wrong"], 500);
        }
    }

    public function initDataTable()
    {

        $data = Contact::query();

        return DataTables::of($data)
            ->filter(function ($query) {

                //search
                $query->where(function ($query) {
                    if (request()->has('search') && !empty(request()->has('search')) && request()->search != null) {
                        $query->where('name', 'like', "%" . request('search') . "%");
                    }
                });
            })
            ->addColumn('name', function ($data) {
                return '<div class="w-300px">' . $data->name . '</div>';
            })

            ->addColumn('action', function ($data) {

                $action = view('pages.contact.action', ['data' => $data])->render();
                return $action;
            })
            ->editColumn('created_at', function ($data) {
                return date('d-m-Y', strtotime($data->created_at));
            })
            ->rawColumns(['name', 'action', 'created_at'])
            ->make(true);
    }
}
