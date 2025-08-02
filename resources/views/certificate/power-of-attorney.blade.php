@extends('certificate.layout')
  @section('content')
 <h1 class="text-center">{{ $application->form_type->application_name_arabic ?  $application->form_type->application_name_arabic : $application->form_type->application_name}}</h1>
   <table class="text-center table table-striped table-bordered">
                <thead>
        <tr><th>اسم مقدم الطلب</th><td>{{ $application->formable->name }}</td></tr>
        <tr><th>رقم الهاتف المحمول</th><td>{{ $application->formable->phone_number }}</td></tr>
        <tr><th>رقم الهوية الإماراتية</th><td>{{ $application->formable->emirate_id }}</td></tr>

        <tr><th>صدر بتاريخ</th><td>{{ $application->formable->clientPassport->issued_on }}</td></tr>
        <tr><th>صادرة عن</th><td>{{ $application->formable->clientPassport->passportCenter->center_name }}</td></tr>
        <tr><th>رقم جواز السفر</th><td>{{ $application->formable->clientPassport->passport_number }}</td></tr>

        <tr><th>  اسم الوكيل</th><td>{{ $application->formable->agent_name }}</td></tr>
         <tr><th>جواز سفر الوكيل </th><td>{{ $application->formable->agentPassport->issued_on }}</td></tr>
        <tr><th>تنتهي صلاحيته</th><td>{{ $application->formable->agentPassport->expires_on }}</td></tr>
        <tr><th> جواز سفر الوكيل صادر في</th><td>{{ $application->formable->agentPassport->passportCenter->center_name }}</td></tr>
        <tr><th> رقم جواز سفر الوكيل</th><td>{{ $application->formable->agentPassport->passport_number }}</td></tr>
        <tr><th> غرض الوكالة</th><td>{{ $application->formable->purpose }}</td></tr>

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