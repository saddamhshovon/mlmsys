@extends('admin.layouts.app')

@section('title', 'Search Between Dates')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->

<div>
   <div class="container-fluid">
      <!-- <h3>Search Between Two Dates</h3> -->
      <a href="{{route('member.all')}}"><button class="btn btn-primary mb-2">Back To All Members</button></a>
      <br>
      <div class="row input-daterange">
         <div class="col-md-4" style="display:inline-block;">
            <input type="text" name="from_date" id="from_date" class="form-control" style="cursor:pointer;" readonly placeholder="From Date: 2000-01-31" />
         </div>
         <div class="col-md-4" style="display:inline-block;">
            <input type="text" name="to_date" id="to_date" class="form-control" style="cursor:pointer;" readonly placeholder="To Date: 2090-02-28" />
         </div>
         <div class="col-md-4">
            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
            <button type="button" name="refresh" id="refresh" class="btn btn-dark">Refresh</button>
         </div>
      </div>
      <br />
      <div class="table-responsive">
         <table class="table table-bordered table-striped" id="member_table">
            <thead>
               <tr>
                  <th>NO</th>
                  <th>Username</th>
                  <th>City</th>
                  <th>Country</th>
                  <th>Balance</th>
                  <th>Mobile Banking</th>
                  <th>Date</th>
               </tr>
            </thead>
            <tbody>
            </tbody>
         </table>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
      $('.input-daterange').datepicker({
         todayBtn: 'linked',
         format: 'yyyy-mm-dd',
         autoclose: true
      });

      load_data();

      function load_data(from_date = '', to_date = '') {
         $('#member_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
               url: '{{ route("daterange.index") }}',
               data: {
                  from_date: from_date,
                  to_date: to_date
               }
            },
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex'
               },
               {
                  data: 'user_name',
                  name: 'user_name'
               },
               {
                  data: 'city',
                  name: 'city'
               },
               {
                  data: 'country',
                  name: 'country'
               },
               {
                  data: 'account_balance',
                  name: 'account_balance'
               },
               {
                  data: 'mobile_banking_service',
                  name: 'mobile_banking_service'
               },
               {
                  data: 'created_at',
                  name: 'created_at'
               }
            ]
         });
      }

      $('#filter').click(function() {
         var from_date = $('#from_date').val();
         var to_date = $('#to_date').val();
         if (from_date != '' && to_date != '') {
            $('#member_table').DataTable().destroy();
            load_data(from_date, to_date);
         } else {
            alert('Both Date is required');
         }
      });

      $('#refresh').click(function() {
         $('#from_date').val('');
         $('#to_date').val('');
         $('#member_table').DataTable().destroy();
         load_data();
      });

   });
</script>


@endsection