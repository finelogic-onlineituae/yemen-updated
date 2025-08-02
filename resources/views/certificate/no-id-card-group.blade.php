@extends('certificate.layout')
  @section('content')
 <h1 class="text-center">{{ $application->form_type->application_name_arabic ?  $application->form_type->application_name_arabic : $application->form_type->application_name}}</h1>
   <table class="text-center table table-striped table-bordered">
                <thead>
                                                        <tr>
                                                            <th scope="col">لا</th>
                                                            <th scope="col">اسم</th>
                                                            <th scope="col">اسم</th>

                                                            <th scope="col">صدر بتاريخ</th>
                                                            <th scope="col">رقم جواز سفر </th>
                                                            <th scope="col">رقم التليفون</th>
                                                            <th scope="col">مركز الجوازات</th>
                                                            <th scope="col"> يتم تقديم هذه المعلومات إلى</th>

                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($application->formable->familyMembers as $index => $familyMember)
                                                            <tr>
                                                                <th scope="row">{{ $index + 1 }}</th>
                                                                <td>{{ $familyMember->name }}</td>
                                                                <td>{{ $familyMember->emirates_id }}</td>
                                                                <td>{{ $familyMember->passport->issued_on }}</td>
                                                                <td>{{ $familyMember->passport->passport_number }}</td>
                                                                <td>{{ $familyMember->phone_number }}</td>
                                                                <td>{{ $familyMember->passport->passportCenter->center_name }}</td>
                                                                <td>{{ $familyMember->submitted_to }}</td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
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