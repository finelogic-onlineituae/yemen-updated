<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على التأشيرة') }}
        </h2>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center">Application for Visa</h2>
    @livewire('visa-application', ['countries' => $countries])

</x-app-layout>




<script>
// Open the modal
function openModal(id) {
   // alert(id);
    console.log(document.getElementById(id));
    document.getElementById(id).style.display = "block";
}

// Close the modal
function closeModal(id) {
    document.getElementById(id).style.display = "none";
}

// Close the modal when clicking outside the content

</script>
<script>
    function toggleTextBox()
    {
        const other =     document.getElementById('issued_by_other');
        const other_text =     document.getElementById('other_text');
        
        other_text.disabled  = !other.checked;
    }

    function toggleDeclaration()
    {
        const declaration = document.getElementById("declaration");
        const confirmButton = document.getElementById("confirm");
        //console.log(confirmButton.disabled);
        confirmButton.disabled = !declaration.checked;
    }

    function toggleAddress()
    {
        const checkbox = document.getElementById("same_address");
        const address = document.getElementById("address");
        const address_uae = document.getElementById("address_uae");
        
        if(checkbox.checked){
            address_uae.value = address.value
         //  address_uae.setAttribute('readonly', true);
         address_uae.dispatchEvent(new Event('address_uae'));
        }
        else{
            address_uae.value = '';
          //  address_uae.removeAttribute('readonly');
            address_uae.focus();        }
    }
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
  document.getElementById('issued_on').setAttribute('max', today);
</script>