<?php

namespace Redlite\Modules\Subredlite\Models;

class ModsMapper
{ 
    private $all_subs = [];

    public function __construct($subs, $mods)
    {
        foreach ($subs as $sub)
        {
            $newSubs = new SubRedlite($sub->id, $sub->name, $sub->description, $sub->owner_id);

            $this->all_subs[$sub->id] = $newSubs;
        }

        foreach ($mods as $mod)
        {
            $sub = $this->all_subs[$mod->subredlite_id];
            $modObj = new SubsMod($mod->id, $mod->subredlite_id, $mod->user_id, $mod->active);
            $sub->addMods($modObj);

            $this->all_subs[$mod->subredlite_id] = $sub;
        }
    }

    public function get()
    {
        return $this->all_subs;
    }
}


?>