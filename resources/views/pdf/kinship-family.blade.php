<x-certificate-print-layout :application="$application">
    <table style="text-align:left; border:1px solid" >
        <tr><th>اسم مقدم الطلب</th><td>{{ $application->formable->name }}</td></tr>
        <tr><th>رقم الهاتف المحمول</th><td>{{ $application->formable->phone_number }}</td></tr>
        <tr><th>رقم الهوية الإماراتية</th><td>{{ $application->formable->emirates_id }}</td></tr>
        <tr><th>صدر بتاريخ</th><td>{{ $application->formable->passport->issued_on }}</td></tr>
        <tr><th>صادرة عن</th><td>{{ $application->formable->passport->passportCenter->center_name }}</td></tr>
        <tr><th>رقم جواز السفر</th><td>{{ $application->formable->passport->passport_number }}</td></tr>

        {{-- <tr><th>Document Type</th><td>Passport</td></tr> --}}
        </table>
        <h5 style="text-align: center">معلومات الأعضاء</h5>
  
                 <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">لا</th>
                                                            <th scope="col">اسم</th>
                                                            <th scope="col">صدر بتاريخ</th>
                                                            <th scope="col">رقم جواز سفر </th>
                                                            <th scope="col">العلاقة</th>
                                                            <th scope="col">مركز الجوازات</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($application->formable->familyMembers as $index => $familyMember)
                                                            <tr>
                                                                <th scope="row">{{ $index + 1 }}</th>
                                                                <td>{{ $familyMember->name }}</td>
                                                                <td>{{ $familyMember->passport->issued_on }}</td>
                                                                <td>{{ $familyMember->passport->passport_number }}</td>
                                                                <td>{{ $familyMember->realtion }}</td>
                                                                <td>{{ $familyMember->passport->passportCenter->center_name }}</td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                     </table>                   
                       
     <p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
    <p style="text-align:justify;">الجمهورية اليمنية وفقًا للبيانات
تاريخ إصدار رخصة القيادة</p>
</x-certificate-print-layout> 