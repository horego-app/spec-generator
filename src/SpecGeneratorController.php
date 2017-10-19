<?php

namespace Printerous\SpecGenerator;

use Illuminate\Http\Request;

use printerous\Http\Requests;
use printerous\Http\Controllers\Controller;

class SpecGeneratorController extends Controller
{
    function generate($type, $orderDetail, $sku = null){
        switch($type){
            case "v3":
                $this->generateV3($orderDetail);
                break;
            case "arterous":
                $this->generateShop($orderDetail, $sku);
                break;
            case "shop":
                $this->generateShop($orderDetail, $sku);
                break;
            case "moments":
                $this->generateMoments($orderDetail);
                break;
            case "panorama":
                break;
            case "custom_orders":
                $this->generateV3($orderDetail);
                break;
        }
    }

    function generateShop($orderDetail,$sku){
        $product = $this->getSkuType($orderDetail->sku_id);
        $project_data = $orderDetail->project_data;
        $spec = array();
        switch ($product) {
            case 'canvas_art':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'poster':
                if(@$sku->title) $spec['title'] = "Poster ".$sku->title;
                break;
            case 'tshirt':
                if(@$sku->title) $spec['title'] = $sku->title;
                if(@$project_data->colorName) $spec['color'] = "Color: ".ucwords($project_data->colorName);
                if(@$project_data->size) $spec['size'] = "Size: ".ucwords($project_data->size);
                break;
            case 'notebook_a5':
                if(@$sku->title) $spec['title'] = $sku->title;
                if(@$project_data->paper) $spec['paper'] = "Paper: ".ucwords($project_data->paper);
                break;
            case 'notebook_pocket':
                if(@$sku->title) $spec['title'] = $sku->title;
                if(@$project_data->paper) $spec['paper'] = "Paper: ".ucwords($project_data->paper);
                break;
            case 'frame_art':
                if(@$sku->title) $spec['title'] = $sku->title;
                if(@$project_data->type) $spec['frame'] = "Frame: ".$project_data->type;
                if(@$project_data->layout) $spec['layout'] = "Layout: ".$project_data->layout."%";
                break;
            case 'gadget_case':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'greetingcards':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'postcards':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'magnets':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'pillow':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'totebag':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'laptop_skins':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'mug':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'tumblr':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
            case 'scarf':
                if(@$sku->title) $spec['title'] = $sku->title;
                break;
        }
    }

    function getSkuType($skuId){
        $canvas_art_type = array(1,2,3,55,56,57,4,5,6,7,8,9,10,11,12,13); // 16 skus
        $pillow_type = array(14,15); // 2 skus
        $notebook_a5 = array(16);
        $notebook_pocket = array(17);
        $tshirt = array(26,67);
        $postcards = array(27,28,29); // 3 skus
        $greetingcards = array(30,31,32); // 3 skus
        $laptop_skins = array(48,49,50,51,58,59,60,61); // 8 skus
        $totebag = array(53);
        $magnets = array(54);
        $iphone4 = array(18);
        $iphone5 = array(19);
        $iphone6 = array(20);
        $iphone6plus = array(21);
        $ipad234 = array(22);
        $ipadmini = array(23);
        $galaxys4 = array(24);
        $galaxys5 = array(25);
        $galaxys7 = array(66, 72);
        $gadgets = array(18,19,20,21,22,23,24,25,66,68,71);
        $frame_art = array(33,34,35,36,37,41,42,38,39,40,46,47,43,44,45);
        $poster = array(52,62,63);
        $mug = array(64);
        $tumblr = array(65, 69);
        $scarf = array(70);

        if(in_array($skuId, $canvas_art_type)) return 'canvas_art';
        if(in_array($skuId, $pillow_type)) return 'pillow';
        if(in_array($skuId, $notebook_a5)) return 'notebook_a5';
        if(in_array($skuId, $notebook_pocket)) return 'notebook_pocket';
        if(in_array($skuId, $tshirt)) return 'tshirt';
        if(in_array($skuId, $postcards)) return 'postcards';
        if(in_array($skuId, $greetingcards)) return 'greetingcards';
        if(in_array($skuId, $laptop_skins)) return 'laptop_skins';
        if(in_array($skuId, $totebag)) return 'totebag';
        if(in_array($skuId, $magnets)) return 'magnets';
        if(in_array($skuId, $gadgets)) return 'gadget_case';
        if(in_array($skuId, $iphone4)) return 'iphone4';
        if(in_array($skuId, $iphone5)) return 'iphone5';
        if(in_array($skuId, $iphone6)) return 'iphone6';
        if(in_array($skuId, $iphone6plus)) return 'iphone6plus';
        if(in_array($skuId, $ipad234)) return 'ipad234';
        if(in_array($skuId, $ipadmini)) return 'ipadmini';
        if(in_array($skuId, $galaxys4)) return 'galaxys4';
        if(in_array($skuId, $galaxys5)) return 'galaxys5';
        if(in_array($skuId, $galaxys7)) return 'galaxys7';
        if(in_array($skuId, $frame_art)) return 'frame_art';
        if(in_array($skuId, $poster)) return 'poster';
        if(in_array($skuId, $mug)) return 'mug';
        if(in_array($skuId, $tumblr)) return 'tumblr';
        if(in_array($skuId, $scarf)) return 'scarf';
    }

    function generateMoments($orderDetail){
        $project_data = $orderDetail->project_data;
        $spec = array();
        switch($project_data->type){
            case "canvas":
                if(@$project_data->qty) $spec['display_name'] = $project_data->qty.' x Canvas';
                if(@$project_data->canvas_type) $spec['type'] = "Material: ".$project_data->canvas_type;
                if(@$project_data->orientation) $spec['orientation'] = "Orientation: ".$project_data->orientation;
                if(@$project_data->size) $spec['size'] = "Size: ".$project_data->size;
                if(@$project_data->spine) $spec['spine'] = "Spine: ".$project_data->spine;
                break;
            case "totebag":
                $spec['display_name'] = "1 x Tote Bag";
                if(@$project_data->size) $spec['size'] = "Size: ".$project_data->size;
                break;
            case "magnet":
                if(@$project_data->size) $spec['size'] = "Quantity: ".$project_data->size;
                if(@$project_data->shape) $spec['shape'] = "Shape: ".$project_data->shape;
                break;
            case "pillow":
                if(@$project_data->size) $spec['size'] = "Size: ".$project_data->size;
                if(@$project_data->insert) $spec['insert'] = "Insert: ".($project_data->insert === true ? "With Insert":"Without Insert");
                break;
            case "photoprint":
                if(@$project_data->size) $spec['size'] = "Quantity: ".$project_data->size;
                if(@$project_data->cover) $spec['cover'] = "Cover: ".$project_data->cover;
                if(@$project_data->useWood) $spec['useWood'] = ($project_data->useWood === true ? "With Wood Block & Box":"Without Wood Block & Box");
                break;
            case "photobook":
                if(@$project_data->paper_type) $spec['paper_type'] = "Paper: ".$project_data->paper_type;
                break;
            case "gadget":
                if(@$project_data->size) $spec['size'] = "Size: ".$project_data->size;
                break;
            case "frameart":
                if(@$project_data->size) $spec['size'] = "Size: ".$project_data->orientation;
                if(@$project_data->orientation) $spec['orientation'] = "Orientation: ".$project_data->orientation;
                if(@$project_data->frame) $spec['frame'] = "Frame: ".$project_data->frame;
                if(@$project_data->layout) $spec['layout'] = "Layout: ".$project_data->layout;
                break;
        }
        return $spec;
    }

    function generateV3($orderDetail){
        $product = $orderDetail->project_data->prod;
        $options = $orderDetail->project_data->options;
        $properties = $orderDetail->project_data->properties;
        $spec = array();
        //business card & square card
        if (in_array($product, array('businesscard', 'squarecard'))) {
            $spec['quantity'] = $options->quantity ?: 0;
            if ($product == 'businesscard') {
                $spec['quantity'] .= " x " . (@$orderDetail->project_data->display_name ? $orderDetail->project_data->display_name : "Business Card");
            } elseif ($product == 'squarecard') {
                $spec['quantity'] .= " x " . (@$orderDetail->project_data->display_name ? $orderDetail->project_data->display_name : "Square Card");
            }
            $spec['size'] = "Size: " . $options->size;
            $spec['sides'] = "Sides: " . $options->sides;
            $spec['paper'] = "Papertype: " . (@$orderDetail->project_data->kertas ? $orderDetail->project_data->kertas : $options->paper);
            if ($product == 'businesscard') {
                $spec['finishing'] = "Finishing: " . (@$options->finishing ? $options->finishing : "");
                $spec['finish'] = "Cornertype: " . (@$options->finish ? $options->finish : "");
                $spec['laminate'] = "Lamination: " . (@$options->laminate ? $options->laminate : "");
            }
            if (@$options->speed) {
                if (strpos($options->speed, 'fast') !== false) $spec['speed'] = "Speed: Fast";
                if (strpos($options->speed, 'same') !== false) $spec['speed'] = "Speed: Same Day";
                if (strpos($options->speed, 'standar') !== false) $spec['speed'] = "Speed: Standar";
            }
        }

        //brochure
        if (in_array($product, array('brochure'))) {
            $spec['quantity'] = $options->quantity ?: 0;
            $spec['quantity'] .= " x " . (@$orderDetail->project_data->display_name ? $orderDetail->project_data->display_name : "Brochure");
            $spec['size'] = "Size: " . $options->size;
            $spec['sides'] = "Sides: " . $options->sides;
            $spec['paper'] = "Papertype: " . (@$orderDetail->project_data->kertas ? $orderDetail->project_data->kertas : $options->paper);
            if (@$options->finish) {
                if ($options->finish == 2) $spec['finish'] = "Folding: Bifold";
                if ($options->finish == 'z_fold') $spec['finish'] = "Folding: Trifold - Z fold";
                if ($options->finish == 'u_fold') $spec['finish'] = "Folding: Trifold - U fold";
            }
            if (@$options->speed) {
                if (strpos($options->speed, 'fast') !== false) $spec['speed'] = "Speed: Fast";
                if (strpos($options->speed, 'same') !== false) $spec['speed'] = "Speed: Same Day";
                if (strpos($options->speed, 'standar') !== false) $spec['speed'] = "Speed: Standar";
            }
        }

        //calendar
        if (in_array($product, array('calendar'))) {
            $spec['quantity'] = $options->quantity ?: 0;
            $spec['quantity'] .= " x " . (@$orderDetail->project_data->display_name ? $orderDetail->project_data->display_name : "Calendar");
            /*if(@$options->size){
                if($options->size == 'wall') $spec['size'] = 'Side: 1 (side)';
                if($options->size == 'desk') $spec['size'] = 'Side: 2 (sides)';
            }*/
            $spec['paper'] = "Papertype: " . (@$orderDetail->project_data->kertas ? $orderDetail->project_data->kertas : $options->paper);
            $spec['laminate'] = "Lamination: " . (@$options->laminate ? $options->laminate : "");
            if (@$options->size) $spec['size'] = "Type: " . $options->size;
            if (@$options->sheet) $spec['sheet'] = "Sheets: " . $options->sheet;
            if (@$options->format) $spec['format'] = "Format: " . $options->sheet;
            //if(@$options->spiral) $spec['spiral'] = "Spiral Color: ".$options->spiral;
            if (@$options->package) $spec['package'] = "Packaging: " . $options->package;
            if (@$options->speed) {
                if (strpos($options->speed, 'fast') !== false) $spec['speed'] = "Speed: Fast";
                if (strpos($options->speed, 'same') !== false) $spec['speed'] = "Speed: Same Day";
                if (strpos($options->speed, 'standar') !== false) $spec['speed'] = "Speed: Standar";
            }
            if (@$orderDetail->project_data->design_file) {
                $idx = 0;
                foreach ($orderDetail->project_data->design_file as $key => $val) {
                    if ($key === 'email') {
                        $spec['design_file'] = "File sent: By email";
                    } else {
                        if ($idx == 0) {
                            $spec['design_file'] .= "File sent: <br/>";
                        } else {
                            $spec['design_file'] .= "<a>" . substr($val, 0, 29) . "</a><br/>";
                        }
                    }
                    $idx++;
                }
            }
        }

        //flyer,letterhead,poster,envelope
        if (in_array($product, array('flyer', 'letterhead', 'poster', 'envelope'))) {
            $spec['quantity'] = $options->quantity ?: 0;
            $spec['quantity'] .= " x " . (@$orderDetail->project_data->display_name ? $orderDetail->project_data->display_name : "Calendar");
            if (@$options->size) $spec['size'] = "Size: " . $options->size;
            if (@$options->sides) $spec['sides'] = "Sides: " . $options->sides;
            $spec['paper'] = "Papertype: " . (@$orderDetail->project_data->kertas ? $orderDetail->project_data->kertas : $options->paper);
            if (@$options->speed) {
                if (strpos($options->speed, 'fast') !== false) $spec['speed'] = "Speed: Fast";
                if (strpos($options->speed, 'same') !== false) $spec['speed'] = "Speed: Same Day";
                if (strpos($options->speed, 'standar') !== false) $spec['speed'] = "Speed: Standar";
            }
            if (@$orderDetail->project_data->design_file) {
                $idx = 0;
                foreach ($orderDetail->project_data->design_file as $key => $val) {
                    if ($key === 'email') {
                        $spec['design_file'] = "File sent: By email";
                    } else {
                        if ($idx == 0) {
                            $spec['design_file'] .= "File sent: <br/>";
                        } else {
                            $spec['design_file'] .= "<a>" . substr($val, 0, 29) . "</a><br/>";
                        }
                    }
                    $idx++;
                }
            }
        }

        //tshirt,poloshirt
        if(in_array($product, array('tshirt','poloshirt'))) {
            if (@$options->front) $spec['front'] = "Front: " . $options->front;
            if (@$options->back) $spec['back'] = "Back: " . $options->back;
            if (@$options->left) $spec['left'] = "Left Arm: " . $options->left;
            if (@$options->right) $spec['right'] = "Right Arm: " . $options->right;
            if (@$options->nlogo) $spec['nlogo'] = "Near Colar: " . $options->nlogo;
            if($product == 'poloshirt'){
                if (@$options->color) $spec['color'] = "Color: " . $options->color;
            }
            if (@$options->speed) {
                if (strpos($options->speed, 'sticker') !== false) $spec['speed'] = "Speed: Fast, Sticker";
                if (strpos($options->speed, 'sablon') !== false) $spec['speed'] = "Speed: Standar, Sablon";
            }
            if (@$options->qtySizeMap){
                $spec['qtySizeMap'] = "Quantity: <br/>";
                foreach($options->qtySizeMap as $key=>$val){
                    if($val['qty'] != 0){
                        $spec['qtySizeMap'] .= $val['color']." ".$val['size'].", ".$val['qty']."<br/>";
                    }
                }
            }
            if (@$orderDetail->project_data->design_file) {
                $idx = 0;
                foreach ($orderDetail->project_data->design_file as $key => $val) {
                    if ($key === 'email') {
                        $spec['design_file'] = "File sent: By email";
                    } else {
                        if ($idx == 0) {
                            $spec['design_file'] .= "File sent: <br/>";
                        } else {
                            $spec['design_file'] .= "<a>" . substr($val, 0, 29) . "</a><br/>";
                        }
                    }
                    $idx++;
                }
            }
        }

        //banner,xbanner,rollupbanner,tripodbanner,eventbackwall,eventdesk,popuptable,popupstand,canvastotebag,spunboundtotebag,spunbond_tote,greetingcard,thankyoucard,voucher,stampcard,companyfolder,sticker,canvas_tote,loyaltycard
        if(in_array($product, array('banner','xbanner','rollupbanner','tripodbanner','eventbackwall','eventdesk','popuptable','popupstand','canvastotebag','spunboundtotebag','spunbond_tote','greetingcard','thankyoucard','voucher','stampcard','companyfolder','sticker','canvas_tote','loyaltycard'))){
            if($product == 'voucher'){
                if (@$options->quantity) {
                    $spec['quantity'] = $options->quantity." x ".($orderDetail->project_data->display_name?:$orderDetail->project_data->prod);
                    if(@$options->size && $options->size == '20x7') $spec['quantity'] .= "book (".$options->quantity." sheet)";
                }
            }else{
                if (@$options->quantity) $spec['quantity'] = $options->quantity." x ".($orderDetail->project_data->display_name?:$orderDetail->project_data->prod);
            }
            if (@$options->printopt) $spec['printopt'] = "Option: ".specFilter($options->printopt);
            if (@$options->size) $spec['size'] = "Size: ".specFilter($options->size);
            if (@$options->sides) $spec['sides'] = "Sides: ".specFilter($options->sides). " (".($options->sides == 2? "Two" : "One").")";
            if(@$options->paper){
                if(@$orderDetail->projec_data->properties->Kertas){
                    $spec['paper'] = "Material: " . $orderDetail->projec_data->properties->Kertas;
                }else{
                    $spec['paper'] = "Material: " . $options->paper;
                }
            }
            if (@$options->material) $spec['material'] = "Material: ".$options->material;
            if (@$options->shape) $spec['shape'] = "Shape: ".specFilter($options->shape);
            if (@$options->flap) $spec['flap'] = "Flap: ".specFilter($options->flap);
            if (@$options->laminate && $options->laminate != 'none') $spec['laminate'] = "Laminasi: ".$options->laminate;
            if (@$options->finish) $spec['finish'] = "Finishing: ".$options->finish;
            if(@$options->finishing){
                $spec['finishing'] = "";
                foreach($options->finishing as $val){
                    $spec['finishing'] .= $val. "<br/>";
                }
            }
            if (@$options->speed) {
                if (strpos($options->speed, 'fast') !== false) $spec['speed'] = "Speed: Fast";
                if (strpos($options->speed, 'same') !== false) $spec['speed'] = "Speed: Same Day";
                if (strpos($options->speed, 'standar') !== false) $spec['speed'] = "Speed: Standar";
            }
            if (@$orderDetail->project_data->design_file) {
                $idx = 0;
                foreach ($orderDetail->project_data->design_file as $key => $val) {
                    if ($key === 'email') {
                        $spec['design_file'] = "File sent: By email";
                    } else {
                        if ($idx == 0) {
                            $spec['design_file'] .= "File sent: <br/>";
                        } else {
                            $spec['design_file'] .= "<a>" . substr($val, 0, 29) . "</a><br/>";
                        }
                    }
                    $idx++;
                }
            }
            if(@$orderDetail->project_data && in_array($product, array('canvastotebag','spunboundtotebag','spunbond_tote')) && @$options->qtySizeMap){
                $spec['qtySizeMap'] = "Quantity: <br/>";
                foreach($options->qtySizeMap as $key=>$val){
                    if($val['qty'] != 0){
                        $spec['qtySizeMap'] .= $val['color']." ".$val['size'].", ".$val['qty']."<br/>";
                    }
                }
            }
        }

        //spanduk
        if($product == "spanduk"){
            if (@$options->quantity) $spec['quantity'] = $options->quantity." x ".($orderDetail->project_data->display_name?:$orderDetail->project_data->prod);
            if(@$options->paper){
                if(@$orderDetail->projec_data->properties->Kertas){
                    $spec['paper'] = "Material: " . $orderDetail->projec_data->properties->Kertas;
                }else{
                    $spec['paper'] = "Material: " . $options->paper;
                }
            }
            if (@$options->material) $spec['material'] = "Material: ".$options->material;
            if (@$options->width && $options->width > 0) $spec['width'] = "Width: ".$options->width. " cm";
            if (@$options->height && $options->height > 0) $spec['height'] = "Height: ".$options->height. " cm";
            if (@$options->size_index && $options->size_index != 'custom') $spec['size_index'] = "Size Index: ".$options->size_index. " cm";
            if (@$options->speed) {
                if (strpos($options->speed, 'fast') !== false) $spec['speed'] = "Speed: Fast";
                if (strpos($options->speed, 'same') !== false) $spec['speed'] = "Speed: Same Day";
                if (strpos($options->speed, 'standar') !== false) $spec['speed'] = "Speed: Standar";
            }
            if (@$orderDetail->project_data->design_file) {
                $idx = 0;
                foreach ($orderDetail->project_data->design_file as $key => $val) {
                    if ($key === 'email') {
                        $spec['design_file'] = "File sent: By email";
                    } else {
                        if ($idx == 0) {
                            $spec['design_file'] .= "File sent: <br/>";
                        } else {
                            $spec['design_file'] .= "<a>" . substr($val, 0, 29) . "</a><br/>";
                        }
                    }
                    $idx++;
                }
            }
        }

        //others
        if(!in_array($product, array('spanduk','banner','xbanner','rollupbanner','tripodbanner','eventbackwall','eventdesk','popuptable','popupstand','canvastotebag','spunboundtotebag','spunbond_tote','greetingcard','thankyoucard','voucher','stampcard','companyfolder','sticker','canvas_tote','loyaltycard','tshirt','poloshirt','flyer','letterhead','poster','envelope','calendar','brochure','businesscard','squarecard'))){
            if (@$product) $spec['prod'] = "Product: ".$this->specFilter($product);
            if (@$properties) {
                $spec['properties'] = '';
                foreach($properties as $key=>$val){
                    if(is_array($val)){
                        foreach($val as $key2=>$val2){
                            $spec['properties'].= $this->specFilter($key)." : ".$this->specFilter($val2);
                        }
                    }else{
                        $spec['properties'].= $key." : ".$this->specFilter($val);
                    }
                }
            }else{
                $spec['properties'] = '';
                foreach($options as $key=>$val){
                    if(is_array($val)){
                        foreach($val as $key2=>$val2){
                            $spec['properties'].= $this->specFilter($key)." : ".$this->specFilter($val2);
                        }
                    }elseif(!in_array($key, array('pro_product_id','pro_product_title','quantity','prod'))){
                        $spec['properties'].= $key." : ".$this->specFilter($val);
                    }
                }
            }
            if (@$orderDetail->project_data->design_file) {
                $spec['design_file'] = "";
                foreach ($orderDetail->project_data->design_file as $key => $val) {
                    $spec['design_file'] .= "<a href='".$this->createUrl($val)."' style='word-wrap: break-word;'>".substr($val,0,30)."</a><br/>";
                }
            }
        }

        return $spec;
    }

    function createUrl($value){
        $temp = parse_url($value);
        $url = $value;
        if(isset($temp['scheme']) && $temp['schema'] != 'https'){
            $url = "http://".$url;
        }
        return $url;
    }

    function specFilter($spec){
        $custSpec = '';
        if (empty($spec)){
            $custSpec = '';
        } else if($spec == 'rollup60' || $spec == 'xbanner60') {
            $custSpec = '60 x 160 cm';
        } else if($spec == 'xbanner25') {
            $custSpec = '25 x 45 cm';
        } else if($spec == 'rollup85') {
            $custSpec = '85 x 200 cm';
        } else if($spec == 'printonly') {
            $custSpec = 'Print Only';
        } else if($spec == 'printleg') {
            $custSpec = 'Print + Leg';
        } else if($spec == 'wallwhite' || $spec == 'deskwhite') {
            $custSpec = 'White';
        } else if($spec == 'wallblack' || $spec == 'deskblack') {
            $custSpec = 'Black';
        }
        return $custSpec;
    }
}
