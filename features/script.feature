Feature: script
  In order to sum the contents of a file
  As a CLI user
  I need to be able to generate a sum of a files contents

  Scenario: Run the script without any parameters displays help message
    Given I am in the current directory
    When I run "php app/script.php"
    Then I should get:
    """
    SUMMARY
        script.php -- Sums up an input file.

    USAGE
        script.php [<arg1>]

    DESCRIPTION
        Reads the input file and sums up all the values found within.  The output
        is sent to either stdout or the specified output file.

        Supported input formats are csv,xml,yml

    OPTIONS
        --input=<value>
            The input file to be read in.

        --output=<value>
            The target file to output the result to.
    """

  Scenario: Run the script with a non-existing input filepath - no parameter indicator
    Given I am in the current directory
    When I run "php app/script.php data/missingFile"
    Then I should get:
    """
    The specified input file does not exist
    """

  Scenario: Run the script with a non-existing input filepath - with parameter indicator
    Given I am in the current directory
    When I run "php app/script.php --input=data/missingFile"
    Then I should get:
    """
    The specified input file does not exist
    """

  Scenario: Run the script with a CSV input w/o output should write to stdio
    Given I am in the current directory
    When I run "php app/script.php --input=data/file.csv"
    Then I should get:
    """
    1000
    """

  Scenario: Run the script with a CSV input and output to a file
    Given I am in the current directory
    When I run "php app/script.php --input=data/file.csv --output=output/result.txt"
    Then I should get:
    """
    The result is in output/result.txt
    """
    And the file "output/result.txt" should contain 1000

  Scenario: Outputting to an existing file should replace the contents
    Given I am in the current directory
    And the file "output/result.txt" is random
    When I run "php app/script.php --input=data/file.csv --output=output/result.txt"
    Then I should get:
    """
    The result is in output/result.txt
    """
    And the file "output/result.txt" should contain 1000

  Scenario: Outputting to the same file as the input isn't allowed
    Given I am in the current directory
    When I run "php app/script.php --input=data/file.csv --output=data/file.csv"
    Then I should get:
    """
    The specified output file cannot be the same as the input
    """
    And the file "data/file.csv" should not contain 1000

  Scenario: Run the script with a YML input w/o output should write to stdio
    Given I am in the current directory
    When I run "php app/script.php --input=data/file.yml"
    Then I should get:
    """
    1000
    """

  Scenario: Run the script with a YML input and output to a file
    Given I am in the current directory
    When I run "php app/script.php --input=data/file.yml --output=output/result.txt"
    Then I should get:
    """
    The result is in output/result.txt
    """
    And the file "output/result.txt" should contain 1000

  Scenario: Run the script with a xml input w/o output should write to stdio
    Given I am in the current directory
    When I run "php app/script.php --input=data/file.xml"
    Then I should get:
    """
    1000
    """

  Scenario: Run the script with a xml input and output to a file
    Given I am in the current directory
    When I run "php app/script.php --input=data/file.xml --output=output/result.txt"
    Then I should get:
    """
    The result is in output/result.txt
    """
    And the file "output/result.txt" should contain 1000

  Scenario: Running the script with an unsupported file type warns the user
    Given I am in the current directory
    When I run "php app/script.php --input=data/badFileType.txt"
    Then I should get:
    """
    The specified input file is not a supported file type: txt
    """
