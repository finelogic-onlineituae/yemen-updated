<x-certificate-print-layout :application="$application">
    <table style="text-align:left; border:1px solid" >
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

    </table>
    <p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
    <p style="text-align:justify;">الجمهورية اليمنية وفقًا للبيانات
تاريخ إصدار رخصة القيادة</p>
</x-certificate-print-layout>