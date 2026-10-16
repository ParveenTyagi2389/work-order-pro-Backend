<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class StorePicture extends Model {
    protected $table = 'store_pictures';
    protected $fillable = ['site_id', 'description', 'notes', 'picture'];
    public function site() { return $this->belongsTo(Site::class, 'site_id', 'id'); }
}
