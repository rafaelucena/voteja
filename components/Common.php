<?php

namespace yii\helpers;

//use yii\helpers\Html;

class Common
{
    /**
     *
     */
    const INDEX_DATE_FORMAT = 'Y-m-d';

    /**
     * @param $model
     * @param $attribute
     * @return string
     */
    private static function getHtml($model, $attribute)
    {
        if ($attribute === 'created') {
            return Html::a(
                $model->createdBy->person->firstname,
                ['/person/view', 'id' => $model->createdBy->person->id]
            );
        } elseif ($attribute === 'updated') {
            return Html::a(
                $model->createdBy->person->firstname,
                ['/person/view', 'id' => $model->createdBy->person->id]
            );
        }
    }

    /**
     * @param $attribute
     * @return array
     */
    public static function standardView($attribute)
    {
        if ($attribute === 'created') {
            return [
                'label' => 'Created',
                'attribute' => 'createdBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->createdBy) {
                        $html = Html::a(
                            $model->createdBy->person->firstname,
                            ['/person/view', 'id' => $model->createdBy->person->id]
                        );

                        return $model->created . ' | ' . $html;
                    }
                },
            ];
        } elseif ($attribute === 'updated') {
            return [
                'label' => 'Updated',
                'attribute' => 'updatedBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->updatedBy) {
                        $html = Html::a(
                            $model->updatedBy->person->firstname,
                            ['/person/view', 'id'=>$model->updatedBy->person->id]
                        );

                        return $model->updated . ' | ' . $html;
                    }
                },
            ];
        }
    }

    /**
     * @param $attribute
     * @return array
     */
    public static function standardIndex($attribute)
    {
        if ($attribute === 'created') {
            return [
                'label' => 'Created',
                'attribute' => 'createdBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->createdBy) {
                        $html = Html::a(
                            $model->createdBy->person->firstname,
                            ['/person/view', 'id' => $model->createdBy->person->id]
                        );

                        return date(self::INDEX_DATE_FORMAT, strtotime($model->created)) . ' | ' . $html;
                    }
                },
            ];
        } elseif ($attribute === 'updated') {
            return [
                'label' => 'Updated',
                'attribute' => 'updatedBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->updatedBy) {
                        $html = Html::a(
                            $model->updatedBy->person->firstname,
                            ['/person/view', 'id'=>$model->updatedBy->person->id]
                        );

                        return date(self::INDEX_DATE_FORMAT, strtotime($model->updated)) . ' | ' . $html;
                    }
                },
            ];
        }
    }
}
