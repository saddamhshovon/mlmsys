@extends('member.layouts.app')

@section('title', 'Add Fund Request')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Fund Request</h1>
</div>

<div class="row">
    <div class="col-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form>
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                            <input type="Number" name="amount" class="form-control" id="amount" placeholder="1000">
                        </div>
                        <div class="mb-3">
                            <label for="mobile_banking_system" class="form-label">Mobile Banking<span class="text-danger">*</span></label>
                            <select class="form-control form-control-md" id="mobile_banking_system" name="mobile_banking_system">
                                <option value="" selected="" disabled="">Select</option>
                                <option value="Bkash">Bkash</option>
                                <option value="Nagad">Nagad</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="trx_id" class="form-label">Transaction ID<span class="text-danger">*</span></label>
                            <input type="text" name="trx_id" class="form-control" id="trx_id">
                        </div>
                        <div class="mb-3">
                            <label for="pin" class="form-label">Pin Code<span class="text-danger">*</span></label>
                            <input type="password" name="pin" class="form-control" id="pin">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-rounded btn-primary">Request</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection