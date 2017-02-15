<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am in the current directory
     */
    public function iAmInTheCurrentDirectory()
        // Nothing to do here really
    {
    }

    /**
     * @When I run :command
     */
    public function iRun($command)
    {
        if( !file_exists( $command ) )
        {
            throw new Exception( "The command {$command} does not exist" );
        }
        
        exec( $command, $output );
        $this->output = trim( implode( "\n", $output));
    }

    /**
     * @Then I should get:
     */
    public function iShouldGet(PyStringNode $string)
    {
        if( (string)$string !== $this->output )
        {
            throw new Exception( "Actual output is:\n" . $this->output );
        }
    }

}
