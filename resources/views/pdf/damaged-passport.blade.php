<x-certificate-print-layout :application="$application">
    <table style="text-align:left; border:1px solid" >
        <tr><th> الاسم الكامل باللغة الإنجليزية</th><td>{{ $application->formable->name }}</td></tr>
        <tr><th> الاسم الكامل باللغة العربية </th><td>{{ $application->formable->name_arabic }}</td></tr>
        <tr><th>رقم الهاتف المحمول</th><td>{{ $application->formable->phone_number }}</td></tr>
        <tr><th>رقم الهوية الإماراتية</th><td>{{ $application->formable->emirates_id }}</td></tr>
        <tr><th>  مهنة</th><td>{{ $application->formable->profession }}</td></tr>
        <tr><th>  مكان الميلاد</th><td>{{ $application->formable->place_of_birth }}</td></tr>
        <tr><th>  تاريخ الميلاد</th><td>{{ $application->formable->date_of_birth }}</td></tr>
        <tr><th>  القريب في الإمارات العربية المتحدة</th><td>{{ $application->formable->relative_in_uae }}</td></tr>
        <tr><th> رقم هاتف أحد الأقارب في الإمارات العربية المتحدة</th><td>{{ $application->formable->relative_in_uae_number }}</td></tr>
        <tr><th>  القريب في اليمن</th><td>{{ $application->formable->relative_in_yemen }}</td></tr>
        <tr><th> رقم هاتف أحد الأقارب في اليمن</th><td>{{ $application->formable->relative_in_yemen_number }}</td></tr>
        <tr><th> عنوان التسليم</th><td>{{ $application->formable->address }}</td></tr>

        <tr><th>صدر بتاريخ</th><td>{{ $application->formable->passport->issued_on }}</td></tr>
        <tr><th>صادرة عن</th><td>{{ $application->formable->passport->issued_by }}</td></tr>
        <tr><th>تنتهي صلاحيته</th><td>{{ $application->formable->passport->expires_on }}</td></tr>
        <tr><th>رقم جواز السفر</th><td>{{ $application->formable->passport->passport_number }}</td></tr>

        {{-- <tr><th>Document Type</th><td>Passport</td></tr> --}}
  

    </table>
    <p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
    <p style="text-align:justify;">الجمهورية اليمنية وفقًا للبيانات
تاريخ إصدار رخصة القيادة</p>
</x-certificate-print-layout> 