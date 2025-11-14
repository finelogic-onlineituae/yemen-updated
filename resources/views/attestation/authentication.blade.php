<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center" >تأكيد</h2>
<div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
         
           
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">
                    <div class="card-body">
                        <div class="border p-2 m-2 rounded">
                            <div class="fw-bold my-2">هل تم تصديق الوثيقة مسبقًا من إحدى الجهات التالية؟ </div>
                            
                        {{-- 
                            <div class="form-group">
                                <input type="radio" class="form-check-input" style="outline: 2px solid brown;" name="authentication" onclick="enableSubmit()" value="Ministry of Foreign Affairs of Yemen">
                                <label for="authentication">وزارة الخارجية اليمنية</label>
                            </div>
                             <div class="form-group">
                                <input type="radio" class="form-check-input" style="outline: 2px solid brown;" name="authentication" onclick="enableSubmit()" value="Ministry of Foreign Affairs of the United Arab Emirates
">
                                <label for="authentication">وزارة الخارجية الإماراتية</label>
                            </div>
                             <div class="form-group">
                                <input type="radio" class="form-check-input" style="outline: 2px solid brown;" name="authentication" onclick="enableSubmit()" value="One of the diplomatic missions of the Republic of Yemen abroad">
                                <label for="authentication">إحدى بعثات الجمهورية اليمنية في الخارج ( سفارة أو قنصلية عامة)</label>
                            </div>
                            <br><br>
                            <div class="d-flex">
                               <form action="{{ route('attestation.choose-type') }}">
                                <button class="btn btn-success mx-2" id="submit-btn" disabled>Yes, Proceed</button>
                               </form>
                            </div>--}}
                            <a href="{{ route('attestation.choose-type') }}" class=" w-75 text-decoration-none">
                            <div class="rounded p-4 prompt-box shadow">
                                وزارة الخارجية اليمنية
                            </div>
                            </a>
                            <div class="w-100 my-3">
                            <a href="{{ route('attestation.choose-type') }}" class="my-3 mt-2 w-75 text-decoration-none">
                            <div class="rounded p-4 prompt-box shadow">
                                وزارة الخارجية الإماراتية
                            </div>
                            </a>
                            </div>
                            <a href="{{ route('attestation.choose-type') }}" class=" w-75 text-decoration-none">
                            <div class="rounded p-4 prompt-box  shadow">
                                إحدى بعثات الجمهورية اليمنية في الخارج ( سفارة أو قنصلية عامة)
                            </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</div>
<script>
function enableSubmit()
{
    document.getElementById("submit-btn").disabled = false;
    }
</script>
</x-app-layout>