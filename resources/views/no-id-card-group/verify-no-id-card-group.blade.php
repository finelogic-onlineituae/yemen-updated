<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center">شهادة عدم وجود بطاقة هوية مجموعة</h2>
    <div>
        <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
            <div class="w-100 align-items-center text-center d-flex justify-content-center verfiy-form">
                @csrf
                <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash " style="width: 100%;">
                   
            
                    <div class="card my-2 d-none d-sm-block">
                        <div class="card-header"> معلومات الأعضاء</div>
                            <div class="card-body text-start">
                                <div class="row">
                                    <div class="table-responsive" style="overflow-x: auto;">
                                        <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">لا</th>
                                                            <th scope="col">اسم</th>
                                                            <th scope="col">رقم جواز سفر </th>
                                                            <th scope="col">رقم الهوية الإماراتية</th>
                                                            <th scope="col">يتم تقديم هذه المعلومات إلى</th>
                                                            <th scope="col">صدر بتاريخ</th>
                                                            <th scope="col">رقم جواز سفر </th>
                                                            <th scope="col">مركز الجوازات</th>
                                                            <th scope="col">عرض تصريح الإقام</th>
                                                            <th scope="col">جواز سفر</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($application->formable->familyMembers as $index => $familyMember)
                                                            <tr>
                                                                <th scope="row">{{ $index + 1 }}</th>
                                                                <td>{{ $familyMember->name }}</td>
                                                                <td>{{ $familyMember->phone_number }}</td>
                                                                <td>{{ $familyMember->emirates_id }}</td>
                                                                <td>{{ $familyMember->submitted_to }}</td>
                                                                <td>{{ $familyMember->passport->issued_on }}</td>
                                                                <td>{{ $familyMember->passport->passport_number }}</td>
                                                                <td>{{ $familyMember->passport->passportCenter->center_name }}</td>
                                                                
                                                                {{-- Residence Permit --}}
                                                                <td>
                                                                    <button class="btn btn-dark rounded-5"
                                                                            onclick="openModal('residence-permit-{{ $index }}')">
                                                                        تصريح الإقامة
                                                                    </button>
                                                                    <div id="residence-permit-{{ $index }}" class="modal">
                                                                        <div class="modal-content">
                                                                            <span class="close" onclick="closeModal('residence-permit-{{ $index }}')">&times;</span>
                                                                            <iframe src="{{ generate_signed_storage_url( $familyMember->residance_permit) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                {{-- Passport --}}
                                                                <td>
                                                                    <button class="btn btn-dark rounded-5"
                                                                            onclick="openModal('passport-{{ $index }}')">
                                                                        جواز سفر
                                                                    </button>
                                                                    <div id="passport-{{ $index }}" class="modal">
                                                                        <div class="modal-content">
                                                                            <span class="close" onclick="closeModal('passport-{{ $index }}')">&times;</span>
                                                                            <iframe src="{{ generate_signed_storage_url( $familyMember->passport->attachment) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                             
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div>

                    <div class="card my-2 ">
                                <div class="card-header d-block d-sm-none"> معلومات الأعضاء</div>
                                <div class="d-block d-sm-none">
                                @foreach ($application->formable->familyMembers as $index => $familyMember)
                                    <div class="card mb-3 w-100">
                                        <div class="card-body">
                                            <h6 class="card-title">اسم : {{ $familyMember->name }}</h6>
                                            <p>رقم جواز سفر  : {{ $familyMember->passport->phone_number }}</p>
                                            <p>>رقم الهوية الإماراتية : {{ $familyMember->passport->emirates_id }}</p>
                                            <p>يتم تقديم هذه المعلومات إلى : {{ $familyMember->passport->submitted_to }}</p>

                                            <p>صدر بتاريخ : {{ $familyMember->passport->issued_on }}</p>

                                            <p>رقم جواز سفر  : {{ $familyMember->passport->passport_number }}</p>
                                            <p>مركز الجوازات : {{ $familyMember->passport->passportCenter->center_name }}</p>
                                            <p>
                                                 <button class="btn btn-dark rounded-5"
                                                                            onclick="openModal('residence-permit-{{ $index+10 }}')">
                                                                    عرض تصريح الإقام
                                                                    </button>
                                                                    <div id="residence-permit-{{ $index+10 }}" class="modal">
                                                                        <div class="modal-content">
                                                                            <span class="close" onclick="closeModal('residence-permit-{{ $index+10 }}')">&times;</span>
                                                                            <iframe src="{{ generate_signed_storage_url( $familyMember->residance_permit) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                            </p>
                                            <p>
                                                <button class="btn btn-dark rounded-5"
                                                                            onclick="openModal('passport-{{ $index+11 }}')">
                                                                     جواز سفر
                                                                    </button>
                                                                    <div id="passport-{{ $index+11 }}" class="modal">
                                                                        <div class="modal-content">
                                                                            <span class="close" onclick="closeModal('passport-{{ $index+11 }}')">&times;</span>
                                                                            <iframe src="{{ generate_signed_storage_url( $familyMember->passport->attachment) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                            </p>
                                           
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        

                    <livewire:signature :application_id="$application->id"/>

                    <div class="form-group gap-2 my-3 text-center d-flex">
                        <form method="POST" action="{{ route('application.confirm', ['application_id' => encrypt($application->id)]) }}">
                            @csrf
                            <button class="btn btn-success" id="final-submit" disabled>تقديم الطلب</button>
                        </form>
                        {{-- <a href="#" class="btn btn-dark">Make Changes</a> --}}
                        <a href="{{ route('no-id-card-group.edit', ['application_id' => encrypt($application->id)]) }}" class="btn btn-dark">إجراء التغييرات</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>