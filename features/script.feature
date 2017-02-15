Feature: script
  In order to sum the contents of a file
  As a CLI user
  I need to be able to generate a sum of a files contents

Scenario: Run the script without any parameters
  Given I am in the current directory
  When I run "php app/script.php"
  Then I should get:
    """
    You must provide at least one parameter
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
