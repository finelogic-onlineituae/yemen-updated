<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h3 class="text-success w-100 text-center">	طلب شهادة عدم وجود بطاقة هوية</h3>
    <livewire:no-id-card />


</x-app-layout>


<script>
    Livewire.on('submit-no-id-card-Form', () => {
       // console.log('test');
        document.getElementById('no-id-card-form').submit();
    });
</script>

<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
  document.getElementById('issued_on').setAttribute('max', today);
</script>

