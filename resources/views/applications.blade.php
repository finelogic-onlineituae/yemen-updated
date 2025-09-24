<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('تطبيقاتك') }}
        </h2>
    </x-slot>
    <div>
         <h2 class="text-success  text-center">تطبيقاتك</h2>
         <div class="filter_search flex-column me-12">
            <form id="languageForm" class="drop-down-form" action="/myapplications" method="POST">
                @csrf
        
        
                   
                  <div class="d-flex align-items-end flex-wrap gap-2" style="    margin-right: 10px;">
            <div class="d-flex flex-column me-2">
        
                <select name="status_select" class="select-atatus-section"  onchange="document.getElementById('languageForm').submit()">
                    <option value="">Select Status</option>
                    <option value="all" {{ request('status_select') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="Applied" {{ request('status_select') == 'Applied' ? 'selected' : '' }}>Applied</option>
                    {{-- <option value="Initiated" {{ request('status_select') == 'Initiated' ? 'selected' : '' }}>Initiated</option> --}}
                </select>  
            </div>
            
            {{-- Application ID --}}
            <div class="d-flex flex-column me-2">
                <label for="application_id">Application ID</label>
                <input type="text" class="form-control" id="application_id" name="application_id" placeholder="Application ID" value="{{ request('application_id') }}">
            </div>

            {{-- From Date --}}
            <div class="d-flex flex-column me-2">
                <label for="from_date">From Date</label>
                <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
            </div>

            {{-- To Date --}}
            <div class="d-flex flex-column me-2">
                <label for="to_date">To Date</label>
                <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
            </div>

            {{-- Submit Button --}}
            <div>
                <button class="btn btn-primary mt-2" type="submit">Filter</button>
            </div>

        </div>
            </form>
        </div>
       

        
    </div>
        <div class="d-none d-lg-block p-3 bg-form border-top mt-1">
            <table class="text-center table table-striped table-bordered">
                <thead>
                    <tr class="table-dark">
                        <th>رقم سل</th>
                        <th>معرف التطبيق</th>
                        <th>نوع التطبيق</th>
                        <th>تطبق على</th>
                        <th>حالة</th>
                        <th>عرض التطبيق</th>
                        <th>حالة الدفع</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $application)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $application->id }}</td>
                            <td>{{  $application->form_type->application_name_arabic }}</td>
                            <td>{{ $application->created_at }}</td>
                            <td>{{ $application->status }}</td>
                            <td><a href="{{url('download-application',$application->id)}}" target="_blank"><button class="btn btn-sm btn-primary">منظر</button></a></td>
                            <td>
                            {{-- @if($application->status=='approved')
                            @endif
                               --}}

                                {{-- <a href="{{url('pay',encrypt($application->id))}}"><button class="btn btn-sm btn-primary">Pay</button></a> --}}
                            </td>
                        
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">لم تقم بالتقدم بطلب للحصول على أي شهادة من خلال هذه البوابة!</td>
                        </tr>    
                    @endforelse
                </tbody>
            </table>
             <!-- Pagination links -->
            <div class="mt-3 d-flex justify-content-center">
                {{ $applications->links('pagination::bootstrap-5') }}
            </div>
        </div>
        
        <!-- Mobile Cards -->
        <div class="d-block d-lg-none align-items-center text-center d-flex flex-column justify-content-cente bg-form p-3 bg-form border-top">
            @forelse ($applications as $application)
                <div class="card mb-3 shadow-sm w-100 mx-3">
                    <div class="card-body">
                        <h6 class="card-title">طلب # {{ $application->id }}</h6>
                        <p class="mb-1"><strong>يكتب:</strong> {{ explode('\\', $application->formable_type)[2] }}</p>
                        <p class="mb-1"><strong>تم تطبيقه على:</strong> {{ date_format(date_create($application->created_at),'d-m-Y H:i:s') }}</p>
                        <p class="mb-1"><strong>حالة:</strong> {{ $application->status }}</p>
                        <button class="btn btn-sm btn-primary mt-2">منظر</button>
                    </div>
                </div>
            @empty
                <p>No applications found.</p>
            @endforelse
        </div>
    </div>

</x-app-layout>
