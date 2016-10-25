<?php

/**
 * PHP Class to get the current and future weather conditions
 * Created by: Tonmoy Nandy
 */
class Weather
{
        protected $apiId = "77d5a352398092afa57ceb6fc880623d";
        protected $url   = "http://api.openweathermap.org/data/2.5/";
        
        protected function _content($field,$type=''){
            $url_type = '';
            switch($type){
                case "forecast":
                    $url_type = 'forecast';
                    break;
                default:
                    $url_type = 'weather';
                    break;
            }
                $field_data = array('appid'=>$this->apiId);
                $field_data = array_merge($field,$field_data);
                $query_string = http_build_query($field_data);
                
                $url = $this->url.$url_type.'?'.$query_string;
                $content = file_get_contents($url);
	        $content = json_decode($content);
		
                return $content;
        }
        public function _temperature($temp,$type='c'){
            if($temp){
                $temperature = $temp;
                switch($type){
                    case "c":
                        $temperature = ($temperature - 273.15);
                        
                        break;
                    case "f":
                        $temperature = ($temperature - 273.15); // c temp
                        $temperature = ($temperature * 9/5)+32;
                        break;
                }
                $temperature = number_format($temperature,2);
                return $temperature;
            }
            return false;
        }
	public function _location($lat,$lng){
            if($lat && $lng){
                $field = array('lat'=>$lat,'lon'=>$lng);
                $content = $this->_content($field);
                //return $content; 
                $location = array(
                             'id'           =>  $content->id,
                             'city_name'    =>  $content->name,
                             'coord'        =>  $content->coord,
                             );
                return $location;
            }
            return false;
        }
        
        public function getCurrentWeather($lat,$lng,$type='c'){
            if($lat && $lng){
                $field = array('lat'=>$lat,'lon'=>$lng);
               $content = $this->_content($field,'');
               //$this->pr($content);
               $weather = array();
               if($content){
                 $content->main->temp = $this->_temperature($content->main->temp,$type);
                 $content->main->temp_min = $this->_temperature($content->main->temp_min,$type);
                 $content->main->temp_max = $this->_temperature($content->main->temp_max,$type);
                 $content->sys->sunrise = date('h:i A',$content->sys->sunrise);
                 $content->sys->sunset = date('h:i A',$content->sys->sunset);
               }
               return $content;
            }
            return false;
        }
        
        public function getforecastWeather($lat,$lng,$type='c'){
            if($lat && $lng){
	       $result = array();
               $field = array('lat'=>$lat,'lon'=>$lng);
               $content = $this->_content($field,'forecast');
	       if(property_exists($content,'list')){
		foreach($content->list as $c){
		   $date = date('Y-m-d',$c->dt);
		   $result[ $date ][] = $c;
		}
	       }
              //$this->pr($content);
              return $result;
            }
            return false;
        }
        
        public function forcastGraphData($lat,$lng,$type='c'){
             $arr = array();
            if($lat && $lng){
                $field = array('lat'=>$lat,'lon'=>$lng);
               $content = $this->_content($field,'forecast');
              
               if(property_exists($content,'list')){
                 foreach($content->list as $l){
                    $date = date('Y-m-d',$l->dt);
                    $arr[$date]['temp'] = round($this->_temperature($l->main->temp_max,$type));
                    $arr[$date]['humidity'] = $l->main->humidity;
                    $arr[$date]['clouds'] = $l->clouds->all;
                 }
               }
             
              return $arr;
            }
            return false;
        }
       
        
        public function getWindAngleIcon($deg){
            $deg = round($deg);
            $icon ='';
            if($deg>=0 && $deg<=22){
                $icon = 'wi-wind towards-0-deg';
            }
            elseif($deg>=23 && $deg<=44){
                $icon = 'wi-wind towards-23-deg';
            }
            elseif($deg>=45 && $deg<=67){
                $icon = 'wi-wind towards-45-deg';
            }
            elseif($deg>=68 && $deg<=89){
                $icon = 'wi-wind towards-68-deg';
            }
            elseif($deg>=90 && $deg<=112){
                $icon = 'wi-wind towards-90-deg';
            }
            elseif($deg>=113 && $deg<=134){
                $icon = 'wi-wind towards-113-deg';
            }
            elseif($deg>=135 && $deg<=157){
                $icon = 'wi-wind towards-135-deg';
            }
            elseif($deg>=158 && $deg<=179){
                $icon = 'wi-wind towards-158-deg';
            }
            elseif($deg>=180 && $deg<=202){
                $icon = 'wi-wind towards-180-deg';
            }
            elseif($deg>=203 && $deg<=224){
                $icon = 'wi-wind towards-203-deg';
            }
            elseif($deg>=248 && $deg<=269){
                $icon = 'wi-wind towards-248-deg';
            }
            elseif($deg>=270 && $deg<=292){
                $icon = 'wi-wind towards-270-deg';
            }
            elseif($deg>=293 && $deg<=312){
                $icon = 'wi-wind towards-293-deg';
            }
            elseif($deg>=313 && $deg<=335){
                $icon = 'wi-wind towards-313-deg';
            }
            elseif($deg>=336){
                $icon = 'wi-wind towards-336-deg';
            }
            return $icon;
            
        }
        public function pr($arr,$s=1){
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
            if($s == 1){
             die;   
            }
        }
}
?>