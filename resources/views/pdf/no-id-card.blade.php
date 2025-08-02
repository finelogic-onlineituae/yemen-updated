<x-certificate-print-layout :application="$application">
    <table style="text-align:left; border:1px solid" >
        <tr><th>اسم مقدم الطلب</th><td>{{ $application->formable->name }}</td></tr>
        <tr><th>رقم الهاتف المحمول</th><td>{{ $application->formable->phone_number }}</td></tr>
        <tr><th>رقم الهوية الإماراتية</th><td>{{ $application->formable->emirates_id }}</td></tr>
        <tr><th>يتم تقديم هذه المعلومات إلى </th><td>{{ $application->formable->submitted_to }}</td></tr>

        <tr><th>صدر بتاريخ</th><td>{{ $application->formable->passport->issued_on }}</td></tr>
        <tr><th>صادرة عن</th><td>{{ $application->formable->passport->passportCenter->center_name }}</td></tr>
        <tr><th>رقم جواز السفر</th><td>{{ $application->formable->passport->passport_number }}</td></tr>

        {{-- <tr><th>Document Type</th><td>Passport</td></tr> --}}
  

    </table>
<p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
    <p style="text-align:justify;">الجمهورية اليمنية وفقًا للبيانات
تاريخ إصدار رخصة القيادة</p>
</x-certificate-print-layout> 