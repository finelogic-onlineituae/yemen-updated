<div class="bg-ash p-2 h-100">
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    @if(!$completed)
        @if(!$allowVerification)
        <form wire:submit.prevent="verifyApplication">
            <div class="row gap-3 mx-2">
                <div class="col-lg-5 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                        Featured
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold" for="name">اسمك</label>
                                <input type="text" class="form-control" name="name" wire:model="name" value="{{ explode('. ', auth()->user()->name, 2)[0].'. '.strtoupper(explode('. ', auth()->user()->name, 2)[1]) }}" disabled/>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold" for="phone">رقم الهاتف المحمول</label>
                                <input type="text" class="form-control" name="phone_number" wire:model="phone_number" value="{{ auth()->user()->phone_number }}" disabled/>
                                @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <livewire:passport/>
            </div>
        </form>
        @else
        @endif
    @else
    @endif