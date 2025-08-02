<x-certificate-print-layout :application="$application">
    <table style="text-align:left; border:1px solid" >
        <tr><th>اسم مقدم الطلب</th><td>{{ $application->formable->name }}</td></tr>
        <tr><th>  جنسية </th><td>{{ $application->formable->nationality }}</td></tr>
        <tr><th>  دِين </th><td>{{ $application->formable->religion }}</td></tr>
        <tr><th>  مكان الميلاد </th><td>{{ $application->formable->place_of_birth }}</td></tr>
        <tr><th>  تاريخ الميلاد </th><td>{{ $application->formable->date_of_birth }}</td></tr>
        <tr><th>  مكان العمل </th><td>{{ $application->formable->place_of_work }}</td></tr>

        <tr><th>  مهنة  </th><td>{{ $application->formable->proffession }}</td></tr>
        <tr><th>  العنوان في الإمارات العربية المتحدة  </th><td>{{ $application->formable->address_uae }}</td></tr>
        <tr><th>العنوان الدائم    </th><td>{{ $application->formable->permanent_address }}</td></tr>
        <tr><th>  غرض السفر إلى الجمهورية اليمنية  </th><td>{{ $application->formable->purpose_of_travel }}</td></tr>
        <tr><th> الفترة المطلوبة (بالأيام)   </th><td>{{ $application->formable->period_required }}</td></tr>
        <tr><th>   العنوان في الجمهورية اليمنية </th><td>{{ $application->formable->address_in_roy }}</td></tr>
        <tr><th> اسم الكفيل ١ </th><td>{{ $application->formable->sponsor_1_name }}</td></tr>
        <tr><th>  عنوان الكفيل ١ </th><td>{{ $application->formable->sponsor_1_address }}</td></tr>
        @if($application->formable->sponsor_2_name)
        <tr><th> اسم الكفيل ٢ </th><td>{{ $application->formable->sponsor_2_name }}</td></tr>
        @endif
        @if($application->formable->sponsor_2_address)
        <tr><th>  عنوان الكفيل ٢ </th><td>{{ $application->formable->sponsor_2_address }}</td></tr>
        @endif
        @if($application->formable->previous_visit_date_1 && $application->formable->previous_visit_date_2)
        <tr><th> تواريخ الزيارة السابقة للجمهورية اليمنية (إن وجدت)   </th><td>{{ $application->formable->previous_visit_date_1 }} - {{ $application->formable->previous_visit_date_2 }}</td></tr>
        @endif

        <tr><th>صدر بتاريخ</th><td>{{ $application->formable->passport->issued_on }}</td></tr>
        <tr><th>تنتهي صلاحيته</th><td>{{ $application->formable->passport->expires_on }}</td></tr>
        <tr><th>صادرة عن</th><td>{{ $application->formable->passport->issued_by }}</td></tr>
        <tr><th>رقم جواز السفر</th><td>{{ $application->formable->passport->passport_number }}</td></tr>
        {{-- <tr><th>Document Type</th><td>Passport</td></tr> --}}
    </table>

@if(count($application->formable->AccompanyMembers)>0)
        <h5 style="text-align: center">معلومات الأعضاء</h5>
  
                 <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                           <th scope="col">لا</th>
                                                            <th scope="col">اسم</th>
                                                            <th scope="col">رقم الهوية الإماراتية</th>

                                                            <th scope="col">صدر بتاريخ</th>
                                                            <th scope="col">رقم جواز سفر </th>
                                                            <th scope="col">تنتهي صلاحيته</th>

                                                            <th scope="col">مركز الجوازات</th>
                                                          
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($application->formable->AccompanyMembers as $index => $familyMember)

                                                            <tr>
                                                                <th scope="row">{{ $index + 1 }}</th>
                                                                <td>{{ $familyMember->name }}</td>
                                                                <td>{{ $familyMember->emirates_id }}</td>

                                                                <td>{{ $familyMember->passport->issued_on }}</td>

                                                                <td>{{ $familyMember->passport->passport_number }}</td>
                                                                <td>{{ $familyMember->passport->expires_on }}</td>

                                                                <td>{{ $familyMember->passport->Country->country_name }}</td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                     </table>             
@endif
  
    <p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
    <p style="text-align:justify;">الجمهورية اليمنية وفقًا للبيانات
تاريخ إصدار رخصة القيادة</p>
</x-certificate-print-layout> 