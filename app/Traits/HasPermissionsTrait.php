<?php

namespace App\Traits;

trait HasPermissionsTrait
{
    public function getPermissionConvertJson()
    {
        $tree = [];
        foreach (config('permission') as $config) {
            $node_tree = $this->getConvertKeyName($config);
            if ($node_tree === false) {
                continue;
            }
            if (count(@$config['children'] ?? []) > 0) {
                $node_tree['children'] = $this->getTreeChildrent($config['children']);
            }
            array_push($tree, $node_tree);
        }
        return $tree;
    }

    public function getConvertKeyName(array $config)
    {
        if (!empty(@$config['name']) && !empty(@$config['key'])) {
            return [
                'text' => $config['name'],
                'id'   => $config['key'],
            ];
        }
        return false;
    }

    public function getTreeChildrent($children)
    {
        $node_revert = [];
        foreach ($children as $item) {
            $node_tree = $this->getConvertKeyName($item);
            if ($node_tree === false) {
                continue;
            }
            if (count(@$item['children'] ?? []) > 0) {
                $node_tree['children'] = $this->getTreeChildrent($item['children']);
            }
            array_push($node_revert, $node_tree);
        }
        return $node_revert;
    }

    public function getJsonPermissionToArray($permissions)
    {
        return collect($permissions)->map(function ($value) {
            return json_decode($value);
        })->unique();
    }


}
