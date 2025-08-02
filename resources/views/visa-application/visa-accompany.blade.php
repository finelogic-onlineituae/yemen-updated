<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center">Accompany Details</h2>
    <livewire:application-visa-accompany :application-id="$application_id"/>


</x-app-layout>


<script>
    Livewire.on('submitVisaApplicationAccompanyForm', () => {
        document.getElementById('visa-application-accompany-form').submit();
    });
</script>

<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
  document.getElementById('issued_on').setAttribute('max', today);
 // document.getElementById('beneficiary_issued_on').setAttribute('max', today);


  
</script>

