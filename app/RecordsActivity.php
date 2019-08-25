<?php

namespace App;

trait RecordsActivity {
    public $oldAttributes = [];

    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event) {
            if ($event === 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }

            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });
        }
    }

    protected static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }

        return ['created', 'updated', 'deleted'];
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project'
                ? $this->id
                : $this->project->id,
            'user_id' => ($this->project ?? $this)->owner->id
        ]);
    }

    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after' => array_except($this->getChanges(), 'updated_at')
            ];
        }
    }

    protected function activityDescription($description)
    {
        return "${description}_" . strtolower(class_basename($this));
    }
}
