<x-certificate-print-layout :application="$application">
    <table style="text-align:left; border:1px solid" >
        <tr><th>اسم الزوج</th><td>{{ $application->formable->husband_name }}</td></tr>
        <tr><th>هوية الزوج الإماراتي </th><td>{{ $application->formable->husband_emirates_id }}</td></tr>
        <tr><th>رقم جواز سفر الزوج </th><td>{{ $application->formable->husbandPassport->passport_number }}</td></tr>
        <tr><th>جواز سفر الزوج صادر في  </th><td>{{ $application->formable->husbandPassport->issued_on }}</td></tr>
        <tr><th>جواز سفر الزوج صادر في  </th><td>{{ $application->formable->husbandPassport->passportCenter->center_name }}</td></tr>

        <tr><th>اسم الزوجة</th><td>{{ $application->formable->wife_name }}</td></tr>
        <tr><th>بطاقة هوية الزوجة الإماراتية </th><td>{{ $application->formable->wife_emirates_id }}</td></tr>
        <tr><th>رقم جواز سفر الزوجة  </th><td>{{ $application->formable->wifePassport->passport_number }}</td></tr>
        <tr><th>جواز سفر الزوجة صادر في </th><td>{{ $application->formable->wifePassport->issued_on }}</td></tr>
        <tr><th>جواز سفر الزوجة صادر في  </th><td>{{ $application->formable->wifePassport->passportCenter->center_name }}</td></tr>

        <tr><th>رقم المحمول</th><td>{{ $application->formable->phone_number }}</td></tr>
        <tr><th> جهة إصدار عقد الزواج</th><td>{{ $application->formable->contract_issued_by }}</td></tr>
        <tr><th>تم إصدار عقد الزواج في</th><td>{{ $application->formable->contract_issued_on }}</td></tr>
        <tr><th> رقم التسجيل</th><td>{{ $application->formable->registration_number }}</td></tr>
        <tr><th> تاريخ الزواج </th><td>{{ $application->formable->date_of_marriage }}</td></tr>

        {{-- <tr><th>Document Type</th><td>Passport</td></tr> --}}
  

    </table>
   <p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
    <p style="text-align:justify;">الجمهورية اليمنية وفقًا للبيانات
تاريخ إصدار رخصة القيادة</p>
</x-certificate-print-layout> 