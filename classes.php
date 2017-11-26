<?php
/************
 * Класс Машина
 *      Описывается определенная модель определенной марки,
 * например Aston Martin Rapide S
 * Свойства:
 *      1) Текущая скорость
 *      2) Текущее положение в пространстве
 *      3) Статус двигателя (заведен \ заглушен)
 *
 *      Обязательные:
 *      4) Владелец
 *      5) Цвет
 *      6) Год выпуска конкретного автомобиля
 * Константы:
 *      1) Максимальная скорость
 *      2) Количество пассажиров
 * Методы:
 *      1) Завести двигатель
 *      2) Заглушить двигатель
 *      3) Нажать педаль газа
 *      4) Нажать педаль тормоза
 *      5) Продать машину (сменить владельца)
 ************/
class Car
{
  private $current_speed = 0;
  private $current_position = array('x' => 0, 'y' => 0);
  private $engine_started = false;
  private $passangers = array();

  const Max_passangers = 4;
  const Max_speed = 250;

  private $owner;
  private $colour;
  private $year;

  function __construct($owner, $colour='Белый'){
    $this->owner = $owner;
    $this->colour = $colour;
    $this->year = date("Y");
  }

  public function StartEngine(){
    $this->engine_started = true;
    echo "Двигатель завелся<br>";
  }

  public function StopEngine(){
    $this->engine_started = false;
    echo "Двигатель заглушен<br>";
  }

  public function Accelerate(){
    if($this->engine_started && $this->current_speed < self::Max_speed){
      $this->current_speed += 10;
      $this->current_position['x'] += 10;
      $this->current_position['y'] += 5;
    }
    elseif ($this->current_speed === self::Max_speed) {
      echo "Нельзя ехать еще быстрее. Это максимальная скорость.<br>";
    }
    else {
      echo "Сначала нужно завести машину.<br>";
    }
  }

  public function SlowDown(){
    if($this->engine_started && $this->current_speed > 0){
      $this->current_speed -= 10;
      $this->current_position['x'] -= 10;
      $this->current_position['y'] -= 5;
    }
    else {
      echo "Ничего не произошло. Машина и так никуда не двигалась.<br>";
    }
  }

  public function SellCar($new_owner){
      $this->owner = $new_owner;
      echo "Новый владелец - ".$new_owner."<br>";
  }

  public function GetPassanger($new_passanger){
    if (count($this->passangers)<self::Max_passangers){
      $this->passangers[] = $new_passanger;
    }
    else {
      echo "Свободных мест нет<br>";
    }
  }
}

echo "Автомобили:<br>";
$first_aston = new Car('Михаил', 'Черный');
$first_aston->StartEngine();
$first_aston->Accelerate();
$first_aston->SellCar('Андрей');

$second_aston = new Car('Игорь');
$second_aston->StopEngine();

echo "--------------------<br>";

/************
 * Класс Телевизор
 * Свойства:
 *      1) Количество каналов
 *      2) Текущий канал
 *      3) Текущая громкость
 *      4) Текущее состояние (вкл \ выкл)
 *
 *      Обязательные:
 *      5) Диагональ
 *      6) Разрешение
 *      7) Год выпуска
 * Константа:
 *      - Максимальная громкость
 * Методы:
 *      1) Включить телевизор
 *      2) Выключить телевизор
 *      3) Переключить канал на следующий
 *      4) Переключить канал на предыдущий
 *      5) Прибавить громкость
 *      6) Убавить громкость
 *      7) Обновить список каналов
 ************/
 class TV
 {
   private $count_channels = 10;
   private $current_channel = 1;
   private $turned_on = false;
   private $current_volume = 5;
   private $screen_size;
   private $resolution;
   private $year;

   const max_volume = 100;

   function __construct($screen_size, $resolution){
     $this->screen_size = $screen_size;
     $this->resolution = $resolution;
     $this->year = date("Y");
   }

   public function TurnOn(){
     $this->turned_on = true;
     echo "TV включен<br>";
   }

   public function TurnOff(){
     $this->engine_started = false;
     echo "TV выключен<br>";
   }

   public function NextChannel(){
     if($this->turned_on && $this->current_channel < $this->count_channels){
       $this->current_channel += 1;
     }
     elseif ($this->current_speed === $this->count_channels) {
       $this->current_channel = 1;
     }
     else {
       echo "Сначала нужно включить телевизор.<br>";
       break;
     }
     echo "Текущий канал - ".$this->current_channel."<br>";
   }

   public function PreviousCannel(){
     if($this->turned_on && $this->current_channel > 1){
       $this->current_channel -= 1;
     }
     elseif ($this->current_speed === 1) {
       $this->current_channel = $this->count_channels;
     }
     else {
       echo "Сначала нужно включить телевизор.<br>";
       break;
     }
     echo "Текущий канал - ".$this->current_channel."<br>";
   }

   public function VolumeUp(){
     if($this->turned_on && $this->current_volume < self::max_volume){
       $this->current_volume += 1;
       echo "Текущая громкость - ".$this->current_volume."<br>";
     }
     elseif ($this->current_volume === self::max_volume) {
       echo "Максимальная громкость.<br>";
     }
     else {
       echo "Сначала нужно включить телевизор.<br>";
     }
   }

   public function VolumeDown(){
     if($this->turned_on && $this->current_volume > 0){
       $this->current_volume -= 1;
       echo "Текущая громкость - ".$this->current_volume."<br>";
     }
     elseif ($this->current_volume === 0) {
       echo "Звук выключен.<br>";
     }
     else {
       echo "Сначала нужно включить телевизор.<br>";
     }
   }

   public function GetNewChannels(){
     $this->count_channels += rand(0,10);
     echo "Всего каналов - ".$this->count_channels."<br>";
   }
 }

echo "Телевизоры:<br>";
$TV_one = new TV(40, "FullHD");
$TV_two = new TV(22, "HD");

$TV_one->TurnOn();
$TV_one->GetNewChannels();
$TV_one->VolumeUp();

echo "--------------------<br>";

 /************
  * Класс Шариковая ручка
  * Свойства:
  *      1) Количество оставшихся чернил (в %)
  *      Обязательные:
  *      2) Цвет чернил
  * Методы:
  *      1) Написать что-то
  *      2) Заменить стержень
  ************/
class Pen
{
  private $ink_left;
  private $ink_colour;
  function __construct($ink_colour='blue'){
    $this->ink_colour = $ink_colour;
    $this->ink_left = 100;
  }

  public function Write($text){
    $ink_needed = round(strlen($text)/10);
    if ($ink_needed <= $this->ink_left) {
      echo "<font color=\"".$this->ink_colour."\">$text</font><br>";
      $this->ink_left -= $ink_needed;
    }
    else {
      echo "Чернил больше нет. Необходимо заменить стержень.<br>";
    }
  }

  public function FillInk(){
    $this->ink_left = 100;
  }
}

echo "Ручки:<br>";
$pen_one = new Pen();
$pen_two = new Pen('black');
$pen_one->Write('Hello world');

echo "--------------------<br>";

/************
 * Класс Утка
 * Свойства:
 *      1) Голод (в %, где 100 - утка умирает с голоду, а 0 - полностью сытая утка)
 *      2) Текущее положение в 3-х мерном пространстве
 *      3) Возраст
 * Методы:
 *      1) Переместиться в новое место
 *      2) Поесть
 *      3) Крякнуть
 * Внутренний метод:
 *      1) Сгенерировать рандомную координату
 ************/
class Duck
{
 private $hunger = 0;
 private $position = array(
                    'x' => 0,
                    'y' => 0,
                    'z' => 0);
 private $age;

 private function GetRandCoord(){
   $destination = (rand(0,1) == 0)?1:-1;
   return $destination*rand(0,200);
 }

  public function RandTravel(){
   $this->position['x'] = $this->GetRandCoord();
   $this->position['y'] = $this->GetRandCoord();
   $this->position['z'] = abs($this->GetRandCoord());// так как утка не может уйти под землю
   var_dump($this->position);
   echo "<br>";
   $this->hunger += rand(5,15);
 }

 function __construct($age){
   $this->age = $age;
   $this->RandTravel();
 }

 public function Quack(){
   echo "Кря-кря-кря<br>";
 }

 public function Eat(){
   $food = rand(0,35);
   if ($this->hunger > $food){
     $this->hunger -= $food;
   }
  else {
    $this->hunger = 0;
  }
  echo 'Голод утки - '.$this->hunger;
 }
}


echo "Утки:<br>";
echo "Перемещения первой утки:<br>";
$first_duck = new Duck(7);
$first_duck->RandTravel();

echo "Перемещения второй утки:<br>";
$second_duck = new Duck(15);
$second_duck->Quack();

echo "--------------------<br>";

/************
 * Класс Товар
 * Свойства:
 *      1) Скидка
 *      Обязательные:
 *      2) ID товара
 *      3) Наименование
 *      4) Стоимость
 *      5) Категория
 * Методы:
 *      1) Получить стоимость
 *      2) Получить стоимость с учетом скидки
 ************/
class Product
{
 private static $id = 0;
 private $name;
 private $price;
 private $category;
 private $discount;

 function __construct($name, $price, $category, $discount=0){
   self::$id+=1;
   $this->name = $name;
   $this->price = $price;
   $this->category = $category;
   $this->discount = $discount;
 }

 public function GetPrice(){
   echo "Стоимость $this->name = $this->price<br>";
 }

 public function GetDiscountPrice(){
   echo "Стоимость $this->name со скидкой = ".($this->price - ($this->price*$this->discount/100))."<br>";
 }
}

echo "Товары:<br>";
$first_product = new Product('Iphone X', 95000, 'Телефоны');
$first_product->GetPrice();
$second_product = new Product('Холодильник', 45000, 'Холодильники', 5);
$second_product->GetDiscountPrice();
