<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobCode extends Model
{
    protected $table = 'job_codes';
    protected $fillable = ['foldername', 'foldercolor', 'foldershape'];
}
