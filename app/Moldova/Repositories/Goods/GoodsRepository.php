<?php

namespace App\Moldova\Repositories\Goods;


use App\Moldova\Entities\OcdsRelease;

class GoodsRepository implements GoodsRepositoryInterface
{
    /**
     * @var OcdsRelease
     */
    private $ocdsRelease;

    /**
     * GoodsRepository constructor.
     * @param OcdsRelease $ocdsRelease
     */
    public function __construct(OcdsRelease $ocdsRelease)
    {

        $this->ocdsRelease = $ocdsRelease;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllGoods($params)
    {
        if ($params === "") {
            return $this->getGoodsCount();
        }

        $orderIndex  = $params['order'][0]['column'];
        $ordDir      = $params['order'][0]['dir'];
        $column      = $this->getColumn($params['columns'][$orderIndex]['data']);
        $startFrom   = $params['start'];
        $ordDir      = (strtolower($ordDir) == 'asc') ? 1 : - 1;
        $search      = $params['search']['value'];
        $limitResult = $params['length'];
        $query  = [];
        $filter = [];

        $unwind = [
            '$unwind' => '$awards'
        ];
        array_push($query, $unwind);

        if ($search != '') {
            $filter = [
                '$match' => ['awards.items.classification.description' => ['$gt' => $search]]
            ];
        }

        if (!empty($filter)) {
            array_push($query, $filter);
        }

        $groupBy =
            [
                '$group' => [
                    '_id'       => '$awards.items.classification.description',
                    'count'     => ['$sum' => 1],
                    'goods'     => ['$addToSet' => '$awards.items.classification.description'],
                    'cpv_value' => ['$addToSet' => '$awards.items.classification.id'],
                    'unit'      => ['$addToSet' => '$awards.items.classification.scheme']
                ]
            ];

        array_push($query, $groupBy);
        $sort = ['$sort' => [$column => $ordDir]];
        array_push($query, $sort);
        $skip = ['$skip' => (int) $startFrom];
        array_push($query, $skip);
        $limit = ['$limit' => (int) $limitResult];
        array_push($query, $limit);

        $result = OcdsRelease::raw(function ($collection) use ($query) {
            return $collection->aggregate($query);
        });

        return ($result['result']);


//        $agencies = $this->ocdsRelease
//            //->select(['buyer.name'])
//            ->where(function ($query) use ($search) {
//                if (!empty($search)) {
//                    return $query->where('buyer.name', 'like', '%' . $search . '%');
//                }
//
//                return $query;
//            })
//            //->skip($startFrom)
//            ->orderBy($column, $ordDir)
//            ->distinct()
//            ->get(['buyer.name']);
//        $agencies = ($agencies->splice($startFrom)->take($limitResult));
//
//        $buyers = [];
//        foreach ($agencies as $key => $agency) {
//
//            $buyer = $this->getBuyerDetails($agency[0]);
//
//            $buyers[$key]['buyer']          = $agency[0];
//            $buyers[$key]['tender']         = $buyer['tenderCount'];
//            $buyers[$key]['contract']       = $buyer['contractCount'];
//            $buyers[$key]['contract_value'] = $buyer['amount'];
//
//        }
//
//        return $buyers;
    }

    protected function getColumn($column)
    {
        switch ($column) {
            case(0):
                $column = 'awards.items.classification.description';
                break;
            case(1):
                $column = 'awards.items.classification.id';
                break;
            case(2):
                $column = 'awards.items.classification.scheme';
                break;
        }

        return $column;
    }

    /**
     * @return mixed
     */
    private function getGoodsCount()
    {
        $query  = [];
        $unwind = [
            '$unwind' => '$awards'
        ];
        array_push($query, $unwind);
        $groupBy =
            [
                '$group' => [
                    '_id'   => '$awards.items.classification.description',
                    'goods' => ['$addToSet' => '$awards.items.classification.description']
                ]
            ];

        array_push($query, $groupBy);

        $result = OcdsRelease::raw(function ($collection) use ($query) {
            return $collection->aggregate($query);
        });

        return $result['result'];
    }
}
