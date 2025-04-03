<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('sale')->orderBy('created_at', 'desc')->get();
        return view('payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'total' => 'required|numeric',
            'payment_method' => 'required|in:cash,card,ewallet',
        ]);

        DB::beginTransaction();
        try {
            Payment::create([
                'sale_id' => $request->sale_id,
                'total' => $request->total,
                'payment_method' => $request->payment_method,
            ]);

            DB::commit();
            return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
