<x-p-d-f-layout :application="$application">
    <h2>Application data for will appear here soon!</h2>
<table>
    <tr><td style="text-align:right;">Application Id</td><td>:{{ $application->id }}</td></tr>
    <tr><td style="text-align:right;">Applicationt Name</td><td>:{{ $application->formable->name }}</td></tr>
    <tr><td style="text-align:right;">Applicationt Mobile Number</td><td>:{{ $application->formable->phone_number }}</td></tr>
</table>

<h2>Embassy of Yemen in UAE</h2>
</x-p-d-f-layout>