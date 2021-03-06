<?php

class TL_PageWrapperChecks {

	/** @var TL_Config */
	private static $_TLC = null ;
	/** @var PHPUnit_Extensions_SeleniumTestCase */
	private $_selTC = null ;

	/**
	 * 
	 * Class constructor
	 * @param PHPUnit_Extensions_SeleniumTestCase $selTC
	 * @throws Exception
	 */
	public function __construct( $selTC = null ) {
		if  ( ( ! isset( $selTC ) )
		   || ( ! $selTC instanceof PHPUnit_Extensions_SeleniumTestCase )
		    ) {
			throw new Exception( "Improper construct." ) ;
		}
		$this->_selTC = $selTC ;
		// Use cached TL_Config since it doesn't change.
		if ( ! isset( self::$_TLC ) ) {
			self::$_TLC = new TL_Config() ;
		}
	}

	/**
	 *
	 * Check that a stack trace is not present.
	 * @param PHPUnit_Extensions_SeleniumTestCase $selTC
	 * @param String $label
	 */
	public function checkForStackTrace( $label = '' ) {
	    try {
	        $this->_selTC->assertTextNotPresent( 'Call Stack' ) ;
		} catch ( PHPUnit_Framework_AssertionFailedError $e ) {
			$this->_selTC->reportNewError( "Stack traces ($label): " . $e->toString() ) ;
	    }
	}

	/**
	 *
	 * Check that the page footer is loaded.
	 * @param PHPUnit_Extensions_SeleniumTestCase $selTC
	 * @param String $label
	 */
	public function checkFooterIsLoaded( $label = '' ) {
		try {
			$this->_selTC->assertTextPresent( 'Want your own copy of this tool?' ) ;
		} catch ( PHPUnit_Framework_AssertionFailedError $e ) {
			$this->_selTC->reportNewError( "Checking footer ($label): " . $e->toString() ) ;
		}
	}

	/**
	 *
	 * Check that the page header is loaded.
	 * @param PHPUnit_Extensions_SeleniumTestCase $selTC
	 * @param String $label
	 * @todo  Verify that the search function is available.
	 */
	public function checkHeaderIsLoaded( $label = '' ) {
		try {
			$this->_selTC->assertTextNotPresent( 'PHP Stack Trace' ) ;
		} catch ( PHPUnit_Framework_AssertionFailedError $e ) {
			$this->_selTC->reportNewError( "Checking header ($label): " . $e->toString() ) ;
		}
		try {
			$this->_selTC->assertTextPresent( self::$_TLC->pageTitle ) ;
		} catch ( PHPUnit_Framework_AssertionFailedError $e ) {
			$this->_selTC->reportNewError( "Checking header ($label): " . $e->toString() ) ;
		}
		foreach ( self::$_TLC->headerLabels as $label ) {
			try {
				$this->_selTC->assertTextPresent( $label ) ;
			} catch ( PHPUnit_Framework_AssertionFailedError $e ) {
				$this->_selTC->reportNewError( "Checking header ($label): " . $e->toString() ) ;
			}
		}
        $buttons = $this->_selTC->getAllButtons() ;
//                var_dump( $buttons ) ;
	}
}
