// Open the modal
function openModal(id) {
    //alert(id);
    document.getElementById(id).style.display = "block";
}

// Close the modal
function closeModal(id) {
    document.getElementById(id).style.display = "none";
}

/* Close the modal when clicking outside the content
window.onclick = function(event) {
    const modal = document.getElementByClass("modal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
}*/
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




$(document).ready(function() {
    			// Start upload preview image
						var $uploadCrop,
						tempFilename,
						rawImg,
						imageId;
						function readFile(input) {
				 			if (input.files && input.files[0]) {
				              var reader = new FileReader();
					            reader.onload = function (e) {
									$('.upload-demo').addClass('ready');
									$('#cropImagePop').modal('show');
						            rawImg = e.target.result;
					            }
					            reader.readAsDataURL(input.files[0]);
					        }
					        else {
						        swal("Sorry - you're browser doesn't support the FileReader API");
						    }
						}
						$uploadCrop = $('#upload-demo').croppie({
							viewport: {
								width: 250,
								height: 100,
							},
							enforceBoundary: false,
							enableExif: true
						});
						$('#cropImagePop').on('shown.bs.modal', function(){
							// alert('Shown pop');
							$uploadCrop.croppie('bind', {
				        		url: rawImg
				        	}).then(function(){
				        		console.log('jQuery bind complete');
				        	});
						});

						$('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
							$('#cancelCropBtn').data('id', imageId); readFile(this); });
						$('#cropImageBtn').on('click', function (ev) {
							$uploadCrop.croppie('result', {
								type: 'base64',
								format: 'jpeg',
								size: {width: 250, height: 100}
							}).then(function (resp) {
								$('#item-img-output').attr('src', resp);
								$('#cropImagePop').modal('hide');
                                // Set cropped image base64 to hidden input and trigger Livewire update
								const signatureInput = document.getElementById('signatureInput');
								signatureInput.value = resp;
								signatureInput.dispatchEvent(new Event('input'));

								$('.item-img').val('');
								
								// Hide modal
								$('#cropImagePop').modal('hide');
								// Show the hidden preview section
								$('#item-img-output').closest('.d-none').removeClass('d-none');
                        
							});
						});

                        });
				// End upload preview image