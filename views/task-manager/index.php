<?php
//use kartik\sortable\Sortable;
use demogorgorn\jquerysortable\Sortable;
use yii\helpers\ArrayHelper;
use Khill\FontAwesome\FontAwesome;
/* @var $this yii\web\View */
?>
<h1>Task Manager</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
    <br/>
    LENGTH : <?= sizeof($model)?>
    <br/>

    <?php
    	$data;
    	foreach(ArrayHelper::map($model, 'task_id', 'task_name') as $key=>$val){
            var_dump($key);
    		$data[] = ["content"=>($val), "options"=>["data-value"=>($key)]];
    	}

        $custom = [
            [
                'content' => 'FIRST',
                'options' => [
                    'class' => 'panel1', 'data-id' => 'XXX'
                ],
            ],
            [
                'content' => 'SECOND',
                'options' => [
                    'class' => 'panel1', 'data-id' => 'YYY'
                ],
                'items' => [
                    [
                        'content' => 'NESTED FIRST',
                        'options' => [
                            'class' => 'nestedPanel',
                            'data-id' => 'NESTED_XXX'
                        ]
                    ],
                    [
                        'content' => 'NESTED SECOND',
                        'options' => [
                            'class' => 'nestedPanel',
                            'data-id' => 'NESTED_YYY'
                        ]
                    ],
                    [
                        'content' => 'NESTED THIRD',
                        'options' => [
                            'class' => 'nestedPanel',
                            'data-id' => 'NESTED_ZZZ'
                        ]
                    ]
                ]
            ]
        ];



    	echo Sortable::widget([
	    'items'=>$custom,
        'options' => [
            'class' => 'vertical',
            'id' => 'menulist'
        ],
        'autoNestedEnabled' => true,
        'useDragHandle' => FontAwesome::icon('bars', ['style' => 'margin:4px;']),
        'clientOptions' => [
            'handle' => '.fa-bars',
            'onDragStart' => new \yii\web\JsExpression('function($item, container, _super){
                if(!container.options.drop){
                    $item.clone().insertAfter($item);
                    _super($item, container);
                }
            }')
        ]
        ]);

/*
        'items' => $data, 
        'clientOptions' => [
            'animation' => 150,
            'filter' => '.js-remove',
            'onFilter' => new \yii\web\JsExpression('function(evt){
                var code = evt.item.getAttribute("data-id");
                evt.item.parentNode.removeChild(evt.item);
            }'),
            'onUpdate' => new \yii\web\JsExpression('function(evt){
                console.log("HEYYYYY HO");
            }')
        ],
	    ]);
*/
    ?>
</p>

	
