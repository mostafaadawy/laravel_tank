<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductsUpdate  implements
    ToCollection,
    SkipsOnError,
    SkipsOnFailure,
    WithChunkReading
{
    use Importable,
        SkipsErrors,
        SkipsFailures;

    public function collection(Collection $rows)
    {

        $CustomArray=array();
        $CustomCol=array();
        $index=0;

        foreach ($rows as $row){
            $breakFlag=false;
            $ArrTrL1=array();
            $p2="";
            $product="";
            $prod_id="";
            $CustomRecord=array();
            $CustomTr=array();
            $barcodes=array();
            foreach ($row as $cell) {
                if (isset($cell)&&$cell!='false') {
                    if ($index == 0) {
                        $product = Product::where('lineItemId', $cell)->first();
                        if(!$product){
                            $breakFlag=true;
                            break;
                        }
                        $prod_id=$product->id;
                    } elseif ($index == 1) {
    //                        $ArrTrL1=Level1CategoryTranslation::where('name', trim($cell))->pluck('level1_category_id');
    //                        if(!isset($ArrTrL1)||sizeof($ArrTrL1)<1){
    //                            $breakFlag=true;
    //                            break;
    //                        }
                    } elseif ($index == 2) {
    //                        $ArrTrL2=Level2CategoryTranslation::where('name', trim($cell))->pluck('level2_category_id');
    //                        if(!isset($ArrTrL2)||sizeof($ArrTrL2)<1){
    //                            $breakFlag=true;
    //                            break;
    //                        }
    //                        $p2=Level2Category::whereIn('id', $ArrTrL2)->whereIn('parent_id', $ArrTrL1)->value('id');
    //                        if(!isset($p2)||sizeof($p2)<1){
    //                            $breakFlag=true;
    //                            break;
    //                        }
                    } elseif ($index == 3) {
    //                        $ArrTrL3=Level3CategoryTranslation::where('name', trim($cell))->pluck('level3_category_id');
    //                        if(!isset($ArrTrL3)||sizeof($ArrTrL3)<1){
    //                            $breakFlag=true;
    //                            break;
    //                        }
    //                        $category = Level3Category::whereIn('id', $ArrTrL3)->where('parent_id',$p2)->first();
    //                        array_push($CustomRecord,['category_id'=> $category->id]);
    //                        if(!isset($category)||sizeof($category)<1){
    //                            $breakFlag=true;
    //                            break;
    //                        }
                        $CustomRecord=array_merge($CustomRecord,['category_id'=> 1]);//for test real Above
                    } elseif ($index == 4) {
    //                        $brand = Brand::where('id', BrandTranslation::where('name', trim($cell))->value('brand_id'))->first();
    //                        if ($brand){
                        $CustomRecord=array_merge($CustomRecord,['brand_id'=> 1]);//for test real $brand
    //                          }
                    } elseif ($index == 5) {
                        $barcodes = explode(';', $cell);
                    } elseif ($index == 6) {
                        $CustomTr=array_merge($CustomTr,['en'=>['name'=>$cell]]);
                    } elseif ($index == 7) {
                        $CustomTr=array_merge($CustomTr,['ar'=>['name'=>$cell]]);
                    } elseif ($index == 8) {
                        $CustomRecord=array_merge($CustomRecord,['unit'=> 'kg']);//for test real $cell
                    } elseif ($index == 9) {
                        foreach (json_decode($cell) as $item) {
                            if (!is_null($item->branchId)) {
                                if (!is_null($item->newPrice)&&$item->newPrice!="") {
                                    if (!is_null($item->oldPrice)&&$item->oldPrice!="") {
                                        $q = ['branchId' => $item->branchId, 'Prices' => ['newPrice' => $item->newPrice, 'oldPrice' => $item->oldPrice]];
                                    } else {
                                        $q = ['branchId' => $item->branchId, 'Prices' => ['newPrice' => $item->newPrice]];
                                    }
                                    array_push($CustomCol, $q);
                                }
                            }
                        }
                    }
                    elseif ($index == 10) $CustomRecord=array_merge($CustomRecord,['old_price'=> $cell]);
                    elseif ($index == 11) $CustomRecord=array_merge($CustomRecord,['final_price'=> $cell]);
                    elseif ($index == 12) $CustomRecord=array_merge($CustomRecord,['available'=> $cell]);
                    elseif ($index == 13) $CustomTr=array_merge($CustomTr,['en'=>['description'=>$cell]]);
                    elseif ($index == 14) $CustomTr=array_merge($CustomTr,['ar'=>['description'=>$cell]]);
                    elseif ($index == 15) $CustomTr=array_merge($CustomTr,['en'=>['feature1'=>$cell]]);
                    elseif ($index == 16) $CustomTr=array_merge($CustomTr,['ar'=>['feature1'=>$cell]]);
                    elseif ($index == 17) $CustomTr=array_merge($CustomTr,['en'=>['feature2'=>$cell]]);
                    elseif ($index == 18) $CustomTr=array_merge($CustomTr,['ar'=>['feature2'=>$cell]]);
                    elseif ($index == 19) $CustomTr=array_merge($CustomTr,['en'=>['feature3'=>$cell]]);
                    elseif ($index == 20) $CustomTr=array_merge($CustomTr,['ar'=>['feature3'=>$cell]]);
                    elseif ($index == 21) $CustomTr=array_merge($CustomTr,['en'=>['feature4'=>$cell]]);
                    elseif ($index == 22) $CustomTr=array_merge($CustomTr,['ar'=>['feature4'=>$cell]]);
                    elseif ($index == 23) $CustomTr=array_merge($CustomTr,['en'=>['keywords'=>$cell]]);
                    elseif ($index == 24) $CustomTr=array_merge($CustomTr,['ar'=>['keywords'=>$cell]]);
                }
                else{
                    if($index<4) {
                        $breakFlag=true;
                        $prod_id="";
                        $CustomCol=array();
                        $barcodes=array();
                        break;
                    }

                }
                $index++;
            }
            $index=0;
            if($breakFlag==true)
            {
                $CustomRecord=array();
                $CustomCol=array();
            }
            else {
                array_push($CustomArray, ['id'=>$prod_id,'product_columns'=>$CustomRecord,'Tr'=>$CustomTr, 'update_barcodes'=>$barcodes,'update_branches'=>$CustomCol]);
                $CustomRecord=array();
                $CustomTr=array();
                $CustomCol=array();
            }
        }

        foreach ($CustomArray as $item){

            $product=Product::find($item['id']);
                // update product
                if($product){
                    $product->update($item['product_columns']);
                }
                // update barcode
//                $product->barcodes()->delete();
//                if (count($item['update_barcodes']) > 0) {
//                    foreach ($item['update_barcodes'] as $barcode) {
//                        ProductBarcode::create(['barcode' => $barcode,'product_id' => $item['id']]);
//                    }
//                }
                // update branches
//                if (count($item['update_branches']) > 0){
//                    foreach ($item['update_branches'] as $branch){
//                        $product->updateBranches()->detach($branch['branchId'],$branch['Prices']);
//                        $product->updateBranches()->attach($branch['branchId'],$branch['Prices']);
//                    }
//
//                }
                // update Translation
//                  if (count($item['Tr']) > 0)$product->update($item['Tr']);
            dd($item['Tr']);
            $data = [
                'en' => ['title' => 'EnEnEnEnEn','content' => 'EnEnEnEnEn'],
                'ar' => ['title' => 'ArArArArAr','content' => 'ArArArArAr'],
            ];
            $post = Post::find(1)->update($data);
        }

    }

//    public function onFailure(Failure ...$failures)
//    {
//        return back()->withFailures($failures);
//    }
    public function chunkSize(): int
    {
        return 1000;
    }
    public static function afterImport(AfterImport $event)
    {
        // TODO: Implement registerEvents() method.
    }
}

