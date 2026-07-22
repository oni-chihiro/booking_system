<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function show($step, $customerName = null)
    {
        // Prevent skipping steps
        if($step == 2 && !session()->has('customer_name')){
            return redirect('/sales/step/1')
                ->with('error', 'Complete Step 1 first.');
        }

        if($step == 3 && !session()->has('product')){
            return redirect('/sales/step/2')
                ->with('error', 'Complete Step 2 first.');
        }

        return view("sales.step{$step}", compact('customerName'));
    }

    public function store(Request $request, $step)
    {
        // STEP 1
        if($step == 1){

            $request->validate([
                'customer_name' => 'required',
                'booking_id' => 'required|alpha_num|size:8',
                'room_name' => 'required|min:5',
                'number_of_person' => 'required|integer|min:1|max:50',
            ],[
                'customer_name.required' => 'Customer name is required.',

                'booking_id.required' => 'Booking ID is required.',
                'booking_id.alpha_num' => 'Booking ID must contain only letters and numbers.',
                'booking_id.size' => 'Booking ID must be exactly 8 characters.',

                'room_name.required' => 'Room name is required.',
                'room_name.min' => 'Room name must be at least 5 characters.',

                'number_of_person.required' => 'Number of person is required.',
                'number_of_person.integer' => 'Number of person must be a number.',
                'number_of_person.min' => 'Number of person must be at least 1.',
                'number_of_person.max' => 'Number of person cannot exceed 50.',
            ]);

            session([
                'customer_name' => $request->customer_name,
                'booking_id' => $request->booking_id,
                'room_name' => $request->room_name,
                'number_of_person' => $request->number_of_person,
            ]);

            return redirect('/sales/step/2');
        }

        // STEP 2
        if($step == 2){

            $request->validate([
                'product' => 'required',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:1'
            ]);

            $total = $request->quantity * $request->price;

            session([
                'product' => $request->product,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total' => $total
            ]);

            return redirect('/sales/step/3');
        }

        // STEP 3
        if($step == 3){

            $request->validate([
                'documents.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048'
            ]);

            $uploadedFiles = [];

            if($request->hasFile('documents')){
                foreach($request->file('documents') as $file){
                    $path = $file->store('uploads', 'public');
                    $uploadedFiles[] = $path;
                }
            }

            session([
                'documents' => $uploadedFiles,
                'submitted_at' => now()->format('F d, Y h:i A'),
                'transaction_no' => 'TXN-' . rand(10000, 99999)
            ]);

            return redirect('/sales/summary')
                ->with('success', 'Booking submitted successfully!');
        }
    }

    public function summary()
    {
        if(!session()->has('documents')){
            return redirect('/sales/step/1');
        }

        return view('sales.summary');
    }
}