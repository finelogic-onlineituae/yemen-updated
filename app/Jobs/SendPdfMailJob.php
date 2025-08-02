<?php

namespace App\Jobs;

use App\Mail\PdfFormMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendPdfMailJob implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $application;
    protected $pdfContent;
    protected $email;

    /**
     * Create a new job instance.
     */
   public function __construct($application, $pdfContent, $email)
    {
        $this->application = $application;
        $this->pdfContent = $pdfContent;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $decodedPdf = base64_decode($this->pdfContent);

        Mail::to($this->email)->send(new PdfFormMail($this->application, $decodedPdf));
    }
}
