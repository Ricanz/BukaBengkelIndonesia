<?php

namespace App\Http\Resources;

use App\Models\Employee;
use App\Models\MasterType;
use App\Models\ServiceAdvisor;
use App\Models\StandartChecking;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckingExportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $pre = StandartChecking::where('checking_id', $this->id)->where('type', 'pre')->first();
        $post = StandartChecking::where('checking_id', $this->id)->where('type', 'post')->first();
        $teknisi = Employee::where('id', $this->employee_id)->pluck('fullname')->first();
        $sa = ServiceAdvisor::where('id', $this->sa_id)->pluck('name')->first();
        $merk = MasterType::where('id', $this->type_id)->pluck('name')->first();
        
        return [
            'teknisi' => $teknisi,
            'wo' => $this->wo,
            'plat_number' => $this->plat_number,
            'merk' => $merk,
            'sa' => $sa,
            'status' => !$post ? 'Pre-Check' : 'Post-Check',
            'precheck_date' => $pre ? Carbon::parse($pre->created_at)->format('d/m/Y') : '',
            'pre_high' => $pre ? $pre->high : '',
            'pre_low' => $pre ? $pre->low : '',
            'pre_suhu' => $pre ? $pre->suhu : '',
            'pre_wind' => $pre ? $pre->wind : '',
            'saran' => $this->saran,
            'pre_pdf' => $pre ? env('APP_URL').'/check-pdf/'.$pre->id : '',
            'postcheck_date' => $post ? Carbon::parse($post->created_at)->format('d/m/Y') : '',
            'post_high' => $post ? $post->high : '',
            'post_low' => $post ? $post->low : '',
            'post_suhu' => $post ? $post->suhu : '',
            'post_wind' => $post ? $post->wind : '',
            'saran_post' => $this->saran_post,
            'post_pdf' => $post ? env('APP_URL').'/check-pdf/post/'.$post->id : ''
        ];
    }
}
