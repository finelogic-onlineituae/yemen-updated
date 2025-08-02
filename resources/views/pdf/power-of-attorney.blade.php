<x-certificate-print-layout :application="$application">
    <table style="text-align:left; border:1px solid" >
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
  

    </table>
<p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
    <p style="text-align:justify;">الجمهورية اليمنية وفقًا للبيانات
تاريخ إصدار رخصة القيادة</p>
</x-certificate-print-layout> 