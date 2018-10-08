<?php
namespace App\Services;

use App\Models\Region;
use Cache;

class RegionService extends BaseService {
    public function __construct() {
        $this->model = new Region();
    }

    // 获取省市数据
    public static function getRegionData() {
        $province = Cache::get('province');

        if (empty($province)) {
            // 省
            $province = Region::select('id', 'name')
                ->where('level', 1)
                ->orderBy('id')
                ->get()
                ->toArray();

            foreach ($province as $k => $v) {
                // 市
                $province_id = $v['id'];
                $city        = Region::select('id', 'name')
                    ->where('level', 2)
                    ->where('parent_id', $province_id)
                    ->orderBy('id')
                    ->get()
                    ->toArray();

                foreach ($city as $key => $value) {
                    // 区
                    $city_id = $value['id'];
                    $area    = Region::select('id', 'name')
                        ->where('level', 3)
                        ->where('parent_id', $city_id)
                        ->orderBy('id')
                        ->get()
                        ->toArray();

                    $city[$key]['child'] = $area;
                }

                $province[$k]['child'] = $city;
            }

            Cache::forever('province', $province);
        }

        return $province;
    }
}