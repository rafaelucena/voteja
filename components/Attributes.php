<?php

namespace yii\helpers;

class Attributes extends Common
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
        $html = null;

        switch ($attribute) {
            case 'created':
                $html = Html::a(
                    $model->createdBy->person->firstname,
                    ['/person/view', 'id' => $model->createdBy->person->id]
                );
                break;

            case 'updated':
                $html = Html::a(
                    $model->updatedBy->person->firstname,
                    ['/person/view', 'id' => $model->updatedBy->person->id]
                );
                break;

            case 'party':
                $html = Html::a(
                    $model->party->code,
                    ['/party/view', 'id'=>$model->party->id]
                );
                break;
        }

        return $html;
    }

    /**
     * @param $attribute
     * @return array
     */
    public static function view($attribute)
    {
        $output = null;

        switch ($attribute) {
            case 'created':
                $output = [
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
                break;
            case 'updated':
                $output = [
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
                break;
        }

        return $output;
    }

    /**
     * @param $attribute ('id'|'created'|'updated')
     * @return array
     */
    public static function index($attribute)
    {
        $output = null;

        switch ($attribute) {
            case 'id':
                $output = [
                    'attribute' => 'id',
                    'headerOptions' => ['style' => 'width:50px'],
                ];
                break;
            case 'created':
                $output = [
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
                break;
            case 'updated':
                $output = [
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
                break;
        }

        return $output;
    }

    /**
     * @param $attribute
     * @return array|string
     */
    public static function general($attribute)
    {
        $output = null;

        switch ($attribute) {
            case 'status':
                $output = [
                    'label' => 'Status',
                    'attribute' => 'historyStatus.name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->historyStatus) {
                            return $model->historyStatus->name;
                        }
                    },
                ];
                break;
            case 'party':
                $output = [
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
                break;
        }

        return $output;
    }
}
