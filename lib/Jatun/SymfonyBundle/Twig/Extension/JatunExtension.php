<?php

namespace Jatun\SymfonyBundle\Twig\Extension;


use Jatun\Event;
use Jatun\EventList;
use Jatun\Environment;
use Jatun\Codec\CodecInterface;

/**
 * Description of Jatun
 *
 * @author arno
 */
class JatunExtension extends \Twig_Extension
{
    /**
     * The Jatun environment
     * @var Environment
     */
    protected $env;
    
    /**
     * The response codec
     * @var CodecInterface
     */
    protected $codec;
    
    /**
     * Constructor
     * Inject the Jatun environment
     * 
     * @param JatunEnvironment $jatunEnv 
     */
    public function __construct(Environment $env, CodecInterface $codec) 
    {
        $this->env = $env;
        $this->codec = $codec;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'jatun'      => new \Twig_Function_Method($this, 'jatun', array('is_safe' => array('html'))),
            'jatun_core' => new \Twig_Function_Method($this, 'jatunCore', array('is_safe' => array('html'))),
        );
    }
    
    /**
     * Return a jatun event
     * 
     * @param type $event
     * @param type $arguments
     * @return JatunEvent 
     */
    public function jatun(array $data = array())
    {
        $list = new EventList();
        foreach ($data as $event => $arguments) {
            $this->handle($event, $arguments, $list);
        }
        
        return $this->env->createResponse($list);
    }
    
    /**
     * Handle and event with the arguments
     * 
     * @param string $event
     * @param array $arguments
     * @param EventList $list
     */
    private function handle($event, $arguments, EventList $list)
    {
        switch ($event) {
            case 'load':
                $this->load($arguments, $list);
                break;
            default:
                $this->addEvent($event, $arguments, $list);
        }
    }
    
    /**
     * Add an event with an array of arguments or an array of argument arrays
     * 
     * @param string $event
     * @param array $arguments
     * @param EventList $list
     */
    private function addEvent($event, $arguments, EventList $list)
    {
        if (count(array_filter(array_keys($arguments), 'is_string'))) {
            $list->add(new Event($event, $arguments));
        } else {
            foreach ($arguments as $args) {
                $list->add(new Event($event, $args));
            }
        }
    }
    
    /**
     * Load a event list string
     * 
     * @param string $string
     * @param EventList $list
     */
    private function load($string, EventList $list) 
    {
        if (is_array($string)) {
            foreach($string as $str) {
                $this->load($str, $list);
            }
        } else {
            $newList = $this->codec->decode($string);
            $list->merge($newList);
        }
    }
    
    /**
     * Dump the javascript for the jatun core
     * 
     * @return string
     */
    public function jatunCore()
    {
        return $this->env->createJavascript();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'jatun';
    }
}
