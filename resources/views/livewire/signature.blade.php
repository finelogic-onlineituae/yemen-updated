<div  class="">
    <hr>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
   <form wire:submit.prevent="confirmSignature" enctype="multipart/form-data">
    @csrf
        <div class="card">
                <div class="card-header">معلومات جواز السفر</div>
                <div class="card-body text-start">
                    <div class="form-group mb-2">
                        <label for="signature" class="form-label"><b>قم بتحميل توقيعك / بصمة الإبهام هنا (200px*60px)</b></label>
                        <input type="file" class="form-control item-img file center-block" name="signature" accept=".jpg,.jpeg,.png"   id="signatureInputtype" />
                        <input type="hidden" id="signatureInput" wire:model="signature" />

                        {{-- @error('signature') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                    
					
                     @if(!$errors->has('signature'))
                        <div @class(["d-none" => !$verification])> 
                          <div class="form-group mb-2">
                                    <figure>
                                        <img src="" class="img-responsive img-thumbnail" id="item-img-output" />
                                        <figcaption><i class="fa fa-camera"></i></figcaption>
                                    </figure>
                            </div>
                            <button type="submit" class="btn btn-primary" wire:model="submitBtn">تأكيد التوقيع</button>
                        </div>
                    @endif   
                     @if($success)
                    <div class="text-success" id="signature-updated">تم إرفاق التوقيع بنجاح</div>
                    @endif 
                </div>
            </div>
    </form>
    @if($success)
    <div class="mt-2">
        <input type="checkbox" name="confirmation" id="confirmation" onclick="toggleConfirmation()"/>
        <label class="form-label">	أنا هنا لتأكيد طلبي</label>
    </div>
    @endif


                       

                        <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <h4 class="modal-title" id="myModalLabel">
                                         </h4>
                                    </div>
                                <div class="modal-body">
                                    <div id="upload-demo" class="center-block"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"  data-bs-dismiss="modal">Close</button>
                                  <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                                </div>
						    </div>
						</div>
						</div>


</div>
