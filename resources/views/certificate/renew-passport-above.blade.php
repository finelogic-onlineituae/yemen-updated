@extends('certificate.layout')
  @section('content')
 <h1 class="text-center">{{ $application->form_type->application_name_arabic ?  $application->form_type->application_name_arabic : $application->form_type->application_name}}</h1>
   <table class="text-center table table-striped table-bordered">
                <thead>
        <tr><th>اسم مقدم الطلب</th><td>{{ $application->formable->name }}</td></tr>
        <tr><th>رقم الهاتف المحمول</th><td>{{ $application->formable->phone_number }}</td></tr>
        <tr><th>رقم الهوية الإماراتية</th><td>{{ $application->formable->emirates_id }}</td></tr>
        <tr><th>   حامل جواز السفر للوالد الحالي </th><td>{{ $application->formable->present_passholder }}</td></tr>

        <tr><th>صدر بتاريخ</th><td>{{ $application->formable->passport->issued_on }}</td></tr>
        <tr><th>صادرة عن</th><td>{{ $application->formable->passport->passportCenter->center_name }}</td></tr>
        <tr><th>رقم جواز السفر</th><td>{{ $application->formable->passport->passport_number }}</td></tr>

        {{-- <tr><th>Document Type</th><td>Passport</td></tr> --}}
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