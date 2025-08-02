<!DOCTYPE html>
<html lan="ar" dir="rtl">
<head>
    
    <style>
        body { font-family: 'Arial, sans-serif'; }
        .container { margin: 20px; height:730px; align-items: center;}
        .flex-between {
  display: flex;
  justify-content: space-between;
}
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 10px;
  border: 1px solid #ccc;
  text-align:left;
}

tr:nth-child(even) {
  background-color: #f9f9f9;  /* Light gray */
}

tr:nth-child(odd) {
  background-color: #ffffff;  /* White */
}
    </style>
</head>
<body>
    <img src="{{ public_path('assets/images/letter-head-top.jpg') }}" width="100%"/>
    <hr>
    <div class="container">
        <span>
            <div>طلب#: {{ $application->id }}</div>
            <div>تطبق من قبل: {{ $application->applicant->name }}</div>
            <div>تطبق على: {{ $application->applied_on }}</div>
            <div>حالة:  {{ $application->status }}</div>

        </span>
        <hr>
       
        <h1 class="text-primary">{{ $application->form_type->application_name_arabic ?  $application->form_type->application_name_arabic : $application->form_type->application_name}}</h1>
        {{ $slot }}
        <img src="{{ public_path('storage/'.$application->signature) }}" style="width:150px; margin-top: 20px;"/>
        
    </div>
        <hr>
        <img src="{{ public_path('assets/images/letter-head-bottom.jpg') }}" width="100%"/>
        {{-- <div class="flex-between">
            <span>
                <p><span>Tel: +971 2 4448457 - Fax: 024443691</span>.<span style="padding-right: 16px; margin-left: 10px;">                                </span>هاتف: ٤٤٤٨٤٥٧ - ٠٢ - فاكس: ٤٤٤٣٦٩١-٠٢</p>
                <p>P.O. Box: 2095 - Abu Dhabi - UAE                                       ص.ب: ۲۰۹۵ أبوظبي - دولة الإمارات العربية المتحدة</p>
                <p>yemenemb@eim.ae</p>
            </span>
            <span>
                <img src="{{ public_path('assets/images/footer-arabic.jpg') }}" width="30%"/>
            </span>
        </div> --}}
        
</body>
</html>
