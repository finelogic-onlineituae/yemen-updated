<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    {{-- <h2 class="text-success w-100 text-center">طلب الحصول على شهادة الميلاد</h2> --}}
     <div class="application-confirm">
        <div class="align-items-center  text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 border-top">
           
                <div class="application-form w-100 align-items-center text-center d-flex justify-content-center ">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-success mt-5">لقد تم تقديم طلبك بنجاح!</h4>
                            <div class="text-center my-3 mt-1 d-flex gap-2 pt-3 border-dark border-top ">
                                <a href="{{ route('download-app', ['application_id'=> $application_id]) }}" target="_blank" class="btn btn-danger">قم بتنزيل التطبيق الخاص بك</button> 
                                    {{-- <a href="#" class="btn btn-danger">قم بتنزيل التطبيق الخاص بك</button> --}}
                                <a href="{{ route('applications.index') }}"><button class="btn btn-dark">عرض جميع تطبيقاتك</button></a>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>


</x-app-layout>