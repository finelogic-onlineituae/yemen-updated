<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center"> شهادة عدم ممانعة </h2>
    <livewire:no-objection-certificate />


</x-app-layout>


<script>
    Livewire.on('submitNOCForm', () => {
       // console.log('test');
        document.getElementById('no-objection-certification-form').submit();
    });
</script>

<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
  document.getElementById('issued_on').setAttribute('max', today);
  document.getElementById('modified_issued_on').setAttribute('max', today);

</script>

