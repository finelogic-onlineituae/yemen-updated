@extends('certificate.layout')
  @section('content')
 <h1 class="text-center">{{ $application->form_type->application_name_arabic ?  $application->form_type->application_name_arabic : $application->form_type->application_name}}</h1>
   <table class="text-center table table-striped table-bordered">
                <thead>
        <tr><th>اسم الزوج</th><td>{{ $application->formable->husband_name }}</td></tr>
        <tr><th>Husband Emirates ID </th><td>{{ $application->formable->husband_emirates_id }}</td></tr>
        <tr><th>Husband Passport Number  </th><td>{{ $application->formable->husbandPassport->passport_number }}</td></tr>
        <tr><th>Husband Passport Issued On  </th><td>{{ $application->formable->husbandPassport->issued_on }}</td></tr>
        <tr><th>Husband Passport Issued At  </th><td>{{ $application->formable->husbandPassport->passportCenter->center_name }}</td></tr>

        <tr><th>اسم الزوجة</th><td>{{ $application->formable->wife_name }}</td></tr>
        <tr><th>Wife Emirates ID </th><td>{{ $application->formable->wife_emirates_id }}</td></tr>
        <tr><th>Wife Passport Number  </th><td>{{ $application->formable->wifePassport->passport_number }}</td></tr>
        <tr><th>Wife Passport Issued On  </th><td>{{ $application->formable->wifePassport->issued_on }}</td></tr>
        <tr><th>Wife Passport Issued At  </th><td>{{ $application->formable->wifePassport->passportCenter->center_name }}</td></tr>

        <tr><th> Phone Number</th><td>{{ $application->formable->phone_number }}</td></tr>
        <tr><th> Marriage contract issuing authority</th><td>{{ $application->formable->contract_issued_by }}</td></tr>
        <tr><th> Marriage contract issued On</th><td>{{ $application->formable->contract_issued_on }}</td></tr>
        <tr><th> Registration Number</th><td>{{ $application->formable->registration_number }}</td></tr>
        <tr><th> Date of Marriage </th><td>{{ $application->formable->date_of_marriage }}</td></tr>

        <tr><th>Document Type</th><td>Passport</td></tr>
                </thead>

    </table>
     <h6>Signature</h6>
    <img src="{{ asset('storage/'.$application->signature) }}" style="width:150px; margin-bottom: 20px;"/>
  <p style="text-align:justify;">Certificate issued by Embassy of
the Republic of Yemen
in the United Arab Emirates</p>
<div class="text-center">
<a  href="{{url('download-application',encrypt($application->id))}}"><button class="btn btn-sm btn-primary">Download</button></a>
</div>
@endsection