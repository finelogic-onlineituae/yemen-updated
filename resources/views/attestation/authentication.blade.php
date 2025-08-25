<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center" >إفادة اثبات ميلاد</h2>
    
<div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
         <form method="POST" id="renew-passport-above-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">
                    <div class="card-body">
                        <div class="border p-2 m-2 rounded">
                            الوثيقة الصادرة من الجمهورية اليمنية، يُشترط أن تكون مصدقة من وزارة الخارجية اليمنية.<br>
                            الوثيقة الصادرة من دولة الإمارات العربية المتحدة، يُشترط أن تكون مصدقة من وزارة <br>
                            الوثيقة الصادرة من دولة أخرى، يُشترط أن تكون مصدقة من وزارة الخارجية في تلك الدولة، وكذلك من سفارة تلك الدولة المعتمدة لدى دولة الإمارات العربية المتحدة.
                            <br><br><br>
                            هل الوثيقة مستوفاة لشروط التصديق
                            <br><br>
                            <div class="d-flex">
                                <a href="{{ route('attestation.failed') }}" class="btn btn-danger">No</a>
                                <a href="{{ route('attestation.create') }}" class="btn btn-success mx-2">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</x-app-layout>