<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SponsorshipOpportunities extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'campaign_sponsorship_opportunities';
    protected $fillable = [
        'campaign_id',
        'title',
        'image',
        'amount'
    ];
    protected $dates = ['deleted_at'];
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
