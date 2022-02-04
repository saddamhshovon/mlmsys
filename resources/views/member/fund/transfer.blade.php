@extends('member.layouts.app')

@section('title', 'Transfer Fund')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transfer Fund</h1>
</div>

<div class="row">
    <div class="col-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form>
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="user_name" class="form-label">User Name<span class="text-danger">*</span></label>
                            <input type="text" name="user_name" class="form-control" id="product_name" placeholder="username">
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                            <input type="Number" name="amount" class="form-control" id="amount" placeholder="1000">
                        </div>

                        <div class="mb-3">
                            <label for="pin" class="form-label">Pin Code<span class="text-danger">*</span></label>
                            <input type="password" name="pin" class="form-control" id="pin">
                        </div>
                    <div>
                        <button type="submit" class="btn btn-rounded btn-primary">Transfer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection