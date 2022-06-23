<?php


namespace App\Laravue\Traits;


use App\Laravue\Models\Media\Attachment;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Attachmentable
{
    public function attachments(): MorphToMany {
        return $this->morphToMany(Attachment::class, 'attachmentable');
    }
}
