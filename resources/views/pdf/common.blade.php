<x-certificate-print-layout :application="$application">
    
    <p>تاريخ الطباعة : {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>

</x-certificate-print-layout>