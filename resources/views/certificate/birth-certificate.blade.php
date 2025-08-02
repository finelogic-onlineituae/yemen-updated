
  {{-- @include('certificate.header') --}}
@extends('certificate.layout')
  @section('content')
 <h1 class="text-center">{{ $application->form_type->application_name_arabic ?  $application->form_type->application_name_arabic : $application->form_type->application_name}}</h1>
   <table class="text-center table table-striped table-bordered">
                <thead>
                  
        <tr><th>اسم مقدم الطلب</th><td>{{ $application->formable->name }}</td></tr>
        <tr><th>رقم الهاتف المحمول</th><td>{{ $application->formable->phone_number }}</td></tr>
        <tr><th>رقم الهوية الإماراتية</th><td>{{ $application->formable->emirates_id }}</td></tr>
        <tr><th>الحالة الاجتماعية</th><td>{{ $application->formable->marital_status }}</td></tr>
        <tr><th>مكان الميلاد</th><td>{{ $application->formable->place_of_birth }}</td></tr>
        <tr><th>تاريخ الميلاد</th><td>{{ $application->formable->date_of_birth }}</td></tr>
        <tr><th>صدر بتاريخ</th><td>{{ $application->formable->passport->issued_on }}</td></tr>
        <tr><th>صادرة عن</th><td>{{ $application->formable->passport->passportCenter->center_name }}</td></tr>
        <tr><th>رقم جواز السفر</th><td>{{ $application->formable->passport->passport_number }}</td></tr>

        {{-- <tr><th>Document Type</th><td>Passport</td></tr> --}}
        <tr><th>اسم الأب</th><td>{{ $application->formable->fathers_name }}</td></tr>
        <tr><th>جواز سفر الأب صدر في</th><td>{{ $application->formable->fathers_issued_on }}</td></tr>
        <tr><th>رقم جواز سفر الأب</th><td>{{ $application->formable->fathers_passport_number }}</td></tr>
        <tr><th>جنسية الأب</th><td>{{ $application->formable->fathers_national->country_name }}</td></tr>

        <tr><th>اسم الأم</th><td>{{ $application->formable->mothers_name }}</td></tr>
        <tr><th>جواز سفر الأم صادر على</th><td>{{ $application->formable->mothers_issued_on }}</td></tr>
        <tr><th>رقم جواز سفر الأم</th><td>{{ $application->formable->mothers_passport_number }}</td></tr>
        <tr><th>جنسية الأم</th><td>{{ $application->formable->mothers_national->country_name }}</td></tr>
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
{{-- @include('certificate.footer') --}}