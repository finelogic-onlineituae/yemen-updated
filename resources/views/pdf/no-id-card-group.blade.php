<x-certificate-print-layout :application="$application">
   
  
                 <table class="table table-bordered">
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
                                     </table>                   
                       
<p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
    <p style="text-align:justify;">الجمهورية اليمنية وفقًا للبيانات
تاريخ إصدار رخصة القيادة</p>
</x-certificate-print-layout> 