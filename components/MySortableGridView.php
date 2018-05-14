<?php

namespace app\components;

use Closure;

use richardfan\sortable\SortableGridView;

use yii\base\InvalidConfigException;
use yii\grid\GridView;
use yii\helpers\Json;
use yii\grid\GridViewAsset;
use yii\helpers\Html;

class MySortableGridView extends SortableGridView {   
    /**
     * {@inheritDoc}
     * @see \yii\grid\GridView::renderTableRow()
     */
    public function renderTableRow($model, $key, $index)
    {
        $cells = [];
        /* @var $column Column */
        foreach ($this->columns as $column) {
            $cells[] = $column->renderDataCell($model, $key, $index);
        }
        
        if ($this->rowOptions instanceof Closure) {
            $options = call_user_func($this->rowOptions, $model, $key, $index, $this);
        } else {
            $options = $this->rowOptions;
        }
        
        if(is_array($model->primaryKey)){
            $options['id'] = "items[]_".(implode(",", $model->primaryKey));
        }else{
            $options['id'] = "items[]_{$model->primaryKey}";
        }

        $options['data-key'] = is_array($key) ? json_encode($key) : (string) $key;
        
        return Html::tag('tr', implode('', $cells), $options);
    }
}
