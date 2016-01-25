<?php
/**
 *  This file is part of the BlackfyreStudio CRUD package which is a recreation of the Krafthaus Bauhaus package.
 *  Copyright (C) 2016. Galicz Miklós <galicz.miklos@blackfyre.ninja>
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License along
 *  with this program; if not, write to the Free Software Foundation, Inc.,
 *  51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */


namespace BlackfyreStudio\CRUD\Fields;

/**
 * Class BelongsToManyField
 * @package BlackfyreStudio\CRUD\Fields
 */
class BelongsToManyField extends RelationField
{

    /**
     * Render the field.
     *
     * @access public
     * @return mixed|string
     */
    public function render()
    {
        if ($this->getDisplayField() === null) {
            throw new \InvalidArgumentException(sprintf('Please provide a display field for the `%s` relation.', $this->getName()));
        }
        switch ($this->getContext()) {
            case BaseField::CONTEXT_INDEX:
                $baseModel = $this->getMasterInstance()->getModelFullName();
                $baseModel = new $baseModel;
                $relatedModel = $baseModel->{$this->getName()}()->getRelated();
                $primaryKey = $relatedModel->getKeyName();
                $values = [];
                foreach ($this->getValue() as $item) {
                    $values[$item->{$primaryKey}] = $item->{$this->getDisplayField()};
                }
                return implode(', ', $values);
                break;
            case BaseField::CONTEXT_FORM:
                $baseModel = $this->getMasterInstance()->getModelFullName();
                $baseModel = new $baseModel;
                $primaryKey = $baseModel->getKeyName();
                $relatedModel = $baseModel->{$this->getName()}()->getRelated();
                $items = [];
                foreach ($relatedModel::all() as $item) {
                    $items[$item->{$primaryKey}] = $item->{$this->getDisplayField()};
                }
                $id = $this->getMasterInstance()->getFormBuilder()->getIdentifier();
                $values = [];
                if ($id !== null) {
                    foreach ($baseModel::find($id)->{$relatedModel->getTable()} as $item) {
                        $values[$item->{$primaryKey}] = $item->{$primaryKey};
                    }
                }
                return view('crud::fields.belongs_to_many')
                    ->with('field', $this)
                    ->with('items', $items)
                    ->with('values', $values);
                break;
            case BaseField::CONTEXT_FILTER:
            default:
                return null;
                break;
        }
    }

    /**
     * Override the getAttributes method to add the multiple attribute.
     *
     * @access public
     * @return array
     */
    public function getAttributes()
    {
        $this->setAttribute('multiple', true);
        return $this->attributes;
    }
}