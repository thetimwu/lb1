<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewUserMail;
use App\Events\NewCustomerHasRegisteredEvent;
use Intervention\Image\Facades\Image;

class CustomersController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth')->except(['index']);
        $this->middleware('auth');
    }

    public function index() {

        //$customers = Customer::all();

        $customers = Customer::with('company')->paginate(5);

        // $activeCustomers = Customer::active()->get();
        // $inactiveCustomers = Customer::inactive()->get();
        
        //$customers = Customer::all();

        //dd($activeCustomers);

        //dd($customers);

        return view('customers.index', compact('customers'));
    }

    public function create(){
        $companies = Company::all();
        $customer = new Customer();

        return view('customers.create', compact('companies', 'customer'));
    }

    public function store() {

        $this->authorize('create', Customer::class);
        //dd($data);
        $customer = Customer::create($this->validateRequest());
        //$customer = new Customer();
        // $customer->name = request('name');
        // $customer->email = request('email');
        // $customer->active = request('active');
        // $customer->save();
        // return back();
        //dd(request('name'));

        $this->storeImage($customer);

        event(new NewCustomerHasRegisteredEvent($customer));
        

        // Register to Newsletter
        //dump('Registered to newsletter');

        // Slack notification to Admin
        //dump('Slack message here');

        //return back();
        return redirect('customers');
    }

    public function show(Customer $customer) {
       // $customer = Customer::where('id',$id)->firstOrFail();
        //dd($customer);
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer) {
        $companies = Company::all();
        return view('customers.edit', compact('customer', 'companies'));
    }

    public function update(Customer $customer) {
     
        $customer->update($this->validateRequest());

        $this->storeImage($customer);

        return redirect('customers/' . $customer->id);
    }

    private function validateRequest() {
        return tap(request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required',
            'company_id' => 'required',
        ]), function() {
            if (request()->hasFile('image')) {
                request()->validate([
                    'image' => 'file|image|max:5000',
                ]);
            }
        });

        //  $validatedData = request()->validate([
        //     'name' => 'required|min:3',
        //     'email' => 'required|email',
        //     'active' => 'required',
        //     'company_id' => 'required',
        // ]);  

        // if (request()->hasFile('image')) {
        //     request()->validate([
        //         'image' => 'file|image|max:5000',
        //     ]);
        // }

        // return $validatedData;
    }

    private function storeImage($customer)
    {
        if (request()->has('image'))
        {
            $customer->update([
                'image' => request()->image->store('uploads', 'public'),            
            ]);

            // composer require intervention/image
            $image = Image::make(public_path('storage/' . $customer->image))->fit(300, 300);
            $image->save();
        }
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);
        //dd($customer);
        $customer->delete();

        return redirect('customers');
    }
}
