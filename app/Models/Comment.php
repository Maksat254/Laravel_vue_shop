<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
  protected  $fillable = [
      'title',
      'commentable_id',
      'commentable_type',
  ];

  public function commentable(): BelongsTo
  {
      return $this->morphTo();
  }
}
