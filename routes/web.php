<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BirthCertificateController;
use App\Http\Controllers\DrivingLicenceController;
use App\Http\Controllers\NoObjectionCertificateController;
use App\Http\Controllers\NoIdCardController;
use App\Http\Controllers\PowerOfAttorneyController;
use App\Http\Controllers\SupportStatementController;
use App\Http\Controllers\MarriageCertificateController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\RenewPassportAboveController;
use App\Http\Controllers\RenewPassportBelowController;
use App\Http\Controllers\NewPassportController;
use App\Http\Controllers\DamagedPassportController;
use App\Http\Controllers\LossPassportController;
use App\Http\Controllers\PassportNameChangeController;
use App\Http\Controllers\VisaApplicationController;
use App\Http\Controllers\NoIdCardGroupController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CertificateShowController;
use App\Http\Controllers\DownloadfileController;
use App\Http\Controllers\MamoPaymentController;
use App\Http\Controllers\OtherCertificateController;
use App\Http\Controllers\SchoolCertificateController;
use App\Http\Controllers\UnivercityCertificateController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\AttestationController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use Illuminate\Notifications\Notification;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

use App\Models\User;



Route::get('/', function () {
    if(auth()->user()){
        return redirect()->route('dashboard');
    }
    
    return view('index');
   // return redirect()->route('register');
});
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'email.verified'])->name('dashboard');
 
Route::middleware(['auth', 'email.verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/create-signature', [ProfileController::class, 'createSignature'])->name('signature.create'); 
});
Route::middleware('throttle:web')->group(function () {

Route::middleware(['auth', 'email.verified'])->group(function () {
    //Route::get('/applications/visa-application', [ApplicationController::class, 'createVisaApplication'])->name('visa.create');

    Route::match(['get', 'post'],'/myapplications', [ApplicationController::class, 'index'])->name('applications.index');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    //Route::post('/myapplications', [ApplicationController::class, 'index'])->name('applications.index');


    //Route::get('/generate-pdf', [PDFController::class, 'generate'])->name('generate-pdf.index');
    Route::get('/applications/visa-application', [VisaApplicationController::class, 'createVisaApplication'])->name('visa-application.create');
    Route::get('/applications/visa-application/travel-documents', [VisaApplicationController::class, 'travelDocuments'])->name('visa-application.travel');
    Route::post('/applications/store-visa-application', [VisaApplicationController::class, 'storeVisaApplication'])->name('visa-application.store');
    Route::post('/applications/store-visa-application-accompany', [VisaApplicationController::class, 'storeVisaApplicationAccompany'])->name('visa-application-accompany.store');
   
    Route::get('/applications/birth-certificate', [BirthCertificateController::class, 'createBirthCertificate'])->name('birth-certificate.create');
    Route::post('/applications/store-birth-certificate', [BirthCertificateController::class, 'storeBirthCertificate'])->name('birth-certificate.store');
   
    Route::get('/applications/university-certificate', [UnivercityCertificateController::class, 'create'])->name('university-certificate.create');
    Route::post('/applications/store-university-certificate', [UnivercityCertificateController::class, 'store'])->name('university-certificate.store');
  
    Route::get('/applications/other-certificate', [OtherCertificateController::class, 'create'])->name('other-certificate.create');
    Route::post('/applications/store-other-certificate', [OtherCertificateController::class, 'store'])->name('other-certificate.store');

    Route::get('/applications/driving-licence', [DrivingLicenceController::class, 'createDrivingLicence'])->name('driving-licence.create');
    Route::post('/applications/store-driving-licence', [DrivingLicenceController::class, 'storeDrivingLicence'])->name('driving-licence.store');
    
    Route::get('/applications/no-objection-certification', [NoObjectionCertificateController::class, 'createNoObjectionCertificatee'])->name('no-objection-certification.create');
    Route::post('/applications/store-no-objection-certification', [NoObjectionCertificateController::class, 'storeNoObjectionCertificate'])->name('no-objection-certification.store');
   
    Route::get('/applications/support-statement', [SupportStatementController::class, 'createSupportStatement'])->name('support-statement.create');
    Route::post('/applications/store-support-statement', [SupportStatementController::class, 'storeSupportStatement'])->name('support-statement.store');
   
    Route::get('/applications/family-member', [FamilyMemberController::class, 'createFamilyMember'])->name('family-member.create');
    Route::post('/applications/store-family-member', [FamilyMemberController::class, 'storeFamilyMember'])->name('family-member.store');

    Route::get('/applications/support', [SupportController::class, 'create'])->name('support.create');
     Route::post('/applications/store-support', [SupportController::class, 'store'])->name('support.store');
   
    Route::get('/applications/no-id-card-group', [NoIdCardGroupController::class, 'create'])->name('no-id-card-group.create');
    Route::get('/applications/no-id-card-group/remove-member', [NoIdCardGroupController::class, 'removeMember'])->name('nic-group.remove');
    Route::post('/applications/store-no-id-card-group', [NoIdCardGroupController::class, 'store'])->name('no-id-card-group.store');
   
    Route::get('/applications/renew-passport-above', [RenewPassportAboveController::class, 'createRenewPassportAbove'])->name('renew-passport-above.create');
    Route::post('/applications/store-renew-passport-above', [RenewPassportAboveController::class, 'storeRenewPassportAbove'])->name('renew-passport-above.store');
   
    Route::get('/applications/renew-passport-below', [RenewPassportBelowController::class, 'createRenewPassportBelow'])->name('renew-passport-below.create');
    Route::post('/applications/store-renew-passport-below', [RenewPassportBelowController::class, 'storeRenewPassportBelow'])->name('renew-passport-below.store');
   
   
    Route::get('/applications/new-passport', [NewPassportController::class, 'createNewPassport'])->name('new-passport.create');
    Route::post('/applications/store-new-passport', [NewPassportController::class, 'storeNewPassport'])->name('new-passport.store');
   

    Route::get('/applications/damaged-passport', [DamagedPassportController::class, 'createDamagedPassport'])->name('damaged-passport.create');
    Route::post('/applications/store-damaged-passport', [DamagedPassportController::class, 'storeDamagedPassport'])->name('damaged-passport.store');

    //Route::get('/payment', [MamoPaymentController::class, 'payment'])->name('payment');
    Route::get('/lander', [MamoPaymentController::class, 'paymentSuccess'])->name('payment.success');
    //Route::get('/payment-success', [MamoPaymentController::class, 'paymentFailed'])->name('payment.failed');

    //Route::post('/webhook/mamo', [MamoPaymentController::class, 'handleWebhook']);

    Route::middleware(['auth', 'user.check'])->group(function () {
        Route::get('/pay/{application_id}', [MamoPaymentController::class, 'createPayment'])->name('payment.start');

        Route::get('/applications/edit-visa-application-accompany/{application_id}', [VisaApplicationController::class, 'editVisaApplicationAccompany'])->name('visa-application-accompany.edit');
        Route::get('/applications/edit-visa-application/{application_id}', [VisaApplicationController::class, 'editVisaApplication'])->name('visa-application.edit');
        Route::get('/applications/verify-visa-application/{application_id}', [VisaApplicationController::class, 'verifyVisaApplication'])->name('visa-application.verify');
        Route::get('/applications/visa-application-accompany/{application_id}', [VisaApplicationController::class, 'VisaApplicationAccompany'])->name('visa-application-accompany');

        Route::get('/applications/verify-birth-certificate/{application_id}', [BirthCertificateController::class, 'verifyBirthCertificate'])->name('birth-certificate.verify');
        Route::get('/applications/edit-birth-certificate/{application_id}', [BirthCertificateController::class, 'editBirthCertificate'])->name('birth-certificate.edit');
        Route::post('/applications/confirm-birth-certificate/{application_id}', [BirthCertificateController::class, 'confirmBirthCertificate'])->name('birth-certificate.confirm');
        Route::get('/applications/birth-certificate/post-confirmation/{application_id}', [BirthCertificateController::class, 'postBirthCertificate'])->name('birth-certificate.success');

        Route::get('/applications/verify-university-certificate/{application_id}', [UnivercityCertificateController::class, 'verifyUnivercityCertificate'])->name('university-certificate.verify');
        Route::get('/applications/edit-university-certificate/{application_id}', [UnivercityCertificateController::class, 'editUnivercityCertificate'])->name('university-certificate.edit');

        Route::get('/applications/verify-other-certificate/{application_id}', [OtherCertificateController::class, 'verifyOtherCertificate'])->name('other-certificate.verify');
        Route::get('/applications/edit-other-certificate/{application_id}', [OtherCertificateController::class, 'editOtherCertificate'])->name('other-certificate.edit');

        Route::get('/applications/verify-driving-licence/{application_id}', [DrivingLicenceController::class, 'verifyDrivingLicence'])->name('driving-licence.verify');
        Route::get('/applications/edit-driving-licence/{application_id}', [DrivingLicenceController::class, 'editDrivingLicence'])->name('driving-licence.edit');

        Route::get('/applications/verify-no-objection-certification/{application_id}', [NoObjectionCertificateController::class, 'verifyNoObjectionCertificate'])->name('no-objection-certification.verify');
        Route::get('/applications/edit-no-objection-certification/{application_id}', [NoObjectionCertificateController::class, 'editNoObjectionCertificate'])->name('no-objection-certification.edit');

        Route::get('/applications/verify-support-statement/{application_id}', [SupportStatementController::class, 'verifySupportStatement'])->name('support-statement.verify');
        Route::get('/applications/edit-support-statement/{application_id}', [SupportStatementController::class, 'editSupportStatement'])->name('support-statement.edit');
   
        Route::get('/applications/verify-family-member/{application_id}', [FamilyMemberController::class, 'verifyFamilyMember'])->name('family-member.verify');
        Route::get('/applications/remove-family-member/{application_id}/{member_id}', [FamilyMemberController::class, 'removeFamilyMember'])->name('family-member.remove');
        Route::post('/applications/add-family-member/{application_id}', [FamilyMemberController::class, 'addFamilyMember'])->name('family-member.more');
        Route::get('/applications/edit-family-member/{application_id}', [FamilyMemberController::class, 'editFamilyMember'])->name('family-member.edit');

        Route::get('/applications/verify-statement-above/{application_id}', [SupportController::class, 'verifySupport'])->name('support.verify');
        Route::get('/applications/remove-statement-above/{application_id}/{member_id}', [SupportController::class, 'removeSupportMember'])->name('support.remove');
        Route::post('/applications/add-statement-above/{application_id}', [SupportController::class, 'addSupportMember'])->name('support.more');
        Route::get('/applications/edit-statement-above/{application_id}', [SupportController::class, 'editMember'])->name('support.edit');

        Route::get('/applications/verify-no-id-card-group/{application_id}', [NoIdCardGroupController::class, 'verify'])->name('no-id-card-group.verify');
        Route::get('/applications/edit-no-id-card-group/{application_id}', [NoIdCardGroupController::class, 'edit'])->name('no-id-card-group.edit');

        Route::get('/applications/verify-renew-passport-above/{application_id}', [RenewPassportAboveController::class, 'verifyRenewPassportAbove'])->name('renew-passport-above.verify');
        Route::get('/applications/edit-renew-passport-above/{application_id}', [RenewPassportAboveController::class, 'editRenewPassportAbove'])->name('renew-passport-above.edit');

        Route::get('/applications/verify-renew-passport-below/{application_id}', [RenewPassportBelowController::class, 'verifyRenewPassportBelow'])->name('renew-passport-below.verify');
        Route::get('/applications/edit-renew-passport-below/{application_id}', [RenewPassportBelowController::class, 'editRenewPassportBelow'])->name('renew-passport-below.edit');

        Route::get('/applications/verify-new-passport/{application_id}', [NewPassportController::class, 'verifyNewPassport'])->name('new-passport.verify');
        Route::get('/applications/edit-new-passport/{application_id}', [NewPassportController::class, 'editNewPassport'])->name('new-passport.edit');

        Route::get('/applications/verify-damaged-passport/{application_id}', [DamagedPassportController::class, 'verifyDamagedPassport'])->name('damaged-passport.verify');
        Route::get('/applications/edit-damaged-passport/{application_id}', [DamagedPassportController::class, 'editDamagedPassport'])->name('damaged-passport.edit');

        Route::get('/applications/verify-loss-passport/{application_id}', [LossPassportController::class, 'verifyLossPassport'])->name('loss-passport.verify');
        Route::get('/applications/edit-loss-passport/{application_id}', [LossPassportController::class, 'editLossPassport'])->name('loss-passport.edit');
        
        Route::get('/applications/verify-passport-name-change/{application_id}', [PassportNameChangeController::class, 'verifyPassportNameChange'])->name('passport-name-change.verify');
        Route::get('/applications/edit-passport-name-change/{application_id}', [PassportNameChangeController::class, 'editPassportNameChange'])->name('passport-name-change.edit');

        Route::get('/applications/verify-marriage-certificate/{application_id}', [MarriageCertificateController::class, 'verifyMarriageCertificate'])->name('marriage-certificate.verify');
        Route::get('/applications/edit-marriage-certificate/{application_id}', [MarriageCertificateController::class, 'editMarriageCertificate'])->name('marriage-certificate.edit');
   
        Route::get('/applications/verify-school-certificate/{application_id}', [SchoolCertificateController::class, 'verifySchoolCertificate'])->name('school-certificate.verify');
        Route::get('/applications/edit-school-certificate/{application_id}', [SchoolCertificateController::class, 'editSchoolCertificate'])->name('school-certificate.edit');
 
        Route::get('/applications/verify-no-id-card/{application_id}', [NoIdCardController::class, 'verify'])->name('no-id-card.verify');
        Route::get('/applications/edit-no-id-card/{application_id}', [NoIdCardController::class, 'edit'])->name('no-id-card.edit');

        Route::get('/applications/verify-power-of-attorney/{application_id}', [PowerOfAttorneyController::class, 'verify'])->name('power-of-attorney.verify');
        Route::get('/applications/edit-power-of-attorney/{application_id}', [PowerOfAttorneyController::class, 'edit'])->name('power-of-attorney.edit');

        Route::post('/applications/confirm-application/{application_id}', [ApplicationController::class, 'confirmApplication'])->name('application.confirm');
        Route::get('/applications/post-confirmation/{application_id}', [ApplicationController::class, 'postConfirmation'])->name('post-confirmation');

       

    });


    Route::post('/notification-view/{application_id}', [NotificationController::class, 'generate'])->name('notification-app');

    Route::get('/applications/loss-passport', [LossPassportController::class, 'createLossPassport'])->name('loss-passport.create');
    Route::post('/applications/store-loss-passport', [LossPassportController::class, 'storeLossPassport'])->name('loss-passport.store');
 
    Route::get('/applications/passport-name-change', [PassportNameChangeController::class, 'createPassportNameChange'])->name('passport-name-change.create');
    Route::post('/applications/store-passport-name-change', [PassportNameChangeController::class, 'storePassportNameChange'])->name('passport-name-change.store');
   
    Route::get('/applications/attestation', [AttestationController::class, 'create'])->name('attestation.create');
    Route::get('/applications/attestation/choose-type', [AttestationController::class, 'chooseType'])->name('attestation.choose-type');
    Route::get('/applications/attestation/prompt-requirements', [AttestationController::class, 'promptRequirement'])->name('attestation.prompt');
    Route::get('/applications/attestation/requirements-failed', [AttestationController::class, 'requirementFailure'])->name('attestation.failed');
    Route::get('/applications/attestation/verify-attestaion/{application_id}', [AttestationController::class, 'verifyAttestation'])->name('attestation.verify');
    Route::post('/applications/store-attestation', [AttestationController::class, 'store'])->name('attestation.store');
    
    Route::get('/applications/marriage-certificate', [MarriageCertificateController::class, 'createMarriageCertificate'])->name('marriage-certificate.create');
    Route::post('/applications/store-marriage-certificate', [MarriageCertificateController::class, 'storeMarriageCertificate'])->name('marriage-certificate.store');
     
    Route::get('/applications/no-id-card', [NoIdCardController::class, 'create'])->name('no-id-card.create');
    Route::post('/applications/store-no-id-card', [NoIdCardController::class, 'store'])->name('no-id-card.store');
   
    Route::get('/applications/power-of-attorney', [PowerOfAttorneyController::class, 'create'])->name('power-of-attorney.create');
    Route::post('/applications/power-of-attorney', [PowerOfAttorneyController::class, 'store'])->name('power-of-attorney.store');
   
   
});

Route::get('/download-application-admin/{application_id}', [PDFController::class, 'generateadmin']);


Route::get('/certificate-details/{application_id}', [CertificateShowController::class, 'certificate'])->name('certificate-view');


Route::get('/download-file', [DownloadfileController::class, 'download'])
    ->name('download.file');

Route::get('/secure-pdf', [DownloadfileController::class, 'servePdf'])->name('secure.pdf')->middleware('signed');

 Route::get('/download-application/{application_id}', [PDFController::class, 'generate'])->name('download-app');
});

require __DIR__.'/auth.php';
