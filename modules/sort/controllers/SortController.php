<?php

namespace app\modules\sort\controllers;

use yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\sort\models\Book;
use app\services;

class SortController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['getSortBooks', 'getBooks', 'getBooks'],
                'rules' => [
                    [
                        'allow' => true,
                        'verbs' => ['POST', 'GET', 'PUT']
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionGetSortBooks()
    {
        $sort = [];
        // Monta array de ordenação
        foreach ($_GET as $key => $value) {
            // Se valor da ordenação for nulo retorna erro!
            switch (strtolower($value)) {
                case 'asc': $sort[$key] = SORT_ASC; break;
                case 'desc': $sort[$key] = SORT_DESC; break;
                default: return json_encode(['error'=>'Valor de ordenação inválido']); break;
            }
        }
        
        $model = Book::find()->orderBy($sort)->all();

        // transforma de objeto private para array
        $books = [];
        foreach ($model as $key => $value) {
            $books[] = $value->getAttributes();
        }

        return json_encode(['data'=>$books]);
    }

    public function getBooks()
    {
        $sql = 'SELECT * FROM book';
        $sort = [];
        // Monta array de ordenação
        foreach ($_GET as $key => $value) {
            // Se valor da ordenação for nulo retorna erro!
            switch (strtolower($value)) {
                case 'asc': $sort[] = ' '.$key.' '.$value; break;
                case 'desc': $sort[] = ' '.$key.' '.$value; break;
                default: return json_encode(['error'=>'Valor de ordenação inválido']); break;
            }
        }
        if($sort){
            $sort = implode(', ', $sort);
            $sql .= ' ORDER BY'.$sort;
        }

        return Book::findBySql($sql)->all();
    }

    public function actionGetBooks()
    {
        $model = $this->getBooks();
        // transforma de objeto private para array
        $books = [];
        foreach ($model as $key => $value) {
            $books[] = $value->getAttributes();
        }

        return json_encode(['data'=>$books]);
    }
}
