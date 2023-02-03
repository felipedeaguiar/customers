<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\File;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(Customer::with('files')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();

        $customer->fill($request->all());

        if (!$request->get('files') || !array_key_exists('id', $request->get('files')[0])) {
            return $this->error(['File is required'], 400);
        }

        $file = File::find($request->get('files')[0]['id']);

        if (!$file) {
            return $this->error(['File not found'], 404);
        }

        if (!$customer->save()) {
            return $this->error($customer->errors, 400);
        }

        $customer->files()->attach($file->id);

        return $this->success($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::with('files')->find($id);

        if (!$customer) {
            return $this->error(['Customer not found'], 404);
        }

        return $this->success($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::with('files')->find($id);

        if (!$customer) {
            return $this->error(['Customer not found'], 404);
        }


        if (!$request->get('files') || !array_key_exists('id', $request->get('files')[0])) {
            return $this->error(['File is required'], 400);
        }

        $file = File::find($request->get('files')[0]['id']);

        $customer->fill($request->all());

        if (!$customer->update()) {
            return $this->error($customer->errors, 400);
        }

        $customer->files()->sync([$file->id]);

        return $this->success($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return $this->error(['Customer not found'], 404);
        }

        $customer->files()->detach();
        $customer->delete();

        return $this->success([], 201);
    }
}
