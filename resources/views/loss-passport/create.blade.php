<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center"> فقدان جواز السفر</h2>
    <livewire:loss-passport />


</x-app-layout>

<script>
    $(document).ready(function() {

        let croppieInstance;
        const cropModal = document.getElementById('crop-modal');
        const cropBtn = document.getElementById('cropImageBtn');


        const photoInput = document.getElementById('photoInput');
    
        if (photoInput) {
            photoInput.addEventListener('change', function (event) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (croppieInstance) {
                        const container = document.getElementById('croppie-container');
                        if (container && container.firstChild) {
                            try {
                                croppieInstance.destroy();
                            } catch (e) {
                                console.warn('Croppie destroy failed:', e.message);
                            }
                        }
                    }

                    cropModal.style.display = 'block';

                    croppieInstance = new Croppie(document.getElementById('croppie-container'), {
                        viewport: { width: 200, height: 200, type: 'square' },
                        boundary: { width: 250, height: 250 },
                        showZoomer: true,
                    });

                    croppieInstance.bind({ url: e.target.result });
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        }

        cropBtn.addEventListener('click', function () {
            croppieInstance.result({
                type: 'base64',
                size: { width: 200, height: 200 },
                format: 'png',
            }).then(function (base64) {
                $('.item-photo').val('');
               // Set base64 string to hidden input
                const croppedInput = document.getElementById('croppedImageInput'); // ✅ get the element

                if (croppedInput) {
                    croppedInput.value = base64; // ✅ assign base64 image string
                    croppedInput.dispatchEvent(new Event('input', { bubbles: true })); // ✅ notify Livewire
                }

                const existingimage = document.getElementById('existing-image');
                  if(existingimage){
                    existingimage.style.display = 'none';
                }
                // Show preview image
                document.getElementById('cropped-image').src = base64;
                const croppedimage = document.getElementById('cropped-div');
                croppedimage.style.display = 'block';
               

                cropModal.style.display = 'none';
            });
        });

        
    });
</script>
<script>
    Livewire.on('submitLossPassportForm', () => {
        const base64Value = document.getElementById('croppedImageInput').value;
        
        const existingPhoto = document.getElementById('renew-form-wrapper').dataset.existingPhoto;
            // 1. Check if empty
            if (!base64Value && existingPhoto === '0') {
                alert("Please upload and crop an image first.");
            // e.preventDefault(); // stop form submission
                return;
            }

        // If base64 is present, check its format
            if (base64Value && !/^data:image\/(jpeg|jpg|png);base64,/.test(base64Value)) {
                alert("Only JPG, JPEG, or PNG base64 images are allowed.");
                return;
            }
        document.getElementById('loss-passport-form').submit();
    });
</script>

<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
  document.getElementById('issued_on').setAttribute('max', today);

</script>

