<?php

namespace App\Models;

use App\Models\ClaimInsuredData;
use App\Models\SlipTable;
use App\Models\Currencies;
use App\Models\ClaimLossDescription;
use Illuminate\Database\Eloquent\Model;

class ClaimDetail extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'claim_detail';

    public function claiminsureddata()
    {
        return $this->hasMany(ClaimInsuredData::class, 'main_claim_id', 'id');
    }

    public function slip()
    {
        return $this->belongsTo(SlipTable::class, 'doc_number', 'number')->latest();
    }

    public function userce()
    {
        return $this->belongsTo(User::class, 'ceuser');
    }

    public function userexaminer()
    {
        return $this->belongsTo(User::class, 'examiner');
    }

    public function userboard()
    {
        return $this->belongsTo(User::class, 'dec_board');
    }

    public function userdecman()
    {
        return $this->belongsTo(User::class, 'dec_manager');
    }

    public function userastman()
    {
        return $this->belongsTo(User::class, 'ast_manager');
    }

    public function usergenman()
    {
        return $this->belongsTo(User::class, 'gen_manager');
    }

    public function usercreatece()
    {
        return $this->belongsTo(User::class, 'user_create_ce');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function currloss()
    {
        return $this->belongsTo(Currencies::class, 'curr_id_loss');
    }

    public function lossdescs()
    {
        return $this->hasMany(ClaimLossDescription::class, ['reg_comp', 'doc_counter'], ['reg_comp', 'doc_counter']);
    }

    public function viewattachs()
    {
        return $this->hasMany(ClaimViewAttachment::class, 'reg_comp', 'reg_comp');
    }
}
