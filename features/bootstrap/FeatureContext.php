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
    {
        // Nothing to do here really
    }

    /**
     * @When I run :command
     */
    public function iRun($command)
    {
        $explodedCommand = explode(' ', $command);
        if (!file_exists($explodedCommand[1])) {
            throw new Exception("The command {$command} does not exist");
        }

        exec($command, $output);
        $this->output = trim(implode("\n", $output));
    }

    /**
     * @Then I should get:
     */
    public function iShouldGet(PyStringNode $string)
    {
        if ((string)$string !== $this->output) {
            throw new Exception("Actual output is:\n" . $this->output);
        }
    }

    /**
     * @Then the file :outputFile should contain :result
     */
    public function theFileShouldContain($outputFile, $result)
    {
        if (!file_exists($outputFile)) {
            throw new Exception("The output file $outputFile does not exist");
        }

        $handler = fopen($outputFile, 'r');
        $fileResult = fgets($handler);
        fclose($handler);

        if ($fileResult != $result) {
            throw new Exception("Actual output is:\n" . $fileResult);
        }
    }

    /**
     * @Then the file :outputFile should not contain :result
     */
    public function theFileShouldNotContain($outputFile, $result)
    {
        $handler = fopen($outputFile, 'r');
        $fileResult = fgets($handler);
        fclose($handler);

        if ($fileResult == $result) {
            throw new Exception("Actual output is:\n" . $fileResult);
        }
    }

    /**
     * @Given the file :targetFile is random
     */
    public function theFileIsRandom($targetFile)
    {
        $fileInfo = pathinfo($targetFile);
        if (!file_exists($fileInfo['dirname'])) {
            mkdir($fileInfo['dirname'], 0777, true);
        }

        $handler = fopen($targetFile, 'w');
        fputs($handler, bin2hex(openssl_random_pseudo_bytes(10)));
        fclose($handler);
    }
}
