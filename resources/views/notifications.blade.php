<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('تطبيقاتك') }}
        </h2>
    </x-slot>
    <div class="status-section w-100">
       
        <h2 class="text-success  text-center">Notifications</h2>

        
    </div>
        <div class="d-none d-lg-block p-3 bg-form border-top">
            <table class="text-center table  table-bordered">
                <thead>
                    <tr class="table-dark">
                        <th> No.</th>
                        <th> Application ID </th>
                        <th> Messeage </th>
                        <th> date </th>
                        {{-- <th> Application Fee </th>
                        <th> Cashier </th>
                        <th> Reason </th> --}}
                        <th> View </th>
                   
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $application)
                            @php
                                $data = json_decode($application->data, true);
                            @endphp
                        <tr>
                            <td class="{{ $application->read_at ? 'tr-read' : 'tr-unread' }}">{{ $loop->iteration }}</td>
                            <td class="{{ $application->read_at ? 'tr-read' : 'tr-unread' }}">{{  $data['application_id'] }}</td>
                            <td class="{{ $application->read_at ? 'tr-read' : 'tr-unread' }}">{{  $data['message'] }}</td>
                            <td class="{{ $application->read_at ? 'tr-read' : 'tr-unread' }}">{{  $application->created_at }}</td>
                           {{-- <td class="{{ $application->read_at ? 'tr-read' : 'tr-unread' }}">{{  $data['application_fee'] ?? '' }}</td>
                            <td class="{{ $application->read_at ? 'tr-read' : 'tr-unread' }}">{{  $data['cashier'] ?? '' }}</td>
                            <td class="{{ $application->read_at ? 'tr-read' : 'tr-unread' }}">{{  $data['reason'] ?? '' }}</td> --}}

                            <td class="{{ $application->read_at ? 'tr-read' : 'tr-unread' }}"><a href="https://yemenembassyadmin.finelogic.in/print-certificate?application_id={{obfuscate_id($application->id)}}" data-id="{{ encrypt($application->id) }}" class="print-certificate-link">
                                @if($application->read_at==null)
                                    <button class="btn btn-sm btn-success">منظر</button>
                                @else
                                    <button class="btn btn-sm btn-primary">تمت المشاهدة</button>
                                @endif


                            </a></td> 
                            {{-- <td class="{{ $application->read_at ? 'tr-read' : 'tr-unread' }}"><a href="#" data-id="{{ encrypt($application->id) }}" class="print-certificate-link">
                                @if($application->read_at==null)
                                    <button class="btn btn-sm btn-success">منظر</button>
                                @else
                                    <button class="btn btn-sm btn-primary">viewd</button>
                                @endif


                            </a></td> --}}
                           
                        
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
                            @php
                                $data = json_decode($application->data, true);
                            @endphp
                <div class="card mb-3 shadow-sm w-100 mx-3">
                    <div class="card-body">
                        <h6 class="card-title"> Application ID {{ $application->id }}</h6>
                        <p class="mb-1"><strong>Messeage:</strong> {{   $data['application_id']  }}</p>
                        <p class="mb-1"><strong>date:</strong> {{    $application->created_at  }}</p>
                       {{-- @if($data['application_fee']?? '')
                        <p class="mb-1"><strong>Application Fee:</strong> {{   $data['application_fee'] ?? ''  }}</p>
                        @endif
                        @if($data['cashier'] ?? '')
                        <p class="mb-1"><strong>Cashier:</strong> {{   $data['cashier'] ?? ''  }}</p>
                        @endif
                        @if($data['reason'] ?? '')
                        <p class="mb-1"><strong>Reason:</strong> {{   $data['reason'] ?? '' }}</p>
                        @endif--}}
                        <a href="https://yemenembassyadmin.finelogic.in/print-certificate?application_id={{obfuscate_id($application->id)}}" data-id="{{ encrypt($application->id) }}" class="print-certificate-link">
                                @if($application->read_at==null)
                                    <button class="btn btn-sm btn-success">منظر</button>
                                @else
                                    <button class="btn btn-sm btn-primary">تمت المشاهدة</button>
                                @endif


                            </a>
                        {{-- <button class="btn btn-sm btn-primary mt-2">منظر</button> --}}
                    </div>
                </div>
            @empty
                <p>No Notifications found.</p>
            @endforelse
        </div>
    </div> 

</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.print-certificate-link').forEach(link => {
        link.addEventListener('click', function (e) {

            const appId = this.dataset.id;

            // Fire AJAX without preventing default navigation
            fetch(`/notification-view/${appId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ application_id: appId })
            })
            .then(response => response.json())
            .then(data => {
                //console.log('Marked as read');
                // Do nothing — let the link continue to navigate
            })
            .catch(error => {
                console.error('Error marking as read:', error);
            });

            // Do NOT prevent default so the page continues navigating
        });
    });
});
</script>
