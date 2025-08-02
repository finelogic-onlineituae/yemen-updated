
  {{-- @include('certificate.header') --}}
@extends('certificate.layout')
  @section('content')
 <h1 class="text-center">Verified Details</h1>
   <table class="text-center table table-striped table-bordered">
                <thead>
                  
        <tr><th> Certificate Number</th><td>{{ $application->certificate_number }}</td></tr>
        <tr><th> Certificate Issued On</th><td>{{ $application->certificate_issued_on	 }}</td></tr>
        <tr><th> Name</th><td>{{ $application->applicant->name	 }}</td></tr>
        <tr><th>Application Type  </th><td>{{ $application->form_type->application_name_arabic ?  $application->form_type->application_name_arabic : $application->form_type->application_name }}</td></tr>

       
                </thead>
    </table>

  <p style="text-align:justify;">Certificate issued by Embassy of
the Republic of Yemen
in the United Arab Emirates</p>
{{-- <div class="text-center">
<a  href="https://yemenembassyadmin.finelogic.in/print-certificate?application_id={{obfuscate_id($application->id)}}&type=d"><button class="btn btn-sm btn-primary">Download</button></a>
</div> --}}
@endsection
{{-- @include('certificate.footer') --}}