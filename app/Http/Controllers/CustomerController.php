<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:150|unique:customers,email',
            'phone'         => 'required|string|max:20|unique:customers,phone',
            'address'       => 'nullable|string',
            'is_member'     => 'nullable|boolean',
            'member_number' => 'nullable|string|unique:customers,member_number',
        ]);

        $data = $request->all();
        $data['is_member'] = $request->has('is_member') ? true : false;

        if ($data['is_member'] && empty($data['member_number'])) {
            $data['member_number'] = 'MBR' . strtoupper(uniqid());
        }

        Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:150|unique:customers,email,' . $customer->id,
            'phone'         => 'required|string|max:20|unique:customers,phone,' . $customer->id,
            'address'       => 'nullable|string',
            'is_member'     => 'nullable|boolean',
            'member_number' => 'nullable|string|unique:customers,member_number,' . $customer->id,
        ]);

        $data = $request->all();
        $data['is_member'] = $request->has('is_member') ? true : false;

        if ($data['is_member'] && empty($data['member_number'])) {
            $data['member_number'] = 'MBR' . strtoupper(uniqid());
        }

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Customer berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus.');
    }
}
