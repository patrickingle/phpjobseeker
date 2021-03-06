<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php' ;
require_once 'Libs/autoload.php' ;

class Framework_PJSTestSeries0012CheckSummary extends PHPUnit_Extensions_SeleniumTestCase
{

    /** @var TL_PageWrapperChecks */
	private $_PWC ;
	/** @var TL_Config */
	private $_TLC ;

    function setUp()
    {
    	$this->_PWC = new TL_PageWrapperChecks( $this ) ;
    	$this->_TLC = new TL_Config() ;
        $this->setBrowser( $this->_TLC->browser ) ;
        $this->setBrowserUrl( $this->_TLC->browserRoot ) ;
    }

    /**
     * @todo Finish this
     * Enter description here ...
     */
    function testSummaryLinks()
    {
        $this->open( $this->_TLC->browserDir ) ;
        $this->waitForPageToLoad( $this->_TLC->maxWaitTime ) ;
        $this->_PWC->checkHeaderIsLoaded( $this, 'index' ) ;
        $this->_PWC->checkFooterIsLoaded( $this, 'index' ) ;
    }

    function reportNewError( $errMsg ) {
        $this->verificationErrors[] = $errMsg ;
    }

}
