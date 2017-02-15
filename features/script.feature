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