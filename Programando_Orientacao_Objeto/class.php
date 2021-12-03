<?php

abstract class Lesson {

    private $costStrategy, $duration;

    function __construct(CostStrategy $strategy, $duration) {
        $this->duration = $duration;
        $this->costStrategy = $strategy;
    }

    function cost() {
        /* switch ($this->costtype) {
          case self::TIMED:
          return (5 * $this->duration);
          break;
          case self::FIXED:
          return 30;
          break;
          default :
          }
          $this->costtype = self::FIXED;
          return 30; */

        return $this->costStrategy->cost($this);
    }

    function chargeType() {
        /* switch ($this->costtype) {
          case self::TIMED:
          return 'taxa horária!';
          break;
          case self::FIXED:
          return 'taxa fixa!';
          break;
          default :
          $this->costtype = self::FIXED;
          return 'taxa fixa!';
          } */
        return $this->costStrategy->chargeType();
    }

    function getDuration() {
        return $this->duration;
    }

}

class Lecture extends Lesson {
    
}

class Seminar extends Lesson {
    
}

abstract class CostStratety {

    abstract function cost(Lesson $lesson);

    abstract function chargeType();
}

class TimedCostStrategy extends CostStratety {

    function cost(Lesson $lesson) {
        return ($lesson->getDuration() * 5);
    }

    function chargeType() {
        return 'taxa horaria!';
    }

}

class FixedCoststrategy extends CostStratety {

    function cost(Lesson $lesson) {
        return 30;
    }

    function chargeType() {
        return 'taxa fixa';
    }

}

/*$lecture = new Lecture(5, Lesson::FIXED);
print "{$lecture->cost()} ({$lecture->chargeType()})<br />";

$seminar = new Seminar(3, Lesson::TIMED);
print "{$seminar->cost()} ({$seminar->chargeType()})<br />";*/

$lessons[] = new Seminar(new TimedCostStrategy(), 4);
$lessons[] = new Lecture(new FixedCoststrategy(), 4);

foreach ($lessons as $lesson) {
    print "Alterando lição {$lesson->cost()}. ";
    print "Alterando tipo: {$lesson->chargeType()} <br />";
}
