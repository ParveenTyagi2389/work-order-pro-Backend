<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Technician extends Model
{
    use HasFactory;
    protected $table = 'technicians';
    protected $fillable = ['access', 'name', 'phone', 'email', 'notes', 'active'];
    protected $casts = ['access' => 'integer', 'active' => 'boolean'];
}
