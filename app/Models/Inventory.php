<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;


class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity']; // Définis les colonnes autorisées
}
