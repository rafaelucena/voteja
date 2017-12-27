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
        } elseif ($attribute === 'party') {
            return Html::a(
                $model->party->code,
                ['/party/view', 'id'=>$model->party->id]
            );
        } else {
            return '';
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
                        $html = self::getHtml($model, 'created');

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
                        $html = self::getHtml($model, 'updated');

                        return $model->updated . ' | ' . $html;
                    }
                },
            ];
        } else {
            return '';
        }
    }

    /**
     * @param $attribute
     * @return array
     */
    public static function standardIndex($attribute)
    {
        if ($attribute === 'id') {
            return [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:50px'],
            ];
        } elseif ($attribute === 'created') {
            return [
                'label' => 'Created',
                'attribute' => 'createdBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->createdBy) {
                        $html = self::getHtml($model, 'created');

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
                        $html = self::getHtml($model, 'updated');

                        return date(self::INDEX_DATE_FORMAT, strtotime($model->updated)) . ' | ' . $html;
                    }
                },
            ];
        } else {
            return '';
        }
    }

    /**
     * @param $attribute
     * @return array|string
     */
    public static function standardGlobal($attribute)
    {
        if ($attribute === 'status') {
            return [
                'label' => 'Status',
                'attribute' => 'historyStatus.name',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->historyStatus) {
                        return $model->historyStatus->name;
                    }
                },
            ];
        } elseif ($attribute === 'party') {
            return [
                'label' => 'Party',
                'attribute' => 'party.code',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->party) {
                        $html = self::getHtml($model, 'party');

                        return $html;
                    }
                },
            ];
        } else {
            return '';
        }
    }
}
