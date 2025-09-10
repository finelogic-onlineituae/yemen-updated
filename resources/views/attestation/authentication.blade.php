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
                            هل تم تصديق الوثيقة مسبقًا من إحدى الجهات التالية؟<br>
                            <div class="form-group">
                                <input type="radio" class="form-check-input" name="authentication" onclick="enableSubmit()" value="Ministry of Foreign Affairs of Yemen">
                                <label for="authentication">وزارة الخارجية اليمنية</label>
                            </div>
                             <div class="form-group">
                                <input type="radio" class="form-check-input" name="authentication" onclick="enableSubmit()" value="Ministry of Foreign Affairs of the United Arab Emirates
">
                                <label for="authentication">وزارة الخارجية الإماراتية</label>
                            </div>
                             <div class="form-group">
                                <input type="radio" class="form-check-input" name="authentication" onclick="enableSubmit()" value="One of the diplomatic missions of the Republic of Yemen abroad">
                                <label for="authentication">إحدى بعثات الجمهورية اليمنية في الخارج ( سفارة أو قنصلية عامة)</label>
                            </div>
                            <br><br>
                            <div class="d-flex">
                               {{--  <a href="{{ route('attestation.failed') }}" class="btn btn-danger">No</a> --}}
                               <form action="{{ route('attestation.choose-type') }}">
                                <button class="btn btn-success mx-2" id="submit-btn" disabled>Yes, Proceed</button>
                               </form>
                            </div>
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