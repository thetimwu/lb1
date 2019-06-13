<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewUserMail;
use App\Events\NewCustomerHasRegisteredEvent;

class CustomersController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth')->except(['index']);
        $this->middleware('auth');
    }

    public function index() {

        $customers = Customer::all();
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

        //dd($data);
        $customer = Customer::create($this->validateRequest());
        //$customer = new Customer();
        // $customer->name = request('name');
        // $customer->email = request('email');
        // $customer->active = request('active');
        // $customer->save();
        // return back();
        //dd(request('name'));

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

        return redirect('customers/' . $customer->id);
    }

    private function validateRequest() {
        return request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required',
            'company_id' => 'required',
        ]);    
    }

    public function destroy(Customer $customer)
    {
        //dd($customer);
        $customer->delete();

        return redirect('customers');
    }
}
