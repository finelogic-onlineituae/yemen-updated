<x-certificate-print-layout :application="$application">
    <table style="text-align:left; border:1px solid" >
        <tr><th>الاسم كما هو مكتوب في جواز السفر  </th><td>{{ $application->formable->name }}</td></tr>
        <tr><th>رقم الهاتف المحمول</th><td>{{ $application->formable->phone_number }}</td></tr>
        <tr><th>رقم الهوية الإماراتية</th><td>{{ $application->formable->emirates_id }}</td></tr>
        <tr><th>رقم تسجيل شهادة الميلا</th><td>{{ $application->formable->birth_certifcate_no }}</td></tr>
        <tr><th>جهة إصدار شهادة الميلاد</th><td>{{ $application->formable->birth_certifcate_issuing_authority }}</td></tr>

        <tr><th>صدر بتاريخ</th><td>{{ $application->formable->passport->issued_on }}</td></tr>
        <tr><th>صادرة عن</th><td>{{ $application->formable->passport->passportCenter->center_name }}</td></tr>
        <tr><th>رقم جواز السفر</th><td>{{ $application->formable->passport->passport_number }}</td></tr>

        <tr><th>الاسم بعد التعديل/التصحيح </th><td>{{ $application->formable->modified_name }}</td></tr>
        <tr><th>سلطة الإصدار </th><td>{{ $application->formable->modified_issued_by }}</td></tr>
        <tr><th> تاريخ الإصدار </th><td>{{ $application->formable->modified_issued_on }}</td></tr>




        {{-- <tr><th>Document Type</th><td>Passport</td></tr> --}}
  

    </table>
<p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
    <p style="text-align:justify;">الجمهورية اليمنية وفقًا للبيانات
تاريخ إصدار رخصة القيادة</p>
</x-certificate-print-layout> 