<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center"> شهادة عدم وجود بطاقة هوية ( عائله)</h2>
    <livewire:no-id-card-group/>


</x-app-layout>


<script>
    Livewire.on('submitNoIDCardGroupForm', () => {
//console.log('test');
     document.getElementById('no-id-card-group-form').submit();
    });
</script>

<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
 // document.getElementById('wife_issued_on').setAttribute('max', today);

  


  
</script>

