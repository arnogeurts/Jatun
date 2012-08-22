<?php

namespace Jatun\SymfonyBundle\Twig\Extension;

use Jatun\Environment;

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
     * Constructor
     * Inject the Jatun environment
     * 
     * @param JatunEnvironment $jatunEnv 
     */
    public function __construct(Environment $env) 
    {
        $this->env = $env;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'jatun' => new \Twig_Function_Method($this, 'jatun', array('is_safe' => array('html'))),
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
        return $this->env->parse($data);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'jatun';
    }
}

?>
